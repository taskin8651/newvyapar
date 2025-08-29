<?php

namespace App\Http\Requests;

use App\Models\AdjustBankBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAdjustBankBalanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('adjust_bank_balance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:adjust_bank_balances,id',
        ];
    }
}
