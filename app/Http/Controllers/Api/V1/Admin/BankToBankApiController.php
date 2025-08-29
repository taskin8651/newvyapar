<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBankToBankRequest;
use App\Http\Requests\UpdateBankToBankRequest;
use App\Http\Resources\Admin\BankToBankResource;
use App\Models\BankToBank;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankToBankApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bank_to_bank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankToBankResource(BankToBank::with(['from', 'to', 'created_by'])->get());
    }

    public function store(StoreBankToBankRequest $request)
    {
        $bankToBank = BankToBank::create($request->all());

        if ($request->input('attechment', false)) {
            $bankToBank->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        return (new BankToBankResource($bankToBank))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BankToBank $bankToBank)
    {
        abort_if(Gate::denies('bank_to_bank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankToBankResource($bankToBank->load(['from', 'to', 'created_by']));
    }

    public function update(UpdateBankToBankRequest $request, BankToBank $bankToBank)
    {
        $bankToBank->update($request->all());

        if ($request->input('attechment', false)) {
            if (! $bankToBank->attechment || $request->input('attechment') !== $bankToBank->attechment->file_name) {
                if ($bankToBank->attechment) {
                    $bankToBank->attechment->delete();
                }
                $bankToBank->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
            }
        } elseif ($bankToBank->attechment) {
            $bankToBank->attechment->delete();
        }

        return (new BankToBankResource($bankToBank))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BankToBank $bankToBank)
    {
        abort_if(Gate::denies('bank_to_bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankToBank->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
