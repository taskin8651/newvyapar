<?php

namespace App\Http\Requests;

use App\Models\AddItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAddItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_item_edit');
    }

    public function rules()
    {
        return [
            'item_name' => [
                'string',
                'required',
            ],
            'item_hsn' => [
                'string',
                'required',
            ],
            'select_categories.*' => [
                'integer',
            ],
            'select_categories' => [
                'array',
            ],
            'item_code' => [
                'string',
                'required',
            ],
            'sale_price' => [
                'string',
                'required',
            ],
            'disc_on_sale_price' => [
                'string',
                'nullable',
            ],
            'disc_type' => [
                'string',
                'nullable',
            ],
            'wholesale_price' => [
                'string',
                'nullable',
            ],
            'minimum_wholesale_qty' => [
                'string',
                'nullable',
            ],
            'purchase_price' => [
                'string',
                'nullable',
            ],
        ];
    }
}
