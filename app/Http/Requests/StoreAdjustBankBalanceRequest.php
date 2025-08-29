<?php

namespace App\Http\Requests;

use App\Models\AdjustBankBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAdjustBankBalanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('adjust_bank_balance_create');
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
