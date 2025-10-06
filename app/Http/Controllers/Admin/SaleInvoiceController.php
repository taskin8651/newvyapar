<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySaleInvoiceRequest;
use App\Http\Requests\StoreSaleInvoiceRequest;
use App\Http\Requests\UpdateSaleInvoiceRequest;
use App\Models\AddItem;
use App\Models\PartyDetail;
use App\Models\SaleInvoice;
use App\Models\MainCostCenter;
use App\Models\SubCostCenter;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

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

    // Fetch customers for dropdown
    $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

    // Fetch all products (not services) and eager load related stocks
    $items = AddItem::where('item_type', 'product')
                    ->with(['currentStocks' => function ($q) {
                        $q->select('current_stocks.id', 'qty'); // fetch stock quantity
                    }])
                    ->select('id', 'item_name', 'sale_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
                    ->get();

    // Fetch main and sub cost centers
    $cost = \App\Models\MainCostCenter::pluck('cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');
    $sub_cost = \App\Models\SubCostCenter::pluck('sub_cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');

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

    public function store(StoreSaleInvoiceRequest $request)
    {
        abort_if(Gate::denies('sale_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Create Sale Invoice
        $saleInvoice = SaleInvoice::create([
            'customer_id' => $request->customer_id,
            'bill_date' => $request->bill_date,
            'payment_type' => $request->payment_type,
            'subtotal' => $request->subtotal ?? 0,
            'total_tax' => $request->total_tax ?? 0,
            'grand_total' => $request->grand_total ?? 0,
            'main_cost_center' => $request->main_cost_center,
            'sub_cost_center' => $request->sub_cost_center,
            'notes' => $request->notes,
            'created_by_id' => auth()->id(),
        ]);

        // Save Items
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

        // Handle uploads
        if ($request->file('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $saleInvoice->addMedia($file)->toMediaCollection('attachments');
            }
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $saleInvoice->id]);
        }

        return redirect()->route('admin.sale-invoices.index')->with('success', 'Sale Invoice created successfully!');
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
}
