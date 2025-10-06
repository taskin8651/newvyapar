<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddItemRequest;
use App\Http\Requests\StoreAddItemRequest;
use App\Http\Requests\UpdateAddItemRequest;
use App\Models\AddItem;
use App\Models\Category;
use App\Models\CurrentStock;
use App\Models\TaxRate;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

public function store(Request $request)
{
    // dd($request->all());
   
    // ✅ Validate data
    $validated = $request->validate([
        'item_type' => 'required|string|in:product,service',// ✅ Product/Service compulsory
        'item_name' => 'required|string|max:255',
        'item_hsn' => 'nullable|string|max:255',
        'select_unit_id' => 'required|integer|exists:units,id',
        'select_category' => 'required|array',
        'select_category.*' => 'integer|exists:categories,id',
        'quantity' => 'nullable|integer',
        'item_code' => 'nullable|string|max:255',
        'sale_price' => 'nullable|numeric',
        'select_type' => 'required', 
        'disc_on_sale_price' => 'nullable|numeric',
        'disc_type' => 'nullable|string',
        'wholesale_price' => 'nullable|numeric',
        'select_type_wholesale' => 'nullable|string',
        'minimum_wholesale_qty' => 'nullable|integer',
        'purchase_price' => 'nullable|numeric',
        'select_purchase_type' => 'nullable|string',
        'select_tax_id' => 'nullable|integer|exists:tax_rates,id',
        'opening_stock' => 'nullable|integer',
        'low_stock_warning' => 'nullable|integer',
        'warehouse_location' => 'nullable|string|max:255',
        'online_store_title' => 'nullable|string|max:255',
        'online_store_description' => 'nullable|string',
        'online_store_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'json_data' => 'nullable',
    ]);

    // ✅ Handle image upload
    if ($request->hasFile('online_store_image')) {
        $validated['online_store_image'] = $request->file('online_store_image')->store('item_images', 'public');
    }

    // ✅ Created By User
    $validated['created_by_id'] = auth()->id();

    // ✅ Save item
    $item = AddItem::create($validated);

    // ✅ Sync categories into pivot table
    if ($request->has('select_category')) {
        $item->select_categories()->sync($request->input('select_category'));
    }

    // ✅ Save Opening Stock only if item_type = Product
    if (
        isset($validated['item_type']) &&
        strtolower($validated['item_type']) === 'product' &&
        !empty($validated['opening_stock']) &&
        $validated['opening_stock'] > 0
    ) {
        $defaultPartyId = 1; // ✅ Always 1

        $stock = CurrentStock::create([
            'json_data'     => $validated['json_data'],
            'user_id'       => $defaultPartyId, // ✅ Fix: hamesha 1
            'qty'           => $validated['opening_stock'],
            'type'          => 'Opening Stock',
            'created_by_id' => auth()->id(),
            'item_id'       => $item->id, // ✅ Link to the item
        ]);

        // ✅ Attach item to the stock (pivot table)
        $stock->items()->attach($item->id);
    }

    return redirect()->route('admin.add-items.index')
        ->with('success', 'Item added successfully!');
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
   
    // ✅ Update item details
    $addItem->update($request->all());

    // ✅ Update Pivot Table: add_item_category
    if ($request->has('select_category')) {
        $addItem->select_categories()->sync($request->input('select_category'));
    }

    // ✅ If opening stock is provided, save/update in current_stocks
    if ($request->has('opening_stock') && !empty($request->opening_stock) && $request->opening_stock > 0) {

        // ✅ Always use default party_id = 1
        $defaultPartyId = 1;

        // Decode JSON data if available
        $jsonData = null;
        if ($request->has('json_data') && !empty($request->json_data)) {
            $jsonData = json_decode($request->json_data, true);
        }


        // ✅ Check if an existing record exists for the same item & party
        $existingStock = CurrentStock::where('user_id', $defaultPartyId)
            ->whereHas('items', function ($query) use ($addItem) {
                $query->where('add_item_id', $addItem->id);
            })
            ->first();

        if ($existingStock) {
            // ✅ Update existing stock quantity & json_data
            $existingStock->update([
                'qty'           => $request->opening_stock,
                'json_data'     => $jsonData ? json_encode($jsonData) : $existingStock->json_data,
                'type'          => 'Opening Stock Updated',
                'created_by_id' => auth()->id(),
            ]);
        } else {
            // ✅ Create a new record if it doesn't exist
            $stock = CurrentStock::create([
                'user_id'       => $defaultPartyId, // ✅ Always 1
                'qty'           => $request->opening_stock,
                'json_data'     => $jsonData ? json_encode($jsonData) : null,
                'type'          => 'Opening Stock',
                'created_by_id' => auth()->id(),
            ]);

            // ✅ Attach item to the stock (pivot table)
            $stock->items()->attach($addItem->id);
        }
    }

    return redirect()->route('admin.add-items.index')
        ->with('success', 'Item updated successfully!');
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
