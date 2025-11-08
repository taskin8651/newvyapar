<?php

namespace App\Http\Requests;

use App\Models\PartyDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePartyDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('party_detail_edit');
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
