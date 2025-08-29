@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-500 px-6 py-4 flex justify-between items-center">
            <h2 class="text-lg md:text-xl font-semibold text-white flex items-center space-x-2">
                <i class="fas fa-user-shield"></i>
                <span>{{ trans('global.show') }} {{ trans('cruds.role.title') }}</span>
            </h2>
            <a href="{{ route('admin.roles.index') }}" 
               class="px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 flex items-center space-x-2 transition">
                <i class="fas fa-arrow-left"></i>
                <span>{{ trans('global.back_to_list') }}</span>
            </a>
        </div>

        <!-- Details -->
        <div class="p-6 space-y-5">
            <div class="flex justify-between items-center border-b pb-3">
                <span class="text-gray-600 font-medium">{{ trans('cruds.role.fields.id') }}</span>
                <span class="text-gray-900 font-semibold">{{ $role->id }}</span>
            </div>

            <div class="flex justify-between items-center border-b pb-3">
                <span class="text-gray-600 font-medium">{{ trans('cruds.role.fields.title') }}</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-700">
                    {{ $role->title }}
                </span>
            </div>

            <div class="border-b pb-3">
                <span class="text-gray-600 font-medium block mb-2">{{ trans('cruds.role.fields.permissions') }}</span>
                <div class="flex flex-wrap gap-2">
                    @forelse($role->permissions as $permission)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                            <i class="fas fa-check-circle mr-1"></i> {{ $permission->title }}
                        </span>
                    @empty
                        <span class="text-gray-500 italic">{{ trans('global.no_permissions_assigned') }}</span>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-6 py-4 flex justify-end">
            <a href="{{ route('admin.roles.index') }}" 
               class="px-5 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 hover:shadow-lg flex items-center space-x-2 transition">
                <i class="fas fa-arrow-left"></i>
                <span>{{ trans('global.back_to_list') }}</span>
            </a>
        </div>

    </div>
</div>
@endsection
