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
            
        ];
    }
}
