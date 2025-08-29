@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.purchaseOrder.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.purchase-orders.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.select_customer') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->select_customer->party_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.billing_name') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->billing_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.e_way_bill_no') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->e_way_bill_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.billing_address') }}
                                    </th>
                                    <td>
                                        {!! $purchaseOrder->billing_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.shipping_address') }}
                                    </th>
                                    <td>
                                        {!! $purchaseOrder->shipping_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.po_no') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->po_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.po_date') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->po_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.item') }}
                                    </th>
                                    <td>
                                        @foreach($purchaseOrder->items as $key => $item)
                                            <span class="label label-info">{{ $item->item_name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.qty') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->qty }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $purchaseOrder->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.image') }}
                                    </th>
                                    <td>
                                        @if($purchaseOrder->image)
                                            <a href="{{ $purchaseOrder->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $purchaseOrder->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.document') }}
                                    </th>
                                    <td>
                                        @if($purchaseOrder->document)
                                            <a href="{{ $purchaseOrder->document->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.payment_type') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->payment_type->account_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.reference_no') }}
                                    </th>
                                    <td>
                                        {{ $purchaseOrder->reference_no }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.purchase-orders.index') }}">
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