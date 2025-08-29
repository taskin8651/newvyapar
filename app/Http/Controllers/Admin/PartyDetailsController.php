<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPartyDetailRequest;
use App\Http\Requests\StorePartyDetailRequest;
use App\Http\Requests\UpdatePartyDetailRequest;
use App\Models\PartyDetail;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PartyDetailsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('party_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partyDetails = PartyDetail::with(['created_by'])->get();

        return view('admin.partyDetails.index', compact('partyDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('party_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyDetails.create');
    }


public function store(StorePartyDetailRequest $request)
{
    // Logged-in user ka ID lete hain
    $data = $request->all();
    $data['created_by_id'] = Auth::id(); // Yaha set kar rahe hain

    $partyDetail = PartyDetail::create($data);

    // Media update karna hai toh ye code rahega
    if ($media = $request->input('ck-media', false)) {
        Media::whereIn('id', $media)->update(['model_id' => $partyDetail->id]);
    }

    return redirect()->route('admin.party-details.index')
                     ->with('success', 'Party Detail created successfully!');
}
    public function edit(PartyDetail $partyDetail)
    {
        abort_if(Gate::denies('party_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partyDetail->load('created_by');

        return view('admin.partyDetails.edit', compact('partyDetail'));
    }

    public function update(UpdatePartyDetailRequest $request, PartyDetail $partyDetail)
    {
        $partyDetail->update($request->all());

        return redirect()->route('admin.party-details.index');
    }

    public function show(PartyDetail $partyDetail)
    {
        abort_if(Gate::denies('party_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partyDetail->load('created_by');

        return view('admin.partyDetails.show', compact('partyDetail'));
    }

    public function destroy(PartyDetail $partyDetail)
    {
        abort_if(Gate::denies('party_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partyDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyPartyDetailRequest $request)
    {
        $partyDetails = PartyDetail::find(request('ids'));

        foreach ($partyDetails as $partyDetail) {
            $partyDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('party_detail_create') && Gate::denies('party_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PartyDetail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
