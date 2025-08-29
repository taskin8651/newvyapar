<?php

namespace App\Http\Requests;

use App\Models\CurrentStock;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCurrentStockRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('current_stock_edit');
    }

    public function rules()
    {
        return [
            'items.*' => [
                'integer',
            ],
            'items' => [
                'array',
            ],
            'qty' => [
                'string',
                'nullable',
            ],
            'type' => [
                'string',
                'nullable',
            ],
        ];
    }
}
