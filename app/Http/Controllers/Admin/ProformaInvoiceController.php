<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\AddItem;
use App\Models\BankAccount;
use App\Models\CurrentStock;
use App\Models\ProformaInvoice;
use App\Models\MainCostCenter;
use App\Models\PartyDetail;
use App\Models\SaleInvoice;
use App\Models\SubCostCenter;
use App\Models\TermAndCondition;
use App\Models\Transaction;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
class ProformaInvoiceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('proforma_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user   = auth()->user();
        $userId = $user->id;
        $userRole = $user->roles->pluck('title')->first();

        $allowedUserIds = collect([$userId]);
        $company   = $user->select_companies()->first();
        $companyId = $company?->id;

        if ($companyId) {
            $companyUserIds = DB::table('add_business_user')
                ->where('add_business_id', $companyId)
                ->pluck('user_id')
                ->toArray();

            $companyAdminId = User::whereIn('id', $companyUserIds)
                ->whereHas('roles', fn($q) => $q->where('title', 'Admin'))
                ->value('id');

            if ($companyAdminId) $allowedUserIds->push($companyAdminId);

            $parentId = $user->created_by_id;
            if ($parentId) {
                $allowedUserIds->push($parentId);

                $parent = User::find($parentId);
                if ($parent) {
                    $parentCompanyId = $parent->select_companies()->first()?->id;
                    if ($parentCompanyId) {
                        $parentCompanyUsers = DB::table('add_business_user')
                            ->where('add_business_id', $parentCompanyId)
                            ->pluck('user_id')
                            ->toArray();

                        $parentAdminId = User::whereIn('id', $parentCompanyUsers)
                            ->whereHas('roles', fn($q) => $q->where('title', 'Admin'))
                            ->value('id');

                        if ($parentAdminId) $allowedUserIds->push($parentAdminId);
                    }
                }
            }

            if ($userRole === 'Admin') $allowedUserIds = collect($companyUserIds);
        }

        $allowedUserIds = $allowedUserIds->unique()->toArray();

        if ($userRole === 'Super Admin') {
            $challans = ProformaInvoice::withoutGlobalScopes()
                ->with(['select_customer' => fn($q)=>$q->withoutGlobalScopes(),'items','created_by','media'])
                ->latest()->paginate(10);
        } else {
            $challans = ProformaInvoice::with(['select_customer','items','created_by','media'])
                ->whereIn('created_by_id', $allowedUserIds)
                ->latest()->paginate(10);
        }

        return view('admin.ProformaInvoices.index', compact('challans'));
    }

    // -----------------------------
    // Create: same dropdowns and stocks
    // -----------------------------
    public function create()
    {
        abort_if(Gate::denies('proforma_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = Auth::user();
        $userId = $user->id;
        $userRole = $user->roles->pluck('title')->first();

        $company = $user->select_companies()->first();
        $companyId = $company?->id;

        $allowedUserIds = collect([$userId]);

        if ($companyId) {
            $companyUserIds = DB::table('add_business_user')
                ->where('add_business_id', $companyId)
                ->pluck('user_id')
                ->toArray();

            $companyAdminId = User::whereIn('id', $companyUserIds)
                ->whereHas('roles', fn($q) => $q->where('title', 'Admin'))
                ->value('id');

            if ($companyAdminId) $allowedUserIds->push($companyAdminId);

            $parentId = $user->created_by_id;
            if ($parentId) {
                $allowedUserIds->push($parentId);

                $parent = User::find($parentId);
                if ($parent) {
                    $parentCompanyId = $parent->select_companies()->first()?->id;
                    if ($parentCompanyId) {
                        $parentCompanyUsers = DB::table('add_business_user')
                            ->where('add_business_id', $parentCompanyId)
                            ->pluck('user_id')->toArray();

                        $parentAdminId = User::whereIn('id', $parentCompanyUsers)
                            ->whereHas('roles', fn($q) => $q->where('title', 'Admin'))
                            ->value('id');

                        if ($parentAdminId) $allowedUserIds->push($parentAdminId);
                    }
                }
            }

            if ($userRole === 'Admin') $allowedUserIds = collect($companyUserIds);
        }

        $allowedUserIds = $allowedUserIds->unique()->toArray();

        // Customers (no balance mutation in challan)
        if ($userRole === 'Super Admin') {
            $select_customers = PartyDetail::withoutGlobalScopes()->get();
        } elseif ($companyId) {
            $select_customers = PartyDetail::whereIn('created_by_id', $allowedUserIds)->get();
        } else {
            $select_customers = PartyDetail::where('created_by_id', $userId)->get();
        }

        $select_customers = $select_customers->mapWithKeys(function ($c) {
            $balance = $c->current_balance ?? $c->opening_balance ?? 0;
            $type    = $c->current_balance_type ?? $c->opening_balance_type ?? 'Debit';
            $balanceFormatted = number_format($balance, 2);
            $display = $type === 'Debit'
                ? "₹{$balanceFormatted} Dr - Payable ↑"
                : "₹{$balanceFormatted} Cr - Receivable ↓";
            return [$c->id => "{$c->party_name} ({$display})"];
        });

        // Items with stock
        if ($userRole === 'Super Admin') {
            $items = AddItem::withoutGlobalScopes()
                ->whereIn('item_type', ['product', 'service'])
                ->with('select_unit')->get();
        } elseif ($companyId) {
            $items = AddItem::whereIn('created_by_id', $allowedUserIds)
                ->whereIn('item_type', ['product', 'service'])
                ->with('select_unit')->get();
        } else {
            $items = AddItem::where('created_by_id', $userId)
                ->whereIn('item_type', ['product', 'service'])
                ->with('select_unit')->get();
        }

        $items->map(function ($item) use ($userRole, $companyId, $allowedUserIds, $userId) {
            if ($item->item_type === 'product') {
                if ($userRole === 'Super Admin') {
                    $item->stock_qty = CurrentStock::where('item_id', $item->id)->sum('qty');
                } elseif ($companyId) {
                    $item->stock_qty = CurrentStock::whereIn('created_by_id', $allowedUserIds)
                        ->where('item_id', $item->id)->sum('qty');
                } else {
                    $item->stock_qty = CurrentStock::where('created_by_id', $userId)
                        ->where('item_id', $item->id)->sum('qty');
                }
            } else {
                $item->stock_qty = null;
            }
            return $item;
        });

        $cost = MainCostCenter::whereIn('created_by_id', $allowedUserIds)
            ->pluck('cost_center_name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $sub_cost = SubCostCenter::whereIn('created_by_id', $allowedUserIds)
            ->pluck('sub_cost_center_name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ProformaInvoices.create', compact('items', 'select_customers', 'cost', 'sub_cost'));
    }

    // helper: composition
    protected function fetchCompositionRowsForItem($itemId)
    {
        return DB::table('finished_goods_raw_material')
            ->where('item_id', $itemId)
            ->get();
    }

    // -----------------------------
    // Store: STOCK MINUS ONLY, NO PARTY BALANCE
    // -----------------------------
    public function store(Request $request)
    {
        abort_if(Gate::denies('delivery_challan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'select_customer_id'      => 'required|exists:party_details,id',
            'po_no'                   => 'required|string',
            'po_date'                 => 'required|date',
            'docket_no'               => 'nullable|string',
            'items'                   => 'required|array|min:1',
            'items.*.add_item_id'     => 'required|exists:add_items,id',
            'items.*.qty'             => 'required|numeric|min:1',
            'attachment'              => 'nullable|file|max:10240',
        ]);

        return DB::transaction(function () use ($request) {

            $challan_no = 'DC-' . now()->format('YmdHis') . rand(100, 999);

            $challan = ProformaInvoice::create([
                'delivery_challan_number' => $challan_no,
                'payment_type'            => $request->payment_type, // informational
                'select_customer_id'      => $request->select_customer_id,
                'po_no'                   => $request->po_no,
                'docket_no'               => $request->docket_no,
                'po_date'                 => $request->po_date,
                'due_date'                => $request->due_date,
                'e_way_bill_no'           => $request->e_way_bill_no,
                'phone_number'            => $request->customer_phone_invoice,
                'billing_address'         => $request->billing_address_invoice,
                'shipping_address'        => $request->shipping_address_invoice,
                'notes'                   => $request->notes,
                'terms'                   => $request->terms,
                'overall_discount'        => $request->overall_discount ?? 0,
                'subtotal'                => $request->subtotal ?? 0,
                'tax'                     => $request->tax ?? 0,
                'discount'                => $request->discount ?? 0,
                'total'                   => $request->total ?? 0,
                'created_by_id'           => auth()->id(),
                'json_data'               => json_encode($request->all()),
                'status'                  => 'Draft', // or Pending
                'main_cost_center_id'     => $request->main_cost_center_id,
                'sub_cost_center_id'      => $request->sub_cost_center_id,
            ]);

            if ($request->hasFile('attachment')) {
                $challan->addMediaFromRequest('attachment')->toMediaCollection('document');
            }

            // attach + STOCK MINUS (finished + raw)
            foreach ($request->items as $itemData) {
                $item = AddItem::findOrFail($itemData['add_item_id']);

                $challan->items()->attach($item->id, [
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
                    // raw material minus
                    $compositionRows = $this->fetchCompositionRowsForItem($item->id);
                    foreach ($compositionRows as $c) {
                        $usedTotalQty = ((float)$c->qty) * (float)$itemData['qty'];
                        $rawStock = CurrentStock::where('item_id', $c->select_raw_material_id)->first();
                        if ($rawStock) {
                            $rawStock->qty = max(0, $rawStock->qty - $usedTotalQty);
                            $rawStock->save();
                        }
                    }
                    // finished minus
                    $stock = CurrentStock::where('item_id', $item->id)->first();
                    if ($stock) {
                        $stock->qty = max(0, $stock->qty - (float)$itemData['qty']);
                        $stock->save();
                    }
                }
            }

            return redirect()->route('admin.delivery-challans.index')
                ->with('success', 'Delivery Challan Created (stock updated).');
        });
    }

    // -----------------------------
    // Edit (load same lists)
    // -----------------------------
    public function edit(ProformaInvoice $ProformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::select('id','party_name','opening_balance','opening_balance_type','current_balance','current_balance_type')
            ->get()
            ->mapWithKeys(function($c){
                $balance = $c->current_balance ?? $c->opening_balance ?? 0;
                $type    = $c->current_balance_type ?? $c->opening_balance_type ?? 'Debit';
                $balanceFormatted = number_format($balance, 2);
                $display = $type === 'Debit'
                    ? "₹{$balanceFormatted} Dr - Payable ↑"
                    : "₹{$balanceFormatted} Cr - Receivable ↓";
                return [$c->id => "{$c->party_name} ({$display})"];
            });

        $items = AddItem::whereIn('item_type', ['product', 'service'])
            ->select('id','item_name','sale_price','select_unit_id','item_hsn','item_code','item_type','purchase_price')
            ->with('select_unit')->get()
            ->map(function($item){
                $item->stock_qty = $item->item_type === 'product'
                    ? CurrentStock::where('item_id', $item->id)->sum('qty')
                    : null;
                return $item;
            });

        $cost     = MainCostCenter::pluck('cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $sub_cost = SubCostCenter::pluck('sub_cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ProformaInvoice->load('select_customer','items');

        return view('admin.ProformaInvoices.edit', compact('ProformaInvoice','items','select_customers','cost','sub_cost'));
    }

    // -----------------------------
    // UPDATE: reverse previous stock, then apply new. NO PARTY BALANCE.
    // -----------------------------
    public function update(Request $request, ProformaInvoice $ProformaInvoice)
    {
        abort_if(Gate::denies('delivery_challan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'select_customer_id'      => 'required|exists:party_details,id',
            'po_no'                   => 'required|string',
            'po_date'                 => 'required|date',
            'items'                   => 'required|array|min:1',
            'items.*.add_item_id'     => 'required|exists:add_items,id',
            'items.*.qty'             => 'required|numeric|min:1',
            'attachment'              => 'nullable|file|max:10240',
        ]);

        return DB::transaction(function() use ($request, $ProformaInvoice) {

            // reverse previous stock effects
            $this->reverseChallanEffects($ProformaInvoice);

            // media
            if ($request->hasFile('attachment')) {
                $ProformaInvoice->clearMediaCollection('document');
                $ProformaInvoice->addMediaFromRequest('attachment')->toMediaCollection('document');
            }

            // update master
            $ProformaInvoice->update([
                'payment_type'         => $request->payment_type,
                'select_customer_id'   => $request->select_customer_id,
                'po_no'                => $request->po_no,
                'docket_no'            => $request->docket_no,
                'po_date'              => $request->po_date,
                'due_date'             => $request->due_date,
                'e_way_bill_no'        => $request->e_way_bill_no,
                'phone_number'         => $request->customer_phone_invoice,
                'billing_address'      => $request->billing_address_invoice,
                'shipping_address'     => $request->shipping_address_invoice,
                'notes'                => $request->notes,
                'terms'                => $request->terms,
                'overall_discount'     => $request->overall_discount ?? 0,
                'subtotal'             => $request->subtotal ?? 0,
                'tax'                  => $request->tax ?? 0,
                'discount'             => $request->discount ?? 0,
                'total'                => $request->total ?? 0,
                'json_data'            => json_encode($request->all()),
                'main_cost_center_id'  => $request->main_cost_center_id,
                'sub_cost_center_id'   => $request->sub_cost_center_id,
            ]);

            // detach old and attach new with stock effects
            $ProformaInvoice->items()->detach();

            foreach ($request->items as $itemData) {
                $item = AddItem::findOrFail($itemData['add_item_id']);

                $ProformaInvoice->items()->attach($item->id, [
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
                        $usedTotalQty = ((float)$c->qty) * (float)$itemData['qty'];
                        $rawStock = CurrentStock::where('item_id', $c->select_raw_material_id)->first();
                        if ($rawStock) {
                            $rawStock->qty = max(0, $rawStock->qty - $usedTotalQty);
                            $rawStock->save();
                        }
                    }
                    $stock = CurrentStock::where('item_id', $item->id)->first();
                    if ($stock) {
                        $stock->qty = max(0, $stock->qty - (float)$itemData['qty']);
                        $stock->save();
                    }
                }
            }

            return redirect()->route('admin.delivery-challans.index')
                ->with('success', 'Delivery Challan Updated (stock re-applied).');
        });
    }

    // reverse stock effects only
    protected function reverseChallanEffects(ProformaInvoice $challan): void
    {
        $oldItems = $challan->items()->withPivot(['qty','price','amount','json_data'])->get();

        foreach ($oldItems as $item) {
            $qty = (float)($item->pivot->qty ?? 0);

            if ($item->item_type === 'product') {
                // add back finished
                $stock = CurrentStock::where('item_id', $item->id)->first();
                if ($stock) {
                    $stock->qty = $stock->qty + $qty;
                    $stock->save();
                }
                // add back raw materials
                $compositionRows = $this->fetchCompositionRowsForItem($item->id);
                foreach ($compositionRows as $c) {
                    $usedTotalQty = ((float)$c->qty) * $qty;
                    $rawStock = CurrentStock::where('item_id', $c->select_raw_material_id)->first();
                    if ($rawStock) {
                        $rawStock->qty = $rawStock->qty + $usedTotalQty;
                        $rawStock->save();
                    }
                }
            }
        }

        // detach handled in update method
    }

    // -----------------------------
    // Convert to Sale: create SaleInvoice WITHOUT stock deduction; apply party balances here.
    // -----------------------------
    public function convertToSale(Request $request, ProformaInvoice $ProformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($ProformaInvoice->status === 'Converted') {
            return back()->with('info', 'Already converted to Sale.');
        }

        return DB::transaction(function() use ($request, $ProformaInvoice) {

            $ProformaInvoice->load('items');

            // create sale invoice skeleton (NO stock deduction again)
            $sale_invoice_number = 'ET-' . now()->format('YmdHis') . rand(100, 999);

            $invoice = SaleInvoice::create([
                'sale_invoice_number' => $sale_invoice_number,
                'payment_type'        => $ProformaInvoice->payment_type,
                'select_customer_id'  => $ProformaInvoice->select_customer_id,
                'po_no'               => $ProformaInvoice->po_no,
                'docket_no'           => $ProformaInvoice->docket_no,
                'po_date'             => $ProformaInvoice->po_date,
                'due_date'            => $ProformaInvoice->due_date,
                'e_way_bill_no'       => $ProformaInvoice->e_way_bill_no,
                'phone_number'        => $ProformaInvoice->phone_number,
                'billing_address'     => $ProformaInvoice->billing_address,
                'shipping_address'    => $ProformaInvoice->shipping_address,
                'notes'               => $ProformaInvoice->notes,
                'terms'               => $ProformaInvoice->terms,
                'overall_discount'    => $ProformaInvoice->overall_discount ?? 0,
                'subtotal'            => $ProformaInvoice->subtotal ?? 0,
                'tax'                 => $ProformaInvoice->tax ?? 0,
                'discount'            => $ProformaInvoice->discount ?? 0,
                'total'               => $ProformaInvoice->total ?? 0,
                'created_by_id'       => auth()->id(),
                'json_data'           => $ProformaInvoice->json_data,
                'status'              => 'Pending',
                'main_cost_center_id' => $ProformaInvoice->main_cost_center_id,
                'sub_cost_center_id'  => $ProformaInvoice->sub_cost_center_id,
                'price'               => 0,
            ]);

            // copy media file if any
            if ($ProformaInvoice->getFirstMedia('document')) {
                $media = $ProformaInvoice->getFirstMedia('document');
                $invoice
                    ->addMedia($media->getPath())
                    ->preservingOriginal()
                    ->toMediaCollection('document');
            }

            // attach items to invoice WITHOUT stock ops (already deducted in DC)
            foreach ($ProformaInvoice->items as $it) {
                $p = $it->pivot;
                $invoice->items()->attach($it->id, [
                    'description'   => $p->description,
                    'qty'           => $p->qty,
                    'unit'          => $p->unit,
                    'price'         => $p->price,
                    'discount_type' => $p->discount_type,
                    'discount'      => $p->discount,
                    'tax_type'      => $p->tax_type,
                    'tax'           => $p->tax,
                    'amount'        => $p->amount,
                    'created_by_id' => auth()->id(),
                    'json_data'     => $p->json_data,
                ]);
            }

            // Apply party balance like SaleInvoiceController
            $customer = PartyDetail::findOrFail($ProformaInvoice->select_customer_id);
            $baseBalance = $customer->current_balance ?? $customer->opening_balance ?? 0;
            $baseType    = $customer->current_balance_type ?? $customer->opening_balance_type ?? 'Debit';

            $totalSaleAmount = $invoice->total ?? 0;
            [$closingBalance, $closingType] = $this->applySaleOnBalance($baseBalance, $baseType, $totalSaleAmount);

            $customer->current_balance      = $closingBalance;
            $customer->current_balance_type = $closingType;
            $customer->save();

            // transaction create (simple)
            Transaction::create([
                'sale_invoice_id'      => $invoice->id,
                'select_customer_id'   => $customer->id,
                'payment_type_id'      => null,
                'main_cost_center_id'  => $invoice->main_cost_center_id,
                'sub_cost_center_id'   => $invoice->sub_cost_center_id,
                'sale_amount'          => $totalSaleAmount,
                'opening_balance'      => $baseBalance,
                'closing_balance'      => $closingBalance,
                'transaction_type'     => 'sale',
                'transaction_id'       => strtoupper('TXN' . rand(1000000000, 9999999999)),
                'created_by_id'        => auth()->id(),
                'json_data'            => json_encode([
                    'from_delivery_challan_id' => $ProformaInvoice->id,
                    'delivery_challan' => $ProformaInvoice->toArray(),
                    'invoice'          => $invoice->toArray(),
                    'customer_before'  => ['balance' => $baseBalance, 'type' => $baseType],
                    'customer_after'   => ['balance' => $closingBalance, 'type' => $closingType],
                ]),
            ]);

            // mark challan converted
            $ProformaInvoice->update(['status' => 'Converted', 'converted_sale_invoice_id' => $invoice->id]);

            return redirect()->route('admin.sale-invoices.edit', $invoice->id)
                ->with('success', 'Delivery Challan converted to Sale Invoice (balances applied).');
        });
    }

    // same helper from SaleInvoice
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

    // Ajax composition (for UI)
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
                    'name' => $r->name ?? (AddItem::find($r->id)->item_name ?? 'Unnamed'),
                    'qty_used' => (float)$r->qty_used,
                    'sale_price' => (float)$r->sale_price,
                    'purchase_price' => (float)$r->purchase_price,
                ];
            });

        return response()->json(['composition' => $rows]);
    }

    public function show(ProformaInvoice $ProformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ProformaInvoice->load('select_customer','items','created_by','media');
        return view('admin.ProformaInvoices.show', compact('ProformaInvoice'));
    }

    public function destroy(ProformaInvoice $ProformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // reverse stock before delete
        DB::transaction(function() use ($ProformaInvoice){
            $this->reverseChallanEffects($ProformaInvoice);
            $ProformaInvoice->items()->detach();
            $ProformaInvoice->delete();
        });
        return back()->with('success', 'Delivery Challan deleted & stock restored.');
    }

    public function pdf(ProformaInvoice $ProformaInvoice)
    {
        $bankDetails = BankAccount::where('print_bank_details', 1)->get();
        $terms       = TermAndCondition::where('status', 'active')->get();

        $ProformaInvoice->load([
            'select_customer',
            'items' => function ($query) {
                $query->withPivot([
                    'description','qty','unit','price','discount_type','discount','tax_type','tax','amount','created_by_id','json_data',
                ]);
            },
            'created_by',
            'main_cost_center',
            'sub_cost_center',
        ]);

        $user    = auth()->user();
        $company = $user->select_companies()->first();
        $logoUrl = $company?->getFirstMediaUrl('logo_upload') ?? null;

        return view('admin.ProformaInvoices.pdf', compact('ProformaInvoice','bankDetails','terms','company','logoUrl'));
    }
}


