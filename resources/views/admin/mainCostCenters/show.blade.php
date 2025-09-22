@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.mainCostCenter.title') }}
                </div> --}}
             <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
    <!-- Header -->
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <h2 class="px-6 py-4 border-b border-gray-500">
            {{ trans('global.show') }} {{ trans('cruds.mainCostCenter.title') }}
        </h2>
    </div>

    <!-- Body -->
    <div class="p-2">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('admin.main-cost-centers.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg shadow-sm">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Info Grid -->
        <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.id') }}</dt>
                <dd class="mt-1 text-gray-900">{{ $mainCostCenter->id }}</dd>
            </div>

            <div class="bg-pink-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.cost_center_name') }}</dt>
                <dd class="mt-1 text-gray-900">{{ $mainCostCenter->cost_center_name }}</dd>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.unique_code') }}</dt>
                <dd class="mt-1 text-gray-900">{{ $mainCostCenter->unique_code }}</dd>
            </div>

           

            <div class="bg-pink-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.link_with_company') }}</dt>
                <dd class="mt-1 text-gray-900">{{ $mainCostCenter->link_with_company->company_name ?? '' }}</dd>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.responsible_manager') }}</dt>
                <dd class="mt-1 text-gray-900">{{ $mainCostCenter->responsible_manager->name ?? '' }}</dd>
            </div>

            <div class="bg-pink-50 p-4 rounded-xl shadow-sm hover:shadow-md transition ">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.location') }}</dt>
                <dd class="mt-1 text-gray-900">{!! $mainCostCenter->location !!}</dd>
            </div>
             <div class="bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition ">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.details_of_cost_center') }}</dt>
                <dd class="mt-1 text-gray-900">{!! $mainCostCenter->details_of_cost_center !!}</dd>
            </div>

            <div class="bg-pink-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.budget_amount') }}</dt>
                <dd class="mt-1 text-gray-900">{{ $mainCostCenter->budget_amount }}</dd>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.actual_amount') }}</dt>
                <dd class="mt-1 text-gray-900">{{ $mainCostCenter->actual_amount }}</dd>
            </div>

            <div class="bg-pink-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.start_date') }}</dt>
                <dd class="mt-1 text-gray-900">{{ $mainCostCenter->start_date }}</dd>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl shadow-sm hover:shadow-md transition">
                <dt class="font-semibold text-gray-600">{{ trans('cruds.mainCostCenter.fields.status') }}</dt>
                <dd class="mt-1 text-gray-900">{{ App\Models\MainCostCenter::STATUS_SELECT[$mainCostCenter->status] ?? '' }}</dd>
            </div>
        </dl>

        <!-- Back Button Again -->
        <div class="mt-8">
            <a href="{{ route('admin.main-cost-centers.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg shadow-sm">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>

            </div>

           

        </div>
    </div>
    
</div>
@endsection