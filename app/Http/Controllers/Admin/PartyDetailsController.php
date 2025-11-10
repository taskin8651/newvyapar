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
use Barryvdh\DomPDF\Facade\Pdf;

class PartyDetailsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;
public function index()
{
    abort_if(Gate::denies('party_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = auth()->user();
    $userRole = $user->roles->pluck('title')->first();

    // 🟢 1️⃣ Super Admin → sabhi records
    if ($userRole === 'Super Admin') {
        $partyDetails = \App\Models\PartyDetail::withoutGlobalScopes()
            ->with(['created_by'])
            ->get();

    } 
    // 🟢 2️⃣ Agar user kisi ko create karta hai (creator) → apne + apne created users ka data
    elseif ($user->created_by()->exists()) {
        // Get IDs of users created by this user
        $createdUserIds = $user->created_by()->pluck('id')->toArray();

        // Include current user ID also
        $allUserIds = array_merge([$user->id], $createdUserIds);

        $partyDetails = \App\Models\PartyDetail::with(['created_by'])
            ->whereIn('created_by_id', $allUserIds)
            ->get();
    } 
    // 🟢 3️⃣ Normal user → sirf apna data
    else {
        $partyDetails = \App\Models\PartyDetail::with(['created_by'])
            ->where('created_by_id', $user->id)
            ->get();
    }

    return view('admin.partyDetails.index', compact('partyDetails'));
}




    public function create()
    {
        abort_if(Gate::denies('party_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyDetails.create');
    }


public function store(Request $request)
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
   public function pdf(PartyDetail $partyDetail)
    {
        // Eager load related user who created
        $partyDetail->load('created_by');

        // Debug (optional)
        // dd($partyDetail->toArray());

        // Return Blade view
        return view('admin.partyDetails.pdf', compact('partyDetail'));
    }

}
