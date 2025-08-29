<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAllTransactionRequest;
use App\Http\Requests\StoreAllTransactionRequest;
use App\Http\Requests\UpdateAllTransactionRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllTransactionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('all_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allTransactions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('all_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allTransactions.create');
    }

    public function store(StoreAllTransactionRequest $request)
    {
        $allTransaction = AllTransaction::create($request->all());

        return redirect()->route('admin.all-transactions.index');
    }

    public function edit(AllTransaction $allTransaction)
    {
        abort_if(Gate::denies('all_transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allTransactions.edit', compact('allTransaction'));
    }

    public function update(UpdateAllTransactionRequest $request, AllTransaction $allTransaction)
    {
        $allTransaction->update($request->all());

        return redirect()->route('admin.all-transactions.index');
    }

    public function show(AllTransaction $allTransaction)
    {
        abort_if(Gate::denies('all_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allTransactions.show', compact('allTransaction'));
    }

    public function destroy(AllTransaction $allTransaction)
    {
        abort_if(Gate::denies('all_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allTransaction->delete();

        return back();
    }

    public function massDestroy(MassDestroyAllTransactionRequest $request)
    {
        $allTransactions = AllTransaction::find(request('ids'));

        foreach ($allTransactions as $allTransaction) {
            $allTransaction->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
