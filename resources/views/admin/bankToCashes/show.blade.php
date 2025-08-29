@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.bankToCash.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.bank-to-cashes.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToCash.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $bankToCash->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToCash.fields.from') }}
                                    </th>
                                    <td>
                                        {{ $bankToCash->from->account_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToCash.fields.to') }}
                                    </th>
                                    <td>
                                        {{ $bankToCash->to }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToCash.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $bankToCash->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToCash.fields.adjustment_date') }}
                                    </th>
                                    <td>
                                        {{ $bankToCash->adjustment_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToCash.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $bankToCash->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bankToCash.fields.attechment') }}
                                    </th>
                                    <td>
                                        @if($bankToCash->attechment)
                                            <a href="{{ $bankToCash->attechment->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $bankToCash->attechment->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.bank-to-cashes.index') }}">
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