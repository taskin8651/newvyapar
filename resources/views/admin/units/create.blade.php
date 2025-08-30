@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default shadow rounded-lg">
                <div class="panel-heading bg-indigo-600 text-white px-4 py-3 rounded-t-lg">
                    <h3 class="text-lg font-semibold">
                        {{ trans('global.create') }} {{ trans('cruds.unit.title_singular') }}
                    </h3>
                </div>

                <div class="panel-body bg-white p-6 rounded-b-lg">
                    <form method="POST" action="{{ route("admin.units.store") }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        {{-- Base Unit --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label for="base_unit" class="block text-sm font-medium text-gray-700">
                                    {{ trans('cruds.unit.fields.base_unit') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="base_unit" id="base_unit" value="{{ old('base_unit', 'none') }}" required
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @if($errors->has('base_unit'))
                                    <p class="text-red-600 text-xs mt-1">{{ $errors->first('base_unit') }}</p>
                                @endif
                                <span class="text-xs text-gray-500">{{ trans('cruds.unit.fields.base_unit_helper') }}</span>
                            </div>

                            {{-- Secondary Unit --}}
                            <div class="space-y-1">
                                <label for="secondary_unit" class="block text-sm font-medium text-gray-700">
                                    {{ trans('cruds.unit.fields.secondary_unit') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="secondary_unit" id="secondary_unit" value="{{ old('secondary_unit', 'none') }}" required
                                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                @if($errors->has('secondary_unit'))
                                    <p class="text-red-600 text-xs mt-1">{{ $errors->first('secondary_unit') }}</p>
                                @endif
                                <span class="text-xs text-gray-500">{{ trans('cruds.unit.fields.secondary_unit_helper') }}</span>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                    class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center gap-2">
                                <i class="fas fa-save"></i> {{ trans('global.save') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
