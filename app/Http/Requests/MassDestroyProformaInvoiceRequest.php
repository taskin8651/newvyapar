<?php

namespace App\Http\Requests;

use App\Models\ProformaInvoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProformaInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('proforma_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:proforma_invoices,id',
        ];
    }
}
