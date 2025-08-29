<?php

namespace App\Http\Requests;

use App\Models\CashInHand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCashInHandRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cash_in_hand_edit');
    }

    public function rules()
    {
        return [
            'adjustment' => [
                'required',
            ],
            'enter_amount' => [
                'required',
            ],
            'adjustment_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
