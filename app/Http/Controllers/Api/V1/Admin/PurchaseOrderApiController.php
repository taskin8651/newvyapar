<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Http\Resources\Admin\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchaseOrderApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('purchase_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PurchaseOrderResource(PurchaseOrder::with(['select_customer', 'items', 'payment_type', 'created_by'])->get());
    }

    public function store(StorePurchaseOrderRequest $request)
    {
        $purchaseOrder = PurchaseOrder::create($request->all());
        $purchaseOrder->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            $purchaseOrder->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($request->input('document', false)) {
            $purchaseOrder->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
        }

        return (new PurchaseOrderResource($purchaseOrder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        abort_if(Gate::denies('purchase_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PurchaseOrderResource($purchaseOrder->load(['select_customer', 'items', 'payment_type', 'created_by']));
    }

    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->update($request->all());
        $purchaseOrder->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            if (! $purchaseOrder->image || $request->input('image') !== $purchaseOrder->image->file_name) {
                if ($purchaseOrder->image) {
                    $purchaseOrder->image->delete();
                }
                $purchaseOrder->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($purchaseOrder->image) {
            $purchaseOrder->image->delete();
        }

        if ($request->input('document', false)) {
            if (! $purchaseOrder->document || $request->input('document') !== $purchaseOrder->document->file_name) {
                if ($purchaseOrder->document) {
                    $purchaseOrder->document->delete();
                }
                $purchaseOrder->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
            }
        } elseif ($purchaseOrder->document) {
            $purchaseOrder->document->delete();
        }

        return (new PurchaseOrderResource($purchaseOrder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        abort_if(Gate::denies('purchase_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseOrder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
