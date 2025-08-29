<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPartyStatementRequest;
use App\Http\Requests\StorePartyStatementRequest;
use App\Http\Requests\UpdatePartyStatementRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PartyStatementController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('party_statement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyStatements.index');
    }

    public function create()
    {
        abort_if(Gate::denies('party_statement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyStatements.create');
    }

    public function store(StorePartyStatementRequest $request)
    {
        $partyStatement = PartyStatement::create($request->all());

        return redirect()->route('admin.party-statements.index');
    }

    public function edit(PartyStatement $partyStatement)
    {
        abort_if(Gate::denies('party_statement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyStatements.edit', compact('partyStatement'));
    }

    public function update(UpdatePartyStatementRequest $request, PartyStatement $partyStatement)
    {
        $partyStatement->update($request->all());

        return redirect()->route('admin.party-statements.index');
    }

    public function show(PartyStatement $partyStatement)
    {
        abort_if(Gate::denies('party_statement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.partyStatements.show', compact('partyStatement'));
    }

    public function destroy(PartyStatement $partyStatement)
    {
        abort_if(Gate::denies('party_statement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $partyStatement->delete();

        return back();
    }

    public function massDestroy(MassDestroyPartyStatementRequest $request)
    {
        $partyStatements = PartyStatement::find(request('ids'));

        foreach ($partyStatements as $partyStatement) {
            $partyStatement->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
