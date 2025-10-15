<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePaymentInRequest extends FormRequest
{
    public function authorize()
    {
        // Permission check
        return Gate::allows('payment_in_create');
    }

    public function rules()
    {
        return [
            'parties_id'       => ['required', 'exists:party_details,id'],
            'payment_type_id'  => ['required', 'exists:bank_accounts,id'],
            'date'             => ['required', 'date'],
            'reference_no'     => ['nullable', 'string'],
            'amount'           => ['required', 'numeric'],
            'discount'         => ['nullable', 'numeric'],
            'total'            => ['required', 'numeric'],
            'description'      => ['nullable', 'string'],
            'attechment'       => ['nullable', 'file'],
        ];
    }
}
