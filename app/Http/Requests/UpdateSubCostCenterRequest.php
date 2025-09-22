<?php

namespace App\Http\Requests;

use App\Models\SubCostCenter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSubCostCenterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sub_cost_center_edit');
    }

    public function rules()
    {
        return [
            'main_cost_center_id' => [
                'required',
                'integer',
            ],
            'sub_cost_center_name' => [
                'string',
                'required',
            ],
            'unique_code' => [
                'string',
                'nullable',
            ],
            'responsible_manager' => [
                'string',
                'required',
            ],
            'budget_allocated' => [
                'string',
                'nullable',
            ],
            'actual_expense' => [
                'string',
                'nullable',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
