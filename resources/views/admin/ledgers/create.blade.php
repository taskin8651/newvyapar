@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6">
                {{ trans('global.create') }} Ledger
            </h2>

            <form method="POST" action="{{ route('admin.ledgers.store') }}" class="space-y-6">
                @csrf

                <!-- Ledger Name -->
                <div>
                    <label for="ledger_name" class="block font-medium text-gray-700">
                        Ledger Name <span class="text-red-600">*</span>
                    </label>
                    <input type="text" 
                           name="ledger_name" 
                           id="ledger_name" 
                           value="{{ old('ledger_name', '') }}" 
                           required
                           class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
                                  focus:ring-indigo-500 focus:border-indigo-500">
                    @error('ledger_name') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Enter the name of the ledger (e.g., Cash, Bank, Supplier).</p>
                </div>

                <!-- Opening Balance -->
                <div>
                    <label for="opening_balance" class="block font-medium text-gray-700">
                        Opening Balance <span class="text-red-600">*</span>
                    </label>
                    <input type="number" 
                           step="0.01" 
                           name="opening_balance" 
                           id="opening_balance" 
                           value="{{ old('opening_balance', 0) }}" 
                           required
                           class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
                                  focus:ring-indigo-500 focus:border-indigo-500">
                    @error('opening_balance') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Specify the opening balance for this ledger.</p>
                </div>

                <!-- Expense Category -->
                <div>
                    <label for="expense_category_id" class="block font-medium text-gray-700">
                        Expense Category <span class="text-red-600">*</span>
                    </label>
                    <select name="expense_category_id" id="expense_category_id" required
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
                               focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled {{ old('expense_category_id') ? '' : 'selected' }}>-- Select Category --</option>
                        @foreach($expenseCategories as $id => $name)
                            <option value="{{ $id }}" {{ old('expense_category_id') == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('expense_category_id') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Select which expense category this ledger belongs to.</p>
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button type="submit" 
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded 
                                   hover:bg-indigo-700 transition-all">
                        {{ trans('global.save') }}
                    </button>
                    <a href="{{ route('admin.ledgers.index') }}" 
                       class="ml-3 px-6 py-2 bg-gray-300 text-gray-800 font-semibold rounded 
                              hover:bg-gray-400 transition-all">
                        Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
