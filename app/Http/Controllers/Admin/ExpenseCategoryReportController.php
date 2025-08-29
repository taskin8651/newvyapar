<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExpenseCategoryReportRequest;
use App\Http\Requests\StoreExpenseCategoryReportRequest;
use App\Http\Requests\UpdateExpenseCategoryReportRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpenseCategoryReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('expense_category_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseCategoryReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('expense_category_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseCategoryReports.create');
    }

    public function store(StoreExpenseCategoryReportRequest $request)
    {
        $expenseCategoryReport = ExpenseCategoryReport::create($request->all());

        return redirect()->route('admin.expense-category-reports.index');
    }

    public function edit(ExpenseCategoryReport $expenseCategoryReport)
    {
        abort_if(Gate::denies('expense_category_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseCategoryReports.edit', compact('expenseCategoryReport'));
    }

    public function update(UpdateExpenseCategoryReportRequest $request, ExpenseCategoryReport $expenseCategoryReport)
    {
        $expenseCategoryReport->update($request->all());

        return redirect()->route('admin.expense-category-reports.index');
    }

    public function show(ExpenseCategoryReport $expenseCategoryReport)
    {
        abort_if(Gate::denies('expense_category_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.expenseCategoryReports.show', compact('expenseCategoryReport'));
    }

    public function destroy(ExpenseCategoryReport $expenseCategoryReport)
    {
        abort_if(Gate::denies('expense_category_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenseCategoryReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseCategoryReportRequest $request)
    {
        $expenseCategoryReports = ExpenseCategoryReport::find(request('ids'));

        foreach ($expenseCategoryReports as $expenseCategoryReport) {
            $expenseCategoryReport->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
