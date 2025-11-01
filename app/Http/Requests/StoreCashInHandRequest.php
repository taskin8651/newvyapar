<?php

namespace App\Http\Requests;

use App\Models\CashInHand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCashInHandRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cash_in_hand_create');
    }

    public function rules()
    {
        return [
            'account_name' => [
                'required',
            ],
          
            'as_of_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
