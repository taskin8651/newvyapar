<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCashInHandRequest;
use App\Http\Requests\UpdateCashInHandRequest;
use App\Http\Resources\Admin\CashInHandResource;
use App\Models\CashInHand;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashInHandApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('cash_in_hand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashInHandResource(CashInHand::with(['created_by'])->get());
    }

    public function store(StoreCashInHandRequest $request)
    {
        $cashInHand = CashInHand::create($request->all());

        return (new CashInHandResource($cashInHand))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CashInHand $cashInHand)
    {
        abort_if(Gate::denies('cash_in_hand_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashInHandResource($cashInHand->load(['created_by']));
    }

    public function update(UpdateCashInHandRequest $request, CashInHand $cashInHand)
    {
        $cashInHand->update($request->all());

        return (new CashInHandResource($cashInHand))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CashInHand $cashInHand)
    {
        abort_if(Gate::denies('cash_in_hand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashInHand->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
