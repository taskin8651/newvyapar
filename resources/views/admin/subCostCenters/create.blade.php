@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <div class="bg-white shadow-2xl rounded-2xl p-10 border border-gray-100">
        <h2 class="text-3xl font-bold text-indigo-700 mb-8 tracking-tight">
            {{ trans('global.create') }} {{ trans('cruds.subCostCenter.title_singular') }}
        </h2>

        <form method="POST" action="{{ route('admin.sub-cost-centers.store') }}" enctype="multipart/form-data" id="subCostCenterForm" class="space-y-10">
            @csrf

            {{-- Row 1 --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Main Cost Center --}}
                <div>
                    <label for="main_cost_center_id" class="block text-sm font-bold text-gray-700 mb-2">
                        {{ trans('cruds.subCostCenter.fields.main_cost_center') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="main_cost_center_id" id="main_cost_center_id" required
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-md px-4 py-2">
                        @foreach($main_cost_centers as $id => $entry)
                            <option value="{{ $id }}" {{ old('main_cost_center_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Sub Cost Center Name --}}
                <div>
                    <label for="sub_cost_center_name" class="block text-sm font-bold text-gray-700 mb-2">
                        {{ trans('cruds.subCostCenter.fields.sub_cost_center_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sub_cost_center_name" id="sub_cost_center_name"
                        value="{{ old('sub_cost_center_name', '') }}" required
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-md px-4 py-2">
                </div>

                {{-- Unique Code --}}
                <div>
                    <label for="unique_code" class="block text-sm font-bold text-gray-700 mb-2">
                        {{ trans('cruds.subCostCenter.fields.unique_code') }}
                    </label>
                    <input type="text" name="unique_code" id="unique_code"
                        value="{{ old('unique_code', '') }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-md px-4 py-2">
                </div>
            </div>

            {{-- Row 2 (Manager + Budget + Expense) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Responsible Manager --}}
                <div>
                    <label for="responsible_manager" class="block text-sm font-bold text-gray-700 mb-2">
                        {{ trans('cruds.subCostCenter.fields.responsible_manager') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="responsible_manager" id="responsible_manager"
                        value="{{ old('responsible_manager', '') }}" required
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-md px-4 py-2">
                </div>

                {{-- Budget Allocated --}}
                <div>
                    <label for="budget_allocated" class="block text-sm font-bold text-gray-700 mb-2">
                        {{ trans('cruds.subCostCenter.fields.budget_allocated') }}
                    </label>
                    <input type="number" name="budget_allocated" id="budget_allocated"
                        value="{{ old('budget_allocated', '') }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-md px-4 py-2">
                </div>

                {{-- Actual Expense --}}
                <div>
                    <label for="actual_expense" class="block text-sm font-bold text-gray-700 mb-2">
                        {{ trans('cruds.subCostCenter.fields.actual_expense') }}
                    </label>
                    <input type="number" name="actual_expense" id="actual_expense"
                        value="{{ old('actual_expense', '') }}"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-md px-4 py-2">
                </div>
            </div>

            {{-- Row 3 (Remaining Budget + Start Date + Status) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Remaining Budget --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        Remaining Budget
                    </label>
                    <input type="text" id="remaining_budget" readonly
                        class="w-full bg-gray-100 rounded-xl border-gray-300 shadow-inner px-4 py-2">
                </div>

                {{-- Start Date --}}
                <div>
                    <label for="start_date" class="block text-sm font-bold text-gray-700 mb-2">
                        {{ trans('cruds.subCostCenter.fields.start_date') }}
                    </label>
                    <input type="text" name="start_date" id="start_date"
                        value="{{ old('start_date') }}"
                        class="date w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-md px-4 py-2">
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-bold text-gray-700 mb-2">
                        {{ trans('cruds.subCostCenter.fields.status') }}
                    </label>
                    <select name="status" id="status"
                        class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-md px-4 py-2">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\SubCostCenter::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', 'Active') === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Details (Full width) --}}
            <div>
                <label for="details_of_sub_cost_center" class="block text-sm font-bold text-gray-700 mb-2">
                    {{ trans('cruds.subCostCenter.fields.details_of_sub_cost_center') }}
                </label>
                <textarea name="details_of_sub_cost_center" id="details_of_sub_cost_center" rows="5"
                    class="ckeditor w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-md px-4 py-2">{{ old('details_of_sub_cost_center') }}</textarea>
            </div>

            {{-- Submit --}}
            <div class="pt-6 flex justify-end">
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg transition transform hover:scale-105">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        // Budget calculation
        function calculateRemaining() {
            let budget = parseFloat($('#budget_allocated').val()) || 0;
            let expense = parseFloat($('#actual_expense').val()) || 0;
            let remaining = budget - expense;
            $('#remaining_budget').val(remaining >= 0 ? remaining : 0);
        }
        $('#budget_allocated, #actual_expense').on('input', calculateRemaining);
        calculateRemaining();

        // Date Picker (flatpickr)
        if (typeof flatpickr !== 'undefined') {
            flatpickr("#start_date", { dateFormat: "Y-m-d" });
        }

        // CKEditor
        var allEditors = document.querySelectorAll('.ckeditor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(allEditors[i]);
        }
    });
</script>
@endsection
