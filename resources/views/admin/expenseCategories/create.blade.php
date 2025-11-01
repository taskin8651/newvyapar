@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6">
                {{ trans('global.create') }} {{ trans('cruds.expenseCategory.title_singular') }}
            </h2>

            <form method="POST" action="{{ route('admin.expense-categories.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Expense Category -->
                <div>
                    <label for="expense_category" class="block font-medium text-gray-700">
                        {{ trans('cruds.expenseCategory.fields.expense_category') }}
                    </label>
                    <input type="text" 
                           name="expense_category" 
                           id="expense_category" 
                           value="{{ old('expense_category', '') }}" 
                           required
                           class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
                                  focus:ring-indigo-500 focus:border-indigo-500">
                    @error('expense_category') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">
                        {{ trans('cruds.expenseCategory.fields.expense_category_helper') }}
                    </p>
                </div>

                <!-- Existing Type -->
                <div>
                    <label for="type" class="block font-medium text-gray-700">
                        {{ trans('cruds.expenseCategory.fields.type') }}
                    </label>
                    <select name="type" id="type"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
                               focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled {{ old('type') ? '' : 'selected' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\ExpenseCategory::TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('type') === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('type') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">
                        {{ trans('cruds.expenseCategory.fields.type_helper') }}
                    </p>
                </div>

                <!-- 🆕 New Field: Category Type (Sale / Purchase / Capital) -->
                <div>
                    <label for="category_type" class="block font-medium text-gray-700">
                        Category Type <span class="text-danger">*</span>
                    </label>
                    <select name="category_type" id="category_type" required
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
                               focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled {{ old('category_type') ? '' : 'selected' }}>-- Select Category Type --</option>
                        <option value="sale" {{ old('category_type') === 'sale' ? 'selected' : '' }}>Sale</option>
                        <option value="purchase" {{ old('category_type') === 'purchase' ? 'selected' : '' }}>Purchase</option>
                        <option value="capital" {{ old('category_type') === 'capital' ? 'selected' : '' }}>Capital</option>
                    </select>
                    @error('category_type') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Select the type of category — Sale, Purchase, or Capital.</p>
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button type="submit" 
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded 
                                   hover:bg-indigo-700 transition-all">
                        {{ trans('global.save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
