@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-plus-circle"></i>
                {{ trans('global.create') }} {{ trans('cruds.expenseList.title_singular') }}
            </h2>
            <a href="{{ route('admin.expense-lists.index') }}"
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.expense-lists.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Entry Date -->
<div>
    <label for="entry_date" class="block font-medium text-gray-700">
        {{ trans('cruds.expenseList.fields.entry_date') }}
    </label>
    <input type="date" name="entry_date" id="entry_date" 
        value="{{ old('entry_date') }}" required
        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
    @error('entry_date')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>


                    <!-- Ledger -->
                    <div>
                        <label for="category_id" class="block font-medium text-gray-700">
                            Select Ledgers
                        </label>
                        <select id="category_id" name="category_id" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select Ledger --</option>
                            @foreach($ledgers as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                <!-- Amount -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.expenseList.fields.amount') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" required
                        class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Description -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.expenseList.fields.description') }}
                    </label>
                    <input type="text" name="description" value="{{ old('description') }}"
                        class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                    <!-- Combined Payment / Cash In Hand -->
<div>
    <label for="account_id" class="block font-medium text-gray-700">
        Payment / Cash In Hand
    </label>
    <select id="account_id" name="account_id"
        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
        <option value="">-- Select Account --</option>
        @foreach($accounts as $account)
            <option value="{{ $account['id'] }}" {{ old('account_id') == $account['id'] ? 'selected' : '' }}>
                {{ $account['name'] }}
            </option>
        @endforeach
    </select>
    @error('account_id')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>


                    <!-- 🆕 Main Cost Center -->
                    <div>
                        <label for="main_cost_center_id" class="block font-medium text-gray-700">
                            Main Cost Center
                        </label>
                        <select id="main_cost_center_id" name="main_cost_center_id"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select Main Cost Center --</option>
                            @foreach($mainCostCenters as $id => $entry)
                                <option value="{{ $id }}" {{ old('main_cost_center_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}
                                </option>
                            @endforeach
                        </select>
                        @error('main_cost_center_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                <!-- Sub Cost Center -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Sub Cost Center
                    </label>
                    <select name="sub_cost_center_id"
                        class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Select --</option>
                        @foreach($subCostCenters as $id => $entry)
                            <option value="{{ $id }}" {{ old('sub_cost_center_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tax Include -->
                <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ trans('cruds.expenseList.fields.tax_include') }}
                    </label>
                    <div class="flex gap-6">
                        @foreach(App\Models\ExpenseList::TAX_INCLUDE_RADIO as $key => $label)
                            <label class="flex items-center gap-2 text-sm">
                                <input type="radio" name="tax_include" value="{{ $key }}"
                                    {{ old('tax_include','No') == $key ? 'checked' : '' }}>
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Notes -->
                <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.expenseList.fields.notes') }}
                    </label>
                    <textarea name="notes"
                        class="w-full rounded-lg border-gray-300 px-3 py-2 text-sm ckeditor focus:ring-indigo-500 focus:border-indigo-500">
                        {!! old('notes') !!}
                    </textarea>
                </div>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.expense-lists.index') }}"
                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow-sm hover:bg-gray-200 transition">
                    {{ trans('global.cancel') }}
                </a>
                <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow-md hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-1"></i> {{ trans('global.save') }}
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
