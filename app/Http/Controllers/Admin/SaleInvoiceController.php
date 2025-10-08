<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySaleInvoiceRequest;
use App\Http\Requests\StoreSaleInvoiceRequest;
use App\Http\Requests\UpdateSaleInvoiceRequest;
use App\Models\AddItem;
use App\Models\CurrentStock;
use App\Models\PartyDetail;
use App\Models\SaleInvoice;
use App\Models\MainCostCenter;
use App\Models\SubCostCenter;
use Gate;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

use App\Models\BankAccount;
use App\Models\TermAndCondition;


class SaleInvoiceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('sale_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleInvoices = SaleInvoice::with(['select_customer', 'items', 'created_by', 'media'])->latest()->get();

        return view('admin.saleInvoices.index', compact('saleInvoices'));
    }

public function create()
{
    abort_if(Gate::denies('sale_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    // Customers dropdown
  $select_customers = \App\Models\PartyDetail::select('id', 'party_name', 'opening_balance', 'opening_balance_type')
    ->get()
    ->mapWithKeys(function($customer) {
        $balance = number_format($customer->opening_balance, 2);
        $type = $customer->opening_balance_type === 'Debit' ? 'Dr' : 'Cr';
        return [$customer->id => "{$customer->party_name} (₹{$balance} {$type})"];
    });




    // Fetch all items (products + services)
    $items = AddItem::whereIn('item_type', ['product', 'service'])
        ->select('id', 'item_name', 'sale_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
        ->with('select_unit') // for unit name
        ->get()
        ->map(function ($item) {
            if ($item->item_type === 'product') {
                // Get total quantity from current_stocks
                $item->stock_qty = CurrentStock::whereHas('addItems', function ($q) use ($item) {
                    $q->where('add_item_id', $item->id);
                })->sum('qty');
            } else {
                // Services don't have stock
                $item->stock_qty = null;
            }
            return $item;
        });
       
    // Cost centers
    $cost = \App\Models\MainCostCenter::pluck('cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $sub_cost = \App\Models\SubCostCenter::pluck('sub_cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    return view('admin.saleInvoices.create', compact('items', 'select_customers', 'cost', 'sub_cost'));
}




public function getCustomerDetails($id)
{
    $customer = PartyDetail::find($id);

    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    // Get current balance from your current_stocks or relevant table
    $currentBalance = $customer->current_balance ?? null; // replace with actual logic

    return response()->json([
        'party_name' => $customer->party_name,
        'gstin' => $customer->gstin,
        'phone_number' => $customer->phone_number,
        'pan_number' => $customer->pan_number,
        'billing_address' => $customer->billing_address,
        'shipping_address' => $customer->shipping_address,
        'state' => $customer->state,
        'city' => $customer->city,
        'pincode' => $customer->pincode,
        'email' => $customer->email,
        'credit_limit' => $customer->credit_limit_amount ?? 0,
        'payment_terms' => $customer->payment_terms,
        'opening_balance' => $customer->opening_balance,
        'opening_balance_date' => optional($customer->created_at)->format('d-m-Y'),
        'current_balance' => $currentBalance,
        'opening_balance_type' => $customer->opening_balance_type
    ]);
}

    public function getSubCostCenters($mainCostCenterId)
    {
        $subCostCenters = SubCostCenter::where('main_cost_center_id', $mainCostCenterId)
            ->select('id', 'sub_cost_center_name as name')
            ->get();

        return response()->json($subCostCenters);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'select_customer_id' => 'required|exists:party_details,id',
            'po_no' => 'required|string',
            'po_date' => 'required|date',
            'docket_no' => 'nullable|string',
            'billing_address_invoice' => 'nullable|string',
            'items' => 'required|array',
            'items.*.add_item_id' => 'required|exists:add_items,id',
            'items.*.qty' => 'required|numeric|min:1',
        ]);
       
        // Handle attachment
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        // Generate random sale invoice number
        $sale_invoice_number = 'ET-' . now()->format('YmdHis') . rand(100,999);
      
        // Save invoice
        $invoice = SaleInvoice::create([
            'sale_invoice_number' => $sale_invoice_number,
            'payment_type' => $request->payment_type,
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

        ]);
        // dd($invoice);

        foreach ($request->items as $itemData) {
            $item = \App\Models\AddItem::find($itemData['add_item_id']);

            // Attach item to invoice pivot
            $invoice->items()->attach($item->id, [
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
            ]);

            if ($item->item_type === 'product') {
                // Fetch current stock by item_id
                $stock = \App\Models\CurrentStock::where('item_id', $item->id)->first();
               
                if ($stock) {
                    $previousQty = $stock->qty; // or quantity_available if using that column
                    $previousAmount = $previousQty * $itemData['price'];

                    // Deduct sold quantity
                    $stock->qty -= $itemData['qty'];
                    $stock->save();

                    // Create Sale Log
                    \App\Models\SaleLog::create([
                        'sale_invoice_id' => $invoice->id,
                        'item_id' => $item->id,
                        'item_type' => 'product',
                        'stock_id' => $stock->id,
                        'previous_qty' => $previousQty,
                        'sold_qty' => $itemData['qty'],
                        'previous_amount' => $previousAmount,
                        'sold_amount' => $itemData['amount'] ?? 0,
                        'price' => $itemData['price'],
                        'sold_to_user_id' => $request->select_customer_id,
                        'created_by_id' => auth()->id(),
                        'json_data_add_item_sale_invoice' => json_encode($itemData),
                        'json_data_current_stock' => json_encode($stock),
                        'json_data_sale_invoice' => json_encode($invoice),
                    ]);
                }
            }
            else {
                // For service, just log sale
                \App\Models\SaleLog::create([
                    'sale_invoice_id' => $invoice->id,
                    'item_id' => $item->id,
                    'item_type' => 'service',
                    'sold_qty' => $itemData['qty'],
                    'sold_amount' => $itemData['amount'] ?? 0,
                    'price' => $itemData['price'],
                    'sold_to_user_id' => $request->select_customer_id,
                    'json_data_sale_invoice' => json_encode($invoice),
                    'json_data_add_item_sale_invoice' => json_encode($itemData),

                ]);
            }
        }

        return redirect()->route('admin.sale-invoices.index')->with('success', 'Sale Invoice Created Successfully.');
    }



    public function edit(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $items = AddItem::select('id', 'item_name', 'price', 'unit', 'hsn')->get();
        $mainCostCenters = MainCostCenter::pluck('cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $subCostCenters = SubCostCenter::where('main_cost_center_id', $saleInvoice->main_cost_center)->pluck('sub_cost_center_name', 'id');

        $saleInvoice->load('select_customer', 'items', 'created_by');

        return view('admin.saleInvoices.edit', compact('saleInvoice', 'select_customers', 'items', 'mainCostCenters', 'subCostCenters'));
    }

    public function update(UpdateSaleInvoiceRequest $request, SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleInvoice->update([
            'customer_id' => $request->customer_id,
            'bill_date' => $request->bill_date,
            'payment_type' => $request->payment_type,
            'subtotal' => $request->subtotal ?? 0,
            'total_tax' => $request->total_tax ?? 0,
            'grand_total' => $request->grand_total ?? 0,
            'main_cost_center' => $request->main_cost_center,
            'sub_cost_center' => $request->sub_cost_center,
            'notes' => $request->notes,
        ]);

        // Update Items
        $saleInvoice->items()->detach();
        if ($request->has('products')) {
            foreach ($request->products as $prod) {
                if (!empty($prod['product_id'])) {
                    $saleInvoice->items()->attach($prod['product_id'], [
                        'quantity' => $prod['quantity'] ?? 1,
                        'unit' => $prod['unit'] ?? '',
                        'price' => $prod['price'] ?? 0,
                        'discount' => $prod['discount'] ?? 0,
                        'tax' => $prod['tax'] ?? 0,
                        'total' => $prod['total'] ?? 0,
                    ]);
                }
            }
        }

        // Re-upload attachments
        if ($request->file('attachments')) {
            $saleInvoice->clearMediaCollection('attachments');
            foreach ($request->file('attachments') as $file) {
                $saleInvoice->addMedia($file)->toMediaCollection('attachments');
            }
        }

        return redirect()->route('admin.sale-invoices.index')->with('success', 'Sale Invoice updated successfully!');
    }

    public function show(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleInvoice->load('select_customer', 'items', 'created_by', 'media');

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

     public function pdf(SaleInvoice $saleInvoice)
    {
        // Bank details for PDF
        $bankDetails = BankAccount::all();

        // Only active terms
        $terms = TermAndCondition::where('status', 'active')->get();

        // Load relationships
        $saleInvoice->load(
            'select_customer', 
            'items', 
            'created_by'
        );

        // Return PDF view
        return view('admin.saleInvoices.pdf', compact('saleInvoice', 'bankDetails', 'terms'));
    }
}
