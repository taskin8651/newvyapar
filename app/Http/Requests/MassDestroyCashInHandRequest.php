<?php

namespace App\Http\Requests;

use App\Models\CashInHand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCashInHandRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cash_in_hand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cash_in_hands,id',
        ];
    }
}
