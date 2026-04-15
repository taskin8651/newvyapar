<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use App\Models\CurrentStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RawMaterialController extends Controller
{
    public function index()
    {
        $materials = RawMaterial::latest()->get();
        return view('admin.raw_materials.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.raw_materials.create');
    }

    public function store(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'warehouse_location' => 'required|string|max:255',
            'low_stock_warning'  => 'nullable|numeric',
            'materials'          => 'required|array',
            'materials.*.title'  => 'required|string|max:255',
            'materials.*.quantity' => 'required|numeric|min:0',
            'materials.*.purchase_price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {

            foreach ($request->materials as $material) {

                $rm = RawMaterial::create([

                    // ✅ Auto Unique Code
                    'unique_code' => 'RM-' . strtoupper(uniqid()),

                    // Buyer Code now inside table row
                    'buyer_code' => $material['buyer_code'] ?? null,

                    'title' => $material['title'],
                    'item_code' => $material['item_code'] ?? null,
                    'item_hsn' => $material['item_hsn'] ?? null,
                    'unit' => $material['unit'] ?? null,
                    'unit_type' => $material['unit_type'] ?? null,
                    'quantity' => $material['quantity'],
                    'purchase_price' => $material['purchase_price'],
                    'sale_price' => $material['sale_price'] ?? 0,
                    'with_tax' => $material['with_tax'] ?? 0,
                    'tax_percent' => $material['tax_percent'] ?? 0,

                    // ✅ These come from header section (single input)
                    'low_stock_warning' => $request->low_stock_warning ?? 0,
                    'warehouse_location' => $request->warehouse_location,
                ]);

                // ✅ Add to Stock Table
                CurrentStock::create([
                    'item_id' => $rm->id,
                    'qty' => $material['quantity'],
                    'type' => 'Opening Stock',
                    'product_type' => 'raw_material',
                    'user_id' => auth()->id(),
                    'created_by_id' => auth()->id(),
                ]);
            }
        });

        return redirect()
            ->route('admin.raw-materials.index')
            ->with('message', 'Raw Materials Added Successfully');
    }
        // ✅ EDIT METHOD (Missing tha)
    public function edit(RawMaterial $rawMaterial)
    {
        // Agar same unique_code ke multiple rows hain
        $materials = RawMaterial::where('unique_code', $rawMaterial->unique_code)->get();
        // dd($materials);
        return view('admin.raw_materials.edit', compact('rawMaterial', 'materials'));
    }

    // ✅ UPDATE METHOD (for edit blade)
    public function update(Request $request, RawMaterial $rawMaterial)
    {
        $request->validate([
            'warehouse_location' => 'required|string|max:255',
            'low_stock_warning'  => 'nullable|numeric',
            'materials'          => 'required|array',
        ]);

        DB::transaction(function () use ($request, $rawMaterial) {

            // Delete old rows if using multiple entry logic
            RawMaterial::where('unique_code', $rawMaterial->unique_code)->delete();

            foreach ($request->materials as $material) {

                $rm = RawMaterial::create([
                    'unique_code' => $rawMaterial->unique_code,
                    'buyer_code' => $material['buyer_code'] ?? null,
                    'title' => $material['title'],
                    'item_code' => $material['item_code'] ?? null,
                    'item_hsn' => $material['item_hsn'] ?? null,
                    'unit' => $material['unit'] ?? null,
                    'unit_type' => $material['unit_type'] ?? null,
                    'quantity' => $material['quantity'],
                    'purchase_price' => $material['purchase_price'],
                    'sale_price' => $material['sale_price'] ?? 0,
                    'with_tax' => $material['with_tax'] ?? 0,
                    'tax_percent' => $material['tax_percent'] ?? 0,
                    'low_stock_warning' => $request->low_stock_warning ?? 0,
                    'warehouse_location' => $request->warehouse_location,
                ]);

                // Update Stock
                CurrentStock::updateOrCreate(
                    ['item_id' => $rm->id, 'product_type' => 'raw_material'],
                    [
                        'qty' => $material['quantity'],
                        'type' => 'Opening Stock',
                        'user_id' => auth()->id(),
                        'created_by_id' => auth()->id(),
                    ]
                );
            }
        });

        return redirect()
            ->route('admin.raw-materials.index')
            ->with('message', 'Raw Materials Updated Successfully');
    }


    public function destroy(RawMaterial $rawMaterial)
    {
        DB::transaction(function () use ($rawMaterial) {

            CurrentStock::where('item_id', $rawMaterial->id)
                ->where('product_type', 'raw_material')
                ->delete();

            $rawMaterial->delete();
        });

        return back()->with('message', 'Deleted Successfully');
    }
}
