<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProformaInvoiceRequest;
use App\Http\Requests\StoreProformaInvoiceRequest;
use App\Http\Requests\UpdateProformaInvoiceRequest;
use App\Models\AddItem;
use App\Models\PartyDetail;
use App\Models\ProformaInvoice;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProformaInvoiceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('proforma_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformaInvoices = ProformaInvoice::with(['select_customer', 'items', 'created_by', 'media'])->get();

        return view('admin.proformaInvoices.index', compact('proformaInvoices'));
    }

    public function create()
    {
        abort_if(Gate::denies('proforma_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        return view('admin.proformaInvoices.create', compact('items', 'select_customers'));
    }

    public function store(StoreProformaInvoiceRequest $request)
    {
        $proformaInvoice = ProformaInvoice::create($request->all());
        $proformaInvoice->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            $proformaInvoice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($request->input('document', false)) {
            $proformaInvoice->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $proformaInvoice->id]);
        }

        return redirect()->route('admin.proforma-invoices.index');
    }

    public function edit(ProformaInvoice $proformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        $proformaInvoice->load('select_customer', 'items', 'created_by');

        return view('admin.proformaInvoices.edit', compact('items', 'proformaInvoice', 'select_customers'));
    }

    public function update(UpdateProformaInvoiceRequest $request, ProformaInvoice $proformaInvoice)
    {
        $proformaInvoice->update($request->all());
        $proformaInvoice->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            if (! $proformaInvoice->image || $request->input('image') !== $proformaInvoice->image->file_name) {
                if ($proformaInvoice->image) {
                    $proformaInvoice->image->delete();
                }
                $proformaInvoice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($proformaInvoice->image) {
            $proformaInvoice->image->delete();
        }

        if ($request->input('document', false)) {
            if (! $proformaInvoice->document || $request->input('document') !== $proformaInvoice->document->file_name) {
                if ($proformaInvoice->document) {
                    $proformaInvoice->document->delete();
                }
                $proformaInvoice->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
            }
        } elseif ($proformaInvoice->document) {
            $proformaInvoice->document->delete();
        }

        return redirect()->route('admin.proforma-invoices.index');
    }

    public function show(ProformaInvoice $proformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformaInvoice->load('select_customer', 'items', 'created_by');

        return view('admin.proformaInvoices.show', compact('proformaInvoice'));
    }

    public function destroy(ProformaInvoice $proformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformaInvoice->delete();

        return back();
    }

    public function massDestroy(MassDestroyProformaInvoiceRequest $request)
    {
        $proformaInvoices = ProformaInvoice::find(request('ids'));

        foreach ($proformaInvoices as $proformaInvoice) {
            $proformaInvoice->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('proforma_invoice_create') && Gate::denies('proforma_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProformaInvoice();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
