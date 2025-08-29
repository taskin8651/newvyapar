<?php

namespace App\Http\Requests;

use App\Models\PartyDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPartyDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('party_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:party_details,id',
        ];
    }
}
