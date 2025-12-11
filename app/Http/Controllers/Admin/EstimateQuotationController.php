<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\AddItem;
use App\Models\EstimateQuotation;
use App\Models\PartyDetail;
use App\Models\MainCostCenter;
use App\Models\SubCostCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class EstimateQuotationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    //================================================
    // INDEX
    //================================================
    public function index()
    {
        abort_if(Gate::denies('estimate_quotation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = auth()->user();
        $userRole = $user->roles->pluck('title')->first();

        if ($userRole === 'Super Admin') {
            $estimateQuotations = EstimateQuotation::withoutGlobalScopes()
                ->with(['select_customer', 'items', 'created_by', 'media'])
                ->latest()
                ->get();
        } else {
            $estimateQuotations = EstimateQuotation::with(['select_customer', 'items', 'created_by', 'media'])
                ->where('created_by_id', $user->id)
                ->latest()
                ->get();
        }

        return view('admin.estimateQuotations.index', compact('estimateQuotations'));
    }

    //================================================
    // GET CUSTOMER DETAILS (AJAX)
    //================================================
    public function getCustomerDetails($id)
    {
        $customer = PartyDetail::withoutGlobalScopes()->find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json([
            'party_name'           => $customer->party_name,
            'phone_number'         => $customer->phone_number,
            'email'                => $customer->email,
            'gstin'                => $customer->gstin,
            'pan_number'           => $customer->pan_number,
            'billing_address'      => $customer->billing_address,
            'shipping_address'     => $customer->shipping_address,
            'state'                => $customer->state,
            'city'                 => $customer->city,
            'pincode'              => $customer->pincode,
            'credit_limit'         => $customer->credit_limit,
            'payment_terms'        => $customer->payment_terms,
            'opening_balance'      => $customer->opening_balance,
            'opening_balance_type' => $customer->opening_balance_type,
            'opening_balance_date' => $customer->opening_balance_date,
            'current_balance'      => $customer->current_balance,
            'current_balance_type' => $customer->current_balance_type,
            'updated_at'           => $customer->updated_at,
        ]);
    }


    //================================================
    // GET ITEM COMPOSITION (AJAX)
    //================================================
    public function getItemComposition($itemId)
    {
        $rows = DB::table('finished_goods_raw_material')
            ->where('item_id', $itemId)
            ->get();

        // Attach raw material names + sale/purchase prices
        $composition = $rows->map(function ($r) {
            $item = AddItem::find($r->select_raw_material_id);

            return [
                'id'             => $r->select_raw_material_id,
                'name'           => $item->item_name ?? 'Unknown',
                'qty_used'       => $r->qty,
                'sale_price'     => $item->sale_price ?? 0,
                'purchase_price' => $item->purchase_price ?? 0,
            ];
        });

        return response()->json(['composition' => $composition]);
    }


    //================================================
    // CREATE (copy from Proforma, STOCK REMOVED)
    //================================================
    public function create()
    {
        abort_if(Gate::denies('estimate_quotation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = Auth::user();
        $userId = $user->id;
        $userRole = $user->roles->pluck('title')->first();

        // customers
        if ($userRole === 'Super Admin') {
            $select_customers = PartyDetail::withoutGlobalScopes()->get();
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
                ->with('select_unit')
                ->get();
        } else {
            $items = AddItem::where('created_by_id', $userId)
                ->with('select_unit')
                ->get();
        }

        // Cost center
        $cost = MainCostCenter::pluck('cost_center_name', 'id')
            ->prepend('Please select', '');

        $sub_cost = SubCostCenter::pluck('sub_cost_center_name', 'id')
            ->prepend('Please select', '');

        return view('admin.estimateQuotations.create', compact(
            'items',
            'select_customers',
            'cost',
            'sub_cost'
        ));
    }


    //================================================
    // STORE (NO STOCK UPDATE)
    //================================================
    public function store(Request $request)
    {
    //    dd($request->all());
        $request->validate([
            'select_customer_id'  => 'required|exists:party_details,id',
            'po_no'               => 'required|string',
            'po_date'             => 'required|date',
            'items'               => 'required|array|min:1',
            'items.*.add_item_id' => 'required|exists:add_items,id',
            'items.*.qty'         => 'required|numeric|min:1',
            'main_cost_centers_id' => 'required|exists:main_cost_centers,id',
            'sub_cost_centers_id' => 'required|exists:sub_cost_centers,id',
        ]);

        return DB::transaction(function () use ($request) {

            $estimate_no = 'EST-' . now()->format('YmdHis') . rand(100, 999);

            $estimate = EstimateQuotation::create([
                'estimate_quotations_number'        => $estimate_no,
                'payment_type'           => $request->payment_type,
                'select_customer_id'     => $request->select_customer_id,
                'po_no'                  => $request->po_no,
                'po_date'                => $request->po_date,
                'due_date'               => $request->due_date,
                'billing_address'        => $request->billing_address_invoice,
                'shipping_address'       => $request->shipping_address_invoice,
                'notes'                  => $request->notes,
                'terms'                  => $request->terms,
                'overall_discount'       => $request->overall_discount ?? 0,
                'subtotal'               => $request->subtotal ?? 0,
                'tax'                    => $request->tax ?? 0,
                'discount'               => $request->discount ?? 0,
                'total'                  => $request->total ?? 0,
                'created_by_id'          => auth()->id(),
                'json_data'              => json_encode($request->all()),
                'main_cost_centers_id'   => $request->main_cost_centers_id,
                'sub_cost_centers_id'    => $request->sub_cost_centers_id,
            ]);

            if ($request->hasFile('attachment')) {
                $estimate->addMediaFromRequest('attachment')->toMediaCollection('document');
            }

            foreach ($request->items as $item) {
                $estimate->items()->attach($item['add_item_id'], [
                    'qty'           => $item['qty'],
                    'unit'          => $item['unit'] ?? '',
                    'price'         => $item['price'] ?? 0,
                    'discount_type' => $item['discount_type'] ?? 'value',
                    'discount'      => $item['discount'] ?? 0,
                    'tax_type'      => $item['tax_type'] ?? 'without',
                    'tax'           => $item['tax'] ?? 0,
                    'amount'        => $item['amount'] ?? 0,
                    'json_data'     => json_encode($item),
                    'created_by_id' => auth()->id(),
                ]);
            }

            return redirect()
                ->route('admin.estimate-quotations.index')
                ->with('success', 'Estimate created successfully.');
        });
    }

    //================================================
    // EDIT
    //================================================
    public function edit(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = auth()->user();
        $userId = $user->id;
        $userRole = $user->roles->pluck('title')->first();

        // Customers
        if ($userRole === 'Super Admin') {
            $select_customers = PartyDetail::withoutGlobalScopes()->get();
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

        // items (no stock restrictions for estimates)
        if ($userRole === 'Super Admin') {
            $items = AddItem::withoutGlobalScopes()
                ->whereIn('item_type', ['product', 'service'])
                ->with('select_unit')
                ->get();
        } else {
            $items = AddItem::where('created_by_id', $userId)
                ->with('select_unit')
                ->get();
        }

        $cost = MainCostCenter::pluck('cost_center_name', 'id')
            ->prepend('Please select', '');

        $sub_cost = SubCostCenter::pluck('sub_cost_center_name', 'id')
            ->prepend('Please select', '');

        // load pivot data
        $estimateQuotation->load([
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
            'media'
        ]);

        return view('admin.estimateQuotations.edit', compact(
            'estimateQuotation','items','select_customers','cost','sub_cost'
        ));
    }

    //================================================
    // UPDATE
    //================================================
    public function update(Request $request, EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'select_customer_id'  => 'required|exists:party_details,id',
            'po_no'               => 'required|string',
            'po_date'             => 'required|date',
            'items'               => 'required|array|min:1',
            'items.*.add_item_id' => 'required|exists:add_items,id',
            'items.*.qty'         => 'required|numeric|min:1',
            'main_cost_centers_id' => 'required|exists:main_cost_centers,id',
            'sub_cost_centers_id' => 'required|exists:sub_cost_centers,id',
        ]);

        return DB::transaction(function () use ($request, $estimateQuotation) {

            // media
            if ($request->hasFile('attachment')) {
                $estimateQuotation->clearMediaCollection('document');
                $estimateQuotation->addMediaFromRequest('attachment')->toMediaCollection('document');
            }

            // update master
            $estimateQuotation->update([
                'payment_type'           => $request->payment_type,
                'select_customer_id'     => $request->select_customer_id,
                'po_no'                  => $request->po_no,
                'po_date'                => $request->po_date,
                'due_date'               => $request->due_date,
                'billing_address'        => $request->billing_address_invoice,
                'shipping_address'       => $request->shipping_address_invoice,
                'notes'                  => $request->notes,
                'terms'                  => $request->terms,
                'overall_discount'       => $request->overall_discount ?? 0,
                'subtotal'               => $request->subtotal ?? 0,
                'tax'                    => $request->tax ?? 0,
                'discount'               => $request->discount ?? 0,
                'total'                  => $request->total ?? 0,
                'json_data'              => json_encode($request->all()),
                'main_cost_centers_id'   => $request->main_cost_centers_id,
                'sub_cost_centers_id'    => $request->sub_cost_centers_id,
            ]);

            // detach old pivot rows and attach new ones (no stock ops)
            $estimateQuotation->items()->detach();

            foreach ($request->items as $item) {
                $estimateQuotation->items()->attach($item['add_item_id'], [
                    'qty'           => $item['qty'],
                    'unit'          => $item['unit'] ?? '',
                    'price'         => $item['price'] ?? 0,
                    'discount_type' => $item['discount_type'] ?? 'value',
                    'discount'      => $item['discount'] ?? 0,
                    'tax_type'      => $item['tax_type'] ?? 'without',
                    'tax'           => $item['tax'] ?? 0,
                    'amount'        => $item['amount'] ?? 0,
                    'json_data'     => json_encode($item),
                    'created_by_id' => auth()->id(),
                ]);
            }

            return redirect()
                ->route('admin.estimate-quotations.index')
                ->with('success', 'Estimate updated successfully.');
        });
    }

    //================================================
    // SHOW
    //================================================
    public function show(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimateQuotation->load([
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
            'media'
        ]);

        return view('admin.estimateQuotations.show', compact('estimateQuotation'));
    }

    //================================================
    // DESTROY
    //================================================
    public function destroy(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DB::transaction(function() use ($estimateQuotation) {
            // no stock reverse (estimates don't change stock)
            $estimateQuotation->items()->detach();
            $estimateQuotation->delete();
        });

        return back()->with('success', 'Estimate deleted successfully.');
    }

    //================================================
    // MASS DESTROY
    //================================================
    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('estimate_quotation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ids = $request->input('ids', []);
        $estimates = EstimateQuotation::whereIn('id', $ids)->get();

        foreach ($estimates as $estimate) {
            $estimate->items()->detach();
            $estimate->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    //================================================
    // PDF (simple loader - uses company logo & bank terms if needed)
    //================================================
    public function pdf(EstimateQuotation $estimateQuotation)
    {
        // You can customize this to use BankAccount / TermAndCondition models like proforma
        $estimateQuotation->load([
            'select_customer',
            'items' => function ($q) {
                $q->withPivot([
                    'description','qty','unit','price','discount_type','discount','tax_type','tax','amount','created_by_id','json_data',
                ]);
            },
            'created_by',
        ]);

        $user    = auth()->user();
        $company = $user->select_companies()->first();
        $logoUrl = $company?->getFirstMediaUrl('logo_upload') ?? null;

        return view('admin.estimateQuotations.invoice', compact('estimateQuotation','company','logoUrl'));
    }

    //================================================
    // CKEditor images
    //================================================
    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('estimate_quotation_create') && Gate::denies('estimate_quotation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new EstimateQuotation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
public function convert(Request $request, EstimateQuotation $estimate)
{
    abort_if(Gate::denies('estimate_quotation_show'), 403);

    // ensure status exists
    if ($estimate->status === 'converted') {
        return back()->with('info', 'Already converted to Sale.');
    }

    return DB::transaction(function () use ($estimate) {

        // CREATE SALE INVOICE NUMBER
        $sale_no = 'SI-' . now()->format('YmdHis') . rand(100, 999);

        // SALE INVOICE CREATE
        $invoice = \App\Models\SaleInvoice::create([
            'sale_invoice_number' => $sale_no,
            'payment_type'        => $estimate->payment_type,
            'select_customer_id'  => $estimate->select_customer_id,
            'po_no'               => $estimate->po_no,
            'po_date'             => $estimate->po_date,
            'due_date'            => $estimate->due_date,
            'billing_address'     => $estimate->billing_address,
            'shipping_address'    => $estimate->shipping_address,
            'notes'               => $estimate->notes,
            'terms'               => $estimate->terms,
            'subtotal'            => $estimate->subtotal,
            'tax'                 => $estimate->tax,
            'discount'            => $estimate->discount,
            'overall_discount'    => $estimate->overall_discount,
            'total'               => $estimate->total,
            'status'              => 'converted from estimate',

            // FIXED — correct field names for sale invoice table
            'main_cost_center_id' => $estimate->main_cost_centers_id,
            'sub_cost_center_id'  => $estimate->sub_cost_centers_id,

            'created_by_id'       => auth()->id(),
            'docket_no'           => $estimate->docket_no,
            'e_way_bill_no'       => $estimate->e_way_bill_no,
            'phone_number'        => $estimate->customer_phone_invoice,
            'terms'               => $estimate->terms,
            'notes'               => $estimate->notes,

            'created_by_id'       => auth()->id(),
          

            // Only store sanitized JSON
                'json_data'     => json_encode([
                'estimate_id'   => $estimate->id,
                'estimate_no'   => $estimate->estimate_quotations_number,
                'customer_id'   => $estimate->select_customer_id,
                'subtotal'      => $estimate->subtotal,
                'tax'           => $estimate->tax,
                'discount'      => $estimate->discount,
                'total'         => $estimate->total,
            ], JSON_UNESCAPED_UNICODE),
        ]);


        // ATTACH ITEMS + STOCK REDUCE
        foreach ($estimate->items as $it) {

            // Attach to invoice pivot
            $invoice->items()->attach($it->id, [
                'qty'           => $it->pivot->qty,
                'unit'          => $it->pivot->unit,
                'price'         => $it->pivot->price,
                'discount'      => $it->pivot->discount,
                'tax'           => $it->pivot->tax,
                'tax_type'      => $it->pivot->tax_type,
                'amount'        => $it->pivot->amount,
                'created_by_id' => auth()->id(),
                'json_data'     => $it->pivot->json_data,
            ]);

            // STOCK REDUCE (CurrentStock)
            if ($it->item_type === 'product') {

                $currentStock = \App\Models\CurrentStock::where('item_id', $it->id)
                    ->latest()
                    ->first();

                if ($currentStock) {

                    $currentStock->qty -= $it->pivot->qty;
                    if ($currentStock->qty < 0) {
                        $currentStock->qty = 0;
                    }
                    $currentStock->save();

                } else {
                    \App\Models\CurrentStock::create([
                        'user_id'       => auth()->id(),
                        'created_by_id' => auth()->id(),
                        'item_id'       => $it->id,
                        'qty'           => 0 - $it->pivot->qty,
                        'type'          => 'Sale Minus',
                        'product_type'  => 'product',
                        'json_data'     => json_encode(['source' => 'estimate convert']),
                    ]);
                }
            }
        }

        // CUSTOMER BALANCE UPDATE
        $customer = PartyDetail::find($estimate->select_customer_id);
        if ($customer) {
            $customer->current_balance = ($customer->current_balance ?? 0) + $estimate->total;
            $customer->save();
        }

        // UPDATE ESTIMATE STATUS
        $estimate->update([
            'status' => 'converted',
            'converted_sale_invoice_id' => $invoice->id
        ]);

        return redirect()
            ->route('admin.sale-invoices.edit', $invoice->id)
            ->with('success', 'Estimate Converted to Sale Invoice.');
    });
}



public function cancel(EstimateQuotation $estimateQuotation)
{
    if ($estimateQuotation->status === 'converted') {
        return back()->with('error', 'Converted estimate cannot be cancelled.');
    }

    $estimateQuotation->update([
        'status' => 'cancelled'
    ]);

    return back()->with('success', 'Estimate cancelled.');
}
public function updateDate(Request $request, EstimateQuotation $estimateQuotation)
{
    $request->validate([
        'due_date' => 'required|date'
    ]);

    $estimateQuotation->update([
        'due_date' => $request->due_date
    ]);

    return back()->with('success', 'Valid date updated.');
}

}

