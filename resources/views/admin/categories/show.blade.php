@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-4xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.categories.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Category Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">
            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.show') }} {{ trans('cruds.category.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.category.fields.id') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $category->id }}</span>
                </div>

                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.category.fields.name') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $category->name }}</span>
                </div>

            </div>

            <!-- Back Button at Bottom -->
            <div class="mt-6">
                <a href="{{ route('admin.categories.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>
</div>
@endsection