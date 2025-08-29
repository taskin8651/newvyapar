<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPaymentOutRequest;
use App\Http\Requests\StorePaymentOutRequest;
use App\Http\Requests\UpdatePaymentOutRequest;
use App\Models\BankAccount;
use App\Models\PartyDetail;
use App\Models\PaymentOut;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PaymentOutController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_out_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentOuts = PaymentOut::with(['parties', 'payment_type', 'created_by', 'media'])->get();

        return view('admin.paymentOuts.index', compact('paymentOuts'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_out_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parties = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.paymentOuts.create', compact('parties', 'payment_types'));
    }

    public function store(StorePaymentOutRequest $request)
    {
        $paymentOut = PaymentOut::create($request->all());

        if ($request->input('attechment', false)) {
            $paymentOut->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $paymentOut->id]);
        }

        return redirect()->route('admin.payment-outs.index');
    }

    public function edit(PaymentOut $paymentOut)
    {
        abort_if(Gate::denies('payment_out_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parties = PartyDetail::pluck('party_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = BankAccount::pluck('account_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $paymentOut->load('parties', 'payment_type', 'created_by');

        return view('admin.paymentOuts.edit', compact('parties', 'paymentOut', 'payment_types'));
    }

    public function update(UpdatePaymentOutRequest $request, PaymentOut $paymentOut)
    {
        $paymentOut->update($request->all());

        if ($request->input('attechment', false)) {
            if (! $paymentOut->attechment || $request->input('attechment') !== $paymentOut->attechment->file_name) {
                if ($paymentOut->attechment) {
                    $paymentOut->attechment->delete();
                }
                $paymentOut->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
            }
        } elseif ($paymentOut->attechment) {
            $paymentOut->attechment->delete();
        }

        return redirect()->route('admin.payment-outs.index');
    }

    public function show(PaymentOut $paymentOut)
    {
        abort_if(Gate::denies('payment_out_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentOut->load('parties', 'payment_type', 'created_by');

        return view('admin.paymentOuts.show', compact('paymentOut'));
    }

    public function destroy(PaymentOut $paymentOut)
    {
        abort_if(Gate::denies('payment_out_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentOut->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentOutRequest $request)
    {
        $paymentOuts = PaymentOut::find(request('ids'));

        foreach ($paymentOuts as $paymentOut) {
            $paymentOut->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('payment_out_create') && Gate::denies('payment_out_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PaymentOut();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
