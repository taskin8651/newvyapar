<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPartyReportByItemRequest;
use App\Http\Requests\StorePartyReportByItemRequest;
use App\Http\Requests\UpdatePartyReportByItemRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PartyReportByItemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('party_report_by_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyReportByItems.index');
    }

    public function create()
    {
        abort_if(Gate::denies('party_report_by_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyReportByItems.create');
    }

    public function store(StorePartyReportByItemRequest $request)
    {
        $partyReportByItem = PartyReportByItem::create($request->all());

        return redirect()->route('admin.party-report-by-items.index');
    }

    public function edit(PartyReportByItem $partyReportByItem)
    {
        abort_if(Gate::denies('party_report_by_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyReportByItems.edit', compact('partyReportByItem'));
    }

    public function update(UpdatePartyReportByItemRequest $request, PartyReportByItem $partyReportByItem)
    {
        $partyReportByItem->update($request->all());

        return redirect()->route('admin.party-report-by-items.index');
    }

    public function show(PartyReportByItem $partyReportByItem)
    {
        abort_if(Gate::denies('party_report_by_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyReportByItems.show', compact('partyReportByItem'));
    }

    public function destroy(PartyReportByItem $partyReportByItem)
    {
        abort_if(Gate::denies('party_report_by_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partyReportByItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyPartyReportByItemRequest $request)
    {
        $partyReportByItems = PartyReportByItem::find(request('ids'));

        foreach ($partyReportByItems as $partyReportByItem) {
            $partyReportByItem->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
