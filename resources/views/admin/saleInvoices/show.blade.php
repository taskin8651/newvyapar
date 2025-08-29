@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.saleInvoice.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.sale-invoices.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $saleInvoice->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.select_customer') }}
                                    </th>
                                    <td>
                                        {{ $saleInvoice->select_customer->party_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.billing_name') }}
                                    </th>
                                    <td>
                                        {{ $saleInvoice->billing_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $saleInvoice->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.e_way_bill_no') }}
                                    </th>
                                    <td>
                                        {{ $saleInvoice->e_way_bill_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.billing_address') }}
                                    </th>
                                    <td>
                                        {!! $saleInvoice->billing_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.shipping_address') }}
                                    </th>
                                    <td>
                                        {!! $saleInvoice->shipping_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.po_no') }}
                                    </th>
                                    <td>
                                        {{ $saleInvoice->po_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.po_date') }}
                                    </th>
                                    <td>
                                        {{ $saleInvoice->po_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.item') }}
                                    </th>
                                    <td>
                                        @foreach($saleInvoice->items as $key => $item)
                                            <span class="label label-info">{{ $item->item_name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.qty') }}
                                    </th>
                                    <td>
                                        {{ $saleInvoice->qty }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $saleInvoice->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.image') }}
                                    </th>
                                    <td>
                                        @if($saleInvoice->image)
                                            <a href="{{ $saleInvoice->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $saleInvoice->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.saleInvoice.fields.document') }}
                                    </th>
                                    <td>
                                        @if($saleInvoice->document)
                                            <a href="{{ $saleInvoice->document->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.sale-invoices.index') }}">
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