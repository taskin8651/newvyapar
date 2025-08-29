<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAdjustBankBalanceRequest;
use App\Http\Requests\UpdateAdjustBankBalanceRequest;
use App\Http\Resources\Admin\AdjustBankBalanceResource;
use App\Models\AdjustBankBalance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdjustBankBalanceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('adjust_bank_balance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdjustBankBalanceResource(AdjustBankBalance::with(['from', 'created_by'])->get());
    }

    public function store(StoreAdjustBankBalanceRequest $request)
    {
        $adjustBankBalance = AdjustBankBalance::create($request->all());

        if ($request->input('attechment', false)) {
            $adjustBankBalance->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        return (new AdjustBankBalanceResource($adjustBankBalance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AdjustBankBalance $adjustBankBalance)
    {
        abort_if(Gate::denies('adjust_bank_balance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AdjustBankBalanceResource($adjustBankBalance->load(['from', 'created_by']));
    }

    public function update(UpdateAdjustBankBalanceRequest $request, AdjustBankBalance $adjustBankBalance)
    {
        $adjustBankBalance->update($request->all());

        if ($request->input('attechment', false)) {
            if (! $adjustBankBalance->attechment || $request->input('attechment') !== $adjustBankBalance->attechment->file_name) {
                if ($adjustBankBalance->attechment) {
                    $adjustBankBalance->attechment->delete();
                }
                $adjustBankBalance->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
            }
        } elseif ($adjustBankBalance->attechment) {
            $adjustBankBalance->attechment->delete();
        }

        return (new AdjustBankBalanceResource($adjustBankBalance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AdjustBankBalance $adjustBankBalance)
    {
        abort_if(Gate::denies('adjust_bank_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $adjustBankBalance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
