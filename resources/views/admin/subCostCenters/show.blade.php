@extends('layouts.admin')
@section('content')
<div class="content">

   <div class="p-6 max-w-5xl mx-auto">

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.sub-cost-centers.index') }}" 
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <!-- Sub Cost Center Card -->
    <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

        <h2 class="text-2xl font-bold mb-6 text-blue-600">
            {{ trans('global.show') }} {{ trans('cruds.subCostCenter.title') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.id') }}</span>
                <span class="text-gray-800 font-medium">{{ $subCostCenter->id }}</span>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.main_cost_center') }}</span>
                <span class="text-gray-800 font-medium">{{ $subCostCenter->main_cost_center->cost_center_name ?? '' }}</span>
            </div>

            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.sub_cost_center_name') }}</span>
                <span class="text-gray-800 font-medium">{{ $subCostCenter->sub_cost_center_name }}</span>
            </div>

            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.unique_code') }}</span>
                <span class="text-gray-800 font-medium">{{ $subCostCenter->unique_code }}</span>
            </div>

          

            <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.responsible_manager') }}</span>
                <span class="text-gray-800 font-medium">{{ $subCostCenter->responsible_manager }}</span>
            </div>

            <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.budget_allocated') }}</span>
                <span class="text-gray-800 font-medium">{{ $subCostCenter->budget_allocated }}</span>
            </div>

            <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.actual_expense') }}</span>
                <span class="text-gray-800 font-medium">{{ $subCostCenter->actual_expense }}</span>
            </div>

            <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.start_date') }}</span>
                <span class="text-gray-800 font-medium">{{ $subCostCenter->start_date }}</span>
            </div>

            <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.status') }}</span>
                <span class="text-gray-800 font-medium">{{ App\Models\SubCostCenter::STATUS_SELECT[$subCostCenter->status] ?? '' }}</span>
            </div>
            
              <div class="bg-yellow-50 p-4 rounded-lg shadow-inner col-span-2">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.subCostCenter.fields.details_of_sub_cost_center') }}</span>
                <span class="text-gray-800 font-medium">{!! $subCostCenter->details_of_sub_cost_center !!}</span>
            </div>

        </div>

        <!-- Back Button at Bottom -->
        <div class="mt-6">
            <a href="{{ route('admin.sub-cost-centers.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

    </div>

</div>
</div>
@endsection