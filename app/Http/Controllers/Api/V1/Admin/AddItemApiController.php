<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddItemRequest;
use App\Http\Requests\UpdateAddItemRequest;
use App\Http\Resources\Admin\AddItemResource;
use App\Models\AddItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddItemApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('add_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddItemResource(AddItem::with(['select_unit', 'select_categories', 'select_tax', 'created_by'])->get());
    }

    public function store(StoreAddItemRequest $request)
    {
        $addItem = AddItem::create($request->all());
        $addItem->select_categories()->sync($request->input('select_categories', []));

        return (new AddItemResource($addItem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AddItem $addItem)
    {
        abort_if(Gate::denies('add_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AddItemResource($addItem->load(['select_unit', 'select_categories', 'select_tax', 'created_by']));
    }

    public function update(UpdateAddItemRequest $request, AddItem $addItem)
    {
        $addItem->update($request->all());
        $addItem->select_categories()->sync($request->input('select_categories', []));

        return (new AddItemResource($addItem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AddItem $addItem)
    {
        abort_if(Gate::denies('add_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addItem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
