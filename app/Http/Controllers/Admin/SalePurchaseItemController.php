<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySalePurchaseItemRequest;
use App\Http\Requests\StoreSalePurchaseItemRequest;
use App\Http\Requests\UpdateSalePurchaseItemRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalePurchaseItemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sale_purchase_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchaseItems.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sale_purchase_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchaseItems.create');
    }

    public function store(StoreSalePurchaseItemRequest $request)
    {
        $salePurchaseItem = SalePurchaseItem::create($request->all());

        return redirect()->route('admin.sale-purchase-items.index');
    }

    public function edit(SalePurchaseItem $salePurchaseItem)
    {
        abort_if(Gate::denies('sale_purchase_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchaseItems.edit', compact('salePurchaseItem'));
    }

    public function update(UpdateSalePurchaseItemRequest $request, SalePurchaseItem $salePurchaseItem)
    {
        $salePurchaseItem->update($request->all());

        return redirect()->route('admin.sale-purchase-items.index');
    }

    public function show(SalePurchaseItem $salePurchaseItem)
    {
        abort_if(Gate::denies('sale_purchase_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchaseItems.show', compact('salePurchaseItem'));
    }

    public function destroy(SalePurchaseItem $salePurchaseItem)
    {
        abort_if(Gate::denies('sale_purchase_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salePurchaseItem->delete();

        return back();
    }

    public function massDestroy(MassDestroySalePurchaseItemRequest $request)
    {
        $salePurchaseItems = SalePurchaseItem::find(request('ids'));

        foreach ($salePurchaseItems as $salePurchaseItem) {
            $salePurchaseItem->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
