<?php

namespace App\Http\Requests;

use App\Models\AddBusiness;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAddBusinessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('add_business_edit');
    }

    public function rules()
    {
        return [
            'company_name' => [
                'string',
                'required',
            ],
            'legal_name' => [
                'string',
                'required',
            ],
            'logo_upload' => [
                'array',
            ],
        ];
    }
}
