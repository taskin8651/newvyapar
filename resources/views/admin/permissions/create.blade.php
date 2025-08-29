@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800">
                {{ trans('global.create') }} {{ trans('cruds.permission.title_singular') }}
            </h2>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('admin.permissions.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Title Field --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ trans('cruds.permission.fields.title') }} <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title', '') }}" 
                        required
                        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror"
                    >
                    @error('title')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.permission.fields.title_helper') }}</p>
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button type="submit" 
                        class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
