<?php

namespace App\Http\Requests;

use App\Models\MainCostCenter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMainCostCenterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('main_cost_center_create');
    }

    public function rules()
    {
        return [
            'cost_center_name' => [
                'string',
                'required',
            ],
            'unique_code' => [
                'string',
                'nullable',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
