@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.currentStock.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.current-stocks.update", [$currentStock->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('items') ? 'has-error' : '' }}">
                            <label for="items">{{ trans('cruds.currentStock.fields.item') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="items[]" id="items" multiple>
                                @foreach($items as $id => $item)
                                    <option value="{{ $id }}" {{ (in_array($id, old('items', [])) || $currentStock->items->contains($id)) ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('items'))
                                <span class="help-block" role="alert">{{ $errors->first('items') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.currentStock.fields.item_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('parties') ? 'has-error' : '' }}">
                            <label for="parties_id">{{ trans('cruds.currentStock.fields.parties') }}</label>
                            <select class="form-control select2" name="parties_id" id="parties_id">
                                @foreach($parties as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('parties_id') ? old('parties_id') : $currentStock->parties->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('parties'))
                                <span class="help-block" role="alert">{{ $errors->first('parties') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.currentStock.fields.parties_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('qty') ? 'has-error' : '' }}">
                            <label for="qty">{{ trans('cruds.currentStock.fields.qty') }}</label>
                            <input class="form-control" type="text" name="qty" id="qty" value="{{ old('qty', $currentStock->qty) }}">
                            @if($errors->has('qty'))
                                <span class="help-block" role="alert">{{ $errors->first('qty') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.currentStock.fields.qty_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label for="type">{{ trans('cruds.currentStock.fields.type') }}</label>
                            <input class="form-control" type="text" name="type" id="type" value="{{ old('type', $currentStock->type) }}">
                            @if($errors->has('type'))
                                <span class="help-block" role="alert">{{ $errors->first('type') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.currentStock.fields.type_helper') }}</span>
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