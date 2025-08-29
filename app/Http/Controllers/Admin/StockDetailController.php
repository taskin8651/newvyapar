<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStockDetailRequest;
use App\Http\Requests\StoreStockDetailRequest;
use App\Http\Requests\UpdateStockDetailRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StockDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('stock_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stockDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('stock_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stockDetails.create');
    }

    public function store(StoreStockDetailRequest $request)
    {
        $stockDetail = StockDetail::create($request->all());

        return redirect()->route('admin.stock-details.index');
    }

    public function edit(StockDetail $stockDetail)
    {
        abort_if(Gate::denies('stock_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stockDetails.edit', compact('stockDetail'));
    }

    public function update(UpdateStockDetailRequest $request, StockDetail $stockDetail)
    {
        $stockDetail->update($request->all());

        return redirect()->route('admin.stock-details.index');
    }

    public function show(StockDetail $stockDetail)
    {
        abort_if(Gate::denies('stock_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.stockDetails.show', compact('stockDetail'));
    }

    public function destroy(StockDetail $stockDetail)
    {
        abort_if(Gate::denies('stock_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stockDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyStockDetailRequest $request)
    {
        $stockDetails = StockDetail::find(request('ids'));

        foreach ($stockDetails as $stockDetail) {
            $stockDetail->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
