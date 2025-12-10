@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-4xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.main-cost-centers.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Main Cost Center Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.show') }} {{ trans('cruds.mainCostCenter.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- ID -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.id') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $mainCostCenter->id }}
                    </span>
                </div>

                <!-- Cost Center Name -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.cost_center_name') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $mainCostCenter->cost_center_name }}
                    </span>
                </div>

                <!-- Unique Code -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.unique_code') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $mainCostCenter->unique_code }}
                    </span>
                </div>

                <!-- Company -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.link_with_company') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $mainCostCenter->link_with_company->company_name ?? '' }}
                    </span>
                </div>

                <!-- Manager -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.responsible_manager') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $mainCostCenter->responsible_manager->name ?? '' }}
                    </span>
                </div>

                <!-- Location -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.location') }}
                    </span>
                    <span class="text-gray-800 font-medium">{!! $mainCostCenter->location !!}</span>
                </div>

                <!-- Details -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.details_of_cost_center') }}
                    </span>
                    <span class="text-gray-800 font-medium">{!! $mainCostCenter->details_of_cost_center !!}</span>
                </div>

                <!-- Budget -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.budget_amount') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $mainCostCenter->budget_amount }}
                    </span>
                </div>

                <!-- Actual -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.actual_amount') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $mainCostCenter->actual_amount }}
                    </span>
                </div>

                <!-- Start Date -->
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.start_date') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $mainCostCenter->start_date }}
                    </span>
                </div>

                <!-- Status -->
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.mainCostCenter.fields.status') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ App\Models\MainCostCenter::STATUS_SELECT[$mainCostCenter->status] ?? '' }}
                    </span>
                </div>

            </div>

            <!-- Back Button (Bottom) -->
            <div class="mt-6">
                <a href="{{ route('admin.main-cost-centers.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
