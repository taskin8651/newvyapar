<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPurchaseReportRequest;
use App\Http\Requests\StorePurchaseReportRequest;
use App\Http\Requests\UpdatePurchaseReportRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchaseReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('purchase_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.purchaseReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('purchase_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.purchaseReports.create');
    }

    public function store(StorePurchaseReportRequest $request)
    {
        $purchaseReport = PurchaseReport::create($request->all());

        return redirect()->route('admin.purchase-reports.index');
    }

    public function edit(PurchaseReport $purchaseReport)
    {
        abort_if(Gate::denies('purchase_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.purchaseReports.edit', compact('purchaseReport'));
    }

    public function update(UpdatePurchaseReportRequest $request, PurchaseReport $purchaseReport)
    {
        $purchaseReport->update($request->all());

        return redirect()->route('admin.purchase-reports.index');
    }

    public function show(PurchaseReport $purchaseReport)
    {
        abort_if(Gate::denies('purchase_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.purchaseReports.show', compact('purchaseReport'));
    }

    public function destroy(PurchaseReport $purchaseReport)
    {
        abort_if(Gate::denies('purchase_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyPurchaseReportRequest $request)
    {
        $purchaseReports = PurchaseReport::find(request('ids'));

        foreach ($purchaseReports as $purchaseReport) {
            $purchaseReport->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
