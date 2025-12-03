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
use Symfony\Component\HttpFoundation\Response;

class ProformaInvoiceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    //================================================
    // INDEX
    //================================================
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

        return view('admin.proformaInvoices.index', compact('challans'));
    }

    //================================================
    // GET CUSTOMER DETAILS AJAX
    //================================================
    public function getCustomerDetails($id)
    {
        $customer = PartyDetail::withoutGlobalScopes()->find($id);

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
            'opening_balance'       => $customer->opening_balance,
            'opening_balance_type'  => $customer->opening_balance_type,
            'opening_balance_date'  => $customer->opening_balance_date,
            'current_balance'       => $customer->current_balance,
            'current_balance_type'  => $customer->current_balance_type,
            'current_balance_date'  => $customer->updated_at,
        ]);
    }

    //================================================
    // CREATE
    //================================================
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

        // customers
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

        // items
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

        return view('admin.proformaInvoices.create', compact('items', 'select_customers', 'cost', 'sub_cost'));
    }

    //================================================
    // STORE
    //================================================
    public function store(Request $request)
    {
       
        $request->validate([
            'select_customer_id'      => 'required|exists:party_details,id',
            'po_no'                   => 'required|string',
            'po_date'                 => 'required|date',
            'items'                   => 'required|array|min:1',
            'items.*.add_item_id'     => 'required|exists:add_items,id',
            'items.*.qty'             => 'required|numeric|min:1',
            'attachment'              => 'nullable|file|max:10240',
            'main_cost_centers_id'     => 'required|exists:main_cost_centers,id',
            'sub_cost_centers_id'      => 'required|exists:sub_cost_centers,id',
            'subtotal'             => 'required',
            'total'                => 'required',

        ]);
        
        return DB::transaction(function () use ($request) {

            $challan_no = 'DC-' . now()->format('YmdHis') . rand(100, 999);

            $challan = ProformaInvoice::create([
                'delivery_challan_number' => $challan_no,
                'payment_type'            => $request->payment_type, 
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
                'status'                  => 'Draft',
                'main_cost_centers_id'     => $request->main_cost_centers_id,
                'sub_cost_centers_id'      => $request->sub_cost_centers_id,
            ]);

            if ($request->hasFile('attachment')) {
                $challan->addMediaFromRequest('attachment')->toMediaCollection('document');
            }

            // attach + STOCK MINUS
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

            return redirect()->route('admin.proforma-invoices.index')
                ->with('success', 'Proforma Invoice Created (stock updated).');
        });
    }

    //================================================
    // EDIT
    //================================================
public function edit(ProformaInvoice $proformaInvoice)
{
    abort_if(Gate::denies('proforma_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    // Load pivot data
    $proformaInvoice->load([
        'select_customer',
        'items' => function ($q) {
            $q->withPivot([
                'description','qty','unit','price',
                'discount_type','discount',
                'tax_type','tax','amount',
                'created_by_id','json_data'
            ]);
        },
        'created_by'
    ]);

    // Customers
    $select_customers = PartyDetail::select(
            'id','party_name','opening_balance',
            'opening_balance_type','current_balance',
            'current_balance_type'
        )->get()
        ->mapWithKeys(function($c){
            $balance = $c->current_balance ?? $c->opening_balance ?? 0;
            $type    = $c->current_balance_type ?? $c->opening_balance_type ?? 'Debit';
            $display = $type === 'Debit'
                ? "₹{$balance} Dr - Payable ↑"
                : "₹{$balance} Cr - Receivable ↓";
            return [$c->id => "{$c->party_name} ({$display})"];
        });

    // Items with stock
    $items = AddItem::whereIn('item_type', ['product', 'service'])
        ->with('select_unit')->get()
        ->map(function($item){
            $item->stock_qty = $item->item_type === 'product'
                ? CurrentStock::where('item_id', $item->id)->sum('qty')
                : null;
            return $item;
        });

    // cost center
    $cost     = MainCostCenter::pluck('cost_center_name', 'id')
                ->prepend(trans('global.pleaseSelect'), '');

    $sub_cost = SubCostCenter::pluck('sub_cost_center_name', 'id')
                ->prepend(trans('global.pleaseSelect'), '');

    return view('admin.ProformaInvoices.edit', compact(
        'proformaInvoice','items','select_customers','cost','sub_cost'
    ));
}


    //================================================
    // UPDATE
    //================================================
public function update(Request $request, ProformaInvoice $proformaInvoice)
{
    abort_if(Gate::denies('proforma_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    if ($proformaInvoice->status === 'Converted') {
        return back()->with('error', 'This Proforma has already been converted. It cannot be edited.');
    }

    $request->validate([
        'select_customer_id'      => 'required|exists:party_details,id',
        'po_no'                   => 'required|string',
        'po_date'                 => 'required|date',
        'items'                   => 'required|array|min:1',
        'items.*.add_item_id'     => 'required|exists:add_items,id',
        'items.*.qty'             => 'required|numeric|min:1',
        'attachment'              => 'nullable|file|max:10240',
    ]);

    return DB::transaction(function() use ($request, $proformaInvoice) {

        // reverse previous stock effects
        $this->reverseChallanEffects($proformaInvoice);

        // media
        if ($request->hasFile('attachment')) {
            $proformaInvoice->clearMediaCollection('document');
            $proformaInvoice->addMediaFromRequest('attachment')->toMediaCollection('document');
        }

        // update master
        $proformaInvoice->update([
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
        $proformaInvoice->items()->detach();

        foreach ($request->items as $itemData) {
            $item = AddItem::findOrFail($itemData['add_item_id']);

            $proformaInvoice->items()->attach($item->id, [
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

            // stock minus again
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

        return redirect()->route('admin.proforma-invoices.index')
            ->with('success', 'Proforma Invoice Updated (stock re-applied).');
    });
}


    //================================================
    // REVERSE STOCK HELPER
    //================================================
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
    }

    //================================================
    // CONVERT TO SALE
    //================================================
public function convertToSale(Request $request, ProformaInvoice $proformaInvoice)
{
    abort_if(Gate::denies('proforma_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    if ($proformaInvoice->status === 'Converted') {
        return back()->with('info', 'Already converted to Sale.');
    }

    return DB::transaction(function() use ($request, $proformaInvoice) {

        $sale_invoice_number = 'ET-' . now()->format('YmdHis') . rand(100, 999);

        $invoice = SaleInvoice::create([
            'sale_invoice_number' => $sale_invoice_number,
            'payment_type'        => $request->payment_type,
            'select_customer_id'  => $request->select_customer_id,
            'po_no'               => $request->po_no,
            'docket_no'           => $request->docket_no,
            'po_date'             => $request->po_date,
            'due_date'            => $request->due_date,
            'e_way_bill_no'       => $request->e_way_bill_no,
            'phone_number'        => $request->phone_number,
            'billing_address'     => $request->billing_address,
            'shipping_address'    => $request->shipping_address,
            'notes'               => $request->notes,
            'terms'               => $request->terms,
            'overall_discount'    => $request->overall_discount ?? 0,
            'subtotal'            => $request->subtotal ?? 0,
            'tax'                 => $request->tax ?? 0,
            'discount'            => $request->discount ?? 0,
            'total'               => $request->total ?? 0,
            'created_by_id'       => auth()->id(),
            'json_data'           => json_encode($request->all()),
            'status'              => 'converted dc to sale',

            // FIXED HERE 👇
            'main_cost_center_id' => $request->main_cost_center_id ?? null,  
            'sub_cost_center_id'  => $request->sub_cost_center_id ?? null, 

            'price'               => 0,
        ]);

        // attach items
        if ($request->has('items')) {

            foreach ($request->items as $it) {

                $invoice->items()->attach($it['add_item_id'], [
                    'description'   => $it['description'] ?? null,
                    'qty'           => $it['qty'] ?? 0,
                    'unit'          => $it['unit'] ?? null,
                    'price'         => $it['price'] ?? 0,
                    'discount_type' => $it['discount_type'] ?? null,
                    'discount'      => $it['discount'] ?? 0,
                    'tax_type'      => $it['tax_type'] ?? null,
                    'tax'           => $it['tax'] ?? 0,
                    'amount'        => $it['amount'] ?? 0,
                    'created_by_id' => auth()->id(),
                    'json_data'     => $it['json_data'] ?? null,
                ]);

            }
        }

        // update status
        $proformaInvoice->update([
            'status' => 'Converted',
            'converted_sale_invoice_id' => $invoice->id
        ]);

        return redirect()
            ->route('admin.sale-invoices.edit', $invoice->id)
            ->with('success', 'Proforma Invoice converted to Sale Invoice.');
    });
}


    //================================================
    // BALANCE HELPER
    //================================================
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

    //================================================
    // ITEM COMPOSITION AJAX
    //================================================
    protected function fetchCompositionRowsForItem($itemId)
    {
        return DB::table('finished_goods_raw_material')
            ->where('item_id', $itemId)
            ->get();
    }

    //================================================
    // SHOW
    //================================================
public function show(ProformaInvoice $proformaInvoice)
{
    abort_if(Gate::denies('proforma_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $proformaInvoice->load([
        'select_customer',
        'items' => function ($q) {
            $q->withPivot([
                'description','qty','unit','price',
                'discount_type','discount',
                'tax_type','tax','amount',
                'created_by_id','json_data'
            ]);
        },
        'created_by',
        'main_cost_center',
        'sub_cost_center',
        'media',
    ]);

    return view('admin.proformaInvoices.show', compact('proformaInvoice'));
}


    //================================================
    // DESTROY
    //================================================
    public function destroy(ProformaInvoice $proformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DB::transaction(function() use ($proformaInvoice){
            $this->reverseChallanEffects($proformaInvoice);
            $proformaInvoice->items()->detach();
            $proformaInvoice->delete();
        });

        return back()->with('success', 'Proforma Invoice deleted & stock restored.');
    }

    //================================================
    // PDF
    //================================================
    public function pdf(ProformaInvoice $proformaInvoice)
    {
        $bankDetails = BankAccount::where('print_bank_details', 1)->get();
        $terms       = TermAndCondition::where('status', 'active')->get();

        $proformaInvoice->load([
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

        return view('admin.proformaInvoices.pdf', compact(
            'proformaInvoice','bankDetails','terms','company','logoUrl'
        ));
    }
}
