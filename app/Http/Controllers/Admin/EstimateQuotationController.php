<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEstimateQuotationRequest;
use App\Http\Requests\StoreEstimateQuotationRequest;
use App\Http\Requests\UpdateEstimateQuotationRequest;
use App\Models\AddItem;
use App\Models\EstimateQuotation;
use App\Models\PartyDetail;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EstimateQuotationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('estimate_quotation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimateQuotations = EstimateQuotation::with(['select_customer', 'items', 'created_by', 'media'])->get();

        return view('admin.estimateQuotations.index', compact('estimateQuotations'));
    }

    public function create()
    {
        abort_if(Gate::denies('estimate_quotation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        return view('admin.estimateQuotations.create', compact('items', 'select_customers'));
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $estimateQuotation->id]);
        }

        return redirect()->route('admin.estimate-quotations.index');
    }

    public function edit(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        $estimateQuotation->load('select_customer', 'items', 'created_by');

        return view('admin.estimateQuotations.edit', compact('estimateQuotation', 'items', 'select_customers'));
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

        return redirect()->route('admin.estimate-quotations.index');
    }

    public function show(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimateQuotation->load('select_customer', 'items', 'created_by');

        return view('admin.estimateQuotations.show', compact('estimateQuotation'));
    }

    public function destroy(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimateQuotation->delete();

        return back();
    }

    public function massDestroy(MassDestroyEstimateQuotationRequest $request)
    {
        $estimateQuotations = EstimateQuotation::find(request('ids'));

        foreach ($estimateQuotations as $estimateQuotation) {
            $estimateQuotation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('estimate_quotation_create') && Gate::denies('estimate_quotation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new EstimateQuotation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
