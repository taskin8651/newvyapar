<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreProformaInvoiceRequest;
use App\Http\Requests\UpdateProformaInvoiceRequest;
use App\Http\Resources\Admin\ProformaInvoiceResource;
use App\Models\ProformaInvoice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProformaInvoiceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('proforma_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProformaInvoiceResource(ProformaInvoice::with(['select_customer', 'items', 'created_by'])->get());
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

        return (new ProformaInvoiceResource($proformaInvoice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProformaInvoice $proformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProformaInvoiceResource($proformaInvoice->load(['select_customer', 'items', 'created_by']));
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

        return (new ProformaInvoiceResource($proformaInvoice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProformaInvoice $proformaInvoice)
    {
        abort_if(Gate::denies('proforma_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proformaInvoice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
