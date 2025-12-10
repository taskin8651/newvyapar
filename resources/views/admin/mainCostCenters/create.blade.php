@extends('layouts.admin')
@section('content')
<div class="max-w-6xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-layer-group"></i>
                {{ trans('global.create') }} {{ trans('cruds.mainCostCenter.title_singular') }}
            </h2>

            <a href="{{ route('admin.main-cost-centers.index') }}" 
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.main-cost-centers.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Row 1 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Cost Center Name -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Cost Center Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="cost_center_name" id="cost_center_name"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('cost_center_name') }}">
                    @error('cost_center_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Unique Code -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Unique Code
                    </label>
                    <input type="text" name="unique_code" id="unique_code"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('unique_code') }}">
                    @error('unique_code')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                            class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm">
                        <option value="">Select Status</option>
                        @foreach(App\Models\MainCostCenter::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Row 2 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                <!-- Company -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Link With Company
                    </label>
                    <select name="link_with_company_id" id="link_with_company_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm">
                        <option value="">Select Company</option>
                        @foreach($link_with_companies as $id => $entry)
                            <option value="{{ $id }}" {{ old('link_with_company_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Manager -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Responsible Manager
                    </label>
                    <select name="responsible_manager_id" id="responsible_manager_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm">
                        <option value="">Select Manager</option>
                        @foreach($responsible_managers as $id => $entry)
                            <option value="{{ $id }}" {{ old('responsible_manager_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Budget -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Budget Amount
                    </label>
                    <input type="number" step="0.01" name="budget_amount"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('budget_amount') }}">
                </div>

            </div>

            <!-- Row 3 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                <!-- Actual Amount -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Actual Amount
                    </label>
                    <input type="number" step="0.01" name="actual_amount"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('actual_amount') }}">
                </div>

                <!-- Start Date -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Start Date
                    </label>
                    <input type="text" name="start_date"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm date"
                           value="{{ old('start_date') }}">
                </div>

                <div></div>
            </div>

            <!-- Textareas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                <!-- Details -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Details of Cost Center</label>
                    <textarea name="details_of_cost_center" class="ckeditor w-full rounded-lg border-gray-300 shadow-sm p-3 min-h-[120px]">
                        {!! old('details_of_cost_center') !!}
                    </textarea>
                </div>

                <!-- Location -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                    <textarea name="location" class="ckeditor w-full rounded-lg border-gray-300 shadow-sm p-3 min-h-[120px]">
                        {!! old('location') !!}
                    </textarea>
                </div>

            </div>

            <!-- Submit -->
            <div class="flex justify-end mt-8">
                <button type="submit" 
                    class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow-md hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
