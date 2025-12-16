@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-balance-scale"></i>
                {{ trans('global.create') }} {{ trans('cruds.unit.title_singular') }}
            </h2>

            <a href="{{ route('admin.units.index') }}"
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.units.store') }}">
            @csrf

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Base Unit --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="base_unit" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.unit.fields.base_unit') }} <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="base_unit"
                           id="base_unit"
                           value="{{ old('base_unit') }}"
                           required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">

                    @error('base_unit')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <p class="text-xs text-gray-500 mt-1">
                        {{ trans('cruds.unit.fields.base_unit_helper') }}
                    </p>
                </div>

                {{-- Secondary Unit --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="secondary_unit" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.unit.fields.secondary_unit') }} <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="secondary_unit"
                           id="secondary_unit"
                           value="{{ old('secondary_unit') }}"
                           required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">

                    @error('secondary_unit')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <p class="text-xs text-gray-500 mt-1">
                        {{ trans('cruds.unit.fields.secondary_unit_helper') }}
                    </p>
                </div>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.units.index') }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow-sm hover:bg-gray-200 transition">
                    {{ trans('global.cancel') }}
                </a>

                <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow-md hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-1"></i> {{ trans('global.save') }}
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
