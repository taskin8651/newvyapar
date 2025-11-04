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

    // 🟢 1️⃣ Super Admin → sabhi records dekh sakta hai
    if ($userRole === 'Super Admin') {
        $bankAccounts = \App\Models\BankAccount::withoutGlobalScopes()
            ->with(['created_by' => fn($q) => $q->withoutGlobalScopes()])
            ->get();

    } else {
        // 🟢 2️⃣ Admin / Branch / Same Company users

        // Step 1️⃣ - Get all company IDs linked with this user
        $companyIds = $user->select_companies()->pluck('id')->toArray();

        // Step 2️⃣ - Get all user IDs (Admin + Branch) under same company
        $relatedUserIds = \App\Models\User::whereHas('select_companies', function ($q) use ($companyIds) {
            $q->whereIn('add_businesses.id', $companyIds);
        })->pluck('id')->toArray();

        // Step 3️⃣ - Fetch all bank accounts created by users of same company
        $bankAccounts = \App\Models\BankAccount::with(['created_by'])
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
    $data['created_by_id'] = auth()->id(); // ✅ Logged-in user ka ID store karega

    $bankAccount = BankAccount::create($data);

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
