@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.addItem.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.add-items.update", [$addItem->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('item_type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.addItem.fields.item_type') }}</label>
                            <select class="form-control" name="item_type" id="item_type">
                                <option value disabled {{ old('item_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AddItem::ITEM_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('item_type', $addItem->item_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('item_type'))
                                <span class="help-block" role="alert">{{ $errors->first('item_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.item_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('item_name') ? 'has-error' : '' }}">
                            <label class="required" for="item_name">{{ trans('cruds.addItem.fields.item_name') }}</label>
                            <input class="form-control" type="text" name="item_name" id="item_name" value="{{ old('item_name', $addItem->item_name) }}" required>
                            @if($errors->has('item_name'))
                                <span class="help-block" role="alert">{{ $errors->first('item_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.item_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('item_hsn') ? 'has-error' : '' }}">
                            <label class="required" for="item_hsn">{{ trans('cruds.addItem.fields.item_hsn') }}</label>
                            <input class="form-control" type="text" name="item_hsn" id="item_hsn" value="{{ old('item_hsn', $addItem->item_hsn) }}" required>
                            @if($errors->has('item_hsn'))
                                <span class="help-block" role="alert">{{ $errors->first('item_hsn') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.item_hsn_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('select_unit') ? 'has-error' : '' }}">
                            <label for="select_unit_id">{{ trans('cruds.addItem.fields.select_unit') }}</label>
                            <select class="form-control select2" name="select_unit_id" id="select_unit_id">
                                @foreach($select_units as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('select_unit_id') ? old('select_unit_id') : $addItem->select_unit->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('select_unit'))
                                <span class="help-block" role="alert">{{ $errors->first('select_unit') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.select_unit_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('select_categories') ? 'has-error' : '' }}">
                            <label for="select_categories">{{ trans('cruds.addItem.fields.select_category') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="select_categories[]" id="select_categories" multiple>
                                @foreach($select_categories as $id => $select_category)
                                    <option value="{{ $id }}" {{ (in_array($id, old('select_categories', [])) || $addItem->select_categories->contains($id)) ? 'selected' : '' }}>{{ $select_category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('select_categories'))
                                <span class="help-block" role="alert">{{ $errors->first('select_categories') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.select_category_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('item_code') ? 'has-error' : '' }}">
                            <label class="required" for="item_code">{{ trans('cruds.addItem.fields.item_code') }}</label>
                            <input class="form-control" type="text" name="item_code" id="item_code" value="{{ old('item_code', $addItem->item_code) }}" required>
                            @if($errors->has('item_code'))
                                <span class="help-block" role="alert">{{ $errors->first('item_code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.item_code_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('sale_price') ? 'has-error' : '' }}">
                            <label class="required" for="sale_price">{{ trans('cruds.addItem.fields.sale_price') }}</label>
                            <input class="form-control" type="text" name="sale_price" id="sale_price" value="{{ old('sale_price', $addItem->sale_price) }}" required>
                            @if($errors->has('sale_price'))
                                <span class="help-block" role="alert">{{ $errors->first('sale_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.sale_price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('select_type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.addItem.fields.select_type') }}</label>
                            <select class="form-control" name="select_type" id="select_type">
                                <option value disabled {{ old('select_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AddItem::SELECT_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('select_type', $addItem->select_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('select_type'))
                                <span class="help-block" role="alert">{{ $errors->first('select_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.select_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('disc_on_sale_price') ? 'has-error' : '' }}">
                            <label for="disc_on_sale_price">{{ trans('cruds.addItem.fields.disc_on_sale_price') }}</label>
                            <input class="form-control" type="text" name="disc_on_sale_price" id="disc_on_sale_price" value="{{ old('disc_on_sale_price', $addItem->disc_on_sale_price) }}">
                            @if($errors->has('disc_on_sale_price'))
                                <span class="help-block" role="alert">{{ $errors->first('disc_on_sale_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.disc_on_sale_price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('disc_type') ? 'has-error' : '' }}">
                            <label for="disc_type">{{ trans('cruds.addItem.fields.disc_type') }}</label>
                            <input class="form-control" type="text" name="disc_type" id="disc_type" value="{{ old('disc_type', $addItem->disc_type) }}">
                            @if($errors->has('disc_type'))
                                <span class="help-block" role="alert">{{ $errors->first('disc_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.disc_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('wholesale_price') ? 'has-error' : '' }}">
                            <label for="wholesale_price">{{ trans('cruds.addItem.fields.wholesale_price') }}</label>
                            <input class="form-control" type="text" name="wholesale_price" id="wholesale_price" value="{{ old('wholesale_price', $addItem->wholesale_price) }}">
                            @if($errors->has('wholesale_price'))
                                <span class="help-block" role="alert">{{ $errors->first('wholesale_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.wholesale_price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('select_type_wholesale') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.addItem.fields.select_type_wholesale') }}</label>
                            <select class="form-control" name="select_type_wholesale" id="select_type_wholesale">
                                <option value disabled {{ old('select_type_wholesale', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AddItem::SELECT_TYPE_WHOLESALE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('select_type_wholesale', $addItem->select_type_wholesale) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('select_type_wholesale'))
                                <span class="help-block" role="alert">{{ $errors->first('select_type_wholesale') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.select_type_wholesale_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('minimum_wholesale_qty') ? 'has-error' : '' }}">
                            <label for="minimum_wholesale_qty">{{ trans('cruds.addItem.fields.minimum_wholesale_qty') }}</label>
                            <input class="form-control" type="text" name="minimum_wholesale_qty" id="minimum_wholesale_qty" value="{{ old('minimum_wholesale_qty', $addItem->minimum_wholesale_qty) }}">
                            @if($errors->has('minimum_wholesale_qty'))
                                <span class="help-block" role="alert">{{ $errors->first('minimum_wholesale_qty') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.minimum_wholesale_qty_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('purchase_price') ? 'has-error' : '' }}">
                            <label for="purchase_price">{{ trans('cruds.addItem.fields.purchase_price') }}</label>
                            <input class="form-control" type="text" name="purchase_price" id="purchase_price" value="{{ old('purchase_price', $addItem->purchase_price) }}">
                            @if($errors->has('purchase_price'))
                                <span class="help-block" role="alert">{{ $errors->first('purchase_price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.purchase_price_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('select_purchase_type') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.addItem.fields.select_purchase_type') }}</label>
                            <select class="form-control" name="select_purchase_type" id="select_purchase_type">
                                <option value disabled {{ old('select_purchase_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\AddItem::SELECT_PURCHASE_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('select_purchase_type', $addItem->select_purchase_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('select_purchase_type'))
                                <span class="help-block" role="alert">{{ $errors->first('select_purchase_type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.select_purchase_type_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('select_tax') ? 'has-error' : '' }}">
                            <label for="select_tax_id">{{ trans('cruds.addItem.fields.select_tax') }}</label>
                            <select class="form-control select2" name="select_tax_id" id="select_tax_id">
                                @foreach($select_taxes as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('select_tax_id') ? old('select_tax_id') : $addItem->select_tax->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('select_tax'))
                                <span class="help-block" role="alert">{{ $errors->first('select_tax') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.addItem.fields.select_tax_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection