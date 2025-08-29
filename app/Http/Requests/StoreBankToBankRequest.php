<?php

namespace App\Http\Requests;

use App\Models\BankToBank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBankToBankRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_to_bank_create');
    }

    public function rules()
    {
        return [
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
