<?php

namespace App\Http\Requests;

use App\Models\CashToBank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCashToBankRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cash_to_bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cash_to_banks,id',
        ];
    }
}
