<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAddBusinessRequest;
use App\Http\Requests\UpdateAddBusinessRequest;
use App\Http\Resources\Admin\AddBusinessResource;
use App\Models\AddBusiness;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddBusinessApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('add_business_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddBusinessResource(AddBusiness::with(['created_by'])->get());
    }

    public function store(StoreAddBusinessRequest $request)
    {
        $addBusiness = AddBusiness::create($request->all());

        foreach ($request->input('logo_upload', []) as $file) {
            $addBusiness->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('logo_upload');
        }

        return (new AddBusinessResource($addBusiness))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AddBusiness $addBusiness)
    {
        abort_if(Gate::denies('add_business_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddBusinessResource($addBusiness->load(['created_by']));
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

        return (new AddBusinessResource($addBusiness))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AddBusiness $addBusiness)
    {
        abort_if(Gate::denies('add_business_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addBusiness->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
