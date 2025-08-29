@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.estimateQuotation.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.estimate-quotations.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $estimateQuotation->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.select_customer') }}
                                    </th>
                                    <td>
                                        {{ $estimateQuotation->select_customer->party_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.billing_name') }}
                                    </th>
                                    <td>
                                        {{ $estimateQuotation->billing_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.phone_number') }}
                                    </th>
                                    <td>
                                        {{ $estimateQuotation->phone_number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.e_way_bill_no') }}
                                    </th>
                                    <td>
                                        {{ $estimateQuotation->e_way_bill_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.billing_address') }}
                                    </th>
                                    <td>
                                        {!! $estimateQuotation->billing_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.shipping_address') }}
                                    </th>
                                    <td>
                                        {!! $estimateQuotation->shipping_address !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.po_no') }}
                                    </th>
                                    <td>
                                        {{ $estimateQuotation->po_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.po_date') }}
                                    </th>
                                    <td>
                                        {{ $estimateQuotation->po_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.item') }}
                                    </th>
                                    <td>
                                        @foreach($estimateQuotation->items as $key => $item)
                                            <span class="label label-info">{{ $item->item_name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.qty') }}
                                    </th>
                                    <td>
                                        {{ $estimateQuotation->qty }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $estimateQuotation->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.image') }}
                                    </th>
                                    <td>
                                        @if($estimateQuotation->image)
                                            <a href="{{ $estimateQuotation->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $estimateQuotation->image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.document') }}
                                    </th>
                                    <td>
                                        @if($estimateQuotation->document)
                                            <a href="{{ $estimateQuotation->document->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.estimate-quotations.index') }}">
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