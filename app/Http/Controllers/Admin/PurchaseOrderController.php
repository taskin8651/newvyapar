<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPurchaseOrderRequest;
use App\Http\Requests\StorePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Models\AddItem;
use App\Models\BankAccount;
use App\Models\PartyDetail;
use App\Models\PurchaseOrder;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PurchaseOrderController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('purchase_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseOrders = PurchaseOrder::with(['select_customer', 'items', 'payment_type', 'created_by', 'media'])->get();

        return view('admin.purchaseOrders.index', compact('purchaseOrders'));
    }

    public function create()
    {
        abort_if(Gate::denies('purchase_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.purchaseOrders.create', compact('items', 'payment_types', 'select_customers'));
    }

    public function store(StorePurchaseOrderRequest $request)
    {
        $purchaseOrder = PurchaseOrder::create($request->all());
        $purchaseOrder->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            $purchaseOrder->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($request->input('document', false)) {
            $purchaseOrder->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $purchaseOrder->id]);
        }

        return redirect()->route('admin.purchase-orders.index');
    }

    public function edit(PurchaseOrder $purchaseOrder)
    {
        abort_if(Gate::denies('purchase_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $purchaseOrder->load('select_customer', 'items', 'payment_type', 'created_by');

        return view('admin.purchaseOrders.edit', compact('items', 'payment_types', 'purchaseOrder', 'select_customers'));
    }

    public function update(UpdatePurchaseOrderRequest $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->update($request->all());
        $purchaseOrder->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            if (! $purchaseOrder->image || $request->input('image') !== $purchaseOrder->image->file_name) {
                if ($purchaseOrder->image) {
                    $purchaseOrder->image->delete();
                }
                $purchaseOrder->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($purchaseOrder->image) {
            $purchaseOrder->image->delete();
        }

        if ($request->input('document', false)) {
            if (! $purchaseOrder->document || $request->input('document') !== $purchaseOrder->document->file_name) {
                if ($purchaseOrder->document) {
                    $purchaseOrder->document->delete();
                }
                $purchaseOrder->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
            }
        } elseif ($purchaseOrder->document) {
            $purchaseOrder->document->delete();
        }

        return redirect()->route('admin.purchase-orders.index');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        abort_if(Gate::denies('purchase_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseOrder->load('select_customer', 'items', 'payment_type', 'created_by');

        return view('admin.purchaseOrders.show', compact('purchaseOrder'));
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        abort_if(Gate::denies('purchase_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseOrder->delete();

        return back();
    }

    public function massDestroy(MassDestroyPurchaseOrderRequest $request)
    {
        $purchaseOrders = PurchaseOrder::find(request('ids'));

        foreach ($purchaseOrders as $purchaseOrder) {
            $purchaseOrder->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('purchase_order_create') && Gate::denies('purchase_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PurchaseOrder();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
