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
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class AddItemController extends Controller
{
    use CsvImportTrait;

public function index()
{
    abort_if(Gate::denies('add_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = auth()->user();
    $userRole = $user->roles->pluck('title')->first();

    // 🟢 1️⃣ Super Admin → sabhi records dekh sakta hai
    if ($userRole === 'Super Admin') {
        $addItems = \App\Models\AddItem::withoutGlobalScopes()
            ->with(['select_unit', 'select_categories', 'select_tax', 'created_by'])
            ->get();

    } else {
        // 🟢 2️⃣ Admin / Branch / Same Company users

        // Step 1️⃣ - Get all company IDs linked with this user
        $companyIds = $user->select_companies()->pluck('id')->toArray();

        // Step 2️⃣ - Get all user IDs (Admin + Branch) under same company
        $relatedUserIds = \App\Models\User::whereHas('select_companies', function ($q) use ($companyIds) {
            $q->whereIn('add_businesses.id', $companyIds);
        })->pluck('id')->toArray();

        // Step 3️⃣ - Fetch all AddItems created by users of same company
        $addItems = \App\Models\AddItem::with(['select_unit', 'select_categories', 'select_tax', 'created_by'])
            ->whereIn('created_by_id', $relatedUserIds)
            ->get();
    }

    return view('admin.addItems.index', compact('addItems'));
}


public function create()
{
    abort_if(Gate::denies('add_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $userId = Auth::id();

    $select_units = Unit::where('created_by_id', $userId)
        ->pluck('base_unit', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    $select_categories = Category::where('created_by_id', $userId)
        ->pluck('name', 'id');

    $select_taxes = TaxRate::where('created_by_id', $userId)
        ->pluck('name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    // Fetch raw materials from current_stocks and include sale & purchase price from AddItem
    $rawMaterials = CurrentStock::with('addItem')
        ->where('product_type', 'raw_material')
        ->where('created_by_id', $userId)
        ->get()
        ->map(function ($stock) {
            // try to read sale and purchase price from related addItem
            $salePrice = $stock->addItem->sale_price ?? 0;
            $purchasePrice = $stock->addItem->purchase_price ?? 0;

            return [
                'id' => $stock->addItem->id ?? null,
                'name' => $stock->addItem->item_name ?? 'Unnamed Item',
                'qty' => (int) $stock->qty,
                'sale_price' => (float) $salePrice,
                'purchase_price' => (float) $purchasePrice,
                'source' => 'current_stock',
            ];
        });

    // Fetch service-type items
    $service_items = \App\Models\AddItem::where('created_by_id', $userId)
        ->where('item_type', 'service')
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->item_name ?? 'Unnamed Item',
                'qty' => 'No Need',
                'sale_price' => (float) ($item->sale_price ?? 0),
                'purchase_price' => (float) ($item->purchase_price ?? 0),
                'source' => 'add_items',
            ];
        });

    $raw_materials = $rawMaterials->merge($service_items);

    return view('admin.addItems.create', compact('select_categories', 'select_taxes', 'select_units', 'raw_materials'));
}


public function store(Request $request)
{
    // Basic required product_type
    $request->validate([
        'product_type' => 'required|string|in:single,raw_material,finished_goods,ready_made',
    ]);

    if ($request->product_type === 'raw_material') {
        $request->merge(['item_type' => 'raw_material']);
    }

    // Full validation including arrays
    $validated = $request->validate([
        'product_type' => 'required|string|in:single,raw_material,finished_goods,ready_made',
        'item_type' => 'required|string|in:raw_material,product,service',
        'item_name' => 'required|string|max:255',
        'item_hsn' => 'nullable|string|max:255',
        'select_unit_id' => 'required|integer|exists:units,id',
        'select_category' => 'required|array',
        'select_category.*' => 'integer|exists:categories,id',
        'quantity' => 'nullable|integer|min:0',
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
        'opening_stock' => 'nullable|integer|min:0',
        'low_stock_warning' => 'nullable|integer|min:0',
        'warehouse_location' => 'nullable|string|max:255',
        'online_store_title' => 'nullable|string|max:255',
        'online_store_description' => 'nullable|string',
        'online_store_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'select_raw_materials' => 'nullable|array',
        'select_raw_materials.*' => 'integer|exists:add_items,id',

        'raw_qty' => 'nullable|array',
        'raw_qty.*' => 'nullable|numeric|min:0',
        'raw_sale_price' => 'nullable|array',
        'raw_sale_price.*' => 'nullable|numeric|min:0',
        'raw_purchase_price' => 'nullable|array',
        'raw_purchase_price.*' => 'nullable|numeric|min:0',

        'json_data' => 'nullable',
    ]);

    // Handle image
    if ($request->hasFile('online_store_image')) {
        $validated['online_store_image'] = $request->file('online_store_image')->store('item_images', 'public');
    }

    $validated['created_by_id'] = auth()->id();

    // Full JSON backup
    $fullData = $request->all();
    if ($request->hasFile('online_store_image')) {
        $fullData['online_store_image'] = $validated['online_store_image'];
    }
    $validated['json_data'] = json_encode($fullData);

    // Create Item
    $item = AddItem::create($validated);

    // Sync categories
    if (!empty($validated['select_category'])) {
        $item->select_categories()->sync($validated['select_category']);
    }

    /*
    |--------------------------------------------------------------------------
    | ✅ Always Create Current Stock Record (Except Service)
    |--------------------------------------------------------------------------
    */
    if ($validated['item_type'] !== 'service') {

        // If opening_stock null, blank or zero → default 0
        $qty = !empty($validated['opening_stock']) ? $validated['opening_stock'] : 0;

        CurrentStock::create([
            'json_data' => json_encode($fullData),
            'user_id' => 1,
            'qty' => $qty,
            'type' => $validated['product_type'] === 'finished_goods' ? 'Manufactured Stock' : 'Opening Stock',
            'created_by_id' => auth()->id(),
            'item_id' => $item->id,
            'product_type' => $validated['product_type'],
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | FINISHED GOODS: Save Composition (No Stock Deduction)
    |--------------------------------------------------------------------------
    */
    if ($validated['product_type'] === 'finished_goods') {
        $rawMaterials = $request->input('select_raw_materials', []);
        $finishedGoodsQty = 0;
        $total_sale_value_all = 0;
        $total_purchase_value_all = 0;

        foreach ($rawMaterials as $rawId) {
            $usedQty = floatval($request->input("raw_qty.$rawId", 0));
            if ($usedQty <= 0) continue;

            $salePriceAtTime = floatval($request->input("raw_sale_price.$rawId", 0));
            $purchasePriceAtTime = floatval($request->input("raw_purchase_price.$rawId", 0));

            $totalSale = $usedQty * $salePriceAtTime;
            $totalPurchase = $usedQty * $purchasePriceAtTime;

            $finishedGoodsQty += $usedQty;
            $total_sale_value_all += $totalSale;
            $total_purchase_value_all += $totalPurchase;

            DB::table('finished_goods_raw_material')->insert([
                'item_id' => $item->id,
                'select_raw_material_id' => $rawId,
                'qty' => $usedQty,
                'sale_price_at_time' => $salePriceAtTime,
                'purchase_price_at_time' => $purchasePriceAtTime,
                'total_sale_value' => $totalSale,
                'total_purchase_value' => $totalPurchase,
                'item_name' => $validated['item_name'],
                'item_hsn' => $validated['item_hsn'] ?? null,
                'json_data' => json_encode($fullData),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Save summary in json_data
        $decodedJson = json_decode($item->json_data ?? '{}', true);
        $decodedJson['composition_summary'] = [
            'finished_goods_composition' => [
                'total_qty_used' => $finishedGoodsQty,
                'total_sale_value' => $total_sale_value_all,
                'total_purchase_value' => $total_purchase_value_all,
            ],
        ];
        $item->json_data = json_encode($decodedJson);
        $item->save();
    }

    return redirect()
        ->route('admin.add-items.index')
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
