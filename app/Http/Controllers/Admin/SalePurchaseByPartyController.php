<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySalePurchaseByPartyRequest;
use App\Http\Requests\StoreSalePurchaseByPartyRequest;
use App\Http\Requests\UpdateSalePurchaseByPartyRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SalePurchaseByPartyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sale_purchase_by_party_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchaseByParties.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sale_purchase_by_party_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchaseByParties.create');
    }

    public function store(StoreSalePurchaseByPartyRequest $request)
    {
        $salePurchaseByParty = SalePurchaseByParty::create($request->all());

        return redirect()->route('admin.sale-purchase-by-parties.index');
    }

    public function edit(SalePurchaseByParty $salePurchaseByParty)
    {
        abort_if(Gate::denies('sale_purchase_by_party_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchaseByParties.edit', compact('salePurchaseByParty'));
    }

    public function update(UpdateSalePurchaseByPartyRequest $request, SalePurchaseByParty $salePurchaseByParty)
    {
        $salePurchaseByParty->update($request->all());

        return redirect()->route('admin.sale-purchase-by-parties.index');
    }

    public function show(SalePurchaseByParty $salePurchaseByParty)
    {
        abort_if(Gate::denies('sale_purchase_by_party_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.salePurchaseByParties.show', compact('salePurchaseByParty'));
    }

    public function destroy(SalePurchaseByParty $salePurchaseByParty)
    {
        abort_if(Gate::denies('sale_purchase_by_party_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salePurchaseByParty->delete();

        return back();
    }

    public function massDestroy(MassDestroySalePurchaseByPartyRequest $request)
    {
        $salePurchaseByParties = SalePurchaseByParty::find(request('ids'));

        foreach ($salePurchaseByParties as $salePurchaseByParty) {
            $salePurchaseByParty->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
