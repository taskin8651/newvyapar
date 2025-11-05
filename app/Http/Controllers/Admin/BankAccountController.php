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

        $user = auth()->user();
        $userRole = $user->roles->pluck('title')->first();

        if ($userRole === 'Super Admin') {
            $bankAccounts = BankAccount::withoutGlobalScopes()
                ->with(['created_by' => fn($q) => $q->withoutGlobalScopes()])
                ->get();
        } else {
            $companyIds = $user->select_companies()->pluck('id')->toArray();

            $relatedUserIds = \App\Models\User::whereHas('select_companies', function ($q) use ($companyIds) {
                $q->whereIn('add_businesses.id', $companyIds);
            })->pluck('id')->toArray();

            $bankAccounts = BankAccount::with(['created_by'])
                ->whereIn('created_by_id', $relatedUserIds)
                ->get();
        }

        return view('admin.bankAccounts.index', compact('bankAccounts'));
    }

    public function create()
    {
        abort_if(Gate::denies('bank_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankAccounts.create');
    }

    public function store(StoreBankAccountRequest $request)
    {
        $data = $request->all();
        $data['created_by_id'] = auth()->id();

        $bankAccount = BankAccount::create($data);

        /** ✅ SAVE UPI QR TO MEDIA LIBRARY */
        if ($request->hasFile('upi_qr')) {
            $bankAccount->addMedia($request->file('upi_qr'))->toMediaCollection('upi_qr');
        }

        return redirect()->route('admin.bank-accounts.index')
            ->with('success', 'Bank account created successfully!');
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

        /** ♻️ UPDATE UPI QR - Remove old & add new if uploaded */
        if ($request->hasFile('upi_qr')) {
            $bankAccount->clearMediaCollection('upi_qr'); // delete previous QR
            $bankAccount->addMedia($request->file('upi_qr'))->toMediaCollection('upi_qr');
        }

        return redirect()->route('admin.bank-accounts.index')
            ->with('success', 'Bank account updated successfully!');
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

        /** 🗑️ Delete QR from media when account deleted */
        $bankAccount->clearMediaCollection('upi_qr');

        $bankAccount->delete();

        return back()->with('success', 'Bank account deleted successfully!');
    }

    public function massDestroy(MassDestroyBankAccountRequest $request)
    {
        $bankAccounts = BankAccount::find(request('ids'));

        foreach ($bankAccounts as $bankAccount) {
            $bankAccount->clearMediaCollection('upi_qr');
            $bankAccount->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
