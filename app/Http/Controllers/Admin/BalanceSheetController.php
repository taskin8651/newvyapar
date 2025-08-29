<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBalanceSheetRequest;
use App\Http\Requests\StoreBalanceSheetRequest;
use App\Http\Requests\UpdateBalanceSheetRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BalanceSheetController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('balance_sheet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.balanceSheets.index');
    }

    public function create()
    {
        abort_if(Gate::denies('balance_sheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.balanceSheets.create');
    }

    public function store(StoreBalanceSheetRequest $request)
    {
        $balanceSheet = BalanceSheet::create($request->all());

        return redirect()->route('admin.balance-sheets.index');
    }

    public function edit(BalanceSheet $balanceSheet)
    {
        abort_if(Gate::denies('balance_sheet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.balanceSheets.edit', compact('balanceSheet'));
    }

    public function update(UpdateBalanceSheetRequest $request, BalanceSheet $balanceSheet)
    {
        $balanceSheet->update($request->all());

        return redirect()->route('admin.balance-sheets.index');
    }

    public function show(BalanceSheet $balanceSheet)
    {
        abort_if(Gate::denies('balance_sheet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.balanceSheets.show', compact('balanceSheet'));
    }

    public function destroy(BalanceSheet $balanceSheet)
    {
        abort_if(Gate::denies('balance_sheet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $balanceSheet->delete();

        return back();
    }

    public function massDestroy(MassDestroyBalanceSheetRequest $request)
    {
        $balanceSheets = BalanceSheet::find(request('ids'));

        foreach ($balanceSheets as $balanceSheet) {
            $balanceSheet->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
