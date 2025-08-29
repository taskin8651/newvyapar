<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCurrentStockRequest;
use App\Http\Requests\StoreCurrentStockRequest;
use App\Http\Requests\UpdateCurrentStockRequest;
use App\Models\AddItem;
use App\Models\CurrentStock;
use App\Models\PartyDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrentStocksController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('current_stock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currentStocks = CurrentStock::with(['items', 'parties', 'created_by'])->get();

        return view('admin.currentStocks.index', compact('currentStocks'));
    }

    public function create()
    {
        abort_if(Gate::denies('current_stock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = AddItem::pluck('item_name', 'id');

        $parties = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.currentStocks.create', compact('items', 'parties'));
    }

    public function store(StoreCurrentStockRequest $request)
    {
        $currentStock = CurrentStock::create($request->all());
        $currentStock->items()->sync($request->input('items', []));

        return redirect()->route('admin.current-stocks.index');
    }

    public function edit(CurrentStock $currentStock)
    {
        abort_if(Gate::denies('current_stock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = AddItem::pluck('item_name', 'id');

        $parties = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currentStock->load('items', 'parties', 'created_by');

        return view('admin.currentStocks.edit', compact('currentStock', 'items', 'parties'));
    }

    public function update(UpdateCurrentStockRequest $request, CurrentStock $currentStock)
    {
        $currentStock->update($request->all());
        $currentStock->items()->sync($request->input('items', []));

        return redirect()->route('admin.current-stocks.index');
    }

    public function show(CurrentStock $currentStock)
    {
        abort_if(Gate::denies('current_stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currentStock->load('items', 'parties', 'created_by');

        return view('admin.currentStocks.show', compact('currentStock'));
    }

    public function destroy(CurrentStock $currentStock)
    {
        abort_if(Gate::denies('current_stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currentStock->delete();

        return back();
    }

    public function massDestroy(MassDestroyCurrentStockRequest $request)
    {
        $currentStocks = CurrentStock::find(request('ids'));

        foreach ($currentStocks as $currentStock) {
            $currentStock->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
