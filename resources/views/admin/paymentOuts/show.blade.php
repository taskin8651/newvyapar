@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.paymentOut.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.payment-outs.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $paymentOut->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.parties') }}
                                    </th>
                                    <td>
                                        {{ $paymentOut->parties->party_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.payment_type') }}
                                    </th>
                                    <td>
                                        {{ $paymentOut->payment_type->account_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.date') }}
                                    </th>
                                    <td>
                                        {{ $paymentOut->date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.reference_no') }}
                                    </th>
                                    <td>
                                        {{ $paymentOut->reference_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.amount') }}
                                    </th>
                                    <td>
                                        {{ $paymentOut->amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.discount') }}
                                    </th>
                                    <td>
                                        {{ $paymentOut->discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.total') }}
                                    </th>
                                    <td>
                                        {{ $paymentOut->total }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $paymentOut->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.attechment') }}
                                    </th>
                                    <td>
                                        @if($paymentOut->attechment)
                                            <a href="{{ $paymentOut->attechment->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $paymentOut->attechment->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.payment-outs.index') }}">
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