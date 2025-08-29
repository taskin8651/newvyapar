<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSaleInvoiceRequest;
use App\Http\Requests\UpdateSaleInvoiceRequest;
use App\Http\Resources\Admin\SaleInvoiceResource;
use App\Models\SaleInvoice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleInvoiceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('sale_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SaleInvoiceResource(SaleInvoice::with(['select_customer', 'items', 'created_by'])->get());
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

        return (new SaleInvoiceResource($saleInvoice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SaleInvoiceResource($saleInvoice->load(['select_customer', 'items', 'created_by']));
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

        return (new SaleInvoiceResource($saleInvoice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleInvoice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
