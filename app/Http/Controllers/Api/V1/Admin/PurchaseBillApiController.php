<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePurchaseBillRequest;
use App\Http\Requests\UpdatePurchaseBillRequest;
use App\Http\Resources\Admin\PurchaseBillResource;
use App\Models\PurchaseBill;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchaseBillApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('purchase_bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PurchaseBillResource(PurchaseBill::with(['select_customer', 'items', 'payment_type', 'created_by'])->get());
    }

    public function store(StorePurchaseBillRequest $request)
    {
        $purchaseBill = PurchaseBill::create($request->all());
        $purchaseBill->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            $purchaseBill->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($request->input('document', false)) {
            $purchaseBill->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
        }

        return (new PurchaseBillResource($purchaseBill))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PurchaseBill $purchaseBill)
    {
        abort_if(Gate::denies('purchase_bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PurchaseBillResource($purchaseBill->load(['select_customer', 'items', 'payment_type', 'created_by']));
    }

    public function update(UpdatePurchaseBillRequest $request, PurchaseBill $purchaseBill)
    {
        $purchaseBill->update($request->all());
        $purchaseBill->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            if (! $purchaseBill->image || $request->input('image') !== $purchaseBill->image->file_name) {
                if ($purchaseBill->image) {
                    $purchaseBill->image->delete();
                }
                $purchaseBill->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($purchaseBill->image) {
            $purchaseBill->image->delete();
        }

        if ($request->input('document', false)) {
            if (! $purchaseBill->document || $request->input('document') !== $purchaseBill->document->file_name) {
                if ($purchaseBill->document) {
                    $purchaseBill->document->delete();
                }
                $purchaseBill->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
            }
        } elseif ($purchaseBill->document) {
            $purchaseBill->document->delete();
        }

        return (new PurchaseBillResource($purchaseBill))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PurchaseBill $purchaseBill)
    {
        abort_if(Gate::denies('purchase_bill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseBill->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
