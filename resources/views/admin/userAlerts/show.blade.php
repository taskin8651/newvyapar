@extends('layouts.admin')

@section('content')
<div class="content">

    <div class="p-6 max-w-4xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.user-alerts.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- User Alert Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.show') }} {{ trans('cruds.userAlert.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- ID -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.userAlert.fields.id') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $userAlert->id }}
                    </span>
                </div>

                <!-- Alert Text -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.userAlert.fields.alert_text') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $userAlert->alert_text }}
                    </span>
                </div>

                <!-- Alert Link -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.userAlert.fields.alert_link') }}
                    </span>
                    <span class="text-blue-600 font-medium break-all">
                        {{ $userAlert->alert_link }}
                    </span>
                </div>

                <!-- Users -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-2">
                        {{ trans('cruds.userAlert.fields.user') }}
                    </span>

                    <div class="flex flex-wrap gap-2">
                        @foreach($userAlert->users as $user)
                            <span class="px-3 py-1 bg-indigo-500 text-white text-xs rounded-full">
                                {{ $user->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Created At -->
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.userAlert.fields.created_at') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $userAlert->created_at }}
                    </span>
                </div>

            </div>

            <!-- Bottom Back Button -->
            <div class="mt-6">
                <a href="{{ route('admin.user-alerts.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
