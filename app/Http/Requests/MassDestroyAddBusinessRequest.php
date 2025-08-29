<?php

namespace App\Http\Requests;

use App\Models\AddBusiness;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAddBusinessRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('add_business_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:add_businesses,id',
        ];
    }
}
