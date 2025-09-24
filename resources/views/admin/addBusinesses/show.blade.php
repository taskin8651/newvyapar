@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.add-businesses.index') }}" 
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <!-- Business Details Card -->
    <div class="bg-white shadow-lg rounded-xl p-6 text-sm">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">
            {{ trans('global.show') }} {{ trans('cruds.addBusiness.title') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- ID -->
            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">
                    {{ trans('cruds.addBusiness.fields.id') }}
                </span>
                <span class="text-gray-800 font-medium">{{ $addBusiness->id }}</span>
            </div>

            <!-- Company Name -->
            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">
                    {{ trans('cruds.addBusiness.fields.company_name') }}
                </span>
                <span class="text-gray-800 font-medium">{{ $addBusiness->company_name }}</span>
            </div>

            <!-- Legal Name -->
            <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">
                    {{ trans('cruds.addBusiness.fields.legal_name') }}
                </span>
                <span class="text-gray-800 font-medium">{{ $addBusiness->legal_name }}</span>
            </div>

            <!-- Business Type -->
            <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">
                    {{ trans('cruds.addBusiness.fields.business_type') }}
                </span>
                <span class="text-gray-800 font-medium">
                    {{ App\Models\AddBusiness::BUSINESS_TYPE_SELECT[$addBusiness->business_type] ?? '' }}
                </span>
            </div>

            <!-- Industry Type -->
            <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">
                    {{ trans('cruds.addBusiness.fields.industry_type') }}
                </span>
                <span class="text-gray-800 font-medium">
                    {{ App\Models\AddBusiness::INDUSTRY_TYPE_SELECT[$addBusiness->industry_type] ?? '' }}
                </span>
            </div>

            <!-- Logo Upload -->
            <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">
                    {{ trans('cruds.addBusiness.fields.logo_upload') }}
                </span>
                <div class="mt-2 flex flex-wrap gap-3">
                    @foreach($addBusiness->logo_upload as $key => $media)
                        <a href="{{ $media->getUrl() }}" target="_blank" class="inline-block">
                            <img src="{{ $media->getUrl('thumb') }}" 
                                class=" shadow-sm max-h-40">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Back Button at Bottom -->
        <div class="mt-6">
            <a href="{{ route('admin.add-businesses.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>

</div>
@endsection