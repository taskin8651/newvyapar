<?php

namespace App\Http\Requests;

use App\Models\BankAccount;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBankAccountRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bank_account_edit');
    }

    public function rules()
    {
        return [
            'account_name' => [
                'string',
                'required',
            ],
            'opening_balance' => [
                'string',
                'required',
            ],
            'as_of_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'account_number' => [
                'string',
                'nullable',
            ],
            'ifsc_code' => [
                'string',
                'nullable',
            ],
            'bank_name' => [
                'string',
                'nullable',
            ],
            'account_holder_name' => [
                'string',
                'nullable',
            ],
            'upi' => [
                'string',
                'nullable',
            ],
        ];
    }
}
