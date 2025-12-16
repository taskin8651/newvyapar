@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.expense-categories.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Edit Expense Category Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.edit') }} {{ trans('cruds.expenseCategory.title_singular') }}
            </h2>

            <form method="POST" 
                  action="{{ route('admin.expense-categories.update', $expenseCategory->id) }}" 
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Expense Category --}}
                    <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                        <label for="expense_category" class="block font-semibold text-gray-700 mb-1 required">
                            {{ trans('cruds.expenseCategory.fields.expense_category') }}
                        </label>
                        <input type="text"
                               name="expense_category"
                               id="expense_category"
                               required
                               value="{{ old('expense_category', $expenseCategory->expense_category) }}"
                               class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                        @error('expense_category')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">
                            {{ trans('cruds.expenseCategory.fields.expense_category_helper') }}
                        </p>
                    </div>

                    {{-- Category Type --}}
                    <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                        <label for="category_type" class="block font-semibold text-gray-700 mb-1 required">
                            {{ trans('cruds.expenseCategory.fields.type') }}
                        </label>
                        <select name="category_type" id="category_type" required
                                class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                            <option value="" disabled>-- Select Category Type --</option>
                            @foreach(App\Models\ExpenseCategory::CATEGORY_TYPE_SELECT as $key => $label)
                                <option value="{{ $key }}" 
                                    {{ old('category_type', $expenseCategory->category_type) == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_type')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">
                            Select whether this category belongs to Asset / Liability / Sale / Purchase / Capital.
                        </p>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-6 flex items-center gap-3">
                    <button type="submit"
                            class="px-6 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                        {{ trans('global.save') }}
                    </button>

                    <a href="{{ route('admin.expense-categories.index') }}" 
                       class="px-6 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow hover:bg-gray-600 transition">
                        {{ trans('global.back') }}
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
