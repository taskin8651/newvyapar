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

        $saleInvoices = SaleInvoice::with(['select_customer', 'items', 'created_by', 'media'])->get();

        return view('admin.saleInvoices.index', compact('saleInvoices'));
    }

    public function create()
    {
        abort_if(Gate::denies('sale_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        return view('admin.saleInvoices.create', compact('items', 'select_customers'));
    }

    public function store(StoreSaleInvoiceRequest $request)
    {
        $saleInvoice = SaleInvoice::create($request->all());
        $saleInvoice->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            $saleInvoice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($request->input('document', false)) {
            $saleInvoice->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $saleInvoice->id]);
        }

        return redirect()->route('admin.sale-invoices.index');
    }

    public function edit(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        $saleInvoice->load('select_customer', 'items', 'created_by');

        return view('admin.saleInvoices.edit', compact('items', 'saleInvoice', 'select_customers'));
    }

    public function update(UpdateSaleInvoiceRequest $request, SaleInvoice $saleInvoice)
    {
        $saleInvoice->update($request->all());
        $saleInvoice->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            if (! $saleInvoice->image || $request->input('image') !== $saleInvoice->image->file_name) {
                if ($saleInvoice->image) {
                    $saleInvoice->image->delete();
                }
                $saleInvoice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($saleInvoice->image) {
            $saleInvoice->image->delete();
        }

        if ($request->input('document', false)) {
            if (! $saleInvoice->document || $request->input('document') !== $saleInvoice->document->file_name) {
                if ($saleInvoice->document) {
                    $saleInvoice->document->delete();
                }
                $saleInvoice->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
            }
        } elseif ($saleInvoice->document) {
            $saleInvoice->document->delete();
        }

        return redirect()->route('admin.sale-invoices.index');
    }

    public function show(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleInvoice->load('select_customer', 'items', 'created_by');

        return view('admin.saleInvoices.show', compact('saleInvoice'));
    }

    public function destroy(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleInvoice->delete();

        return back();
    }

    public function massDestroy(MassDestroySaleInvoiceRequest $request)
    {
        $saleInvoices = SaleInvoice::find(request('ids'));

        foreach ($saleInvoices as $saleInvoice) {
            $saleInvoice->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sale_invoice_create') && Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SaleInvoice();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
