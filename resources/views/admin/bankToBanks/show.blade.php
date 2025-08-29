@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.bankToBank.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.bank-to-banks.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bankToBank->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.from') }}
                                    </th>
                                    <td>
                                        {{ $bankToBank->from->account_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.to') }}
                                    </th>
                                    <td>
                                        {{ $bankToBank->to->account_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $bankToBank->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.adjustment_date') }}
                                    </th>
                                    <td>
                                        {{ $bankToBank->adjustment_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $bankToBank->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.attechment') }}
                                    </th>
                                    <td>
                                        @if($bankToBank->attechment)
                                            <a href="{{ $bankToBank->attechment->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $bankToBank->attechment->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.bank-to-banks.index') }}">
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