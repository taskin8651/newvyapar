<?php

namespace App\Http\Requests;

use App\Models\CashToBank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCashToBankRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cash_to_bank_create');
    }

    public function rules()
    {
        return [
            'from' => [
                'string',
                'nullable',
            ],
            'amount' => [
                'required',
            ],
            'adjustment_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
