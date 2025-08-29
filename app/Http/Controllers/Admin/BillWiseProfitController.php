<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBillWiseProfitRequest;
use App\Http\Requests\StoreBillWiseProfitRequest;
use App\Http\Requests\UpdateBillWiseProfitRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillWiseProfitController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_wise_profit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.billWiseProfits.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bill_wise_profit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.billWiseProfits.create');
    }

    public function store(StoreBillWiseProfitRequest $request)
    {
        $billWiseProfit = BillWiseProfit::create($request->all());

        return redirect()->route('admin.bill-wise-profits.index');
    }

    public function edit(BillWiseProfit $billWiseProfit)
    {
        abort_if(Gate::denies('bill_wise_profit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.billWiseProfits.edit', compact('billWiseProfit'));
    }

    public function update(UpdateBillWiseProfitRequest $request, BillWiseProfit $billWiseProfit)
    {
        $billWiseProfit->update($request->all());

        return redirect()->route('admin.bill-wise-profits.index');
    }

    public function show(BillWiseProfit $billWiseProfit)
    {
        abort_if(Gate::denies('bill_wise_profit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.billWiseProfits.show', compact('billWiseProfit'));
    }

    public function destroy(BillWiseProfit $billWiseProfit)
    {
        abort_if(Gate::denies('bill_wise_profit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billWiseProfit->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillWiseProfitRequest $request)
    {
        $billWiseProfits = BillWiseProfit::find(request('ids'));

        foreach ($billWiseProfits as $billWiseProfit) {
            $billWiseProfit->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
