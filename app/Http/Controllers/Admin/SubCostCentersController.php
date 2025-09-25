<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubCostCenterRequest;
use App\Http\Requests\StoreSubCostCenterRequest;
use App\Http\Requests\UpdateSubCostCenterRequest;
use App\Models\MainCostCenter;
use App\Models\SubCostCenter;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use PDF;
class SubCostCentersController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('sub_cost_center_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCostCenters = SubCostCenter::with(['main_cost_center', 'created_by'])->get();

        return view('admin.subCostCenters.index', compact('subCostCenters'));
    }

    public function create()
    {
        abort_if(Gate::denies('sub_cost_center_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $main_cost_centers = MainCostCenter::pluck('cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.subCostCenters.create', compact('main_cost_centers'));
    }

    public function store(StoreSubCostCenterRequest $request)
    {
        $subCostCenter = SubCostCenter::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $subCostCenter->id]);
        }

        return redirect()->route('admin.sub-cost-centers.index');
    }

    public function edit(SubCostCenter $subCostCenter)
    {
        abort_if(Gate::denies('sub_cost_center_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $main_cost_centers = MainCostCenter::pluck('cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $subCostCenter->load('main_cost_center', 'created_by');

        return view('admin.subCostCenters.edit', compact('main_cost_centers', 'subCostCenter'));
    }

    public function update(UpdateSubCostCenterRequest $request, SubCostCenter $subCostCenter)
    {
        $subCostCenter->update($request->all());

        return redirect()->route('admin.sub-cost-centers.index');
    }

    public function show(SubCostCenter $subCostCenter)
    {
        abort_if(Gate::denies('sub_cost_center_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCostCenter->load('main_cost_center', 'created_by');

        return view('admin.subCostCenters.show', compact('subCostCenter'));
    }

    public function destroy(SubCostCenter $subCostCenter)
    {
        abort_if(Gate::denies('sub_cost_center_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subCostCenter->delete();

        return back();
    }

    public function massDestroy(MassDestroySubCostCenterRequest $request)
    {
        $subCostCenters = SubCostCenter::find(request('ids'));

        foreach ($subCostCenters as $subCostCenter) {
            $subCostCenter->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sub_cost_center_create') && Gate::denies('sub_cost_center_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SubCostCenter();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
public function pdf(SubCostCenter $subCostCenter)
{
    // Load relations
    $subCostCenter->load(['main_cost_center', 'created_by', 'purchase_bills']);

    // Debug
    dd($subCostCenter->toArray());

    return view('admin.subCostCenters.pdf', compact('subCostCenter'));
}


}
