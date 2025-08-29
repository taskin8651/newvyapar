@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.cashToBank.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.cash-to-banks.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $cashToBank->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.from') }}
                                    </th>
                                    <td>
                                        {{ $cashToBank->from }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.to') }}
                                    </th>
                                    <td>
                                        {{ $cashToBank->to->account_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $cashToBank->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.adjustment_date') }}
                                    </th>
                                    <td>
                                        {{ $cashToBank->adjustment_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $cashToBank->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.attechment') }}
                                    </th>
                                    <td>
                                        @if($cashToBank->attechment)
                                            <a href="{{ $cashToBank->attechment->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $cashToBank->attechment->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.cash-to-banks.index') }}">
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