@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-edit"></i>
                {{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}
            </h2>

            <a href="{{ route('admin.categories.index') }}"
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST"
              action="{{ route('admin.categories.update', $category->id) }}"
              enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Category Name --}}
                <div class="md:col-span-2 bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.category.fields.name') }}
                        <span class="text-red-500">*</span>
                    </label>

                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name', $category->name) }}"
                           required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <p class="text-xs text-gray-500 mt-1">
                        {{ trans('cruds.category.fields.name_helper') }}
                    </p>
                </div>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.categories.index') }}"
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
