<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePaymentOutRequest;
use App\Http\Requests\UpdatePaymentOutRequest;
use App\Http\Resources\Admin\PaymentOutResource;
use App\Models\PaymentOut;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentOutApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_out_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentOutResource(PaymentOut::with(['parties', 'payment_type', 'created_by'])->get());
    }

    public function store(StorePaymentOutRequest $request)
    {
        $paymentOut = PaymentOut::create($request->all());

        if ($request->input('attechment', false)) {
            $paymentOut->addMedia(storage_path('tmp/uploads/' . basename($request->input('attechment'))))->toMediaCollection('attechment');
        }

        return (new PaymentOutResource($paymentOut))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PaymentOut $paymentOut)
    {
        abort_if(Gate::denies('payment_out_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentOutResource($paymentOut->load(['parties', 'payment_type', 'created_by']));
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

        return (new PaymentOutResource($paymentOut))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PaymentOut $paymentOut)
    {
        abort_if(Gate::denies('payment_out_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentOut->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
