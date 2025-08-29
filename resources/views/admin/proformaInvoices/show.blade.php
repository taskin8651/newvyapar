@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.proformaInvoice.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.proforma-invoices.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $proformaInvoice->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.select_customer') }}
                                    </th>
                                    <td>
                                        {{ $proformaInvoice->select_customer->party_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.billing_name') }}
                                    </th>
                                    <td>
                                        {{ $proformaInvoice->billing_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $proformaInvoice->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.e_way_bill_no') }}
                                    </th>
                                    <td>
                                        {{ $proformaInvoice->e_way_bill_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.billing_address') }}
                                    </th>
                                    <td>
                                        {!! $proformaInvoice->billing_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.shipping_address') }}
                                    </th>
                                    <td>
                                        {!! $proformaInvoice->shipping_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.po_no') }}
                                    </th>
                                    <td>
                                        {{ $proformaInvoice->po_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.po_date') }}
                                    </th>
                                    <td>
                                        {{ $proformaInvoice->po_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.item') }}
                                    </th>
                                    <td>
                                        @foreach($proformaInvoice->items as $key => $item)
                                            <span class="label label-info">{{ $item->item_name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.qty') }}
                                    </th>
                                    <td>
                                        {{ $proformaInvoice->qty }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $proformaInvoice->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.image') }}
                                    </th>
                                    <td>
                                        @if($proformaInvoice->image)
                                            <a href="{{ $proformaInvoice->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $proformaInvoice->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.document') }}
                                    </th>
                                    <td>
                                        @if($proformaInvoice->document)
                                            <a href="{{ $proformaInvoice->document->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.proforma-invoices.index') }}">
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