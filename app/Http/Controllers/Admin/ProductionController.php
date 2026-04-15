<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddItem;
use App\Models\Production;
use App\Models\FinishedGood;
use App\Models\ProductionRawMaterial;
use App\Models\CurrentStock;
use App\Models\PartyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $productions = Production::with([
                'template',
                'finishedGoods',
                'rawMaterials',
                'party',
            ])
            ->latest()
            ->get();

        return view('admin.productions.index', compact('productions'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $templates = AddItem::where('product_type', 'finished_goods')
            ->with(['rawMaterials', 'select_tax', 'select_unit'])
            ->get()
            ->map(fn($item) => $this->formatTemplate($item))
            ->values()
            ->toArray();

        $parties = PartyDetail::where('status', 'enable')
            ->select('id', 'party_name', 'phone_number')
            ->orderBy('party_name')
            ->get();

        return view('admin.productions.create', compact('templates', 'parties'));
    }

    /*
    |--------------------------------------------------------------------------
    | STOCK CHECK API — called via AJAX before finalising qty
    |--------------------------------------------------------------------------
    */
    public function checkStock(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:add_items,id',
            'qty'         => 'required|integer|min:1',
        ]);

        $template = AddItem::with(['rawMaterials.select_unit'])->findOrFail($request->template_id);
        $qty      = (int) $request->qty;

        $issues    = [];
        $maxUnits  = PHP_INT_MAX;
        $stockData = [];

        foreach ($template->rawMaterials as $rm) {

            $pivotQty  = floatval($rm->pivot->qty ?? 0);
            $needed    = $pivotQty * $qty;

            $available = CurrentStock::where('item_id', $rm->id)
                ->sum('qty');

            $stockData[] = [
                'material'  => $rm->item_name,
                'available' => (float) $available,
                'unit'      => optional($rm->select_unit)->base_unit ?? 'pcs',
            ];

            if ($available < $needed) {
                $maxPossible = $pivotQty > 0 ? floor($available / $pivotQty) : 0;
                $maxUnits    = min($maxUnits, (int) $maxPossible);

                $issues[] = [
                    'material'  => $rm->item_name,
                    'needed'    => (float) $needed,
                    'available' => (float) $available,
                    'unit'      => optional($rm->select_unit)->base_unit ?? 'pcs',
                    'max_units' => (int) $maxPossible,
                ];
            }
        }

        if (empty($issues)) {
            return response()->json([
                'ok'        => true,
                'max_units' => $qty,
                'issues'    => [],
                'stock'     => $stockData,
            ]);
        }

        return response()->json([
            'ok'        => false,
            'max_units' => $maxUnits === PHP_INT_MAX ? 0 : $maxUnits,
            'issues'    => $issues,
            'stock'     => $stockData,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'add_item_template_id'  => 'required|exists:add_items,id',
            'finished_qty'          => 'required|integer|min:1',
            'party_id'              => 'nullable|exists:party_details,id',
            'warehouse_location'    => 'required|string|max:255',  // ← global warehouse
            'goods'                 => 'required|array|min:1',
            'goods.*.sale_price'    => 'required|numeric|min:0',
            'goods.*.buyer_code'    => 'nullable|string|max:255',
            'goods.*.serial_no'     => 'nullable|string|max:255',
            'goods.*.batch_no'      => 'nullable|string|max:100',  // ← new
            'goods.*.notes'         => 'nullable|string|max:1000', // ← new
            'goods.*.tax_percent'   => 'nullable|numeric|min:0',
            'goods.*.sale_mode'     => 'required|in:exclusive,inclusive,export',
        ]);

        DB::transaction(function () use ($request) {

            $template = AddItem::with(['rawMaterials', 'select_tax'])
                ->findOrFail($request->add_item_template_id);

            $referenceNo      = 'PROD-' . strtoupper(uniqid());
            $batchNo          = 'BATCH-' . date('YmdHis');
            $qty              = (int) $request->finished_qty;
            $globalWarehouse  = $request->warehouse_location; // single warehouse for all

            // ---------------------------------------------------------------
            // 1. Validate & Deduct Raw Material Stock
            // ---------------------------------------------------------------
            foreach ($template->rawMaterials as $rm) {
                $pivotQty  = floatval($rm->pivot->qty ?? 0);
                $needed    = $pivotQty * $qty;
                $available = CurrentStock::where('item_id', $rm->id)
                    ->whereIn('product_type', ['raw_material', 'single', 'ready_made'])
                    ->sum('qty');

                if ($available < $needed) {
                    throw new \Exception("Insufficient stock for: {$rm->item_name}. Available: {$available}, Needed: {$needed}");
                }
            }

            foreach ($template->rawMaterials as $rm) {
                $pivotQty = floatval($rm->pivot->qty ?? 0);
                $needed   = $pivotQty * $qty;

                CurrentStock::create([
                    'item_id'       => $rm->id,
                    'qty'           => -$needed,
                    'type'          => 'Production Consumed',
                    'product_type'  => 'raw_material',
                    'user_id'       => auth()->id(),
                    'created_by_id' => auth()->id(),
                ]);
            }

            // ---------------------------------------------------------------
            // 2. Calculate raw cost
            // ---------------------------------------------------------------
            $totalRawCost  = 0;
            $totalInputTax = 0;

            foreach ($template->rawMaterials as $rm) {
                $pivotQty  = floatval($rm->pivot->qty ?? 0);
                $unitPrice = floatval($rm->pivot->purchase_price_at_time ?? $rm->purchase_price ?? 0);
                $taxPct    = $rm->select_tax
                                ? floatval($rm->select_tax->rate ?? $rm->select_tax->percent ?? 0)
                                : 0;
                $withTax   = ($rm->select_purchase_type === 'With Tax');

                $usedQty   = $pivotQty * $qty;
                $baseCost  = $usedQty * $unitPrice;
                $taxAmount = $withTax ? ($baseCost * $taxPct / 100) : 0;

                $totalRawCost  += $baseCost + $taxAmount;
                $totalInputTax += $taxAmount;
            }

            $costPerUnit = $qty > 0 ? $totalRawCost / $qty : 0;

            // ---------------------------------------------------------------
            // 3. Calculate output tax & revenue
            // ---------------------------------------------------------------
            $outputTax    = 0;
            $totalRevenue = 0;

            foreach ($request->goods as $good) {
                $sp = floatval($good['sale_price'] ?? 0);
                $tp = floatval($good['tax_percent'] ?? 0);
                $sm = $good['sale_mode'] ?? 'exclusive';

                if ($sm === 'exclusive') {
                    $outputTax    += $sp * $tp / 100;
                    $totalRevenue += $sp;
                } elseif ($sm === 'inclusive') {
                    $divisor       = 1 + $tp / 100;
                    $outputTax    += $sp - ($sp / $divisor);
                    $totalRevenue += $sp / $divisor;
                } else {
                    $totalRevenue += $sp;
                }
            }

            $cgst        = $outputTax / 2;
            $sgst        = $outputTax / 2;
            $totalProfit = $totalRevenue - $totalRawCost;

            // ---------------------------------------------------------------
            // 4. Create Production record
            // ---------------------------------------------------------------
            $firstGood  = $request->goods[0];
            $production = Production::create([
                'finished_good_id'      =>$template->id,
                'reference_no'          => $referenceNo,
                'add_item_template_id'  => $template->id,
                'product_name'          => $template->item_name,
                'finished_qty'          => $qty,
                'sale_price'            => floatval($firstGood['sale_price']),
                'sale_mode'             => $firstGood['sale_mode'] ?? 'exclusive',
                'finished_tax_percent'  => floatval($firstGood['tax_percent'] ?? 0),
                'total_raw_cost'        => $totalRawCost,
                'total_production_cost' => $totalRawCost,
                'input_tax'             => $totalInputTax,
                'output_tax'            => $outputTax,
                'profit'                => $totalProfit,
                'warehouse_location'    => $globalWarehouse,  // ← global warehouse
                'batch_no'              => $batchNo,
                'party_id'              => $request->party_id ?: null,
                'created_by_id'         => auth()->id(),
            ]);

            // ---------------------------------------------------------------
            // 5. Create individual FinishedGood records + CurrentStock
            // ---------------------------------------------------------------
            $firstFinishedId = null;

            foreach ($request->goods as $i => $goodData) {
                $sp  = floatval($goodData['sale_price'] ?? 0);
                $tp  = floatval($goodData['tax_percent'] ?? 0);
                $sm  = $goodData['sale_mode'] ?? 'exclusive';

                $revenueNet    = $sm === 'inclusive' ? $sp / (1 + $tp / 100) : $sp;
                $profitPerUnit = $revenueNet - $costPerUnit;

                $serialNo = !empty($goodData['serial_no'])
                    ? $goodData['serial_no']
                    : ('SN-' . strtoupper(base_convert(microtime(true) + $i, 10, 36)));

                $uniqueCode = 'FG-' . strtoupper(uniqid());

                $refShort  = substr($production->reference_no, 5, 8);
                $buyerCode = !empty($goodData['buyer_code'])
                    ? $goodData['buyer_code']
                    : ('BC-' . $refShort . '-' . str_pad($i + 1, 3, '0', STR_PAD_LEFT));

                // Per-item batch number (from frontend) or auto-generate
                $itemBatchNo = !empty($goodData['batch_no'])
                    ? $goodData['batch_no']
                    : $this->autoGenerateBatchNo();

                // Per-item notes
                $notes = !empty($goodData['notes']) ? $goodData['notes'] : null;

                $attachmentPath = null;
                if (isset($request->file('goods_attachments')[$i])) {
                    $attachmentPath = $request->file('goods_attachments')[$i]
                        ->store('production_attachments', 'public');
                }

                $finished = FinishedGood::create([
                    'production_id'         => $production->id,
                    'add_item_template_id'  => $template->id,
                    'unique_code'           => $uniqueCode,
                    'buyer_code'            => $buyerCode,
                    'title'                 => $template->item_name,
                    'item_code'             => $serialNo,
                    'item_hsn'              => $template->item_hsn,
                    'unit'                  => optional($template->select_unit)->base_unit ?? 'pcs',
                    'quantity'              => 1,
                    'manufacturing_cost'    => $costPerUnit,
                    'sale_price'            => $sp,
                    'profit_per_unit'       => $profitPerUnit,
                    'tax_percent'           => $tp,
                    'sale_mode'             => $sm,
                    'warehouse_location'    => $globalWarehouse,  // ← global warehouse
                    'batch_no'              => $itemBatchNo,       // ← per-item batch no
                    'notes'                 => $notes,             // ← per-item notes
                    'attachment'            => $attachmentPath,
                ]);

                if ($i === 0) $firstFinishedId = $finished->id;

                CurrentStock::create([
                    'item_id'       => $finished->id,
                    'qty'           => 1,
                    'type'          => 'Manufactured',
                    'product_type'  => 'finished_goods',
                    'user_id'       => auth()->id(),
                    'created_by_id' => auth()->id(),
                ]);
            }

            $production->update(['finished_good_id' => $firstFinishedId]);

            // ---------------------------------------------------------------
            // 6. Log raw material usage
            // ---------------------------------------------------------------
            foreach ($template->rawMaterials as $rm) {
                $pivotQty  = floatval($rm->pivot->qty ?? 0);
                $unitPrice = floatval($rm->pivot->purchase_price_at_time ?? $rm->purchase_price ?? 0);
                $taxPct    = $rm->select_tax
                                ? floatval($rm->select_tax->rate ?? $rm->select_tax->percent ?? 0)
                                : 0;
                $withTax   = ($rm->select_purchase_type === 'With Tax');

                $usedQty   = $pivotQty * $qty;
                $baseCost  = $usedQty * $unitPrice;
                $taxAmount = $withTax ? ($baseCost * $taxPct / 100) : 0;

                ProductionRawMaterial::create([
                    'production_id'      => $production->id,
                    'finished_good_id'   => $production->id,
                    'raw_material_id'    => $rm->id,
                    'used_qty'           => $usedQty,
                    'purchase_price'     => $unitPrice,
                    'base_cost'          => $baseCost,
                    'tax_percent'        => $taxPct,
                    'tax_amount'         => $taxAmount,
                    'total_cost'         => $baseCost + $taxAmount,
                    'warehouse_location' => $globalWarehouse,
                    'batch_no'           => $batchNo,
                    'created_by_id'      => auth()->id(),
                ]);
            }
        });

        return redirect()
            ->route('admin.productions.index')
            ->with('message', 'Production Completed Successfully! 🎉');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show(Production $production)
    {
        $production->load(['template', 'finishedGoods', 'rawMaterials.rawMaterial', 'party']);
        return view('admin.productions.show', compact('production'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit(Production $production)
    {
        $production->load(['template.rawMaterials', 'finishedGoods', 'rawMaterials']);

        $templateData = null;
        if ($production->template) {
            $templateData = $this->formatTemplate($production->template);
        }

        $parties = PartyDetail::where('status', 'enable')
            ->select('id', 'party_name', 'phone_number')
            ->orderBy('party_name')
            ->get();

        return view('admin.productions.edit', compact('production', 'templateData', 'parties'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Production $production)
    {
        $request->validate([
            'party_id'                   => 'nullable|exists:party_details,id',
            'goods'                      => 'required|array|min:1',
            'goods.*.id'                 => 'nullable|exists:finished_goods,id',
            'goods.*.sale_price'         => 'required|numeric|min:0',
            'goods.*.warehouse_location' => 'required|string|max:255',
            'goods.*.buyer_code'         => 'nullable|string|max:255',
            'goods.*.serial_no'          => 'nullable|string|max:255',
            'goods.*.batch_no'           => 'nullable|string|max:100',
            'goods.*.notes'              => 'nullable|string|max:1000',
            'goods.*.tax_percent'        => 'nullable|numeric|min:0',
            'goods.*.sale_mode'          => 'required|in:exclusive,inclusive,export',
        ]);

        DB::transaction(function () use ($request, $production) {

            $production->load('template.rawMaterials');
            $template = $production->template;
            $qty      = (int) $production->finished_qty;

            $totalRawCost  = 0;
            $totalInputTax = 0;

            if ($template) {
                foreach ($template->rawMaterials as $rm) {
                    $pivotQty  = floatval($rm->pivot->qty ?? 0);
                    $unitPrice = floatval($rm->pivot->purchase_price_at_time ?? $rm->purchase_price ?? 0);
                    $taxPct    = $rm->select_tax
                                    ? floatval($rm->select_tax->rate ?? $rm->select_tax->percent ?? 0)
                                    : 0;
                    $withTax   = ($rm->select_purchase_type === 'With Tax');

                    $baseCost  = ($pivotQty * $qty) * $unitPrice;
                    $taxAmount = $withTax ? ($baseCost * $taxPct / 100) : 0;

                    $totalRawCost  += $baseCost + $taxAmount;
                    $totalInputTax += $taxAmount;
                }
            }

            $costPerUnit  = $qty > 0 ? $totalRawCost / $qty : 0;
            $outputTax    = 0;
            $totalRevenue = 0;

            foreach ($request->goods as $good) {
                $sp = floatval($good['sale_price'] ?? 0);
                $tp = floatval($good['tax_percent'] ?? 0);
                $sm = $good['sale_mode'] ?? 'exclusive';

                if ($sm === 'exclusive') {
                    $outputTax    += $sp * $tp / 100;
                    $totalRevenue += $sp;
                } elseif ($sm === 'inclusive') {
                    $divisor       = 1 + $tp / 100;
                    $outputTax    += $sp - ($sp / $divisor);
                    $totalRevenue += $sp / $divisor;
                } else {
                    $totalRevenue += $sp;
                }
            }

            $totalProfit = $totalRevenue - $totalRawCost;

            foreach ($request->goods as $i => $goodData) {
                if (empty($goodData['id'])) continue;

                $finished = FinishedGood::find($goodData['id']);
                if (!$finished) continue;

                $sp  = floatval($goodData['sale_price'] ?? 0);
                $tp  = floatval($goodData['tax_percent'] ?? 0);
                $sm  = $goodData['sale_mode'] ?? 'exclusive';
                $net = $sm === 'inclusive' ? $sp / (1 + $tp / 100) : $sp;

                $attachmentPath = $finished->attachment;
                if (isset($request->file('goods_attachments')[$i])) {
                    if ($attachmentPath) Storage::disk('public')->delete($attachmentPath);
                    $attachmentPath = $request->file('goods_attachments')[$i]
                        ->store('production_attachments', 'public');
                }

                $finished->update([
                    'buyer_code'         => $goodData['buyer_code'] ?? $finished->buyer_code,
                    'item_code'          => !empty($goodData['serial_no']) ? $goodData['serial_no'] : $finished->item_code,
                    'batch_no'           => !empty($goodData['batch_no'])  ? $goodData['batch_no']  : $finished->batch_no,
                    'notes'              => $goodData['notes'] ?? $finished->notes,
                    'sale_price'         => $sp,
                    'tax_percent'        => $tp,
                    'sale_mode'          => $sm,
                    'warehouse_location' => $goodData['warehouse_location'],
                    'profit_per_unit'    => $net - $costPerUnit,
                    'manufacturing_cost' => $costPerUnit,
                    'attachment'         => $attachmentPath,
                ]);
            }

            $production->update([
                'sale_price'            => floatval($request->goods[0]['sale_price'] ?? 0),
                'sale_mode'             => $request->goods[0]['sale_mode'] ?? 'exclusive',
                'finished_tax_percent'  => floatval($request->goods[0]['tax_percent'] ?? 0),
                'total_raw_cost'        => $totalRawCost,
                'total_production_cost' => $totalRawCost,
                'input_tax'             => $totalInputTax,
                'output_tax'            => $outputTax,
                'profit'                => $totalProfit,
                'warehouse_location'    => $request->goods[0]['warehouse_location'],
                'party_id'              => $request->party_id ?: $production->party_id,
            ]);
        });

        return redirect()
            ->route('admin.productions.index')
            ->with('message', 'Production Updated Successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */
    public function destroy(Production $production)
    {
        DB::transaction(function () use ($production) {

            $production->load('template.rawMaterials');
            if ($production->template) {
                foreach ($production->template->rawMaterials as $rm) {
                    $pivotQty = floatval($rm->pivot->qty ?? 0);
                    $restored = $pivotQty * $production->finished_qty;

                    CurrentStock::create([
                        'item_id'       => $rm->id,
                        'qty'           => $restored,
                        'type'          => 'Production Reversal - Restored',
                        'product_type'  => 'raw_material',
                        'user_id'       => auth()->id(),
                        'created_by_id' => auth()->id(),
                    ]);
                }
            }

            foreach ($production->finishedGoods as $fg) {
                CurrentStock::create([
                    'item_id'       => $fg->id,
                    'qty'           => -1,
                    'type'          => 'Production Reversal',
                    'product_type'  => 'finished_goods',
                    'user_id'       => auth()->id(),
                    'created_by_id' => auth()->id(),
                ]);

                if ($fg->attachment) Storage::disk('public')->delete($fg->attachment);
                $fg->delete();
            }

            $production->rawMaterials()->delete();
            $production->delete();
        });

        return back()->with('message', 'Production Reversed Successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER — Auto-generate batch number (server-side fallback)
    | Format: {MMM}{YYYY}-{5_RANDOM_ALPHA}
    |--------------------------------------------------------------------------
    */
    private function autoGenerateBatchNo(): string
    {
        $months = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
        $mon    = $months[(int) date('n') - 1];
        $yr     = date('Y');
        $chars  = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $rand   = '';
        for ($i = 0; $i < 5; $i++) {
            $rand .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return "{$mon}{$yr}-{$rand}";
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER — Format template for Alpine.js
    |--------------------------------------------------------------------------
    */
    private function formatTemplate(AddItem $item): array
    {
        return [
            'id'          => $item->id,
            'title'       => $item->item_name,
            'item_code'   => $item->item_code ?? '',
            'item_hsn'    => $item->item_hsn ?? '',
            'sale_price'  => floatval($item->sale_price ?? 0),
            'tax_percent' => $item->select_tax
                              ? floatval($item->select_tax->rate ?? $item->select_tax->percent ?? 0)
                              : 0,
            'raw_materials' => $item->rawMaterials->map(function ($rm) {
                // Fetch earliest positive stock entry date as "purchase date"
                $purchaseDate = CurrentStock::where('item_id', $rm->id)
                    ->where('qty', '>', 0)
                    ->orderBy('created_at', 'asc')
                    ->value('created_at');

                return [
                    'id'             => $rm->id,
                    'name'           => $rm->item_name,
                    'unit'           => optional($rm->select_unit)->base_unit ?? 'pcs',
                    'purchase_price' => floatval($rm->pivot->purchase_price_at_time ?? $rm->purchase_price ?? 0),
                    'with_tax'       => ($rm->select_purchase_type === 'With Tax') ? 1 : 0,
                    'tax_percent'    => $rm->select_tax
                                          ? floatval($rm->select_tax->rate ?? $rm->select_tax->percent ?? 0)
                                          : 0,
                    'pivot_qty'      => floatval($rm->pivot->qty ?? 0),
                    // ↓ NEW: earliest purchase date for this raw material
                    'purchase_date'  => $purchaseDate ? (string) $purchaseDate : null,
                ];
            })->values()->toArray(),
        ];
    }
}
