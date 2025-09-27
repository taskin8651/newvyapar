<?php

namespace App\Http\Requests;

use App\Models\PurchaseBill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePurchaseBillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('purchase_bill_create');
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
        'items' => [
            'required',
            'array',
            'min:1',
        ],
        'items.*.id' => [   // product/service id
            'required',
            // 'integer',
          
        ],
        'items.*.qty' => [  // per item qty
            'required',
            'integer',
            'min:1',
        ],
        'items.*.price' => [
            'nullable',
            'numeric',
        ],
        'reference_no' => [
            'string',
            'nullable',
        ],
    ];
}

}
