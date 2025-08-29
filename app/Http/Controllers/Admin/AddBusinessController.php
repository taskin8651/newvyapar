<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAddBusinessRequest;
use App\Http\Requests\StoreAddBusinessRequest;
use App\Http\Requests\UpdateAddBusinessRequest;
use App\Models\AddBusiness;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AddBusinessController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('add_business_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addBusinesses = AddBusiness::with(['created_by', 'media'])->get();

        return view('admin.addBusinesses.index', compact('addBusinesses'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_business_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.addBusinesses.create');
    }

    public function store(StoreAddBusinessRequest $request)
    {
        $addBusiness = AddBusiness::create($request->all());

        foreach ($request->input('logo_upload', []) as $file) {
            $addBusiness->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('logo_upload');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $addBusiness->id]);
        }

        return redirect()->route('admin.add-businesses.index');
    }

    public function edit(AddBusiness $addBusiness)
    {
        abort_if(Gate::denies('add_business_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addBusiness->load('created_by');

        return view('admin.addBusinesses.edit', compact('addBusiness'));
    }

    public function update(UpdateAddBusinessRequest $request, AddBusiness $addBusiness)
    {
        $addBusiness->update($request->all());

        if (count($addBusiness->logo_upload) > 0) {
            foreach ($addBusiness->logo_upload as $media) {
                if (! in_array($media->file_name, $request->input('logo_upload', []))) {
                    $media->delete();
                }
            }
        }
        $media = $addBusiness->logo_upload->pluck('file_name')->toArray();
        foreach ($request->input('logo_upload', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $addBusiness->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('logo_upload');
            }
        }

        return redirect()->route('admin.add-businesses.index');
    }

    public function show(AddBusiness $addBusiness)
    {
        abort_if(Gate::denies('add_business_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addBusiness->load('created_by');

        return view('admin.addBusinesses.show', compact('addBusiness'));
    }

    public function destroy(AddBusiness $addBusiness)
    {
        abort_if(Gate::denies('add_business_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addBusiness->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddBusinessRequest $request)
    {
        $addBusinesses = AddBusiness::find(request('ids'));

        foreach ($addBusinesses as $addBusiness) {
            $addBusiness->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('add_business_create') && Gate::denies('add_business_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AddBusiness();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
