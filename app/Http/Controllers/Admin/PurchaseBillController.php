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
use App\Models\PartyDetail;
use App\Models\PurchaseBill;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PurchaseBillController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('purchase_bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchaseBills = PurchaseBill::with(['select_customer', 'items', 'payment_type', 'created_by', 'media'])->get();

        return view('admin.purchaseBills.index', compact('purchaseBills'));
    }

    public function create()
    {
        abort_if(Gate::denies('purchase_bill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_customers = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = AddItem::pluck('item_name', 'id');

        $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.purchaseBills.create', compact('items', 'payment_types', 'select_customers'));
    }

    public function store(StorePurchaseBillRequest $request)
    {
        $purchaseBill = PurchaseBill::create($request->all());
        $purchaseBill->items()->sync($request->input('items', []));
        if ($request->input('image', false)) {
            $purchaseBill->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($request->input('document', false)) {
            $purchaseBill->addMedia(storage_path('tmp/uploads/' . basename($request->input('document'))))->toMediaCollection('document');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $purchaseBill->id]);
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
