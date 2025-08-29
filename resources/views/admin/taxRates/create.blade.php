@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.taxRate.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.tax-rates.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.taxRate.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.taxRate.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('parcentage') ? 'has-error' : '' }}">
                            <label class="required" for="parcentage">{{ trans('cruds.taxRate.fields.parcentage') }}</label>
                            <input class="form-control" type="text" name="parcentage" id="parcentage" value="{{ old('parcentage', '') }}" required>
                            @if($errors->has('parcentage'))
                                <span class="help-block" role="alert">{{ $errors->first('parcentage') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.taxRate.fields.parcentage_helper') }}</span>
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