<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemWiseProfitAndLoassRequest;
use App\Http\Requests\StoreItemWiseProfitAndLoassRequest;
use App\Http\Requests\UpdateItemWiseProfitAndLoassRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemWiseProfitAndLoassController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('item_wise_profit_and_loass_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.itemWiseProfitAndLoasses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('item_wise_profit_and_loass_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.itemWiseProfitAndLoasses.create');
    }

    public function store(StoreItemWiseProfitAndLoassRequest $request)
    {
        $itemWiseProfitAndLoass = ItemWiseProfitAndLoass::create($request->all());

        return redirect()->route('admin.item-wise-profit-and-loasses.index');
    }

    public function edit(ItemWiseProfitAndLoass $itemWiseProfitAndLoass)
    {
        abort_if(Gate::denies('item_wise_profit_and_loass_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.itemWiseProfitAndLoasses.edit', compact('itemWiseProfitAndLoass'));
    }

    public function update(UpdateItemWiseProfitAndLoassRequest $request, ItemWiseProfitAndLoass $itemWiseProfitAndLoass)
    {
        $itemWiseProfitAndLoass->update($request->all());

        return redirect()->route('admin.item-wise-profit-and-loasses.index');
    }

    public function show(ItemWiseProfitAndLoass $itemWiseProfitAndLoass)
    {
        abort_if(Gate::denies('item_wise_profit_and_loass_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.itemWiseProfitAndLoasses.show', compact('itemWiseProfitAndLoass'));
    }

    public function destroy(ItemWiseProfitAndLoass $itemWiseProfitAndLoass)
    {
        abort_if(Gate::denies('item_wise_profit_and_loass_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemWiseProfitAndLoass->delete();

        return back();
    }

    public function massDestroy(MassDestroyItemWiseProfitAndLoassRequest $request)
    {
        $itemWiseProfitAndLoasses = ItemWiseProfitAndLoass::find(request('ids'));

        foreach ($itemWiseProfitAndLoasses as $itemWiseProfitAndLoass) {
            $itemWiseProfitAndLoass->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
