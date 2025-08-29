<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAllPartyRequest;
use App\Http\Requests\StoreAllPartyRequest;
use App\Http\Requests\UpdateAllPartyRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllPartiesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('all_party_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allParties.index');
    }

    public function create()
    {
        abort_if(Gate::denies('all_party_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allParties.create');
    }

    public function store(StoreAllPartyRequest $request)
    {
        $allParty = AllParty::create($request->all());

        return redirect()->route('admin.all-parties.index');
    }

    public function edit(AllParty $allParty)
    {
        abort_if(Gate::denies('all_party_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allParties.edit', compact('allParty'));
    }

    public function update(UpdateAllPartyRequest $request, AllParty $allParty)
    {
        $allParty->update($request->all());

        return redirect()->route('admin.all-parties.index');
    }

    public function show(AllParty $allParty)
    {
        abort_if(Gate::denies('all_party_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.allParties.show', compact('allParty'));
    }

    public function destroy(AllParty $allParty)
    {
        abort_if(Gate::denies('all_party_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allParty->delete();

        return back();
    }

    public function massDestroy(MassDestroyAllPartyRequest $request)
    {
        $allParties = AllParty::find(request('ids'));

        foreach ($allParties as $allParty) {
            $allParty->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
