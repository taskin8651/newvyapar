<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLowStockSummaryRequest;
use App\Http\Requests\StoreLowStockSummaryRequest;
use App\Http\Requests\UpdateLowStockSummaryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LowStockSummaryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('low_stock_summary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lowStockSummaries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('low_stock_summary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lowStockSummaries.create');
    }

    public function store(StoreLowStockSummaryRequest $request)
    {
        $lowStockSummary = LowStockSummary::create($request->all());

        return redirect()->route('admin.low-stock-summaries.index');
    }

    public function edit(LowStockSummary $lowStockSummary)
    {
        abort_if(Gate::denies('low_stock_summary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lowStockSummaries.edit', compact('lowStockSummary'));
    }

    public function update(UpdateLowStockSummaryRequest $request, LowStockSummary $lowStockSummary)
    {
        $lowStockSummary->update($request->all());

        return redirect()->route('admin.low-stock-summaries.index');
    }

    public function show(LowStockSummary $lowStockSummary)
    {
        abort_if(Gate::denies('low_stock_summary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lowStockSummaries.show', compact('lowStockSummary'));
    }

    public function destroy(LowStockSummary $lowStockSummary)
    {
        abort_if(Gate::denies('low_stock_summary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lowStockSummary->delete();

        return back();
    }

    public function massDestroy(MassDestroyLowStockSummaryRequest $request)
    {
        $lowStockSummaries = LowStockSummary::find(request('ids'));

        foreach ($lowStockSummaries as $lowStockSummary) {
            $lowStockSummary->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
