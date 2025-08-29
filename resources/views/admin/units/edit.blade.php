@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.unit.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.units.update", [$unit->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('base_unit') ? 'has-error' : '' }}">
                            <label class="required" for="base_unit">{{ trans('cruds.unit.fields.base_unit') }}</label>
                            <input class="form-control" type="text" name="base_unit" id="base_unit" value="{{ old('base_unit', $unit->base_unit) }}" required>
                            @if($errors->has('base_unit'))
                                <span class="help-block" role="alert">{{ $errors->first('base_unit') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.unit.fields.base_unit_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('secondary_unit') ? 'has-error' : '' }}">
                            <label class="required" for="secondary_unit">{{ trans('cruds.unit.fields.secondary_unit') }}</label>
                            <input class="form-control" type="text" name="secondary_unit" id="secondary_unit" value="{{ old('secondary_unit', $unit->secondary_unit) }}" required>
                            @if($errors->has('secondary_unit'))
                                <span class="help-block" role="alert">{{ $errors->first('secondary_unit') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.unit.fields.secondary_unit_helper') }}</span>
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