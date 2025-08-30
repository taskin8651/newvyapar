@extends('layouts.admin')
@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="bg-white shadow rounded-2xl p-8">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-layer-group text-indigo-600"></i>
                {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
            </h2>
            <a href="{{ route('admin.categories.index') }}" 
               class="text-sm text-indigo-600 hover:text-indigo-800">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ trans('cruds.category.fields.name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', '') }}" 
                       required
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @if($errors->has('name'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('name') }}</p>
                @endif
                <p class="mt-1 text-xs text-gray-500">{{ trans('cruds.category.fields.name_helper') }}</p>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t">
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
