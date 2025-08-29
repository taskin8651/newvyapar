<?php

namespace App\Http\Requests;

use App\Models\TaxRate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxRateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tax_rate_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'parcentage' => [
                'string',
                'required',
            ],
        ];
    }
}
