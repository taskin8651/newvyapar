@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-book"></i>
                {{ trans('global.create') }} Ledger
            </h2>
            <a href="{{ route('admin.ledgers.index') }}"
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.ledgers.store') }}">
            @csrf

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Ledger Name -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="ledger_name" class="block text-sm font-semibold text-gray-700 mb-1">
                        Ledger Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="ledger_name"
                           id="ledger_name"
                           value="{{ old('ledger_name') }}"
                           required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">
                    @error('ledger_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Opening Balance -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="opening_balance" class="block text-sm font-semibold text-gray-700 mb-1">
                        Opening Balance <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           step="0.01"
                           name="opening_balance"
                           id="opening_balance"
                           value="{{ old('opening_balance', 0) }}"
                           required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">
                    @error('opening_balance')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expense Category -->
                <div class="md:col-span-2 bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label for="expense_category_id" class="block text-sm font-semibold text-gray-700 mb-1">
                        Expense Category <span class="text-red-500">*</span>
                    </label>
                    <select name="expense_category_id"
                            id="expense_category_id"
                            required
                            class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm
                                   focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="" disabled {{ old('expense_category_id') ? '' : 'selected' }}>
                            -- Select Category --
                        </option>
                        @foreach($expenseCategories as $id => $name)
                            <option value="{{ $id }}" {{ old('expense_category_id') == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('expense_category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.ledgers.index') }}"
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
