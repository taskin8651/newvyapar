<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankTransaction;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class BankTransactionController extends Controller
{
public function index()
{
    abort_if(Gate::denies('bank_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = auth()->user();
    $userRole = $user->roles->pluck('title')->first();

    // 🟢 1️⃣ Super Admin → sabhi records dekh sakta hai
    if ($userRole === 'Super Admin') {
        $transactions = \App\Models\BankTransaction::withoutGlobalScopes()
            ->with(['party', 'paymentType', 'createdBy' => fn($q) => $q->withoutGlobalScopes()])
            ->latest()
            ->get();

    } else {
        // 🟢 2️⃣ Admin / Branch / Same Company users

        // Step 1️⃣ - Get all company IDs linked with this user
        $companyIds = $user->select_companies()->pluck('id')->toArray();

        // Step 2️⃣ - Get all user IDs (Admin + Branch) under same company
        $relatedUserIds = \App\Models\User::whereHas('select_companies', function ($q) use ($companyIds) {
            $q->whereIn('add_businesses.id', $companyIds);
        })->pluck('id')->toArray();

        // Step 3️⃣ - Fetch all bank transactions created by users of same company
        $transactions = \App\Models\BankTransaction::with(['party', 'paymentType', 'createdBy'])
            ->whereIn('created_by_id', $relatedUserIds)
            ->latest()
            ->get();
    }

    return view('admin.bankTransactions.index', compact('transactions'));
}

}
