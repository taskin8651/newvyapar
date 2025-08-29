<?php

namespace App\Http\Requests;

use App\Models\PurchaseOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePurchaseOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('purchase_order_create');
    }

    public function rules()
    {
        return [
            'select_customer_id' => [
                'required',
                'integer',
            ],
            'billing_name' => [
                'string',
                'nullable',
            ],
            'phone_number' => [
                'string',
                'nullable',
            ],
            'e_way_bill_no' => [
                'string',
                'nullable',
            ],
            'po_no' => [
                'string',
                'nullable',
            ],
            'po_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'items.*' => [
                'integer',
            ],
            'items' => [
                'array',
            ],
            'qty' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'reference_no' => [
                'string',
                'nullable',
            ],
        ];
    }
}
