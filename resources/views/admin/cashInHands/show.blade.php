@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.cashInHand.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.cash-in-hands.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashInHand.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $cashInHand->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashInHand.fields.adjustment') }}
                                    </th>
                                    <td>
                                        {{ App\Models\CashInHand::ADJUSTMENT_SELECT[$cashInHand->adjustment] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashInHand.fields.enter_amount') }}
                                    </th>
                                    <td>
                                        {{ $cashInHand->enter_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashInHand.fields.adjustment_date') }}
                                    </th>
                                    <td>
                                        {{ $cashInHand->adjustment_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cashInHand.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $cashInHand->description !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.cash-in-hands.index') }}">
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