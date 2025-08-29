@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">
            {{ trans('global.edit') }} {{ trans('cruds.permission.title_singular') }}
        </h2>

        <form method="POST" action="{{ route('admin.permissions.update', $permission->id) }}" enctype="multipart/form-data" class="space-y-6">
            @method('PUT')
            @csrf

            {{-- Title Input --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ trans('cruds.permission.fields.title') }} <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $permission->title) }}" 
                    required
                    class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm 
                           focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition"
                >
                @if($errors->has('title'))
                    <p class="text-red-600 text-sm mt-1">{{ $errors->first('title') }}</p>
                @endif
                <p class="text-gray-500 text-xs mt-1">{{ trans('cruds.permission.fields.title_helper') }}</p>
            </div>

            {{-- Submit --}}
            <div>
                <button type="submit" 
                    class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 
                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
