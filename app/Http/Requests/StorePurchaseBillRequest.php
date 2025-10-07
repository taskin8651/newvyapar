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

            // ✅ items array must exist, but individual fields are flexible
            'items' => [
                'required',
                'array',
                'min:1',
            ],

            // ✅ Allow either product or service (so ID can be nullable)
            'items.*.id' => [
                'nullable', // changed from required
                'integer',
            ],

            // ✅ Qty can be nullable for service
            'items.*.qty' => [
                'nullable', // changed from required
                'numeric',
                'min:0',
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

    protected function prepareForValidation()
    {
        // Filter out empty rows (optional)
        if ($this->has('items')) {
            $this->merge([
                'items' => collect($this->items)
                    ->filter(function ($item) {
                        return !empty($item['id']) || !empty($item['description']);
                    })
                    ->values()
                    ->toArray(),
            ]);
        }
    }
}
