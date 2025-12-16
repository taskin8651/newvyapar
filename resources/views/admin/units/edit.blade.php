@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.units.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Edit Unit Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.edit') }} {{ trans('cruds.unit.title_singular') }}
            </h2>

            <form method="POST"
                  action="{{ route('admin.units.update', $unit->id) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Base Unit --}}
                    <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                        <label for="base_unit" class="block font-semibold mb-1 required">
                            {{ trans('cruds.unit.fields.base_unit') }}
                        </label>

                        <input type="text"
                               name="base_unit"
                               id="base_unit"
                               value="{{ old('base_unit', $unit->base_unit) }}"
                               required
                               class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">

                        @error('base_unit')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror

                        <p class="text-xs text-gray-500 mt-1">
                            {{ trans('cruds.unit.fields.base_unit_helper') }}
                        </p>
                    </div>

                    {{-- Secondary Unit --}}
                    <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                        <label for="secondary_unit" class="block font-semibold mb-1 required">
                            {{ trans('cruds.unit.fields.secondary_unit') }}
                        </label>

                        <input type="text"
                               name="secondary_unit"
                               id="secondary_unit"
                               value="{{ old('secondary_unit', $unit->secondary_unit) }}"
                               required
                               class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">

                        @error('secondary_unit')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror

                        <p class="text-xs text-gray-500 mt-1">
                            {{ trans('cruds.unit.fields.secondary_unit_helper') }}
                        </p>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-6 flex gap-3">
                    <button type="submit"
                            class="px-6 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">
                        {{ trans('global.save') }}
                    </button>

                    <a href="{{ route('admin.units.index') }}"
                       class="px-6 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
                        {{ trans('global.back') }}
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
