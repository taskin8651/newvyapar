@extends('layouts.admin')
@section('content')
<div class="content">

<div class="p-6 max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" 
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <!-- User Card -->
    <div class="bg-white shadow-lg rounded-xl p-6 text-sm">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">
            {{ trans('global.show') }} {{ trans('cruds.user.title') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- ID -->
            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.user.fields.id') }}</span>
                <span class="text-gray-800 font-medium">{{ $user->id }}</span>
            </div>

            <!-- Name -->
            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.user.fields.name') }}</span>
                <span class="text-gray-800 font-medium">{{ $user->name }}</span>
            </div>

            <!-- Email -->
            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.user.fields.email') }}</span>
                <span class="text-gray-800 font-medium">{{ $user->email }}</span>
            </div>

            <!-- Email Verified At -->
            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.user.fields.email_verified_at') }}</span>
                <span class="text-gray-800 font-medium">{{ $user->email_verified_at }}</span>
            </div>

            <!-- Companies -->
            <div class="bg-yellow-50 p-4 rounded-lg shadow-inner col-span-1 md:col-span-2">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.user.fields.select_companies') }}</span>
                <div class="flex flex-wrap gap-2">
                    @foreach($user->select_companies as $company)
                        <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded-full text-xs">{{ $company->company_name }}</span>
                    @endforeach
                </div>
            </div>

            <!-- Roles -->
            <div class="bg-purple-50 p-4 rounded-lg shadow-inner col-span-1 md:col-span-2">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.user.fields.roles') }}</span>
                <div class="flex flex-wrap gap-2">
                    @foreach($user->roles as $role)
                        <span class="px-2 py-1 bg-purple-200 text-purple-800 rounded-full text-xs">{{ $role->title }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Back Button at Bottom -->
        <div class="mt-6">
            <a href="{{ route('admin.users.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>

</div>
@endsection