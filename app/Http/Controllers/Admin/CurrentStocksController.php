<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCurrentStockRequest;
use App\Http\Requests\StoreCurrentStockRequest;
use App\Http\Requests\UpdateCurrentStockRequest;
use App\Models\AddItem;
use App\Models\CurrentStock;
use App\Models\PartyDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use  PDF;

class CurrentStocksController extends Controller
{
    use CsvImportTrait;

public function index()
{
    abort_if(Gate::denies('current_stock_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = auth()->user();
    $userRole = $user->roles->pluck('title')->first();

    // 🟢 1️⃣ Super Admin → sabhi records dekh sakta hai
    if ($userRole === 'Super Admin') {
        $currentStocks = \App\Models\CurrentStock::withoutGlobalScopes()
            ->with([
                'addItems' => fn($q) => $q->withoutGlobalScopes(),
                'user' => fn($q) => $q->withoutGlobalScopes(),
                'created_by' => fn($q) => $q->withoutGlobalScopes(),
                'party' => fn($q) => $q->withoutGlobalScopes(),
            ])
            ->latest()
            ->get();

    } else {
        // 🟢 2️⃣ Admin / Branch / Same Company users

        // Step 1️⃣ - Get all company IDs linked with this user
        $companyIds = $user->select_companies()->pluck('id')->toArray();

        // Step 2️⃣ - Get all user IDs (Admin + Branch) under same company
        $relatedUserIds = \App\Models\User::whereHas('select_companies', function ($q) use ($companyIds) {
            $q->whereIn('add_businesses.id', $companyIds);
        })->pluck('id')->toArray();

        // Step 3️⃣ - Fetch all CurrentStock entries created by users of same company
        $currentStocks = \App\Models\CurrentStock::with(['addItems', 'user', 'createdBy', 'party'])
            ->whereIn('created_by_id', $relatedUserIds)
            ->latest()
            ->get();
    }

    return view('admin.currentStocks.index', compact('currentStocks'));
}


    public function create()
    {
        abort_if(Gate::denies('current_stock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = AddItem::pluck('item_name', 'id');

        $parties = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.currentStocks.create', compact('items', 'parties'));
    }

    public function store(StoreCurrentStockRequest $request)
    {
        $currentStock = CurrentStock::create($request->all());
        $currentStock->items()->sync($request->input('items', []));

        return redirect()->route('admin.current-stocks.index');
    }

    public function edit(CurrentStock $currentStock)
    {
        abort_if(Gate::denies('current_stock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = AddItem::pluck('item_name', 'id');

        $parties = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currentStock->load('items', 'parties', 'created_by');

        return view('admin.currentStocks.edit', compact('currentStock', 'items', 'parties'));
    }

    public function update(UpdateCurrentStockRequest $request, CurrentStock $currentStock)
    {
        $currentStock->update($request->all());
        $currentStock->items()->sync($request->input('items', []));

        return redirect()->route('admin.current-stocks.index');
    }

    public function show(CurrentStock $currentStock)
    {
        abort_if(Gate::denies('current_stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

         $currentStock->load('items', 'party', 'created_by');

        return view('admin.currentStocks.show', compact('currentStock'));
    }

    public function destroy(CurrentStock $currentStock)
    {
        abort_if(Gate::denies('current_stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $currentStock->delete();

        return back();
    }

    public function massDestroy(MassDestroyCurrentStockRequest $request)
    {
        $currentStocks = CurrentStock::find(request('ids'));

        foreach ($currentStocks as $currentStock) {
            $currentStock->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

public function pdf(CurrentStock $currentStock)
{
    $currentStock->load(['party', 'items']);
    return view('admin.currentStocks.pdf', compact('currentStock'));
}



}
