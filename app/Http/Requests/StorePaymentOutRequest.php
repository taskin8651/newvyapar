<?php

namespace App\Http\Requests;

use App\Models\PaymentOut;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentOutRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_out_create');
    }

    public function rules()
    {
        return [
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'reference_no' => [
                'string',
                'nullable',
            ],
            'discount' => [
                'string',
                'nullable',
            ],
        ];
    }
}
