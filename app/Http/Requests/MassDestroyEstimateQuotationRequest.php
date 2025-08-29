<?php

namespace App\Http\Requests;

use App\Models\EstimateQuotation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEstimateQuotationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('estimate_quotation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:estimate_quotations,id',
        ];
    }
}
