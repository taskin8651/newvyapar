<?php

namespace App\Http\Requests;

use App\Models\MainCostCenter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMainCostCenterRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('main_cost_center_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:main_cost_centers,id',
        ];
    }
}
