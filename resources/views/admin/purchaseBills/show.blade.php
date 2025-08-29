@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.purchaseBill.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.purchase-bills.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.select_customer') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->select_customer->party_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.billing_name') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->billing_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.e_way_bill_no') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->e_way_bill_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.billing_address') }}
                                    </th>
                                    <td>
                                        {!! $purchaseBill->billing_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.shipping_address') }}
                                    </th>
                                    <td>
                                        {!! $purchaseBill->shipping_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.po_no') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->po_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.po_date') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->po_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.item') }}
                                    </th>
                                    <td>
                                        @foreach($purchaseBill->items as $key => $item)
                                            <span class="label label-info">{{ $item->item_name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.qty') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->qty }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $purchaseBill->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.image') }}
                                    </th>
                                    <td>
                                        @if($purchaseBill->image)
                                            <a href="{{ $purchaseBill->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $purchaseBill->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.document') }}
                                    </th>
                                    <td>
                                        @if($purchaseBill->document)
                                            <a href="{{ $purchaseBill->document->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.payment_type') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->payment_type->account_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.reference_no') }}
                                    </th>
                                    <td>
                                        {{ $purchaseBill->reference_no }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.purchase-bills.index') }}">
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