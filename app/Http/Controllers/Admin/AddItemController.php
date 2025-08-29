<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddItemRequest;
use App\Http\Requests\StoreAddItemRequest;
use App\Http\Requests\UpdateAddItemRequest;
use App\Models\AddItem;
use App\Models\Category;
use App\Models\TaxRate;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddItemController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('add_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addItems = AddItem::with(['select_unit', 'select_categories', 'select_tax', 'created_by'])->get();

        return view('admin.addItems.index', compact('addItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('add_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_units = Unit::pluck('base_unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $select_categories = Category::pluck('name', 'id');

        $select_taxes = TaxRate::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addItems.create', compact('select_categories', 'select_taxes', 'select_units'));
    }

    public function store(StoreAddItemRequest $request)
    {
        $addItem = AddItem::create($request->all());
        $addItem->select_categories()->sync($request->input('select_categories', []));

        return redirect()->route('admin.add-items.index');
    }

    public function edit(AddItem $addItem)
    {
        abort_if(Gate::denies('add_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_units = Unit::pluck('base_unit', 'id')->prepend(trans('global.pleaseSelect'), '');

        $select_categories = Category::pluck('name', 'id');

        $select_taxes = TaxRate::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $addItem->load('select_unit', 'select_categories', 'select_tax', 'created_by');

        return view('admin.addItems.edit', compact('addItem', 'select_categories', 'select_taxes', 'select_units'));
    }

    public function update(UpdateAddItemRequest $request, AddItem $addItem)
    {
        $addItem->update($request->all());
        $addItem->select_categories()->sync($request->input('select_categories', []));

        return redirect()->route('admin.add-items.index');
    }

    public function show(AddItem $addItem)
    {
        abort_if(Gate::denies('add_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addItem->load('select_unit', 'select_categories', 'select_tax', 'created_by');

        return view('admin.addItems.show', compact('addItem'));
    }

    public function destroy(AddItem $addItem)
    {
        abort_if(Gate::denies('add_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddItemRequest $request)
    {
        $addItems = AddItem::find(request('ids'));

        foreach ($addItems as $addItem) {
            $addItem->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
