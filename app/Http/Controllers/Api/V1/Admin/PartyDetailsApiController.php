<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePartyDetailRequest;
use App\Http\Requests\UpdatePartyDetailRequest;
use App\Http\Resources\Admin\PartyDetailResource;
use App\Models\PartyDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PartyDetailsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('party_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PartyDetailResource(PartyDetail::with(['created_by'])->get());
    }

    public function store(StorePartyDetailRequest $request)
    {
        $partyDetail = PartyDetail::create($request->all());

        return (new PartyDetailResource($partyDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PartyDetail $partyDetail)
    {
        abort_if(Gate::denies('party_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PartyDetailResource($partyDetail->load(['created_by']));
    }

    public function update(UpdatePartyDetailRequest $request, PartyDetail $partyDetail)
    {
        $partyDetail->update($request->all());

        return (new PartyDetailResource($partyDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PartyDetail $partyDetail)
    {
        abort_if(Gate::denies('party_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partyDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
