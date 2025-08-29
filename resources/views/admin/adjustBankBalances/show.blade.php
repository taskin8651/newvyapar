@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.adjustBankBalance.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.adjust-bank-balances.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustBankBalance.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $adjustBankBalance->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustBankBalance.fields.from') }}
                                    </th>
                                    <td>
                                        {{ $adjustBankBalance->from->account_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustBankBalance.fields.type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\AdjustBankBalance::TYPE_SELECT[$adjustBankBalance->type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustBankBalance.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $adjustBankBalance->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustBankBalance.fields.adjustment_date') }}
                                    </th>
                                    <td>
                                        {{ $adjustBankBalance->adjustment_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustBankBalance.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $adjustBankBalance->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.adjustBankBalance.fields.attechment') }}
                                    </th>
                                    <td>
                                        @if($adjustBankBalance->attechment)
                                            <a href="{{ $adjustBankBalance->attechment->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $adjustBankBalance->attechment->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.adjust-bank-balances.index') }}">
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