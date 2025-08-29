<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemReportByPartyRequest;
use App\Http\Requests\StoreItemReportByPartyRequest;
use App\Http\Requests\UpdateItemReportByPartyRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemReportByPartyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('item_report_by_party_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.itemReportByParties.index');
    }

    public function create()
    {
        abort_if(Gate::denies('item_report_by_party_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.itemReportByParties.create');
    }

    public function store(StoreItemReportByPartyRequest $request)
    {
        $itemReportByParty = ItemReportByParty::create($request->all());

        return redirect()->route('admin.item-report-by-parties.index');
    }

    public function edit(ItemReportByParty $itemReportByParty)
    {
        abort_if(Gate::denies('item_report_by_party_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.itemReportByParties.edit', compact('itemReportByParty'));
    }

    public function update(UpdateItemReportByPartyRequest $request, ItemReportByParty $itemReportByParty)
    {
        $itemReportByParty->update($request->all());

        return redirect()->route('admin.item-report-by-parties.index');
    }

    public function show(ItemReportByParty $itemReportByParty)
    {
        abort_if(Gate::denies('item_report_by_party_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.itemReportByParties.show', compact('itemReportByParty'));
    }

    public function destroy(ItemReportByParty $itemReportByParty)
    {
        abort_if(Gate::denies('item_report_by_party_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $itemReportByParty->delete();

        return back();
    }

    public function massDestroy(MassDestroyItemReportByPartyRequest $request)
    {
        $itemReportByParties = ItemReportByParty::find(request('ids'));

        foreach ($itemReportByParties as $itemReportByParty) {
            $itemReportByParty->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
