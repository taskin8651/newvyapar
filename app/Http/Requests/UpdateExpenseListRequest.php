<?php

namespace App\Http\Requests;

use App\Models\ExpenseList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExpenseListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('expense_list_edit');
    }

    public function rules()
    {
        return [
            'entry_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'amount' => [
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
