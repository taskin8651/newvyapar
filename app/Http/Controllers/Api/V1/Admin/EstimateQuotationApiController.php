<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreEstimateQuotationRequest;
use App\Http\Requests\UpdateEstimateQuotationRequest;
use App\Http\Resources\Admin\EstimateQuotationResource;
use App\Models\EstimateQuotation;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstimateQuotationApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('estimate_quotation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EstimateQuotationResource(EstimateQuotation::with(['select_customer', 'items', 'created_by'])->get());
    }

    public function store(StoreEstimateQuotationRequest $request)
    {
        $estimateQuotation = EstimateQuotation::create($request->all());
        $estimateQuotation->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            $estimateQuotation->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($request->input('document', false)) {
            $estimateQuotation->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
        }

        return (new EstimateQuotationResource($estimateQuotation))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EstimateQuotationResource($estimateQuotation->load(['select_customer', 'items', 'created_by']));
    }

    public function update(UpdateEstimateQuotationRequest $request, EstimateQuotation $estimateQuotation)
    {
        $estimateQuotation->update($request->all());
        $estimateQuotation->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            if (! $estimateQuotation->image || $request->input('image') !== $estimateQuotation->image->file_name) {
                if ($estimateQuotation->image) {
                    $estimateQuotation->image->delete();
                }
                $estimateQuotation->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($estimateQuotation->image) {
            $estimateQuotation->image->delete();
        }

        if ($request->input('document', false)) {
            if (! $estimateQuotation->document || $request->input('document') !== $estimateQuotation->document->file_name) {
                if ($estimateQuotation->document) {
                    $estimateQuotation->document->delete();
                }
                $estimateQuotation->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
            }
        } elseif ($estimateQuotation->document) {
            $estimateQuotation->document->delete();
        }

        return (new EstimateQuotationResource($estimateQuotation))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimateQuotation->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
