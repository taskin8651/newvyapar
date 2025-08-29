@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.addItem.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.add-items.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $addItem->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.item_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\AddItem::ITEM_TYPE_SELECT[$addItem->item_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.item_name') }}
                                    </th>
                                    <td>
                                        {{ $addItem->item_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.item_hsn') }}
                                    </th>
                                    <td>
                                        {{ $addItem->item_hsn }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_unit') }}
                                    </th>
                                    <td>
                                        {{ $addItem->select_unit->base_unit ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_category') }}
                                    </th>
                                    <td>
                                        @foreach($addItem->select_categories as $key => $select_category)
                                            <span class="label label-info">{{ $select_category->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.item_code') }}
                                    </th>
                                    <td>
                                        {{ $addItem->item_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.sale_price') }}
                                    </th>
                                    <td>
                                        {{ $addItem->sale_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\AddItem::SELECT_TYPE_SELECT[$addItem->select_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.disc_on_sale_price') }}
                                    </th>
                                    <td>
                                        {{ $addItem->disc_on_sale_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.disc_type') }}
                                    </th>
                                    <td>
                                        {{ $addItem->disc_type }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.wholesale_price') }}
                                    </th>
                                    <td>
                                        {{ $addItem->wholesale_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_type_wholesale') }}
                                    </th>
                                    <td>
                                        {{ App\Models\AddItem::SELECT_TYPE_WHOLESALE_SELECT[$addItem->select_type_wholesale] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.minimum_wholesale_qty') }}
                                    </th>
                                    <td>
                                        {{ $addItem->minimum_wholesale_qty }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.purchase_price') }}
                                    </th>
                                    <td>
                                        {{ $addItem->purchase_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_purchase_type') }}
                                    </th>
                                    <td>
                                        {{ App\Models\AddItem::SELECT_PURCHASE_TYPE_SELECT[$addItem->select_purchase_type] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_tax') }}
                                    </th>
                                    <td>
                                        {{ $addItem->select_tax->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.add-items.index') }}">
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