<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBankAccountRequest;
use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\BankAccount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankAccountController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bank_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccounts = BankAccount::with(['created_by'])->get();

        return view('admin.bankAccounts.index', compact('bankAccounts'));
    }

    public function create()
    {
        abort_if(Gate::denies('bank_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankAccounts.create');
    }

    public function store(StoreBankAccountRequest $request)
    {
        $bankAccount = BankAccount::create($request->all());

        return redirect()->route('admin.bank-accounts.index');
    }

    public function edit(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccount->load('created_by');

        return view('admin.bankAccounts.edit', compact('bankAccount'));
    }

    public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        $bankAccount->update($request->all());

        return redirect()->route('admin.bank-accounts.index');
    }

    public function show(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccount->load('created_by');

        return view('admin.bankAccounts.show', compact('bankAccount'));
    }

    public function destroy(BankAccount $bankAccount)
    {
        abort_if(Gate::denies('bank_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankAccount->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankAccountRequest $request)
    {
        $bankAccounts = BankAccount::find(request('ids'));

        foreach ($bankAccounts as $bankAccount) {
            $bankAccount->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
