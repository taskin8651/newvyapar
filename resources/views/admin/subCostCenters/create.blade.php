@extends('layouts.admin')
@section('content')
<div class="max-w-6xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-diagram-project"></i>
                {{ trans('global.create') }} {{ trans('cruds.subCostCenter.title_singular') }}
            </h2>

            <a href="{{ route('admin.sub-cost-centers.index') }}" 
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.sub-cost-centers.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Row 1 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Main Cost Center -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Main Cost Center <span class="text-red-500">*</span>
                    </label>
                    <select name="main_cost_center_id" 
                            class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm">
                        <option value="">Select</option>
                        @foreach($main_cost_centers as $id => $entry)
                            <option value="{{ $id }}" {{ old('main_cost_center_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sub Cost Center -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Sub Cost Center Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sub_cost_center_name"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('sub_cost_center_name') }}">
                </input>
                </div>

                <!-- Unique Code -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Unique Code
                    </label>
                    <input type="text" name="unique_code"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('unique_code') }}">
                </div>
            </div>

            <!-- Row 2 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                <!-- Details -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Details of Sub Cost Center
                    </label>
                    <textarea name="details_of_sub_cost_center"
                              class="ckeditor w-full rounded-lg border-gray-300 shadow-sm p-3 min-h-[120px]">
                        {!! old('details_of_sub_cost_center') !!}
                    </textarea>
                </div>

                <!-- Responsible Manager -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Responsible Manager <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="responsible_manager"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('responsible_manager') }}">
                </div>
            </div>

            <!-- Row 3 -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">

                <!-- Budget Allocated -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Budget Allocated
                    </label>
                    <input type="number" step="0.01" name="budget_allocated"
                           id="budget_allocated"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('budget_allocated') }}">
                </div>

                <!-- Actual Expense -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Actual Expense
                    </label>
                    <input type="number" step="0.01" name="actual_expense" id="actual_expense"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('actual_expense') }}">
                </div>

                <!-- Remaining Budget -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Remaining Budget
                    </label>
                    <input type="text" id="remaining_budget" readonly
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm bg-gray-100">
                </div>

                <!-- Start Date -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Start Date
                    </label>
                    <input type="date" name="start_date"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm"
                           value="{{ old('start_date') }}">
                </div>
            </div>

            <!-- Row 4 -->
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-6">

                <!-- Status -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Status
                    </label>
                    <select name="status"
                        class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm">
                        <option value="">Select Status</option>
                        @foreach(App\Models\SubCostCenter::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status','Active') == $key ? 'selected':'' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Empty for alignment -->
                <div></div>
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

        document.querySelectorAll('.ckeditor').forEach((el) => {
            ClassicEditor.create(el).catch(err => console.error(err));
        });

    });
</script>
@endsection
