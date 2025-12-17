<?php

namespace App\Http\Requests;

use App\Models\ExpenseList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExpenseListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('expense_list_create');
    }

    public function rules()
    {
    return [
        'entry_date' => ['required', 'date'],
        'category_id' => ['required', 'integer'],
        'amount' => ['required', 'numeric', 'min:0.01'],
        'description' => ['nullable', 'string'],
        'payment_id' => ['required', 'integer', 'exists:bank_accounts,id'], // ✅ THIS LINE
        'main_cost_center_id' => ['nullable', 'integer'],
        'sub_cost_center_id' => ['nullable', 'integer'],
        'tax_include' => ['required'],
        'notes' => ['nullable', 'string'],
    ];
    }
}
