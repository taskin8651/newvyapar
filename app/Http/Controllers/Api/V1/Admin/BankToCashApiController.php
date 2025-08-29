<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBankToCashRequest;
use App\Http\Requests\UpdateBankToCashRequest;
use App\Http\Resources\Admin\BankToCashResource;
use App\Models\BankToCash;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankToCashApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bank_to_cash_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankToCashResource(BankToCash::with(['from', 'created_by'])->get());
    }

    public function store(StoreBankToCashRequest $request)
    {
        $bankToCash = BankToCash::create($request->all());

        if ($request->input('attechment', false)) {
            $bankToCash->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        return (new BankToCashResource($bankToCash))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BankToCash $bankToCash)
    {
        abort_if(Gate::denies('bank_to_cash_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankToCashResource($bankToCash->load(['from', 'created_by']));
    }

    public function update(UpdateBankToCashRequest $request, BankToCash $bankToCash)
    {
        $bankToCash->update($request->all());

        if ($request->input('attechment', false)) {
            if (! $bankToCash->attechment || $request->input('attechment') !== $bankToCash->attechment->file_name) {
                if ($bankToCash->attechment) {
                    $bankToCash->attechment->delete();
                }
                $bankToCash->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
            }
        } elseif ($bankToCash->attechment) {
            $bankToCash->attechment->delete();
        }

        return (new BankToCashResource($bankToCash))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BankToCash $bankToCash)
    {
        abort_if(Gate::denies('bank_to_cash_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankToCash->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
