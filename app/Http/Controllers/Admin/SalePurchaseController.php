<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySalePurchaseRequest;
use App\Http\Requests\StoreSalePurchaseRequest;
use App\Http\Requests\UpdateSalePurchaseRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalePurchaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sale_purchase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchases.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sale_purchase_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchases.create');
    }

    public function store(StoreSalePurchaseRequest $request)
    {
        $salePurchase = SalePurchase::create($request->all());

        return redirect()->route('admin.sale-purchases.index');
    }

    public function edit(SalePurchase $salePurchase)
    {
        abort_if(Gate::denies('sale_purchase_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchases.edit', compact('salePurchase'));
    }

    public function update(UpdateSalePurchaseRequest $request, SalePurchase $salePurchase)
    {
        $salePurchase->update($request->all());

        return redirect()->route('admin.sale-purchases.index');
    }

    public function show(SalePurchase $salePurchase)
    {
        abort_if(Gate::denies('sale_purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchases.show', compact('salePurchase'));
    }

    public function destroy(SalePurchase $salePurchase)
    {
        abort_if(Gate::denies('sale_purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salePurchase->delete();

        return back();
    }

    public function massDestroy(MassDestroySalePurchaseRequest $request)
    {
        $salePurchases = SalePurchase::find(request('ids'));

        foreach ($salePurchases as $salePurchase) {
            $salePurchase->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
