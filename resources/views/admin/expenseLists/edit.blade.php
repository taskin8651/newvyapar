@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.expense-lists.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Edit Expense List Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.edit') }} {{ trans('cruds.expenseList.title_singular') }}
            </h2>

            <form method="POST"
                  action="{{ route('admin.expense-lists.update', $expenseList->id) }}"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Entry Date --}}
                    <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                        <label class="block font-semibold mb-1 required">
                            {{ trans('cruds.expenseList.fields.entry_date') }}
                        </label>
                        <input type="text"
                               name="entry_date"
                               value="{{ old('entry_date', $expenseList->entry_date) }}"
                               required
                               class="w-full p-2 border rounded-md date focus:ring focus:ring-blue-200">
                        @error('entry_date')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                        <label class="block font-semibold mb-1">
                            {{ trans('cruds.expenseList.fields.category') }}
                        </label>
                        <select name="category_id"
                                class="w-full p-2 border rounded-md select2 focus:ring focus:ring-green-200">
                            @foreach($categories as $id => $entry)
                                <option value="{{ $id }}"
                                    {{ (old('category_id', $expenseList->category->id ?? '') == $id) ? 'selected' : '' }}>
                                    {{ $entry }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Amount --}}
                    <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                        <label class="block font-semibold mb-1 required">
                            {{ trans('cruds.expenseList.fields.amount') }}
                        </label>
                        <input type="number"
                               step="0.01"
                               name="amount"
                               value="{{ old('amount', $expenseList->amount) }}"
                               required
                               class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                    </div>

                    {{-- Payment --}}
                    <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                        <label class="block font-semibold mb-1">
                            {{ trans('cruds.expenseList.fields.payment') }}
                        </label>
                        <select name="payment_id"
                                class="w-full p-2 border rounded-md select2 focus:ring focus:ring-purple-200">
                            @foreach($payments as $id => $entry)
                                <option value="{{ $id }}"
                                    {{ (old('payment_id', $expenseList->payment->id ?? '') == $id) ? 'selected' : '' }}>
                                    {{ $entry }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Description --}}
                    <div class="bg-gray-50 p-4 rounded-lg shadow-inner md:col-span-2">
                        <label class="block font-semibold mb-1">
                            {{ trans('cruds.expenseList.fields.description') }}
                        </label>
                        <input type="text"
                               name="description"
                               value="{{ old('description', $expenseList->description) }}"
                               class="w-full p-2 border rounded-md">
                    </div>

                    {{-- Tax Include --}}
                    <div class="bg-red-50 p-4 rounded-lg shadow-inner">
                        <label class="block font-semibold mb-2">
                            {{ trans('cruds.expenseList.fields.tax_include') }}
                        </label>
                        @foreach(App\Models\ExpenseList::TAX_INCLUDE_RADIO as $key => $label)
                            <label class="flex items-center gap-2 mb-1">
                                <input type="radio"
                                       name="tax_include"
                                       value="{{ $key }}"
                                       {{ old('tax_include', $expenseList->tax_include) == $key ? 'checked' : '' }}>
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>

                    {{-- Notes --}}
                    <div class="bg-indigo-50 p-4 rounded-lg shadow-inner md:col-span-2">
                        <label class="block font-semibold mb-1">
                            {{ trans('cruds.expenseList.fields.notes') }}
                        </label>
                        <textarea name="notes"
                                  class="ckeditor w-full p-2 border rounded-md"
                                  rows="4">{!! old('notes', $expenseList->notes) !!}</textarea>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-6 flex gap-3">
                    <button type="submit"
                            class="px-6 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition">
                        {{ trans('global.save') }}
                    </button>

                    <a href="{{ route('admin.expense-lists.index') }}"
                       class="px-6 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">
                        {{ trans('global.back') }}
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
