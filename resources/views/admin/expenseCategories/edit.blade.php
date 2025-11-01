@extends('layouts.admin')
@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6 flex items-center gap-2 text-indigo-700">
                <i class="fas fa-edit"></i> 
                {{ trans('global.edit') }} {{ trans('cruds.expenseCategory.title_singular') }}
            </h2>

            <form method="POST" action="{{ route('admin.expense-categories.update', [$expenseCategory->id]) }}" enctype="multipart/form-data" class="space-y-6">
                @method('PUT')
                @csrf

                <!-- Expense Category -->
                <div>
                    <label for="expense_category" class="block font-medium text-gray-700">
                        {{ trans('cruds.expenseCategory.fields.expense_category') }}
                    </label>
                    <input type="text" 
                           name="expense_category" 
                           id="expense_category" 
                           value="{{ old('expense_category', $expenseCategory->expense_category) }}" 
                           required
                           class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('expense_category') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">
                        {{ trans('cruds.expenseCategory.fields.expense_category_helper') }}
                    </p>
                </div>

                <!-- Type -->
                <div>
                    <label for="type" class="block font-medium text-gray-700">
                        {{ trans('cruds.expenseCategory.fields.type') }}
                    </label>
                    <select name="type" id="type"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\ExpenseCategory::TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" 
                                    {{ old('type', $expenseCategory->type) === (string)$key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('type') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">
                        {{ trans('cruds.expenseCategory.fields.type_helper') }}
                    </p>
                </div>

                <!-- Category Type (Sale / Purchase / Capital) -->
                <div>
                    <label for="category_type" class="block font-medium text-gray-700">
                        Category Type <span class="text-red-500">*</span>
                    </label>
                    <select name="category_type" id="category_type" required
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled {{ old('category_type', null) === null ? 'selected' : '' }}>
                            -- Select Category Type --
                        </option>
                        @foreach(App\Models\ExpenseCategory::CATEGORY_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" 
                                    {{ old('category_type', $expenseCategory->category_type) === (string)$key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_type') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">
                        Select whether this category is for Sale, Purchase, or Capital.
                    </p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center gap-3">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                        <i class="fas fa-save mr-1"></i> {{ trans('global.save') }}
                    </button>
                    <a href="{{ route('admin.expense-categories.index') }}" 
                       class="px-6 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600 transition">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
