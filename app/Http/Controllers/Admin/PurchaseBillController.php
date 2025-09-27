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

        // Fetch customers
        $select_customers = PartyDetail::pluck('party_name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $cost = \App\Models\MainCostCenter::pluck('cost_center_name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $sub_cost = \App\Models\SubCostCenter::pluck('sub_cost_center_name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        // Products (from CurrentStock)
       
        $products = CurrentStock::with('items')->get()->mapWithKeys(function ($stock) {
            $item = $stock->items->first();
            if (!$item) return [];

            // Use item id as the key
            return [
                $item->id => '[Product] ' . $item->item_name 
                    . ' | HSN: ' . $item->item_hsn
                    . ' | Price: ' . number_format($item->purchase_price, 2)
                    . ' | Qty: ' . $stock->qty
                    . ' | id: ' . $stock->id
            ];
        });

        // Services (from AddItem)
        $services = AddItem::where('item_type', 'service')->get()->mapWithKeys(function ($item) {
            return [
                $item->id => '[Service] ' . $item->item_name
                    . ' | HSN: ' . $item->item_hsn
                    . ' | Price: ' . number_format($item->purchase_price, 2)
                    . ' | id: ' . $item->id
            ];
        });

        // Merge products and services
        $items = $products->merge($services);


        // Payment Types
        $payment_types = BankAccount::pluck('account_name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.purchaseBills.create', compact(
            'items',
            'payment_types',
            'select_customers',
            'cost',
            'sub_cost'
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
    // 1️⃣ Generate unique purchase bill number
    $purchaseBillNo = 'PB' . mt_rand(1000000000, 9999999999);
    while (PurchaseBill::where('purchase_bill_no', $purchaseBillNo)->exists()) {
        $purchaseBillNo = 'PB' . mt_rand(1000000000, 9999999999);
    }

    // 2️⃣ Prepare full request data with user ID
    $fullData = $request->all();
    $fullData['purchase_bill_no'] = $purchaseBillNo;
    $fullData['user_id'] = auth()->id();
   
 
    // 3️⃣ Create PurchaseBill and save full JSON in 'json_data' field
    $purchaseBill = PurchaseBill::create(array_merge($fullData, [
        'json_data' => json_encode($fullData),
    ]));

    // 4️⃣ Sync items (if using pivot)
    if ($request->has('items')) {
        $purchaseBill->items()->sync(array_column($request->items, 'id'));
    }

    // 5️⃣ Update current stock for products
    foreach ($request->items as $item) {
        $stock = \App\Models\CurrentStock::find($item['id']); // CurrentStock ID
        if ($stock) {
            $stock->qty += $item['qty'];
            $stock->save();
        }
    }

    // 6️⃣ Save PurchaseLog with full JSON in 'extra_data'
    \App\Models\PurchaseLog::create([
        'user_id' => auth()->id(),
        'party_id' => $request->select_customer_id,
        'main_cost_center_id' => $request->main_cost_center_id,
        'sub_cost_center_id' => $request->sub_cost_center_id,
        'payment_type_id' => $request->payment_type_id,
        'items' => $request->items,
        'extra_data' => $fullData, // everything including user_id
    ]);

    // 7️⃣ Handle media uploads
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

    return redirect()->route('admin.purchase-bills.index');
}


    public function edit(PurchaseBill $purchaseBill)
    {
        abort_if(Gate::denies('purchase_bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $purchaseBill->load('select_customer', 'items', 'payment_type', 'created_by');

        return view('admin.purchaseBills.edit', compact('items', 'payment_types', 'purchaseBill', 'select_customers'));
    }

    public function update(UpdatePurchaseBillRequest $request, PurchaseBill $purchaseBill)
    {
        $purchaseBill->update($request->all());
        $purchaseBill->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            if (! $purchaseBill->image || $request->input('image') !== $purchaseBill->image->file_name) {
                if ($purchaseBill->image) {
                    $purchaseBill->image->delete();
                }
                $purchaseBill->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($purchaseBill->image) {
            $purchaseBill->image->delete();
        }

        if ($request->input('document', false)) {
            if (! $purchaseBill->document || $request->input('document') !== $purchaseBill->document->file_name) {
                if ($purchaseBill->document) {
                    $purchaseBill->document->delete();
                }
                $purchaseBill->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
            }
        } elseif ($purchaseBill->document) {
            $purchaseBill->document->delete();
        }

        return redirect()->route('admin.purchase-bills.index');
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
}
