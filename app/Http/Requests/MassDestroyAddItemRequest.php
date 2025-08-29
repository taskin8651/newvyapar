<?php

namespace App\Http\Requests;

use App\Models\AddItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAddItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('add_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:add_items,id',
        ];
    }
}
