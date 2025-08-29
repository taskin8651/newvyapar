@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.bankAccount.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.bank-accounts.update", [$bankAccount->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('account_name') ? 'has-error' : '' }}">
                            <label class="required" for="account_name">{{ trans('cruds.bankAccount.fields.account_name') }}</label>
                            <input class="form-control" type="text" name="account_name" id="account_name" value="{{ old('account_name', $bankAccount->account_name) }}" required>
                            @if($errors->has('account_name'))
                                <span class="help-block" role="alert">{{ $errors->first('account_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.account_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('opening_balance') ? 'has-error' : '' }}">
                            <label class="required" for="opening_balance">{{ trans('cruds.bankAccount.fields.opening_balance') }}</label>
                            <input class="form-control" type="text" name="opening_balance" id="opening_balance" value="{{ old('opening_balance', $bankAccount->opening_balance) }}" required>
                            @if($errors->has('opening_balance'))
                                <span class="help-block" role="alert">{{ $errors->first('opening_balance') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.opening_balance_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('as_of_date') ? 'has-error' : '' }}">
                            <label for="as_of_date">{{ trans('cruds.bankAccount.fields.as_of_date') }}</label>
                            <input class="form-control date" type="text" name="as_of_date" id="as_of_date" value="{{ old('as_of_date', $bankAccount->as_of_date) }}">
                            @if($errors->has('as_of_date'))
                                <span class="help-block" role="alert">{{ $errors->first('as_of_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.as_of_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('account_number') ? 'has-error' : '' }}">
                            <label for="account_number">{{ trans('cruds.bankAccount.fields.account_number') }}</label>
                            <input class="form-control" type="text" name="account_number" id="account_number" value="{{ old('account_number', $bankAccount->account_number) }}">
                            @if($errors->has('account_number'))
                                <span class="help-block" role="alert">{{ $errors->first('account_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.account_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ifsc_code') ? 'has-error' : '' }}">
                            <label for="ifsc_code">{{ trans('cruds.bankAccount.fields.ifsc_code') }}</label>
                            <input class="form-control" type="text" name="ifsc_code" id="ifsc_code" value="{{ old('ifsc_code', $bankAccount->ifsc_code) }}">
                            @if($errors->has('ifsc_code'))
                                <span class="help-block" role="alert">{{ $errors->first('ifsc_code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.ifsc_code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('bank_name') ? 'has-error' : '' }}">
                            <label for="bank_name">{{ trans('cruds.bankAccount.fields.bank_name') }}</label>
                            <input class="form-control" type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $bankAccount->bank_name) }}">
                            @if($errors->has('bank_name'))
                                <span class="help-block" role="alert">{{ $errors->first('bank_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.bank_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('account_holder_name') ? 'has-error' : '' }}">
                            <label for="account_holder_name">{{ trans('cruds.bankAccount.fields.account_holder_name') }}</label>
                            <input class="form-control" type="text" name="account_holder_name" id="account_holder_name" value="{{ old('account_holder_name', $bankAccount->account_holder_name) }}">
                            @if($errors->has('account_holder_name'))
                                <span class="help-block" role="alert">{{ $errors->first('account_holder_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.account_holder_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('upi') ? 'has-error' : '' }}">
                            <label for="upi">{{ trans('cruds.bankAccount.fields.upi') }}</label>
                            <input class="form-control" type="text" name="upi" id="upi" value="{{ old('upi', $bankAccount->upi) }}">
                            @if($errors->has('upi'))
                                <span class="help-block" role="alert">{{ $errors->first('upi') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.upi_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('print_upi_qr') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="print_upi_qr" value="0">
                                <input type="checkbox" name="print_upi_qr" id="print_upi_qr" value="1" {{ $bankAccount->print_upi_qr || old('print_upi_qr', 0) === 1 ? 'checked' : '' }}>
                                <label for="print_upi_qr" style="font-weight: 400">{{ trans('cruds.bankAccount.fields.print_upi_qr') }}</label>
                            </div>
                            @if($errors->has('print_upi_qr'))
                                <span class="help-block" role="alert">{{ $errors->first('print_upi_qr') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.print_upi_qr_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('print_bank_details') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="print_bank_details" value="0">
                                <input type="checkbox" name="print_bank_details" id="print_bank_details" value="1" {{ $bankAccount->print_bank_details || old('print_bank_details', 0) === 1 ? 'checked' : '' }}>
                                <label for="print_bank_details" style="font-weight: 400">{{ trans('cruds.bankAccount.fields.print_bank_details') }}</label>
                            </div>
                            @if($errors->has('print_bank_details'))
                                <span class="help-block" role="alert">{{ $errors->first('print_bank_details') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.bankAccount.fields.print_bank_details_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection