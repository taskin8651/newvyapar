@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.ledgers.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Edit Ledger Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600 flex items-center gap-2">
                <i class="fa fa-book"></i>
                {{ trans('global.edit') }} Ledger
            </h2>

            <form method="POST" action="{{ route('admin.ledgers.update', $ledger->id) }}">
                @method('PUT')
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Ledger Name --}}
                    <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                        <label for="ledger_name" class="block font-semibold text-gray-700 mb-1 required">
                            Ledger Name
                        </label>
                        <input type="text"
                               name="ledger_name"
                               id="ledger_name"
                               value="{{ old('ledger_name', $ledger->ledger_name) }}"
                               required
                               class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                        @error('ledger_name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span class="text-gray-500 text-xs">
                            Enter ledger name (Cash, Bank, Supplier etc.)
                        </span>
                    </div>

                    {{-- Opening Balance --}}
                    <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                        <label for="opening_balance" class="block font-semibold text-gray-700 mb-1 required">
                            Opening Balance
                        </label>
                        <input type="number"
                               step="0.01"
                               name="opening_balance"
                               id="opening_balance"
                               value="{{ old('opening_balance', $ledger->opening_balance) }}"
                               required
                               class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                        @error('opening_balance')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span class="text-gray-500 text-xs">
                            Ledger opening balance
                        </span>
                    </div>

                    {{-- Expense Category --}}
                    <div class="bg-yellow-50 p-4 rounded-lg shadow-inner md:col-span-2">
                        <label for="expense_category_id" class="block font-semibold text-gray-700 mb-1 required">
                            Expense Category
                        </label>
                        <select name="expense_category_id"
                                id="expense_category_id"
                                required
                                class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                            <option value="" disabled>-- Select Category --</option>
                            @foreach($expenseCategories as $id => $name)
                                <option value="{{ $id }}"
                                    {{ old('expense_category_id', $ledger->expense_category_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('expense_category_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span class="text-gray-500 text-xs">
                            Select expense category for this ledger
                        </span>
                    </div>

                </div>

                <!-- Save Button -->
                <div class="mt-6">
                    <button type="submit"
                            class="px-6 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                        <i class="fa fa-save mr-1"></i> {{ trans('global.save') }}
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection
