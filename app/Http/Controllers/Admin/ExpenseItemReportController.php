<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExpenseItemReportRequest;
use App\Http\Requests\StoreExpenseItemReportRequest;
use App\Http\Requests\UpdateExpenseItemReportRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseItemReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('expense_item_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseItemReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('expense_item_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseItemReports.create');
    }

    public function store(StoreExpenseItemReportRequest $request)
    {
        $expenseItemReport = ExpenseItemReport::create($request->all());

        return redirect()->route('admin.expense-item-reports.index');
    }

    public function edit(ExpenseItemReport $expenseItemReport)
    {
        abort_if(Gate::denies('expense_item_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseItemReports.edit', compact('expenseItemReport'));
    }

    public function update(UpdateExpenseItemReportRequest $request, ExpenseItemReport $expenseItemReport)
    {
        $expenseItemReport->update($request->all());

        return redirect()->route('admin.expense-item-reports.index');
    }

    public function show(ExpenseItemReport $expenseItemReport)
    {
        abort_if(Gate::denies('expense_item_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseItemReports.show', compact('expenseItemReport'));
    }

    public function destroy(ExpenseItemReport $expenseItemReport)
    {
        abort_if(Gate::denies('expense_item_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseItemReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseItemReportRequest $request)
    {
        $expenseItemReports = ExpenseItemReport::find(request('ids'));

        foreach ($expenseItemReports as $expenseItemReport) {
            $expenseItemReport->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
