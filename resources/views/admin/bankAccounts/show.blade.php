@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.bankAccount.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.bank-accounts.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bankAccount->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.account_name') }}
                                    </th>
                                    <td>
                                        {{ $bankAccount->account_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.opening_balance') }}
                                    </th>
                                    <td>
                                        {{ $bankAccount->opening_balance }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.as_of_date') }}
                                    </th>
                                    <td>
                                        {{ $bankAccount->as_of_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.account_number') }}
                                    </th>
                                    <td>
                                        {{ $bankAccount->account_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.ifsc_code') }}
                                    </th>
                                    <td>
                                        {{ $bankAccount->ifsc_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.bank_name') }}
                                    </th>
                                    <td>
                                        {{ $bankAccount->bank_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.account_holder_name') }}
                                    </th>
                                    <td>
                                        {{ $bankAccount->account_holder_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.upi') }}
                                    </th>
                                    <td>
                                        {{ $bankAccount->upi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.print_upi_qr') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $bankAccount->print_upi_qr ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.print_bank_details') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $bankAccount->print_bank_details ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.bank-accounts.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection