<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySaleReportRequest;
use App\Http\Requests\StoreSaleReportRequest;
use App\Http\Requests\UpdateSaleReportRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sale_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.saleReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sale_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.saleReports.create');
    }

    public function store(StoreSaleReportRequest $request)
    {
        $saleReport = SaleReport::create($request->all());

        return redirect()->route('admin.sale-reports.index');
    }

    public function edit(SaleReport $saleReport)
    {
        abort_if(Gate::denies('sale_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.saleReports.edit', compact('saleReport'));
    }

    public function update(UpdateSaleReportRequest $request, SaleReport $saleReport)
    {
        $saleReport->update($request->all());

        return redirect()->route('admin.sale-reports.index');
    }

    public function show(SaleReport $saleReport)
    {
        abort_if(Gate::denies('sale_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.saleReports.show', compact('saleReport'));
    }

    public function destroy(SaleReport $saleReport)
    {
        abort_if(Gate::denies('sale_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleReport->delete();

        return back();
    }

    public function massDestroy(MassDestroySaleReportRequest $request)
    {
        $saleReports = SaleReport::find(request('ids'));

        foreach ($saleReports as $saleReport) {
            $saleReport->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
