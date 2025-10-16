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

        $transactions = BankTransaction::with(['party', 'paymentType', 'createdBy'])
            ->latest()
            ->get();

        return view('admin.bankTransactions.index', compact('transactions'));
    }
}
