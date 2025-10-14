@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6">{{ trans('global.create') }} {{ trans('cruds.subCostCenter.title_singular') }}</h2>

            <form method="POST" action="{{ route('admin.sub-cost-centers.store') }}" enctype="multipart/form-data" class="flex flex-wrap -mx-3">
                @csrf

                <!-- Main Cost Center -->
                <div class="w-full md:w-1/3 px-3 mb-4">
                    <label for="main_cost_center_id" class="block font-medium text-gray-700">{{ trans('cruds.subCostCenter.fields.main_cost_center') }}</label>
                    <select id="main_cost_center_id" name="main_cost_center_id" required
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($main_cost_centers as $id => $entry)
                            <option value="{{ $id }}" {{ old('main_cost_center_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @error('main_cost_center') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Sub Cost Center Name -->
                <div class="w-full md:w-1/3 px-3 mb-4">
                    <label for="sub_cost_center_name" class="block font-medium text-gray-700">{{ trans('cruds.subCostCenter.fields.sub_cost_center_name') }}</label>
                    <input type="text" name="sub_cost_center_name" id="sub_cost_center_name" value="{{ old('sub_cost_center_name') }}"
                        required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('sub_cost_center_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Unique Code -->
                <div class="w-full md:w-1/3 px-3 mb-4">
                    <label for="unique_code" class="block font-medium text-gray-700">{{ trans('cruds.subCostCenter.fields.unique_code') }}</label>
                    <input type="text" name="unique_code" id="unique_code" value="{{ old('unique_code') }}"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('unique_code') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Details of Sub Cost Center -->
                <div class="w-full md:w-1/2 px-3 mb-4">
                    <label for="details_of_sub_cost_center" class="block font-medium text-gray-700">{{ trans('cruds.subCostCenter.fields.details_of_sub_cost_center') }}</label>
                    <textarea id="details_of_sub_cost_center" name="details_of_sub_cost_center"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm ckeditor focus:ring-indigo-500 focus:border-indigo-500">{!! old('details_of_sub_cost_center') !!}</textarea>
                    @error('details_of_sub_cost_center') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Responsible Manager -->
                <div class="w-full md:w-1/2 px-3 mb-4">
                    <label for="responsible_manager" class="block font-medium text-gray-700">{{ trans('cruds.subCostCenter.fields.responsible_manager') }}</label>
                    <input type="text" name="responsible_manager" id="responsible_manager" value="{{ old('responsible_manager') }}"
                        required class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('responsible_manager') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Budget Allocated -->
                <div class="w-full md:w-1/4 px-3 mb-4">
                    <label for="budget_allocated" class="block font-medium text-gray-700">{{ trans('cruds.subCostCenter.fields.budget_allocated') }}</label>
                    <input type="text" name="budget_allocated" id="budget_allocated" value="{{ old('budget_allocated') }}"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Actual Expense -->
                <div class="w-full md:w-1/4 px-3 mb-4">
                    <label for="actual_expense" class="block font-medium text-gray-700">{{ trans('cruds.subCostCenter.fields.actual_expense') }}</label>
                    <input type="text" name="actual_expense" id="actual_expense" value="{{ old('actual_expense') }}"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Remaining Budget -->
                <div class="w-full md:w-1/4 px-3 mb-4">
                    <label for="remaining_budget" class="block font-medium text-gray-700">Remaining Budget</label>
                    <input type="text" id="remaining_budget" readonly
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Start Date -->
                <div class="w-full md:w-1/4 px-3 mb-4">
                    <label for="start_date" class="block font-medium text-gray-700">{{ trans('cruds.subCostCenter.fields.start_date') }}</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('start_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Status -->
                <div class="w-full md:w-1/4 px-3 mb-4">
                    <label for="status" class="block font-medium text-gray-700">{{ trans('cruds.subCostCenter.fields.status') }}</label>
                    <select id="status" name="status" class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\SubCostCenter::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', 'Active') === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Submit -->
                <div class="w-full px-3">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                        {{ trans('global.save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function calculateRemaining() {
            let budget = parseFloat(document.getElementById('budget_allocated').value) || 0;
            let expense = parseFloat(document.getElementById('actual_expense').value) || 0;
            let remaining = budget - expense;
            document.getElementById('remaining_budget').value = remaining >= 0 ? remaining : 0;
        }

        document.getElementById('budget_allocated').addEventListener('input', calculateRemaining);
        document.getElementById('actual_expense').addEventListener('input', calculateRemaining);
        calculateRemaining();

        if (typeof flatpickr !== 'undefined') {
            flatpickr("#start_date", { dateFormat: "Y-m-d" });
        }

        document.querySelectorAll('.ckeditor').forEach(el => {
            ClassicEditor.create(el).catch(error => console.error(error));
        });
    });
</script>
@endsection
