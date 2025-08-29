<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProfitLossRequest;
use App\Http\Requests\StoreProfitLossRequest;
use App\Http\Requests\UpdateProfitLossRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfitLossController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('profit_loss_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.profitLosses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('profit_loss_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.profitLosses.create');
    }

    public function store(StoreProfitLossRequest $request)
    {
        $profitLoss = ProfitLoss::create($request->all());

        return redirect()->route('admin.profit-losses.index');
    }

    public function edit(ProfitLoss $profitLoss)
    {
        abort_if(Gate::denies('profit_loss_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.profitLosses.edit', compact('profitLoss'));
    }

    public function update(UpdateProfitLossRequest $request, ProfitLoss $profitLoss)
    {
        $profitLoss->update($request->all());

        return redirect()->route('admin.profit-losses.index');
    }

    public function show(ProfitLoss $profitLoss)
    {
        abort_if(Gate::denies('profit_loss_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.profitLosses.show', compact('profitLoss'));
    }

    public function destroy(ProfitLoss $profitLoss)
    {
        abort_if(Gate::denies('profit_loss_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profitLoss->delete();

        return back();
    }

    public function massDestroy(MassDestroyProfitLossRequest $request)
    {
        $profitLosses = ProfitLoss::find(request('ids'));

        foreach ($profitLosses as $profitLoss) {
            $profitLoss->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
