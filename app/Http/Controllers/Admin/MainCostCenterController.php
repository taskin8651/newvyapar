<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMainCostCenterRequest;
use App\Http\Requests\StoreMainCostCenterRequest;
use App\Http\Requests\UpdateMainCostCenterRequest;
use App\Models\AddBusiness;
use App\Models\MainCostCenter;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use PDF;

class MainCostCenterController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('main_cost_center_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mainCostCenters = MainCostCenter::with(['link_with_company', 'responsible_manager', 'created_by'])->get();

        return view('admin.mainCostCenters.index', compact('mainCostCenters'));
    }

    public function create()
    {
        abort_if(Gate::denies('main_cost_center_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $link_with_companies = AddBusiness::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsible_managers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mainCostCenters.create', compact('link_with_companies', 'responsible_managers'));
    }

    public function store(StoreMainCostCenterRequest $request)
    {
        $mainCostCenter = MainCostCenter::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mainCostCenter->id]);
        }

        return redirect()->route('admin.main-cost-centers.index');
    }

    public function edit(MainCostCenter $mainCostCenter)
    {
        abort_if(Gate::denies('main_cost_center_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $link_with_companies = AddBusiness::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsible_managers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mainCostCenter->load('link_with_company', 'responsible_manager', 'created_by');

        return view('admin.mainCostCenters.edit', compact('link_with_companies', 'mainCostCenter', 'responsible_managers'));
    }

    public function update(UpdateMainCostCenterRequest $request, MainCostCenter $mainCostCenter)
    {
        $mainCostCenter->update($request->all());

        return redirect()->route('admin.main-cost-centers.index');
    }

    public function show(MainCostCenter $mainCostCenter)
    {
        abort_if(Gate::denies('main_cost_center_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mainCostCenter->load('link_with_company', 'responsible_manager', 'created_by', 'mainCostCenterSubCostCenters');

        return view('admin.mainCostCenters.show', compact('mainCostCenter'));
    }

    public function destroy(MainCostCenter $mainCostCenter)
    {
        abort_if(Gate::denies('main_cost_center_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mainCostCenter->delete();

        return back();
    }

    public function massDestroy(MassDestroyMainCostCenterRequest $request)
    {
        $mainCostCenters = MainCostCenter::find(request('ids'));

        foreach ($mainCostCenters as $mainCostCenter) {
            $mainCostCenter->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('main_cost_center_create') && Gate::denies('main_cost_center_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MainCostCenter();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

   public function pdf(\App\Models\MainCostCenter $mainCostCenter)
{
    $mainCostCenter->load(['responsible_manager', 'link_with_company', 'mainCostCenterSubCostCenters']);
    return view('admin.mainCostCenters.pdf', compact('mainCostCenter'));
}


}
