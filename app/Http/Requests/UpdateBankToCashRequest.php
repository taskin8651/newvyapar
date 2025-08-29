<?php

namespace App\Http\Requests;

use App\Models\BankToCash;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankToCashRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_to_cash_edit');
    }

    public function rules()
    {
        return [
            'from_id' => [
                'required',
                'integer',
            ],
            'to' => [
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
