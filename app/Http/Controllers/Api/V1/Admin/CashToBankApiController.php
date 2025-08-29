<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCashToBankRequest;
use App\Http\Requests\UpdateCashToBankRequest;
use App\Http\Resources\Admin\CashToBankResource;
use App\Models\CashToBank;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashToBankApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('cash_to_bank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashToBankResource(CashToBank::with(['to', 'created_by'])->get());
    }

    public function store(StoreCashToBankRequest $request)
    {
        $cashToBank = CashToBank::create($request->all());

        if ($request->input('attechment', false)) {
            $cashToBank->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        return (new CashToBankResource($cashToBank))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CashToBank $cashToBank)
    {
        abort_if(Gate::denies('cash_to_bank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CashToBankResource($cashToBank->load(['to', 'created_by']));
    }

    public function update(UpdateCashToBankRequest $request, CashToBank $cashToBank)
    {
        $cashToBank->update($request->all());

        if ($request->input('attechment', false)) {
            if (! $cashToBank->attechment || $request->input('attechment') !== $cashToBank->attechment->file_name) {
                if ($cashToBank->attechment) {
                    $cashToBank->attechment->delete();
                }
                $cashToBank->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
            }
        } elseif ($cashToBank->attechment) {
            $cashToBank->attechment->delete();
        }

        return (new CashToBankResource($cashToBank))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CashToBank $cashToBank)
    {
        abort_if(Gate::denies('cash_to_bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cashToBank->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
