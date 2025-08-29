<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStocksReportRequest;
use App\Http\Requests\StoreStocksReportRequest;
use App\Http\Requests\UpdateStocksReportRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StocksReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('stocks_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stocksReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('stocks_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stocksReports.create');
    }

    public function store(StoreStocksReportRequest $request)
    {
        $stocksReport = StocksReport::create($request->all());

        return redirect()->route('admin.stocks-reports.index');
    }

    public function edit(StocksReport $stocksReport)
    {
        abort_if(Gate::denies('stocks_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stocksReports.edit', compact('stocksReport'));
    }

    public function update(UpdateStocksReportRequest $request, StocksReport $stocksReport)
    {
        $stocksReport->update($request->all());

        return redirect()->route('admin.stocks-reports.index');
    }

    public function show(StocksReport $stocksReport)
    {
        abort_if(Gate::denies('stocks_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stocksReports.show', compact('stocksReport'));
    }

    public function destroy(StocksReport $stocksReport)
    {
        abort_if(Gate::denies('stocks_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stocksReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyStocksReportRequest $request)
    {
        $stocksReports = StocksReport::find(request('ids'));

        foreach ($stocksReports as $stocksReport) {
            $stocksReport->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
