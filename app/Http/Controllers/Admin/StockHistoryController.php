<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStockHistoryRequest;
use App\Http\Requests\StoreStockHistoryRequest;
use App\Http\Requests\UpdateStockHistoryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StockHistoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('stock_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stockHistories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('stock_history_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stockHistories.create');
    }

    public function store(StoreStockHistoryRequest $request)
    {
        $stockHistory = StockHistory::create($request->all());

        return redirect()->route('admin.stock-histories.index');
    }

    public function edit(StockHistory $stockHistory)
    {
        abort_if(Gate::denies('stock_history_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stockHistories.edit', compact('stockHistory'));
    }

    public function update(UpdateStockHistoryRequest $request, StockHistory $stockHistory)
    {
        $stockHistory->update($request->all());

        return redirect()->route('admin.stock-histories.index');
    }

    public function show(StockHistory $stockHistory)
    {
        abort_if(Gate::denies('stock_history_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stockHistories.show', compact('stockHistory'));
    }

    public function destroy(StockHistory $stockHistory)
    {
        abort_if(Gate::denies('stock_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stockHistory->delete();

        return back();
    }

    public function massDestroy(MassDestroyStockHistoryRequest $request)
    {
        $stockHistories = StockHistory::find(request('ids'));

        foreach ($stockHistories as $stockHistory) {
            $stockHistory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
