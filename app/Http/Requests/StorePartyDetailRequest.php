<?php

namespace App\Http\Requests;

use App\Models\PartyDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePartyDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('party_detail_create');
    }

    public function rules()
    {
        return [
            'party_name' => [
                'string',
                'required',
            ],
            'gstin' => [
                'string',
                'min:15',
                'max:15',
                'required',
                'unique:party_details',
            ],
            'phone_number' => [
                'string',
                'min:10',
                'max:10',
                'required',
                'unique:party_details',
            ],
            'pan_number' => [
                'string',
                'min:10',
                'max:10',
                'nullable',
            ],
            'place_of_supply' => [
                'string',
                'nullable',
            ],
            'pincode' => [
                'string',
                'min:6',
                'max:6',
                'required',
                'unique:party_details',
            ],
            'state' => [
                'string',
                'nullable',
            ],
            'city' => [
                'string',
                'nullable',
            ],
            'opening_balance' => [
                'required',
            ],
            'as_of_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'credit_limit' => [
                'required',
            ],
            'payment_terms' => [
                'string',
                'nullable',
            ],
            'ifsc_code' => [
                'string',
                'nullable',
            ],
            'account_number' => [
                'string',
                'nullable',
            ],
            'bank_name' => [
                'string',
                'nullable',
            ],
            'branch' => [
                'string',
                'nullable',
            ],
        ];
    }
}
