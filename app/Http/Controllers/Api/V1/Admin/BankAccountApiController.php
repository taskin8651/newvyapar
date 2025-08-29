<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Http\Resources\Admin\BankAccountResource;
use App\Models\BankAccount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankAccountApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bank_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankAccountResource(BankAccount::with(['created_by'])->get());
    }

    public function store(StoreBankAccountRequest $request)
    {
        $bankAccount = BankAccount::create($request->all());

        return (new BankAccountResource($bankAccount))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BankAccountResource($bankAccount->load(['created_by']));
    }

    public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        $bankAccount->update($request->all());

        return (new BankAccountResource($bankAccount))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccount->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
