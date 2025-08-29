<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPartyWiseProfitLossRequest;
use App\Http\Requests\StorePartyWiseProfitLossRequest;
use App\Http\Requests\UpdatePartyWiseProfitLossRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PartyWiseProfitLossController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('party_wise_profit_loss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyWiseProfitLosses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('party_wise_profit_loss_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyWiseProfitLosses.create');
    }

    public function store(StorePartyWiseProfitLossRequest $request)
    {
        $partyWiseProfitLoss = PartyWiseProfitLoss::create($request->all());

        return redirect()->route('admin.party-wise-profit-losses.index');
    }

    public function edit(PartyWiseProfitLoss $partyWiseProfitLoss)
    {
        abort_if(Gate::denies('party_wise_profit_loss_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyWiseProfitLosses.edit', compact('partyWiseProfitLoss'));
    }

    public function update(UpdatePartyWiseProfitLossRequest $request, PartyWiseProfitLoss $partyWiseProfitLoss)
    {
        $partyWiseProfitLoss->update($request->all());

        return redirect()->route('admin.party-wise-profit-losses.index');
    }

    public function show(PartyWiseProfitLoss $partyWiseProfitLoss)
    {
        abort_if(Gate::denies('party_wise_profit_loss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyWiseProfitLosses.show', compact('partyWiseProfitLoss'));
    }

    public function destroy(PartyWiseProfitLoss $partyWiseProfitLoss)
    {
        abort_if(Gate::denies('party_wise_profit_loss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partyWiseProfitLoss->delete();

        return back();
    }

    public function massDestroy(MassDestroyPartyWiseProfitLossRequest $request)
    {
        $partyWiseProfitLosses = PartyWiseProfitLoss::find(request('ids'));

        foreach ($partyWiseProfitLosses as $partyWiseProfitLoss) {
            $partyWiseProfitLoss->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
