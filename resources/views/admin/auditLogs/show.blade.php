@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.audit-logs.index') }}" 
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <!-- Audit Log Card -->
    <div class="bg-white shadow-lg rounded-xl p-6 text-sm">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">
            {{ trans('global.show') }} {{ trans('cruds.auditLog.title') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- ID -->
            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.auditLog.fields.id') }}</span>
                <span class="text-gray-800 font-medium">{{ $auditLog->id }}</span>
            </div>

            <!-- Description -->
            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.auditLog.fields.description') }}</span>
                <span class="text-gray-800 font-medium">{{ $auditLog->description }}</span>
            </div>

            <!-- Subject ID -->
            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.auditLog.fields.subject_id') }}</span>
                <span class="text-gray-800 font-medium">{{ $auditLog->subject_id }}</span>
            </div>

            <!-- Subject Type -->
            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.auditLog.fields.subject_type') }}</span>
                <span class="text-gray-800 font-medium">{{ $auditLog->subject_type }}</span>
            </div>

            <!-- User ID -->
            <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.auditLog.fields.user_id') }}</span>
                <span class="text-gray-800 font-medium">{{ $auditLog->user_id }}</span>
            </div>

            <!-- Properties -->
            <div class="bg-yellow-50 p-4 rounded-lg shadow-inner overflow-auto max-h-40">
            <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.auditLog.fields.properties') }}</span>
            <pre class="text-gray-800 font-medium whitespace-pre-wrap break-words">{{ $auditLog->properties }}</pre>
            </div>

            <!-- Host -->
            <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.auditLog.fields.host') }}</span>
                <span class="text-gray-800 font-medium">{{ $auditLog->host }}</span>
            </div>

            <!-- Created At -->
            <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.auditLog.fields.created_at') }}</span>
                <span class="text-gray-800 font-medium">{{ $auditLog->created_at }}</span>
            </div>
     </div>

        <!-- Back Button at Bottom -->
        <div class="mt-6">
            <a href="{{ route('admin.audit-logs.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>

</div>
@endsection