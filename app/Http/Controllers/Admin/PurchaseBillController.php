<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPurchaseBillRequest;
use App\Http\Requests\StorePurchaseBillRequest;
use App\Http\Requests\UpdatePurchaseBillRequest;
use App\Models\AddItem;
use App\Models\BankAccount;
use App\Models\CurrentStock;
use App\Models\PartyDetail;
use App\Models\PurchaseBill;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Tests\Browser\PartyDetailsTest;
use App\Models\Unit;
use App\Models\TaxRate;
use Illuminate\Support\Facades\DB;
use App\Models\TermAndCondition;
use Carbon\Carbon;

class PurchaseBillController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('purchase_bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseBills = PurchaseBill::with(['select_customer', 'items', 'payment_type', 'created_by', 'media','main_cost_center', 'sub_cost_center'])->get();

        return view('admin.purchaseBills.index', compact('purchaseBills'));
    }


    public function getCustomerDetails($id)
    {
        $customer = \App\Models\PartyDetail::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json([
            'party_name'       => $customer->party_name,
            'gstin'           => $customer->gstin,
            'phone_number'    => $customer->phone_number,
            'email'           => $customer->email,
            'billing_address' => $customer->billing_address,
            'shipping_address'=> $customer->shipping_address,
            'state'           => $customer->state,
            'city'            => $customer->city,
        ]);
    }



 public function create()
{
    abort_if(Gate::denies('purchase_bill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    // 1️⃣ Fetch full customer details
    $select_customers = PartyDetail::all();

    // 2️⃣ Prepare array for dropdown + JS
    $select_customers_details = $select_customers->map(function($c){
    $opening_balance_date = $c->opening_balance_date ? Carbon::parse($c->opening_balance_date)->format('d-m-Y') : '-';
    
    $balance_type = $c->opening_balance_type ?? 'Debit'; // Default Debit
    if($balance_type === 'Debit'){
        $icon = '↓';
        $color = 'red';
        $label = 'Receivable';
    } else {
        $icon = '↑';
        $color = 'green';
        $label = 'Payable';
    }

    $opening_balance_text = "<span style='color: $color; font-weight:bold;'>"
                            . $c->opening_balance . " ($opening_balance_date) $balance_type ($label) $icon</span>";

    return [
        'id' => $c->id,
        'name' => $c->party_name . ' - ' . $opening_balance_text, // HTML included
        'party_name' => $c->party_name,
        'gstin' => $c->gstin,
        'phone' => $c->phone_number,
        'pan' => $c->pan_number,
        'billing_address' => $c->billing_address,
        'shipping_address' => $c->shipping_address,
        'state' => $c->state,
        'city' => $c->city,
        'pincode' => $c->pincode,
        'email' => $c->email,
        'credit_limit' => $c->credit_limit,
        'payment_terms' => $c->payment_terms,
        'opening_balance' => $c->opening_balance,
        'opening_balance_date' => $opening_balance_date,
        'opening_balance_type' => $c->opening_balance_type,
        'current_balance' => $c->current_balance,
    ];
});

    // 3️⃣ Fetch products, units, cost centers, payment types, tax rates (same as before)
    $items = AddItem::whereIn('item_type', ['product', 'service'])
        ->select('id', 'item_name', 'purchase_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
        ->with('select_unit')
        ->get()
        ->map(function ($item) {
            $item->stock_qty = ($item->item_type === 'product') ? CurrentStock::where('item_id', $item->id)->sum('qty') : null;
            return $item;
        });

    $product_ids = $items->where('item_type', 'product')->pluck('id')->toArray();
    $units = Unit::pluck('base_unit', 'id')->prepend(trans('global.pleaseSelect'), '');
    $cost = \App\Models\MainCostCenter::pluck('cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');
    $sub_cost = \App\Models\SubCostCenter::pluck('sub_cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');
    $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');
    $tax_rates = TaxRate::select('id', 'name', 'parcentage')->get();

    // 4️⃣ Pass to view
    return view('admin.purchaseBills.create', compact(
        'items',
        'product_ids',
        'payment_types',
        'select_customers',
        'select_customers_details', // 🔹 pass extra details for JS
        'cost',
        'sub_cost',
        'units',
        'tax_rates'
    ));
}



    public function getSubCostCenters($mainCostCenterId)
    {
        $subCostCenters = \App\Models\SubCostCenter::where('main_cost_center_id', $mainCostCenterId)
            ->pluck('sub_cost_center_name', 'id');

        return response()->json($subCostCenters);
    }



 public function store(Request $request)
{
    $request->validate([
        'select_customer_id' => 'required|exists:party_details,id',
        'po_no' => 'required|string',
        'reference_no' => 'required|string',
        'due_date' => 'required|date',
        'po_date' => 'required|date',
        'docket_no' => 'nullable|string',
        'billing_address_invoice' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.id' => 'required|exists:add_items,id',
        'items.*.qty' => 'required|numeric|min:1',
        'main_cost_center_id' => 'required|exists:main_cost_centers,id',
        'sub_cost_center_id' => 'required|exists:sub_cost_centers,id',
    ]);
    // Handle attachment
    $attachmentPath = $request->hasFile('attachment') 
        ? $request->file('attachment')->store('attachments', 'public') 
        : null;

    // Generate purchase invoice number
    $purchase_invoice_number = 'ET-' . now()->format('YmdHis') . rand(100,999);

    // Create PurchaseBill
    $invoice = PurchaseBill::create([
        'purchase_invoice_number' => $purchase_invoice_number,
        'select_customer_id' => $request->select_customer_id,
        'po_no' => $request->po_no,
        'docket_no' => $request->docket_no,
        'po_date' => $request->po_date,
        'due_date' => $request->due_date,
        'e_way_bill_no' => $request->e_way_bill_no,
        'phone_number' => $request->customer_phone_invoice,
        'billing_address' => $request->billing_address_invoice,
        'shipping_address' => $request->shipping_address_invoice,
        'notes' => $request->notes,
        'terms' => $request->terms,
        'overall_discount' => $request->overall_discount ?? 0,
        'subtotal' => $request->subtotal ?? 0,
        'tax' => $request->tax ?? 0,
        'discount' => $request->discount ?? 0,
        'total' => $request->total ?? 0,
        'attachment' => $attachmentPath,
        'created_by_id' => auth()->id(),
        'json_data' => json_encode($request->all()),
        'status' => 'pending',
        'main_cost_center_id' => $request->main_cost_center_id,
        'sub_cost_center_id'  => $request->sub_cost_center_id,
        'reference_no' => $request->reference_no,
        'ddescription' => $request->ddescription,
        'created_by_id' => auth()->id(),
        'payment_type_id' => $request->payment_type_id,
    ]);

    // Loop through items
    foreach ($request->items as $itemData) {
        $item = \App\Models\AddItem::find($itemData['id']);
        
        if (!$item) continue;

        $pivotData = [
            'description' => $itemData['description'] ?? null,
            'qty' => $itemData['qty'],
            'unit' => $itemData['unit'] ?? null,
            'price' => $itemData['price'] ?? 0,
            'discount_type' => $itemData['discount_type'] ?? 'value',
            'discount' => $itemData['discount'] ?? 0,
            'tax_type' => $itemData['tax_type'] ?? 'without',
            'tax' => $itemData['tax'] ?? 0,
            'amount' => $itemData['amount'] ?? 0,
            'created_by_id' => auth()->id(),
            'json_data' => json_encode($itemData),
        ];
        // dd($pivotData);

        if ($item->item_type === 'product') {
            $stock = \App\Models\CurrentStock::firstOrCreate(['item_id' => $item->id], ['qty' => 0]);
            $previousQty = $stock->qty;
            $stock->qty += $itemData['qty']; // increment stock
            $stock->save();

            // Attach using CurrentStock ID for clarity
            $invoice->items()->attach($stock->id, $pivotData);

            // Purchase Log
            \App\Models\PurchaseLog::create([
                'purchase_bill_id' => $invoice->id,
                'party_id' => $request->select_customer_id,
                'main_cost_center_id' => $request->main_cost_center_id,
                'sub_cost_center_id' => $request->sub_cost_center_id,
                'payment_type_id' => $request->payment_type_id,
                'json_data' => json_encode($request->all()),
                'purchase_bill_id' => $invoice->id,

                'stock_id' => $stock->id,
                'previous_qty' => $previousQty,
                'purchased_qty' => $itemData['qty'],
                'price' => $itemData['price'],
                'purchased_amount' => $itemData['amount'] ?? 0,
                'purchased_to_user_id' => $request->select_customer_id,
                'created_by_id' => auth()->id(),
                'json_data_purchase_invoice' => json_encode($itemData),
                'json_data_current_stock' => json_encode($stock->toArray()),
                'json_data_add_item_purchase_invoice' => json_encode($invoice->toArray()),
            ]);
        } else {
            // Service → attach normally
            $invoice->items()->attach($item->id, $pivotData);

            \App\Models\PurchaseLog::create([
                'purchase_bill_id' => $invoice->id,
                'party_id' => $request->select_customer_id,
                'main_cost_center_id' => $request->main_cost_center_id,
                'sub_cost_center_id' => $request->sub_cost_center_id,
                'payment_type_id' => $request->payment_type_id,
                'json_data' => json_encode($request->all()),
                'purchase_bill_id' => $invoice->id,
               
                'purchased_qty' => $itemData['qty'],
                'price' => $itemData['price'],
                'purchased_amount' => $itemData['amount'] ?? 0,
                'purchased_to_user_id' => $request->select_customer_id,
                'created_by_id' => auth()->id(),
                'json_data_purchase_invoice' => json_encode($itemData),
              
                'json_data_add_item_purchase_invoice' => json_encode($invoice->toArray()),

            ]);
        }
    }

    return redirect()->route('admin.purchase-bills.index')
                     ->with('success', 'Sale Invoice Created Successfully.');
}



public function edit(PurchaseBill $purchaseBill)
{
    abort_if(Gate::denies('purchase_bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    // Customers
    $select_customers = PartyDetail::pluck('party_name', 'id');
   
    // Cost Centers
    $cost = \App\Models\MainCostCenter::pluck('cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $sub_cost = \App\Models\SubCostCenter::pluck('sub_cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    // Units
    $units = Unit::pluck('base_unit', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    // Payment Types
    $payment_types = BankAccount::pluck('account_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    // Tax Rates
    $tax_rates = TaxRate::select('id', 'name', 'parcentage')->get();

    // Fetch items with their pivot data (products via current_stocks, services direct)
    $itemsWithPivot = collect();

    $pivotRecords = \DB::table('add_item_purchase_bill')
        ->where('purchase_bill_id', $purchaseBill->id)
        ->get();

    foreach ($pivotRecords as $pivot) {
        // Try joining current_stock → add_item
        $stock = \App\Models\CurrentStock::find($pivot->add_item_id);
        if ($stock && $stock->item_id) {
            $item = \App\Models\AddItem::find($stock->item_id);
            $itemsWithPivot->push([
               
                'stock_id' => $stock->id,
                'item_id' => $item->id,
                'item_name' => $item->item_name,
                'item_code' => $item->item_code,
                'item_hsn' => $item->item_hsn,
                'purchase_price' => $item->purchase_price,
                'unit' => $item->select_unit->base_unit ?? '',
                'qty' => $pivot->qty,
                'price' => $pivot->price,
                'discount' => $pivot->discount,
                'tax' => $pivot->tax,
                'amount' => $pivot->amount,
                'description' => $pivot->description,
            ]);
        } else {
            // For services (direct link)
            $item = \App\Models\AddItem::find($pivot->add_item_id);
            if ($item) {
                $itemsWithPivot->push([
                   
                    'stock_id' => null,
                    'item_id' => $item->id,
                    'item_name' => $item->item_name,
                    'item_code' => $item->item_code,
                    'item_hsn' => $item->item_hsn,
                    'purchase_price' => $item->purchase_price,
                    'unit' => $item->select_unit->base_unit ?? '',
                    'qty' => $pivot->qty,
                    'price' => $pivot->price,
                    'discount' => $pivot->discount,
                    'tax' => $pivot->tax,
                    'amount' => $pivot->amount,
                    'description' => $pivot->description,
                ]);
            }
        }
    }

    // All available items for dropdown
    $items = AddItem::whereIn('item_type', ['product', 'service'])
        ->select('id', 'item_name', 'purchase_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
        ->with('select_unit')
        ->get();

    foreach ($items as $itm) {
        $itm->stock_qty = $itm->item_type === 'product'
            ? CurrentStock::where('item_id', $itm->id)->sum('qty')
            : null;
    }

    return view('admin.purchaseBills.edit', compact(
        'purchaseBill',
        'itemsWithPivot',
        'items',
        'select_customers',
        'cost',
        'sub_cost',
        'units',
        'payment_types',
        'tax_rates'
    ));
}





public function update(Request $request, PurchaseBill $purchaseBill)
{
    $request->validate([
        'select_customer_id' => 'required|exists:party_details,id',
        'po_no' => 'required|string',
        'ref_no' => 'required|string',
        'due_date' => 'required|date',
        'po_date' => 'required|date',
        'items' => 'required|array|min:1',
        'items.*.id' => 'required|exists:add_items,id',
        'items.*.qty' => 'required|numeric|min:1',
        'main_cost_center_id' => 'required|exists:main_cost_centers,id',
        'sub_cost_center_id' => 'required|exists:sub_cost_centers,id',
    ]);

    // Handle new attachment
    $attachmentPath = $request->hasFile('attachment') 
        ? $request->file('attachment')->store('attachments', 'public') 
        : $purchaseBill->attachment;

    // Update PurchaseBill
    $purchaseBill->update([
        'select_customer_id' => $request->select_customer_id,
        'po_no' => $request->po_no,
        'ref_no' => $request->ref_no,
        'docket_no' => $request->docket_no,
        'po_date' => $request->po_date,
        'due_date' => $request->due_date,
        'billing_address' => $request->billing_address_invoice,
        'shipping_address' => $request->shipping_address_invoice,
        'notes' => $request->notes,
        'terms' => $request->terms,
        'overall_discount' => $request->overall_discount ?? 0,
        'subtotal' => $request->subtotal ?? 0,
        'tax' => $request->tax ?? 0,
        'discount' => $request->discount ?? 0,
        'total' => $request->total ?? 0,
        'attachment' => $attachmentPath,
        'main_cost_center_id' => $request->main_cost_center_id,
        'sub_cost_center_id'  => $request->sub_cost_center_id,
        'json_data' => json_encode($request->all()),
    ]);

    // Sync / update items
    $purchaseBill->items()->detach();

    foreach ($request->items as $itemData) {
        $item = \App\Models\AddItem::find($itemData['id']);
        if (!$item) continue;

        $pivotData = [
            'description' => $itemData['description'] ?? null,
            'qty' => $itemData['qty'],
            'unit' => $itemData['unit'] ?? null,
            'price' => $itemData['price'] ?? 0,
            'discount_type' => $itemData['discount_type'] ?? 'value',
            'discount' => $itemData['discount'] ?? 0,
            'tax_type' => $itemData['tax_type'] ?? 'without',
            'tax' => $itemData['tax'] ?? 0,
            'amount' => $itemData['amount'] ?? 0,
            'created_by_id' => auth()->id(),
            'json_data' => json_encode($itemData),
        ];

        if ($item->item_type === 'product') {
            $stock = \App\Models\CurrentStock::firstOrCreate(['item_id' => $item->id], ['qty' => 0]);
            $oldQty = $stock->qty;
            $stock->qty = $oldQty + ($itemData['qty'] ?? 0);
            $stock->save();

            $purchaseBill->items()->attach($stock->id, $pivotData);

            \App\Models\PurchaseLog::create([
                'purchase_bill_id' => $purchaseBill->id,
                'party_id' => $request->select_customer_id,
                'main_cost_center_id' => $request->main_cost_center_id,
                'sub_cost_center_id' => $request->sub_cost_center_id,
                'payment_type_id' => $request->payment_type_id,
                'json_data' => json_encode($request->all()),
                'stock_id' => $stock->id,
                'previous_qty' => $oldQty,
                'purchased_qty' => $itemData['qty'],
                'price' => $itemData['price'],
                'purchased_amount' => $itemData['amount'] ?? 0,
                'purchased_to_user_id' => $request->select_customer_id,
                'created_by_id' => auth()->id(),
                'json_data_purchase_invoice' => json_encode($itemData),
                'json_data_current_stock' => json_encode($stock->toArray()),
                'json_data_add_item_purchase_invoice' => json_encode($purchaseBill->toArray()),
            ]);
        } else {
            $purchaseBill->items()->attach($item->id, $pivotData);

            \App\Models\PurchaseLog::create([
                'purchase_bill_id' => $purchaseBill->id,
                'party_id' => $request->select_customer_id,
                'main_cost_center_id' => $request->main_cost_center_id,
                'sub_cost_center_id' => $request->sub_cost_center_id,
                'payment_type_id' => $request->payment_type_id,
                'json_data' => json_encode($request->all()),
                'purchased_qty' => $itemData['qty'],
                'price' => $itemData['price'],
                'purchased_amount' => $itemData['amount'] ?? 0,
                'purchased_to_user_id' => $request->select_customer_id,
                'created_by_id' => auth()->id(),
                'json_data_purchase_invoice' => json_encode($itemData),
                'json_data_add_item_purchase_invoice' => json_encode($purchaseBill->toArray()),
            ]);
        }
    }

    return redirect()->route('admin.purchase-bills.index')
                     ->with('success', 'Purchase Bill Updated Successfully.');
}



    public function show(PurchaseBill $purchaseBill)
    {
        abort_if(Gate::denies('purchase_bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseBill->load('select_customer', 'items', 'payment_type', 'created_by');

        return view('admin.purchaseBills.show', compact('purchaseBill'));
    }

    public function destroy(PurchaseBill $purchaseBill)
    {
        abort_if(Gate::denies('purchase_bill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseBill->delete();

        return back();
    }

    public function massDestroy(MassDestroyPurchaseBillRequest $request)
    {
        $purchaseBills = PurchaseBill::find(request('ids'));

        foreach ($purchaseBills as $purchaseBill) {
            $purchaseBill->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('purchase_bill_create') && Gate::denies('purchase_bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PurchaseBill();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

  public function pdf(PurchaseBill $purchaseBill)
{
    $bankDetails = BankAccount::all();
    $terms = TermAndCondition::where('status', 'active')->get();
    
    $purchaseBill->load([
        'select_customer',
        'items',          // pivot ke through current_stocks fetch hoga
        'payment_type',
        'created_by',
        'main_cost_center',
        'sub_cost_center'
    ]);
    return view('admin.purchaseBills.pdf', compact('purchaseBill', 'bankDetails', 'terms'));
}


}