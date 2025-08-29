<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCurrentStockRequest;
use App\Http\Requests\UpdateCurrentStockRequest;
use App\Http\Resources\Admin\CurrentStockResource;
use App\Models\CurrentStock;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CurrentStocksApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('current_stock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CurrentStockResource(CurrentStock::with(['items', 'parties', 'created_by'])->get());
    }

    public function store(StoreCurrentStockRequest $request)
    {
        $currentStock = CurrentStock::create($request->all());
        $currentStock->items()->sync($request->input('items', []));

        return (new CurrentStockResource($currentStock))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CurrentStock $currentStock)
    {
        abort_if(Gate::denies('current_stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CurrentStockResource($currentStock->load(['items', 'parties', 'created_by']));
    }

    public function update(UpdateCurrentStockRequest $request, CurrentStock $currentStock)
    {
        $currentStock->update($request->all());
        $currentStock->items()->sync($request->input('items', []));

        return (new CurrentStockResource($currentStock))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CurrentStock $currentStock)
    {
        abort_if(Gate::denies('current_stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currentStock->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
