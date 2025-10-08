<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPurchaseBillRequest;
use App\Http\Requests\StorePurchaseBillRequest;
use App\Http\Requests\UpdatePurchaseBillRequest;
use App\Models\AddItem;
use App\Models\BankAccount;
use App\Models\CurrentStock;
use App\Models\PartyDetail;
use App\Models\PurchaseBill;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Tests\Browser\PartyDetailsTest;
use App\Models\Unit;
use App\Models\TaxRate;
use Illuminate\Support\Facades\DB;
use App\Models\TermAndCondition;
class PurchaseBillController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('purchase_bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseBills = PurchaseBill::with(['select_customer', 'items', 'payment_type', 'created_by', 'media','main_cost_center', 'sub_cost_center'])->get();

        return view('admin.purchaseBills.index', compact('purchaseBills'));
    }


    public function getCustomerDetails($id)
    {
        $customer = \App\Models\PartyDetail::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json([
            'party_name'       => $customer->party_name,
            'gstin'           => $customer->gstin,
            'phone_number'    => $customer->phone_number,
            'email'           => $customer->email,
            'billing_address' => $customer->billing_address,
            'shipping_address'=> $customer->shipping_address,
            'state'           => $customer->state,
            'city'            => $customer->city,
        ]);
    }



 public function create()
{
    abort_if(Gate::denies('purchase_bill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    // Customers dropdown
    $select_customers = PartyDetail::pluck('party_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    // Fetch products (with stock) and services (without stock)
    $items = AddItem::whereIn('item_type', ['product', 'service'])
        ->select('id', 'item_name', 'purchase_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
        ->with('select_unit')
        ->get()
        ->map(function ($item) {
            if ($item->item_type === 'product') {
                $item->stock_qty = CurrentStock::where('item_id', $item->id)->sum('qty');
            } else { // service
                $item->stock_qty = null;
            }
            return $item;
        });
    
    // Only get product IDs for stock
    $product_ids = $items->where('item_type', 'product')->pluck('id')->toArray();
    
    // Units
    $units = Unit::pluck('base_unit', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    // Cost centers
    $cost = \App\Models\MainCostCenter::pluck('cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $sub_cost = \App\Models\SubCostCenter::pluck('sub_cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    // Payment Types
    $payment_types = BankAccount::pluck('account_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');

    // Tax Rates
    $tax_rates = TaxRate::select('id', 'name', 'parcentage')->get();

    return view('admin.purchaseBills.create', compact(
        'items',
        'product_ids',
        'payment_types',
        'select_customers',
        'cost',
        'sub_cost',
        'units',
        'tax_rates'
    ));
}



    public function getSubCostCenters($mainCostCenterId)
    {
        $subCostCenters = \App\Models\SubCostCenter::where('main_cost_center_id', $mainCostCenterId)
            ->pluck('sub_cost_center_name', 'id');

        return response()->json($subCostCenters);
    }



public function store(StorePurchaseBillRequest $request)
{
    dd( $request->all());
    $purchaseBillNo = 'ET' . mt_rand(1000000000, 9999999999);
    while (PurchaseBill::where('purchase_bill_no', $purchaseBillNo)->exists()) {
        $purchaseBillNo = 'ET' . mt_rand(1000000000, 9999999999);
    }

    $fullData = $request->all();
    $fullData['purchase_bill_no'] = $purchaseBillNo;
    $fullData['user_id'] = auth()->id();

    $purchaseBill = PurchaseBill::create(array_merge($fullData, [
        'json_data' => json_encode($fullData),
    ]));

    if ($request->has('items')) {
        $syncData = [];
        foreach ($request->items as $item) {
            $addItem = \App\Models\AddItem::find($item['id']);
            if (!$addItem) continue;

            if ($addItem->item_type === 'product') {
                // Product → link via CurrentStock
                $stock = \App\Models\CurrentStock::where('item_id', $addItem->id)->first();
                if ($stock) {
                    $syncData[$stock->id] = ['qty' => $item['qty']];
                    $stock->qty += $item['qty'];
                    $stock->save();
                }
            } else {
                // Service → link directly to AddItem
                $syncData[$addItem->id] = ['qty' => $item['qty']];
            }
        }

        $purchaseBill->items()->sync($syncData);
    }

    \App\Models\PurchaseLog::create([
        'user_id' => auth()->id(),
        'party_id' => $request->select_customer_id,
        'main_cost_center_id' => $request->main_cost_center_id,
        'sub_cost_center_id' => $request->sub_cost_center_id,
        'payment_type_id' => $request->payment_type_id,
        'items' => $request->items,
        'extra_data' => $fullData,
    ]);

    if ($request->hasFile('image')) {
        $purchaseBill->addMedia($request->file('image'))->toMediaCollection('image');
    }

    if ($request->hasFile('document')) {
        $purchaseBill->addMedia($request->file('document'))->toMediaCollection('document');
    }

    if ($media = $request->input('ck-media', false)) {
        \Spatie\MediaLibrary\MediaCollections\Models\Media::whereIn('id', $media)
            ->update(['model_id' => $purchaseBill->id]);
    }

    return redirect()->route('admin.purchase-bills.index')
                     ->with('success', 'Purchase bill created successfully.');
}



public function edit(PurchaseBill $purchaseBill)
{
    abort_if(Gate::denies('purchase_bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    // 🔹 Dropdown data
    $select_customers = PartyDetail::pluck('party_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $cost = \App\Models\MainCostCenter::pluck('cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $subCostCenters = \App\Models\SubCostCenter::pluck('sub_cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $units = Unit::pluck('base_unit', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $payment_types = BankAccount::pluck('account_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $tax_rates = TaxRate::select('id', 'name', 'parcentage')->get();

   $itemsWithPivot = \DB::table('add_item_purchase_bill as aipb')
    ->join('current_stocks as cs', 'aipb.add_item_id', '=', 'cs.id') // pivot -> current stock
    ->join('add_items as ai', 'cs.item_id', '=', 'ai.id')            // current stock -> add_items
    ->leftJoin('units as u', 'ai.select_unit_id', '=', 'u.id')       // unit
    ->select(
        'cs.id as stock_id',        // current stock ID
        'ai.id as item_id',         // add_item ID
        'ai.item_name',
        'ai.purchase_price',
        'u.base_unit as unit',
        'aipb.qty'
    )
    ->where('aipb.purchase_bill_id', $purchaseBill->id)
    ->get();

    // 🔹 All items for selection dropdown if needed
    $allItems = AddItem::all();

    return view('admin.purchaseBills.edit', compact(
        'allItems',
        'payment_types',
        'purchaseBill',
        'select_customers',
        'cost',
        'subCostCenters',
        'units',
        'tax_rates',
        'itemsWithPivot'
    ));
}




 public function update(UpdatePurchaseBillRequest $request, PurchaseBill $purchaseBill)
{
    // 1️⃣ Prepare full request data with user ID
    $fullData = $request->all();
    $fullData['user_id'] = auth()->id();

    // 2️⃣ Update PurchaseBill and save full JSON in 'json_data' field
    $purchaseBill->update(array_merge($fullData, [
        'json_data' => json_encode($fullData),
    ]));

    // 3️⃣ Sync items with qty in pivot table
    if ($request->has('items')) {
        $syncData = [];
        foreach ($request->items as $item) {
            $syncData[$item['id']] = ['qty' => $item['qty']];
        }
        $purchaseBill->items()->sync($syncData);
    }

    // 4️⃣ Update current stock for products
    // Optional: adjust stock based on difference (old vs new qty)
    foreach ($request->items as $item) {
        $stock = \App\Models\CurrentStock::find($item['id']); // CurrentStock ID
        if ($stock) {
            // Calculate new quantity difference
            $oldQty = $purchaseBill->items()->where('add_item_id', $item['id'])->first()->pivot->qty ?? 0;
            $stock->qty = $stock->qty - $oldQty + $item['qty'];
            $stock->save();
        }
    }

    // 5️⃣ Save PurchaseLog with full JSON in 'extra_data'
    \App\Models\PurchaseLog::create([
        'user_id' => auth()->id(),
        'party_id' => $request->select_customer_id,
        'main_cost_center_id' => $request->main_cost_center_id,
        'sub_cost_center_id' => $request->sub_cost_center_id,
        'payment_type_id' => $request->payment_type_id,
        'items' => $request->items,
        'extra_data' => $fullData, // everything including user_id
    ]);

    // 6️⃣ Handle media uploads
    if ($request->hasFile('image')) {
        if ($purchaseBill->getFirstMedia('image')) {
            $purchaseBill->getFirstMedia('image')->delete();
        }
        $purchaseBill->addMedia($request->file('image'))->toMediaCollection('image');
    }

    if ($request->hasFile('document')) {
        if ($purchaseBill->getFirstMedia('document')) {
            $purchaseBill->getFirstMedia('document')->delete();
        }
        $purchaseBill->addMedia($request->file('document'))->toMediaCollection('document');
    }

    if ($media = $request->input('ck-media', false)) {
        \Spatie\MediaLibrary\MediaCollections\Models\Media::whereIn('id', $media)
            ->update(['model_id' => $purchaseBill->id]);
    }

    // 7️⃣ Redirect back with success
    return redirect()->route('admin.purchase-bills.index')
                     ->with('success', 'Purchase bill updated successfully.');
}


    public function show(PurchaseBill $purchaseBill)
    {
        abort_if(Gate::denies('purchase_bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseBill->load('select_customer', 'items', 'payment_type', 'created_by');

        return view('admin.purchaseBills.show', compact('purchaseBill'));
    }

    public function destroy(PurchaseBill $purchaseBill)
    {
        abort_if(Gate::denies('purchase_bill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseBill->delete();

        return back();
    }

    public function massDestroy(MassDestroyPurchaseBillRequest $request)
    {
        $purchaseBills = PurchaseBill::find(request('ids'));

        foreach ($purchaseBills as $purchaseBill) {
            $purchaseBill->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('purchase_bill_create') && Gate::denies('purchase_bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PurchaseBill();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function pdf(PurchaseBill $purchaseBill)
    {
        $bankDetails = BankAccount::all();
        $terms = TermAndCondition::where('status', 'active')->get();

        $purchaseBill->load('select_customer', 'items', 'payment_type', 'created_by', 'main_cost_center', 'sub_cost_center');
    return view('admin.purchaseBills.pdf', compact('purchaseBill', 'bankDetails', 'terms'));
    }
}