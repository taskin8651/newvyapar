<?php

namespace App\Http\Requests;

use App\Models\SaleInvoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySaleInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sale_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sale_invoices,id',
        ];
    }
}
