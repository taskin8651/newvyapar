<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStocksSummaryRequest;
use App\Http\Requests\StoreStocksSummaryRequest;
use App\Http\Requests\UpdateStocksSummaryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StocksSummaryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('stocks_summary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stocksSummaries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('stocks_summary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stocksSummaries.create');
    }

    public function store(StoreStocksSummaryRequest $request)
    {
        $stocksSummary = StocksSummary::create($request->all());

        return redirect()->route('admin.stocks-summaries.index');
    }

    public function edit(StocksSummary $stocksSummary)
    {
        abort_if(Gate::denies('stocks_summary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stocksSummaries.edit', compact('stocksSummary'));
    }

    public function update(UpdateStocksSummaryRequest $request, StocksSummary $stocksSummary)
    {
        $stocksSummary->update($request->all());

        return redirect()->route('admin.stocks-summaries.index');
    }

    public function show(StocksSummary $stocksSummary)
    {
        abort_if(Gate::denies('stocks_summary_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stocksSummaries.show', compact('stocksSummary'));
    }

    public function destroy(StocksSummary $stocksSummary)
    {
        abort_if(Gate::denies('stocks_summary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stocksSummary->delete();

        return back();
    }

    public function massDestroy(MassDestroyStocksSummaryRequest $request)
    {
        $stocksSummaries = StocksSummary::find(request('ids'));

        foreach ($stocksSummaries as $stocksSummary) {
            $stocksSummary->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
