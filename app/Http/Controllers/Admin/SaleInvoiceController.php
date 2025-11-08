<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySaleInvoiceRequest;
use App\Models\AddItem;
use App\Models\CurrentStock;
use App\Models\PartyDetail;
use App\Models\SaleInvoice;
use App\Models\MainCostCenter;
use App\Models\SubCostCenter;
use App\Models\BankAccount;
use App\Models\SaleInvoiceStatusHistory;
use App\Models\TermAndCondition;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SaleInvoiceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    // -----------------------------
    // Index (unchanged + hierarchical visibility)
    // -----------------------------
    public function index()
    {
        abort_if(Gate::denies('sale_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user   = auth()->user();
        $userId = $user->id;
        $userRole = $user->roles->pluck('title')->first();

        // Build allowed hierarchy
        $allowedUserIds = collect([$userId]);

        $company   = $user->select_companies()->first();
        $companyId = $company?->id;

        if ($companyId) {
            $companyUserIds = DB::table('add_business_user')
                ->where('add_business_id', $companyId)
                ->pluck('user_id')
                ->toArray();

            $companyAdminId = \App\Models\User::whereIn('id', $companyUserIds)
                ->whereHas('roles', fn($q) => $q->where('title', 'Admin'))
                ->value('id');

            if ($companyAdminId) {
                $allowedUserIds->push($companyAdminId);
            }

            $parentId = $user->created_by_id;
            if ($parentId) {
                $allowedUserIds->push($parentId);

                $parent = \App\Models\User::find($parentId);
                if ($parent) {
                    $parentCompanyId = $parent->select_companies()->first()?->id;
                    if ($parentCompanyId) {
                        $parentCompanyUsers = DB::table('add_business_user')
                            ->where('add_business_id', $parentCompanyId)
                            ->pluck('user_id')
                            ->toArray();

                        $parentAdminId = \App\Models\User::whereIn('id', $parentCompanyUsers)
                            ->whereHas('roles', fn($q) => $q->where('title', 'Admin'))
                            ->value('id');

                        if ($parentAdminId) {
                            $allowedUserIds->push($parentAdminId);
                        }
                    }
                }
            }

            if ($userRole === 'Admin') {
                $allowedUserIds = collect($companyUserIds);
            }
        }

        $allowedUserIds = $allowedUserIds->unique()->toArray();

        if ($userRole === 'Super Admin') {
            $saleInvoices = SaleInvoice::withoutGlobalScopes()
                ->with([
                    'select_customer' => fn($q) => $q->withoutGlobalScopes(),
                    'items',
                    'created_by',
                    'media'
                ])
                ->latest()
                ->paginate(10);
        } else {
            $saleInvoices = SaleInvoice::with(['select_customer','items','created_by','media'])
                ->whereIn('created_by_id', $allowedUserIds)
                ->latest()
                ->paginate(10);
        }

        return view('admin.saleInvoices.index', compact('saleInvoices'));
    }

    // -----------------------------
    // Ajax: Profit/Loss get + update (unchanged)
    // -----------------------------
    public function getProfitLoss(SaleInvoice $saleInvoice)
    {
        $profitLoss = DB::table('sale_profit_losses')->where('sale_invoice_id', $saleInvoice->id)->first();

        if (!$profitLoss) {
            return response()->json(['status' => 'error', 'message' => 'Profit/Loss data not found.'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $profitLoss]);
    }

    public function updateProfitLoss(Request $request, SaleInvoice $saleInvoice)
    {
        $validated = $request->validate([
            'total_purchase_value' => 'required|numeric|min:0',
            'total_sale_value' => 'required|numeric|min:0',
        ]);

        $totalPurchase = round($validated['total_purchase_value'], 2);
        $totalSale     = round($validated['total_sale_value'], 2);
        $profitLossAmount = round($totalSale - $totalPurchase, 2);
        $isProfit = $profitLossAmount >= 0;

        DB::table('sale_profit_losses')
            ->where('sale_invoice_id', $saleInvoice->id)
            ->update([
                'total_purchase_value' => $totalPurchase,
                'total_sale_value'     => $totalSale,
                'profit_loss_amount'   => abs($profitLossAmount),
                'is_profit'            => $isProfit,
                'updated_at'           => now(),
            ]);

        return response()->json(['status' => 'success', 'message' => '✅ Profit/Loss updated successfully.']);
    }

    // -----------------------------
    // Confirm Manufacture (unchanged logic)
    // -----------------------------
    public function confirmManufacture($id)
    {
        try {
            $saleInvoice = SaleInvoice::with([
                'select_customer:id,party_name,state,gstin,phone_number',
                'main_cost_center:id,cost_center_name',
                'sub_cost_center:id,sub_cost_center_name'
            ])->findOrFail($id);

            $saleItems = DB::table('add_item_sale_invoice')
                ->join('add_items', 'add_item_sale_invoice.add_item_id', '=', 'add_items.id')
                ->where('add_item_sale_invoice.sale_invoice_id', $id)
                ->select(
                    'add_items.id as item_id',
                    'add_items.item_name',
                    'add_item_sale_invoice.qty',
                    'add_item_sale_invoice.price as sale_price',
                    'add_item_sale_invoice.amount as total_sale',
                    'add_items.purchase_price'
                )
                ->get();

            if ($saleItems->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => '❌ No sale items found for this invoice.'
                ], 404);
            }

            $totalSale = 0;
            $totalPurchase = 0;
            $itemDetails = [];

            foreach ($saleItems as $item) {
                $productTotalSale      = floatval($item->total_sale);
                $productTotalPurchase  = floatval($item->purchase_price) * floatval($item->qty);
                $totalSale            += $productTotalSale;
                $totalPurchase        += $productTotalPurchase;

                $rawMaterials = DB::table('finished_goods_raw_material')
                    ->join('add_items', 'finished_goods_raw_material.select_raw_material_id', '=', 'add_items.id')
                    ->where('finished_goods_raw_material.item_id', $item->item_id)
                    ->select(
                        'add_items.item_name as raw_material_name',
                        'finished_goods_raw_material.qty',
                        'finished_goods_raw_material.sale_price_at_time',
                        'finished_goods_raw_material.purchase_price_at_time',
                        'finished_goods_raw_material.total_sale_value',
                        'finished_goods_raw_material.total_purchase_value'
                    )
                    ->get();

                $totalSale     += $rawMaterials->sum('total_sale_value');
                $totalPurchase += $rawMaterials->sum('total_purchase_value');

                $itemDetails[] = [
                    'product_name'   => $item->item_name,
                    'qty'            => floatval($item->qty),
                    'sale_price'     => floatval($item->sale_price),
                    'purchase_price' => floatval($item->purchase_price),
                    'total'          => floatval($item->total_sale),
                    'raw_materials'  => $rawMaterials->map(function ($r) {
                        return [
                            'raw_material_name'   => $r->raw_material_name,
                            'qty'                 => floatval($r->qty),
                            'sale_price'          => floatval($r->sale_price_at_time),
                            'purchase_price'      => floatval($r->purchase_price_at_time),
                            'total_sale_value'    => floatval($r->total_sale_value),
                            'total_purchase_value'=> floatval($r->total_purchase_value),
                        ];
                    }),
                ];
            }

            $profitLossAmount = $totalSale - $totalPurchase;
            $isProfit = $profitLossAmount >= 0;

            $existing = DB::table('sale_profit_losses')->where('sale_invoice_id', $id)->first();

            $data = [
                'sale_invoice_id'      => $id,
                'select_customer_id'   => $saleInvoice->select_customer_id,
                'main_cost_center_id'  => $saleInvoice->main_cost_center_id,
                'sub_cost_center_id'   => $saleInvoice->sub_cost_center_id,
                'total_purchase_value' => $totalPurchase,
                'total_sale_value'     => $totalSale,
                'profit_loss_amount'   => $profitLossAmount,
                'is_profit'            => $isProfit ? 1 : 0,
                'composition_json'     => json_encode($itemDetails),
                'created_by_id'        => auth()->id(),
                'updated_at'           => now(),
            ];

            if ($existing) {
                DB::table('sale_profit_losses')->where('sale_invoice_id', $id)->update($data);
            } else {
                $data['created_at'] = now();
                DB::table('sale_profit_losses')->insert($data);
            }

            return response()->json([
                'status' => 'success',
                'message' => '✅ Manufacture confirmed and profit/loss calculated successfully (with raw materials).',
                'data' => [
                    'invoice' => [
                        'id' => $saleInvoice->id,
                        'docket_no' => $saleInvoice->docket_no ?? '—',
                        'billing_date' => $saleInvoice->created_at ? $saleInvoice->created_at->format('d M Y') : '—',
                        'select_customer' => [
                            'party_name' => $saleInvoice->select_customer->party_name ?? '—',
                            'state' => $saleInvoice->select_customer->state ?? '—',
                            'gstin' => $saleInvoice->select_customer->gstin ?? '—',
                            'phone_number' => $saleInvoice->select_customer->phone_number ?? '—',
                        ],
                        'main_cost_center' => [
                            'name' => $saleInvoice->main_cost_center->cost_center_name ?? '—',
                        ],
                        'sub_cost_center' => [
                            'name' => $saleInvoice->sub_cost_center->sub_cost_center_name ?? '—',
                        ],
                    ],
                    'profit_loss' => [
                        'total_purchase_value' => $totalPurchase,
                        'total_sale_value' => $totalSale,
                        'profit_loss_amount' => abs($profitLossAmount),
                        'is_profit' => $isProfit,
                        'composition_json' => $itemDetails,
                    ],
                ],
            ]);

        } catch (\Exception $e) {
            Log::error('Error confirming manufacture: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => '⚠️ ' . $e->getMessage(),
            ], 500);
        }
    }
public function getCustomerDetails($id)
{
    $customer = \App\Models\PartyDetail::withoutGlobalScopes()->find($id);

    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    return response()->json([
        'party_name'            => $customer->party_name,
        'phone_number'          => $customer->phone_number,
        'email'                 => $customer->email,
        'gstin'                 => $customer->gstin,
        'pan_number'            => $customer->pan_number,
        'billing_address'       => $customer->billing_address,
        'shipping_address'      => $customer->shipping_address,
        'state'                 => $customer->state,
        'city'                  => $customer->city,
        'pincode'               => $customer->pincode,
        'credit_limit'          => $customer->credit_limit,
        'payment_terms'         => $customer->payment_terms,

        // Opening & Current Balance
        'opening_balance'       => $customer->opening_balance,
        'opening_balance_type'  => $customer->opening_balance_type,
        'opening_balance_date'  => $customer->opening_balance_date,

        'current_balance'       => $customer->current_balance,
        'current_balance_type'  => $customer->current_balance_type,
        'current_balance_date'  => $customer->updated_at,
    ]);
}

    // -----------------------------
    // Create (unchanged logic you shared)
    // -----------------------------
    public function create()
{
    abort_if(Gate::denies('sale_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = Auth::user();
    $userId = $user->id;
    $userRole = $user->roles->pluck('title')->first();

    $company = $user->select_companies()->first();
    $companyId = $company?->id;

    $allowedUserIds = collect([$userId]); // Start with logged-in user

    if ($companyId) 
    {
        // All users under this company (admin + branches)
        $companyUserIds = DB::table('add_business_user')
            ->where('add_business_id', $companyId)
            ->pluck('user_id')
            ->toArray();

        // Find company Admin ID
        $companyAdminId = \App\Models\User::whereIn('id', $companyUserIds)
            ->whereHas('roles', fn($q) => $q->where('title', 'Admin'))
            ->value('id');

        if ($companyAdminId) {
            $allowedUserIds->push($companyAdminId);
        }

        // Parent-Admin Logic for Branch User
        $parentId = $user->created_by_id;
        if ($parentId) {
            $allowedUserIds->push($parentId);

            $parent = \App\Models\User::find($parentId);
            if ($parent) {
                $parentCompanyId = $parent->select_companies()->first()?->id;
                if ($parentCompanyId) {
                    $parentCompanyUsers = DB::table('add_business_user')
                        ->where('add_business_id', $parentCompanyId)
                        ->pluck('user_id')
                        ->toArray();

                    $parentAdminId = \App\Models\User::whereIn('id', $parentCompanyUsers)
                        ->whereHas('roles', fn($q) => $q->where('title', 'Admin'))
                        ->value('id');

                    if ($parentAdminId) {
                        $allowedUserIds->push($parentAdminId);
                    }
                }
            }
        }

        // ✅ FIX APPLIED HERE
        if ($userRole === 'Admin') {
            // Admin + All users of that company
            $allowedUserIds = collect($companyUserIds)->push($userId);
        }
    }

    $allowedUserIds = $allowedUserIds->unique()->toArray();

    // ✅ Customers dropdown
    if ($userRole === 'Super Admin') {
        $select_customers = \App\Models\PartyDetail::withoutGlobalScopes()->get();
    } elseif ($companyId) {
        $select_customers = \App\Models\PartyDetail::whereIn('created_by_id', $allowedUserIds)->get();
    } else {
        $select_customers = \App\Models\PartyDetail::where('created_by_id', $userId)->get();
    }

    $select_customers = $select_customers->mapWithKeys(function ($customer) {
        $balance = $customer->current_balance ?? $customer->opening_balance ?? 0;
        $type    = $customer->current_balance_type ?? $customer->opening_balance_type ?? 'Debit';
        $balanceFormatted = number_format($balance, 2);

        $display = $type === 'Debit'
            ? "₹{$balanceFormatted} Dr - Payable ↑"
            : "₹{$balanceFormatted} Cr - Receivable ↓";

        return [$customer->id => "{$customer->party_name} ({$display})"];
    });

    // ✅ Items with stock
    if ($userRole === 'Super Admin') {
        $items = \App\Models\AddItem::withoutGlobalScopes()
            ->whereIn('item_type', ['product', 'service'])
            ->with('select_unit')
            ->get();
    } elseif ($companyId) {
        $items = \App\Models\AddItem::whereIn('created_by_id', $allowedUserIds)
            ->whereIn('item_type', ['product', 'service'])
            ->with('select_unit')
            ->get();
    } else {
        $items = \App\Models\AddItem::where('created_by_id', $userId)
            ->whereIn('item_type', ['product', 'service'])
            ->with('select_unit')
            ->get();
    }

    $items->map(function ($item) use ($userRole, $companyId, $allowedUserIds, $userId) {
        if ($item->item_type === 'product') {
            if ($userRole === 'Super Admin') {
                $item->stock_qty = \App\Models\CurrentStock::where('item_id', $item->id)->sum('qty');
            } elseif ($companyId) {
                $item->stock_qty = \App\Models\CurrentStock::whereIn('created_by_id', $allowedUserIds)
                    ->where('item_id', $item->id)->sum('qty');
            } else {
                $item->stock_qty = \App\Models\CurrentStock::where('created_by_id', $userId)
                    ->where('item_id', $item->id)->sum('qty');
            }
        } else {
            $item->stock_qty = null;
        }
        return $item;
    });

    // ✅ Cost Center & Sub Cost Center (Works Perfect Now)
    $cost = \App\Models\MainCostCenter::whereIn('created_by_id', $allowedUserIds)
        ->pluck('cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    dd($cost->toArray());
    $sub_cost = \App\Models\SubCostCenter::whereIn('created_by_id', $allowedUserIds)
        ->pluck('sub_cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    return view('admin.saleInvoices.create', compact('items', 'select_customers', 'cost', 'sub_cost'));
}


    // -----------------------------
    // Helper: Fetch composition for item
    // -----------------------------
    protected function fetchCompositionRowsForItem($itemId)
    {
        return DB::table('finished_goods_raw_material')
            ->where('item_id', $itemId)
            ->get();
    }

    // -----------------------------
    // Store (same logic as shared, wrapped in transaction + minor hardening)
    // -----------------------------
    public function store(Request $request)
    {
        abort_if(Gate::denies('sale_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'select_customer_id' => 'required|exists:party_details,id',
            'po_no'              => 'required|string',
            'po_date'            => 'required|date',
            'docket_no'          => 'nullable|string',
            'billing_address_invoice' => 'nullable|string',
            'items'              => 'required|array|min:1',
            'items.*.add_item_id'=> 'required|exists:add_items,id',
            'items.*.qty'        => 'required|numeric|min:1',
            'attachment'         => 'nullable|file|max:10240',
        ]);

        return DB::transaction(function () use ($request) {

            // Unique invoice no
            $sale_invoice_number = 'ET-' . now()->format('YmdHis') . rand(100, 999);

            $invoice = \App\Models\SaleInvoice::create([
                'sale_invoice_number' => $sale_invoice_number,
                'payment_type'        => $request->payment_type,
                'select_customer_id'  => $request->select_customer_id,
                'po_no'               => $request->po_no,
                'docket_no'           => $request->docket_no,
                'po_date'             => $request->po_date,
                'due_date'            => $request->due_date,
                'e_way_bill_no'       => $request->e_way_bill_no,
                'phone_number'        => $request->customer_phone_invoice,
                'billing_address'     => $request->billing_address_invoice,
                'shipping_address'    => $request->shipping_address_invoice,
                'notes'               => $request->notes,
                'terms'               => $request->terms,
                'overall_discount'    => $request->overall_discount ?? 0,
                'subtotal'            => $request->subtotal ?? 0,
                'tax'                 => $request->tax ?? 0,
                'discount'            => $request->discount ?? 0,
                'total'               => $request->total ?? 0,
                'created_by_id'       => auth()->id(),
                'json_data'           => json_encode($request->all()),
                'status'              => $request->status ?? 'Draft',
                'main_cost_center_id' => $request->main_cost_center_id,
                'sub_cost_center_id'  => $request->sub_cost_center_id,
                'price'               => $request->price ?? 0,
            ]);

            if ($request->hasFile('attachment')) {
                $invoice->addMediaFromRequest('attachment')->toMediaCollection('document');
            }

            $customer = \App\Models\PartyDetail::findOrFail($request->select_customer_id);

            // Compute customer current balance
            $baseBalance = $customer->current_balance ?? $customer->opening_balance ?? 0;
            $baseType    = $customer->current_balance_type ?? $customer->opening_balance_type ?? 'Debit';

            $totalSaleAmount = $request->total ?? 0;
            [$closingBalance, $closingType] = $this->applySaleOnBalance($baseBalance, $baseType, $totalSaleAmount);

            $customer->current_balance      = $closingBalance;
            $customer->current_balance_type = $closingType;
            $customer->save();

            // Attach items + stock + composition
            $invoice_total_purchase_cost = 0;
            $composition_master = [];

            foreach ($request->items as $itemData) {
                $item = \App\Models\AddItem::findOrFail($itemData['add_item_id']);

                $invoice->items()->attach($item->id, [
                    'description'   => $itemData['description'] ?? null,
                    'qty'           => $itemData['qty'],
                    'unit'          => $itemData['unit'] ?? null,
                    'price'         => $itemData['price'] ?? 0,
                    'discount_type' => $itemData['discount_type'] ?? 'value',
                    'discount'      => $itemData['discount'] ?? 0,
                    'tax_type'      => $itemData['tax_type'] ?? 'without',
                    'tax'           => $itemData['tax'] ?? 0,
                    'amount'        => $itemData['amount'] ?? 0,
                    'created_by_id' => auth()->id(),
                    'json_data'     => json_encode($itemData),
                ]);

                if ($item->item_type === 'product') {
                    // Deduct composition raw materials
                    $compositionRows = $this->fetchCompositionRowsForItem($item->id);

                    foreach ($compositionRows as $c) {
                        $qtyPerFinished        = (float) $c->qty;
                        $salePriceAtTime       = (float) ($c->sale_price_at_time ?? 0);
                        $purchasePriceAtTime   = (float) ($c->purchase_price_at_time ?? 0);
                        $usedTotalQty          = $qtyPerFinished * (float)$itemData['qty'];
                        $lineSaleValue         = $usedTotalQty * $salePriceAtTime;
                        $linePurchaseValue     = $usedTotalQty * $purchasePriceAtTime;

                        $invoice_total_purchase_cost += $linePurchaseValue;

                        $rawStock = \App\Models\CurrentStock::where('item_id', $c->select_raw_material_id)->first();
                        if ($rawStock) {
                            $previousQty   = $rawStock->qty;
                            $rawStock->qty = max(0, $rawStock->qty - $usedTotalQty);
                            $rawStock->save();

                            \App\Models\SaleLog::create([
                                'sale_invoice_id' => $invoice->id,
                                'item_id'         => $c->select_raw_material_id,
                                'item_type'       => 'raw_material',
                                'stock_id'        => $rawStock->id,
                                'previous_qty'    => $previousQty,
                                'sold_qty'        => $usedTotalQty,
                                'sold_amount'     => 0,
                                'price'           => 0,
                                'sold_to_user_id' => $request->select_customer_id,
                                'created_by_id'   => auth()->id(),
                                'json_data_add_item_sale_invoice' => json_encode($itemData),
                                'json_data_current_stock'         => json_encode($rawStock),
                                'json_data_sale_invoice'          => json_encode($invoice),
                            ]);
                        }

                        $composition_master[] = [
                            'finished_item_id'        => $item->id,
                            'finished_item_name'      => $item->item_name,
                            'raw_material_id'         => $c->select_raw_material_id,
                            'raw_material_name'       => $c->item_name ?? \App\Models\AddItem::find($c->select_raw_material_id)->item_name ?? 'Unnamed',
                            'qty_used_per_finished'   => $qtyPerFinished,
                            'used_total_qty'          => $usedTotalQty,
                            'sale_price_at_time'      => $salePriceAtTime,
                            'purchase_price_at_time'  => $purchasePriceAtTime,
                            'total_sale_value'        => $lineSaleValue,
                            'total_purchase_value'    => $linePurchaseValue,
                        ];
                    }

                    // Deduct finished product stock
                    $stock = \App\Models\CurrentStock::where('item_id', $item->id)->first();
                    if ($stock) {
                        $previousQty    = $stock->qty;
                        $previousAmount = $previousQty * ($itemData['price'] ?? 0);
                        $stock->qty     -= $itemData['qty'];
                        $stock->save();

                        \App\Models\SaleLog::create([
                            'sale_invoice_id' => $invoice->id,
                            'item_id'         => $item->id,
                            'item_type'       => 'product',
                            'stock_id'        => $stock->id,
                            'previous_qty'    => $previousQty,
                            'sold_qty'        => $itemData['qty'],
                            'previous_amount' => $previousAmount,
                            'sold_amount'     => $itemData['amount'] ?? 0,
                            'price'           => $itemData['price'] ?? 0,
                            'sold_to_user_id' => $request->select_customer_id,
                            'created_by_id'   => auth()->id(),
                            'json_data_add_item_sale_invoice' => json_encode($itemData),
                            'json_data_current_stock'         => json_encode($stock),
                            'json_data_sale_invoice'          => json_encode($invoice),
                        ]);
                    }
                } else {
                    // service: pseudo composition
                    $qty       = (float)$itemData['qty'];
                    $sale      = ((float)($itemData['price'] ?? 0)) * $qty;
                    $purchase  = ((float)($item->purchase_price ?? 0)) * $qty;
                    $invoice_total_purchase_cost += $purchase;

                    $composition_master[] = [
                        'finished_item_id'        => $item->id,
                        'finished_item_name'      => $item->item_name,
                        'raw_material_id'         => null,
                        'raw_material_name'       => $item->item_name,
                        'qty_used_per_finished'   => 1,
                        'used_total_qty'          => $qty,
                        'sale_price_at_time'      => (float)($itemData['price'] ?? 0),
                        'purchase_price_at_time'  => (float)($item->purchase_price ?? 0),
                        'total_sale_value'        => $sale,
                        'total_purchase_value'    => $purchase,
                    ];

                    \App\Models\SaleLog::create([
                        'sale_invoice_id' => $invoice->id,
                        'item_id'         => $item->id,
                        'item_type'       => 'service',
                        'sold_qty'        => $itemData['qty'],
                        'sold_amount'     => $itemData['amount'] ?? 0,
                        'price'           => $itemData['price'] ?? 0,
                        'sold_to_user_id' => $request->select_customer_id,
                        'json_data_sale_invoice'          => json_encode($invoice),
                        'json_data_add_item_sale_invoice' => json_encode($itemData),
                    ]);
                }
            }

            // Profit/Loss
            $profit_loss_amount = floatval($invoice->total) - floatval($invoice_total_purchase_cost);
            $is_profit = $profit_loss_amount >= 0;

            DB::table('sale_profit_losses')->insert([
                'sale_invoice_id'      => $invoice->id,
                'select_customer_id'   => $invoice->select_customer_id,
                'main_cost_center_id'  => $invoice->main_cost_center_id,
                'sub_cost_center_id'   => $invoice->sub_cost_center_id,
                'total_purchase_value' => $invoice_total_purchase_cost,
                'total_sale_value'     => $invoice->total,
                'profit_loss_amount'   => $profit_loss_amount,
                'is_profit'            => $is_profit ? 1 : 0,
                'composition_json'     => json_encode($composition_master),
                'created_by_id'        => auth()->id(),
                'created_at'           => now(),
                'updated_at'           => now(),
            ]);

            // Transaction (store both opening & closing)
            \App\Models\Transaction::create([
                'sale_invoice_id'      => $invoice->id,
                'select_customer_id'   => $customer->id,
                'payment_type_id'      => $request->payment_type_id ?? null,
                'main_cost_center_id'  => $request->main_cost_center_id,
                'sub_cost_center_id'   => $request->sub_cost_center_id,
                'sale_amount'          => $request->total ?? 0,
                'opening_balance'      => $baseBalance,
                'closing_balance'      => $closingBalance,
                'transaction_type'     => 'sale',
                'transaction_id'       => strtoupper('TXN' . rand(1000000000, 9999999999)),
                'created_by_id'        => auth()->id(),
                'json_data'            => json_encode([
                    'request' => $request->all(),
                    'invoice' => $invoice->toArray(),
                    'customer_before' => ['balance' => $baseBalance, 'type' => $baseType],
                    'customer_after'  => ['balance' => $closingBalance, 'type' => $closingType],
                ]),
            ]);

            return redirect()->route('admin.sale-invoices.index')
                ->with('success', 'Sale Invoice Created Successfully.');
        });
    }

    // -----------------------------
    // Balance helper
    // -----------------------------
    protected function applySaleOnBalance($baseBalance, $baseType, $saleAmount): array
    {
        $closingBalance = $baseBalance;
        $closingType    = $baseType;

        if ($baseType === 'Debit') {
            $closingBalance -= $saleAmount;
            if ($closingBalance < 0) {
                $closingBalance = abs($closingBalance);
                $closingType = 'Credit';
            } else {
                $closingType = 'Debit';
            }
        } else {
            $closingBalance += $saleAmount;
            $closingType = 'Credit';
        }

        return [$closingBalance, $closingType];
    }

    // -----------------------------
    // Ajax: Composition fetch (unchanged)
    // -----------------------------
    public function getItemComposition($itemId)
    {
        $rows = DB::table('finished_goods_raw_material')
            ->where('item_id', $itemId)
            ->select(
                'select_raw_material_id as id',
                'qty as qty_used',
                'sale_price_at_time as sale_price',
                'purchase_price_at_time as purchase_price',
                'item_name as name'
            )->get()->map(function($r){
                return [
                    'id' => $r->id,
                    'name' => $r->name ?? (\App\Models\AddItem::find($r->id)->item_name ?? 'Unnamed'),
                    'qty_used' => (float)$r->qty_used,
                    'sale_price' => (float)$r->sale_price,
                    'purchase_price' => (float)$r->purchase_price,
                ];
            });

        return response()->json(['composition' => $rows]);
    }

    public function profitDetails($invoiceId)
    {
        $record = DB::table('sale_profit_losses')->where('sale_invoice_id', $invoiceId)->first();
        if (!$record) {
            return response()->json(['error' => 'Not found'], 404);
        }
        $invoice = SaleInvoice::find($invoiceId);
        $customer = \App\Models\PartyDetail::find($record->select_customer_id);

        return response()->json([
            'invoice' => $invoice,
            'customer_name' => $customer->party_name ?? '',
            'total_purchase_value' => $record->total_purchase_value,
            'total_sale_value' => $record->total_sale_value,
            'profit_loss_amount' => $record->profit_loss_amount,
            'is_profit' => (bool)$record->is_profit,
            'composition' => json_decode($record->composition_json, true) ?? [],
        ]);
    }

    // -----------------------------
    // Edit page (scoped lists, with stock)
    // -----------------------------
    public function edit(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = \App\Models\PartyDetail::select(
                'id','party_name','opening_balance','opening_balance_type','current_balance','current_balance_type'
            )
            ->get()
            ->mapWithKeys(function($customer) {
                $balance = $customer->current_balance ?? $customer->opening_balance;
                $type    = $customer->current_balance_type ?? $customer->opening_balance_type;
                $balanceFormatted = number_format($balance, 2);

                $display = $type === 'Debit'
                    ? "₹{$balanceFormatted} Dr - Payable ↑"
                    : "₹{$balanceFormatted} Cr - Receivable ↓";

                return [$customer->id => "{$customer->party_name} ({$display})"];
            });

        $items = AddItem::whereIn('item_type', ['product', 'service'])
            ->select('id','item_name','sale_price','select_unit_id','item_hsn','item_code','item_type','purchase_price')
            ->with('select_unit')
            ->get()
            ->map(function ($item) {
                $item->stock_qty = $item->item_type === 'product'
                    ? CurrentStock::where('item_id', $item->id)->sum('qty')
                    : null;
                return $item;
            });

        $cost     = MainCostCenter::pluck('cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $sub_cost = SubCostCenter::pluck('sub_cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $saleInvoice->load('select_customer','items');

        return view('admin.saleInvoices.edit', compact('saleInvoice','items','select_customers','cost','sub_cost'));
    }

    // -----------------------------
    // UPDATE with Full Reverse then Recalculate
    // -----------------------------
    public function update(Request $request, SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'select_customer_id'      => 'required|exists:party_details,id',
            'po_no'                   => 'required|string',
            'po_date'                 => 'required|date',
            'docket_no'               => 'nullable|string',
            'billing_address_invoice' => 'nullable|string',
            'items'                   => 'required|array|min:1',
            'items.*.add_item_id'     => 'required|exists:add_items,id',
            'items.*.qty'             => 'required|numeric|min:1',
            'attachment'              => 'nullable|file|max:10240',
        ]);

        return DB::transaction(function () use ($request, $saleInvoice) {

            // 1) Reverse previous effects
            $this->reverseInvoiceEffects($saleInvoice);

            // 2) Attachment replace
            if ($request->hasFile('attachment')) {
                $saleInvoice->clearMediaCollection('document');
                $saleInvoice->addMediaFromRequest('attachment')->toMediaCollection('document');
            }

            // 3) Update invoice (status NOT changed here; separate endpoint handles it)
            $saleInvoice->update([
                'payment_type'       => $request->payment_type,
                'select_customer_id' => $request->select_customer_id,
                'po_no'              => $request->po_no,
                'docket_no'          => $request->docket_no,
                'po_date'            => $request->po_date,
                'due_date'           => $request->due_date,
                'e_way_bill_no'      => $request->e_way_bill_no,
                'phone_number'       => $request->customer_phone_invoice,
                'billing_address'    => $request->billing_address_invoice,
                'shipping_address'   => $request->shipping_address_invoice,
                'notes'              => $request->notes,
                'terms'              => $request->terms,
                'overall_discount'   => $request->overall_discount ?? 0,
                'subtotal'           => $request->subtotal ?? 0,
                'tax'                => $request->tax ?? 0,
                'discount'           => $request->discount ?? 0,
                'total'              => $request->total ?? 0,
                'json_data'          => json_encode($request->all()),
                'main_cost_center_id'=> $request->main_cost_center_id,
                'sub_cost_center_id' => $request->sub_cost_center_id,
                // 'status' is not modifiable here (Admin-only via updateStatus)
            ]);

            // 4) Detach old items (already reversed), then attach new
            $saleInvoice->items()->detach();

            $customer = \App\Models\PartyDetail::findOrFail($request->select_customer_id);

            // For new transaction we use the *current* balance as base
            $baseBalance = $customer->current_balance ?? $customer->opening_balance ?? 0;
            $baseType    = $customer->current_balance_type ?? $customer->opening_balance_type ?? 'Debit';
            $totalSaleAmount = $request->total ?? 0;

            [$closingBalance, $closingType] = $this->applySaleOnBalance($baseBalance, $baseType, $totalSaleAmount);
            $customer->current_balance      = $closingBalance;
            $customer->current_balance_type = $closingType;
            $customer->save();

            $invoice_total_purchase_cost = 0;
            $composition_master = [];

            foreach ($request->items as $itemData) {
                $item = \App\Models\AddItem::findOrFail($itemData['add_item_id']);

                $saleInvoice->items()->attach($item->id, [
                    'description'   => $itemData['description'] ?? null,
                    'qty'           => $itemData['qty'],
                    'unit'          => $itemData['unit'] ?? null,
                    'price'         => $itemData['price'] ?? 0,
                    'discount_type' => $itemData['discount_type'] ?? 'value',
                    'discount'      => $itemData['discount'] ?? 0,
                    'tax_type'      => $itemData['tax_type'] ?? 'without',
                    'tax'           => $itemData['tax'] ?? 0,
                    'amount'        => $itemData['amount'] ?? 0,
                    'created_by_id' => auth()->id(),
                    'json_data'     => json_encode($itemData),
                ]);

                if ($item->item_type === 'product') {
                    $compositionRows = $this->fetchCompositionRowsForItem($item->id);

                    foreach ($compositionRows as $c) {
                        $qtyPerFinished       = (float) $c->qty;
                        $salePriceAtTime      = (float) ($c->sale_price_at_time ?? 0);
                        $purchasePriceAtTime  = (float) ($c->purchase_price_at_time ?? 0);
                        $usedTotalQty         = $qtyPerFinished * (float)$itemData['qty'];
                        $lineSaleValue        = $usedTotalQty * $salePriceAtTime;
                        $linePurchaseValue    = $usedTotalQty * $purchasePriceAtTime;

                        $invoice_total_purchase_cost += $linePurchaseValue;

                        $rawStock = \App\Models\CurrentStock::where('item_id', $c->select_raw_material_id)->first();
                        if ($rawStock) {
                            $previousQty   = $rawStock->qty;
                            $rawStock->qty = max(0, $rawStock->qty - $usedTotalQty);
                            $rawStock->save();

                            \App\Models\SaleLog::create([
                                'sale_invoice_id' => $saleInvoice->id,
                                'item_id'         => $c->select_raw_material_id,
                                'item_type'       => 'raw_material',
                                'stock_id'        => $rawStock->id,
                                'previous_qty'    => $previousQty,
                                'sold_qty'        => $usedTotalQty,
                                'sold_amount'     => 0,
                                'price'           => 0,
                                'sold_to_user_id' => $request->select_customer_id,
                                'created_by_id'   => auth()->id(),
                                'json_data_add_item_sale_invoice' => json_encode($itemData),
                                'json_data_current_stock'         => json_encode($rawStock),
                                'json_data_sale_invoice'          => json_encode($saleInvoice),
                            ]);
                        }

                        $composition_master[] = [
                            'finished_item_id'        => $item->id,
                            'finished_item_name'      => $item->item_name,
                            'raw_material_id'         => $c->select_raw_material_id,
                            'raw_material_name'       => $c->item_name ?? \App\Models\AddItem::find($c->select_raw_material_id)->item_name ?? 'Unnamed',
                            'qty_used_per_finished'   => $qtyPerFinished,
                            'used_total_qty'          => $usedTotalQty,
                            'sale_price_at_time'      => $salePriceAtTime,
                            'purchase_price_at_time'  => $purchasePriceAtTime,
                            'total_sale_value'        => $lineSaleValue,
                            'total_purchase_value'    => $linePurchaseValue,
                        ];
                    }

                    $stock = \App\Models\CurrentStock::where('item_id', $item->id)->first();
                    if ($stock) {
                        $previousQty    = $stock->qty;
                        $previousAmount = $previousQty * ($itemData['price'] ?? 0);
                        $stock->qty     -= $itemData['qty'];
                        $stock->save();

                        \App\Models\SaleLog::create([
                            'sale_invoice_id' => $saleInvoice->id,
                            'item_id'         => $item->id,
                            'item_type'       => 'product',
                            'stock_id'        => $stock->id,
                            'previous_qty'    => $previousQty,
                            'sold_qty'        => $itemData['qty'],
                            'previous_amount' => $previousAmount,
                            'sold_amount'     => $itemData['amount'] ?? 0,
                            'price'           => $itemData['price'] ?? 0,
                            'sold_to_user_id' => $request->select_customer_id,
                            'created_by_id'   => auth()->id(),
                            'json_data_add_item_sale_invoice' => json_encode($itemData),
                            'json_data_current_stock'         => json_encode($stock),
                            'json_data_sale_invoice'          => json_encode($saleInvoice),
                        ]);
                    }
                } else {
                    $qty       = (float)$itemData['qty'];
                    $sale      = ((float)($itemData['price'] ?? 0)) * $qty;
                    $purchase  = ((float)($item->purchase_price ?? 0)) * $qty;
                    $invoice_total_purchase_cost += $purchase;

                    $composition_master[] = [
                        'finished_item_id'        => $item->id,
                        'finished_item_name'      => $item->item_name,
                        'raw_material_id'         => null,
                        'raw_material_name'       => $item->item_name,
                        'qty_used_per_finished'   => 1,
                        'used_total_qty'          => $qty,
                        'sale_price_at_time'      => (float)($itemData['price'] ?? 0),
                        'purchase_price_at_time'  => (float)($item->purchase_price ?? 0),
                        'total_sale_value'        => $sale,
                        'total_purchase_value'    => $purchase,
                    ];

                    \App\Models\SaleLog::create([
                        'sale_invoice_id' => $saleInvoice->id,
                        'item_id'         => $item->id,
                        'item_type'       => 'service',
                        'sold_qty'        => $itemData['qty'],
                        'sold_amount'     => $itemData['amount'] ?? 0,
                        'price'           => $itemData['price'] ?? 0,
                        'sold_to_user_id' => $request->select_customer_id,
                        'json_data_sale_invoice'          => json_encode($saleInvoice),
                        'json_data_add_item_sale_invoice' => json_encode($itemData),
                    ]);
                }
            }

            // 5) Profit/Loss upsert
            $profit_loss_amount = floatval($saleInvoice->total) - floatval($invoice_total_purchase_cost);
            $is_profit = $profit_loss_amount >= 0;

            DB::table('sale_profit_losses')->updateOrInsert(
                ['sale_invoice_id' => $saleInvoice->id],
                [
                    'select_customer_id'   => $saleInvoice->select_customer_id,
                    'main_cost_center_id'  => $saleInvoice->main_cost_center_id,
                    'sub_cost_center_id'   => $saleInvoice->sub_cost_center_id,
                    'total_purchase_value' => $invoice_total_purchase_cost,
                    'total_sale_value'     => $saleInvoice->total,
                    'profit_loss_amount'   => $profit_loss_amount,
                    'is_profit'            => $is_profit ? 1 : 0,
                    'composition_json'     => json_encode($composition_master),
                    'created_by_id'        => auth()->id(),
                    'updated_at'           => now(),
                    'created_at'           => now(),
                ]
            );

            // 6) Transaction: if exists, update with new opening = current base used here is $baseBalance (after reversal step we set customer's balance to a clean state already)
            $transaction = \App\Models\Transaction::where('sale_invoice_id', $saleInvoice->id)->first();
            if ($transaction) {
                $transaction->update([
                    'select_customer_id'  => $customer->id,
                    'payment_type_id'     => $request->payment_type_id ?? $transaction->payment_type_id,
                    'main_cost_center_id' => $request->main_cost_center_id,
                    'sub_cost_center_id'  => $request->sub_cost_center_id,
                    'sale_amount'         => $totalSaleAmount,
                    'opening_balance'     => $baseBalance,
                    'closing_balance'     => $closingBalance,
                    'json_data' => json_encode([
                        'request' => $request->all(),
                        'invoice' => $saleInvoice->toArray(),
                        'customer_before' => ['balance' => $baseBalance, 'type' => $baseType],
                        'customer_after'  => ['balance' => $closingBalance, 'type' => $closingType],
                    ]),
                ]);
            } else {
                \App\Models\Transaction::create([
                    'sale_invoice_id'      => $saleInvoice->id,
                    'select_customer_id'   => $customer->id,
                    'payment_type_id'      => $request->payment_type_id ?? null,
                    'main_cost_center_id'  => $request->main_cost_center_id,
                    'sub_cost_center_id'   => $request->sub_cost_center_id,
                    'sale_amount'          => $totalSaleAmount,
                    'opening_balance'      => $baseBalance,
                    'closing_balance'      => $closingBalance,
                    'transaction_type'     => 'sale',
                    'transaction_id'       => strtoupper('TXN' . rand(1000000000, 9999999999)),
                    'created_by_id'        => auth()->id(),
                    'json_data'            => json_encode([
                        'request' => $request->all(),
                        'invoice' => $saleInvoice->toArray(),
                        'customer_before' => ['balance' => $baseBalance, 'type' => $baseType],
                        'customer_after'  => ['balance' => $closingBalance, 'type' => $closingType],
                    ]),
                ]);
            }

            return redirect()->route('admin.sale-invoices.index')
                ->with('success', 'Sale Invoice Updated Successfully.');
        });
    }

    // -----------------------------
    // Reverse effects helper (stock, composition, customer balance, P/L)
    // -----------------------------
    protected function reverseInvoiceEffects(SaleInvoice $saleInvoice): void
    {
        // Reverse customer balance to previous opening (from transaction if exists)
        $transaction = \App\Models\Transaction::where('sale_invoice_id', $saleInvoice->id)->first();
        if ($transaction) {
            $customer = PartyDetail::find($saleInvoice->select_customer_id);
            if ($customer) {
                // Bring back to opening before this invoice
                // We don't know the type here explicitly; infer using logic similar to applySaleOnBalance inverse.
                // Since opening_balance & closing_balance are numeric values without type,
                // we will restore to opening numerically and infer type:
                $opening = (float)$transaction->opening_balance;
                // If you store types separately, use them. Otherwise assume:
                // If closing was Credit and sale was positive, opening likely closer to Debit/Credit based on your domain rules.
                // We'll try to extract from json_data if present.
                $type = $customer->opening_balance_type ?? 'Debit';
                if ($transaction->json_data) {
                    $jd = json_decode($transaction->json_data, true);
                    $type = $jd['customer_before']['type'] ?? $type;
                }
                $customer->current_balance = $opening;
                $customer->current_balance_type = $type;
                $customer->save();
            }
        }

        // Reverse stocks using pivot items and composition
        $oldItems = $saleInvoice->items()->withPivot(['qty','price','amount','json_data'])->get();

        foreach ($oldItems as $item) {
            $qty   = (float)($item->pivot->qty ?? 0);
            $price = (float)($item->pivot->price ?? 0);

            if ($item->item_type === 'product') {
                // 1) Add back finished product stock
                $stock = CurrentStock::where('item_id', $item->id)->first();
                if ($stock) {
                    $prev = $stock->qty;
                    $stock->qty = $stock->qty + $qty;
                    $stock->save();

                    \App\Models\SaleLog::create([
                        'sale_invoice_id' => $saleInvoice->id,
                        'item_id'         => $item->id,
                        'item_type'       => 'product_reversal',
                        'stock_id'        => $stock->id,
                        'previous_qty'    => $prev,
                        'sold_qty'        => -$qty,
                        'previous_amount' => $prev * $price,
                        'sold_amount'     => -($item->pivot->amount ?? 0),
                        'price'           => $price,
                        'sold_to_user_id' => $saleInvoice->select_customer_id,
                        'created_by_id'   => auth()->id(),
                        'json_data_sale_invoice'          => json_encode($saleInvoice),
                        'json_data_add_item_sale_invoice' => $item->pivot->json_data ?? null,
                    ]);
                }

                // 2) Add back raw materials consumed
                $compositionRows = $this->fetchCompositionRowsForItem($item->id);
                foreach ($compositionRows as $c) {
                    $usedTotalQty = ((float)$c->qty) * $qty;
                    $rawStock = CurrentStock::where('item_id', $c->select_raw_material_id)->first();
                    if ($rawStock) {
                        $prev = $rawStock->qty;
                        $rawStock->qty = $rawStock->qty + $usedTotalQty;
                        $rawStock->save();

                        \App\Models\SaleLog::create([
                            'sale_invoice_id' => $saleInvoice->id,
                            'item_id'         => $c->select_raw_material_id,
                            'item_type'       => 'raw_material_reversal',
                            'stock_id'        => $rawStock->id,
                            'previous_qty'    => $prev,
                            'sold_qty'        => -$usedTotalQty,
                            'sold_amount'     => 0,
                            'price'           => 0,
                            'sold_to_user_id' => $saleInvoice->select_customer_id,
                            'created_by_id'   => auth()->id(),
                            'json_data_sale_invoice'          => json_encode($saleInvoice),
                        ]);
                    }
                }
            } else {
                // service reversal log (no stock)
                \App\Models\SaleLog::create([
                    'sale_invoice_id' => $saleInvoice->id,
                    'item_id'         => $item->id,
                    'item_type'       => 'service_reversal',
                    'sold_qty'        => -$qty,
                    'sold_amount'     => -($item->pivot->amount ?? 0),
                    'price'           => $price,
                    'sold_to_user_id' => $saleInvoice->select_customer_id,
                    'json_data_sale_invoice'          => json_encode($saleInvoice),
                    'json_data_add_item_sale_invoice' => $item->pivot->json_data ?? null,
                ]);
            }
        }

        // Clear existing P/L row; will be re-inserted on update
        DB::table('sale_profit_losses')->where('sale_invoice_id', $saleInvoice->id)->delete();
    }

    // -----------------------------
    // Show / Destroy / MassDestroy / CKEditor
    // -----------------------------
    public function show(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $saleInvoice->load('select_customer','items','created_by','media');
        return view('admin.saleInvoices.show', compact('saleInvoice'));
    }

    public function destroy(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $saleInvoice->delete();
        return back()->with('success', 'Sale Invoice deleted successfully!');
    }

    public function massDestroy(MassDestroySaleInvoiceRequest $request)
    {
        SaleInvoice::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sale_invoice_create') && Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new SaleInvoice();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    // -----------------------------
    // PDF
    // -----------------------------
public function pdf(SaleInvoice $saleInvoice)
{
    $saleInvoice->load([
        'select_customer',
        'items' => function ($query) {
            $query->withPivot([
                'description','qty','unit','price','discount_type','discount',
                'tax_type','tax','amount','created_by_id','json_data',
            ]);
        },
        'created_by',
        'main_cost_center',
        'sub_cost_center',
    ]);

    $user = auth()->user();
    $company = $user->select_companies()->first();
    $logoUrl = $company?->getFirstMediaUrl('logo_upload') ?? null;

    $userRole = $user->roles->first()->title;

    // ✅ SUPER ADMIN → All bank + all terms
    if ($userRole === 'Super Admin') {
        $bankDetails = BankAccount::where('print_bank_details', 1)->get();
        $terms = TermAndCondition::where('status', 'active')->get();

        return view('admin.saleInvoices.pdf', compact('saleInvoice', 'bankDetails', 'terms', 'company', 'logoUrl'));
    }

    // ✅ If logged-in user is Admin → He is the main admin
    if ($userRole === 'Admin') {
        $mainAdminId = $user->id;
    } else {
        // ✅ Branch User → find Main Admin from add_business_user table
        $mainAdminId = DB::table('add_business_user')
            ->where('user_id', $user->id)
            ->value('add_business_id'); // this is main admin id

        if (!$mainAdminId) {
            $mainAdminId = $user->id; // fallback
        }
    }

    // ✅ Get all branches under this main admin
    $branchUserIds = DB::table('add_business_user')
        ->where('add_business_id', $mainAdminId) // fetch branch users of this admin
        ->pluck('user_id')
        ->toArray();

    // Include main admin also
    $allRelatedUsers = array_merge([$mainAdminId], $branchUserIds);

    // ✅ Fetch bank accounts of main admin + branches
    $bankDetails = BankAccount::whereIn('created_by_id', $allRelatedUsers)
        ->where('print_bank_details', 1)
        ->get();

    // ✅ Terms also based on main admin only
    $terms = TermAndCondition::where('status', 'active')
        ->where('created_by_id', $mainAdminId)
        ->get();

    return view('admin.saleInvoices.pdf', compact('saleInvoice', 'bankDetails', 'terms', 'company', 'logoUrl'));
}


    // =========================================================================
    //                      ADMIN-ONLY STATUS UPDATE (Option B)
    // =========================================================================
    public function updateStatus(Request $request, SaleInvoice $saleInvoice)
    {
        // Only Admin/Super Admin can change status
        $user = auth()->user();
        $role = $user->roles->pluck('title')->first();
        abort_unless(in_array($role, ['Admin','Super Admin']), 403, 'Only Admin can change status');

        $request->validate([
            'status' => 'required|string|in:Draft,Pending,Approved,Rejected,Canceled,Cancelled',
        ]);

        $newStatus = $request->status === 'Canceled' ? 'Cancelled' : $request->status;
        $current   = $saleInvoice->status ?? 'Draft';

        // Allowed transitions: Draft -> Pending -> Approved/Rejected/Cancelled
        $allowed = [
            'Draft'   => ['Pending'],
            'Pending' => ['Approved','Rejected','Cancelled'],
            'Approved'=> [], // lock forward unless you want to allow cancel; customize if needed
            'Rejected'=> [],
            'Cancelled'=> [],
        ];

        if (!isset($allowed[$current]) || !in_array($newStatus, $allowed[$current])) {
            return back()->withErrors(['status' => "Not allowed to change status from {$current} to {$newStatus}."]);
        }

        $saleInvoice->update(['status' => $newStatus]);

        // Optional: log status change
        \App\Models\SaleLog::create([
            'sale_invoice_id' => $saleInvoice->id,
            'item_id'         => null,
            'item_type'       => 'status_change',
            'sold_qty'        => 0,
            'sold_amount'     => 0,
            'price'           => 0,
            'sold_to_user_id' => $saleInvoice->select_customer_id,
            'created_by_id'   => auth()->id(),
            'json_data_sale_invoice' => json_encode([
                'old_status' => $current,
                'new_status' => $newStatus,
            ]),
        ]);

        return back()->with('success', "Status updated to {$newStatus}.");
    }
    // ... inside App\Http\Controllers\Admin\SaleInvoiceController



    protected function canChangeStatus(User $user, SaleInvoice $invoice): bool
    {
    // Super Admin can always change
    $isSuper = $user->roles()->where('title', 'Super Admin')->exists();
    if ($isSuper) return true;

    // Company Admin of the invoice's company can change
    $invoiceCreator = $invoice->created_by()->first(); // relation exists in your code (created_by)
    if (!$invoiceCreator) return false;

    $userCompany = $user->select_companies()->first();
    $invoiceCompany = $invoiceCreator->select_companies()->first();

    $isAdmin = $user->roles()->where('title', 'Admin')->exists();

    return $isAdmin && $userCompany && $invoiceCompany && $userCompany->id === $invoiceCompany->id;
    }

/**
 * GET: Status History (for slide-over timeline)
 */
    public function getStatusHistory(SaleInvoice $saleInvoice)
    {
    abort_if(Gate::denies('sale_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $history = SaleInvoiceStatusHistory::with(['changedBy:id,name'])
        ->where('sale_invoice_id', $saleInvoice->id)
        ->orderByDesc('created_at')
        ->get()
        ->map(function ($row) {
            return [
                'id' => $row->id,
                'old_status' => $row->old_status,
                'new_status' => $row->new_status,
                'remark' => $row->remark,
                'changed_by' => $row->changedBy?->name ?? '—',
                'changed_at' => optional($row->created_at)->format('d M Y, h:i A'),
            ];
        });

    return response()->json([
        'status' => 'success',
        'data' => [
            'current_status' => $saleInvoice->status ?? 'Pending',
            'history' => $history,
        ],
    ]);
    }

    public function AupdateStatus(Request $request, SaleInvoice $saleInvoice)
{
    $validated = $request->validate([
        'new_status' => 'required|string|in:Pending,Approved,Rejected,Cancelled,Other',
        'remark'     => 'nullable|string|max:2000',
    ]);

    $user = auth()->user();
    if (!$this->canChangeStatus($user, $saleInvoice)) {
        return response()->json([
            'status' => 'error',
            'message' => 'You are not allowed to change status.',
        ], 403);
    }

    $old = $saleInvoice->status ?? 'Pending';
    $new = $validated['new_status'];

    if ($old === $new) {
        return response()->json([
            'status' => 'success',
            'message' => 'Status unchanged.',
            'data' => ['status' => $new]
        ]);
    }

    $saleInvoice->status = $new;
    $saleInvoice->save();

    SaleInvoiceStatusHistory::create([
        'sale_invoice_id' => $saleInvoice->id,
        'old_status'      => $old,
        'new_status'      => $new,
        'remark'          => $request->remark,
        'changed_by_id'   => $user->id,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Status updated.',
        'data' => [
            'status' => $new,
        ],
    ]);
}

}
