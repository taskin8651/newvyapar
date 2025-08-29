<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExpenseReportListRequest;
use App\Http\Requests\StoreExpenseReportListRequest;
use App\Http\Requests\UpdateExpenseReportListRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseReportListController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('expense_report_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseReportLists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('expense_report_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseReportLists.create');
    }

    public function store(StoreExpenseReportListRequest $request)
    {
        $expenseReportList = ExpenseReportList::create($request->all());

        return redirect()->route('admin.expense-report-lists.index');
    }

    public function edit(ExpenseReportList $expenseReportList)
    {
        abort_if(Gate::denies('expense_report_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseReportLists.edit', compact('expenseReportList'));
    }

    public function update(UpdateExpenseReportListRequest $request, ExpenseReportList $expenseReportList)
    {
        $expenseReportList->update($request->all());

        return redirect()->route('admin.expense-report-lists.index');
    }

    public function show(ExpenseReportList $expenseReportList)
    {
        abort_if(Gate::denies('expense_report_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseReportLists.show', compact('expenseReportList'));
    }

    public function destroy(ExpenseReportList $expenseReportList)
    {
        abort_if(Gate::denies('expense_report_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseReportList->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseReportListRequest $request)
    {
        $expenseReportLists = ExpenseReportList::find(request('ids'));

        foreach ($expenseReportLists as $expenseReportList) {
            $expenseReportList->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
