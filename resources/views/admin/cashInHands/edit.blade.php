@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="p-6 max-w-4xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.cash-in-hands.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Edit Form Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                Edit {{ trans('cruds.cashInHand.title') }}
            </h2>

            <form method="POST" action="{{ route('admin.cash-in-hands.update', $cashInHand->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Account Name -->
                    <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                        <label class="text-gray-500 font-semibold block mb-1">Account Name</label>
                        <input type="text" name="account_name"
                            value="{{ old('account_name', $cashInHand->account_name) }}"
                            class="w-full p-2 border rounded-lg" required>
                    </div>

                    <!-- Opening Balance -->
                    <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                        <label class="text-gray-500 font-semibold block mb-1">Opening Balance</label>
                        <input type="number" name="opening_balance"
                            value="{{ old('opening_balance', $cashInHand->opening_balance) }}"
                            class="w-full p-2 border rounded-lg" required>
                    </div>

                    <!-- As of Date -->
                    <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                        <label class="text-gray-500 font-semibold block mb-1">As of Date</label>
                        <input type="date" name="as_of_date"
                            value="{{ old('as_of_date', $cashInHand->as_of_date) }}"
                            class="w-full p-2 border rounded-lg">
                    </div>

                    <!-- Account Number -->
                    <div class="bg-red-50 p-4 rounded-lg shadow-inner">
                        <label class="text-gray-500 font-semibold block mb-1">Account Number</label>
                        <input type="text" name="account_number"
                            value="{{ old('account_number', $cashInHand->account_number) }}"
                            class="w-full p-2 border rounded-lg">
                    </div>

                    <!-- IFSC Code -->
                    <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                        <label class="text-gray-500 font-semibold block mb-1">IFSC Code</label>
                        <input type="text" name="ifsc_code"
                            value="{{ old('ifsc_code', $cashInHand->ifsc_code) }}"
                            class="w-full p-2 border rounded-lg">
                    </div>

                    <!-- Bank Name -->
                    <div class="bg-orange-50 p-4 rounded-lg shadow-inner">
                        <label class="text-gray-500 font-semibold block mb-1">Bank Name</label>
                        <input type="text" name="bank_name"
                            value="{{ old('bank_name', $cashInHand->bank_name) }}"
                            class="w-full p-2 border rounded-lg">
                    </div>

                    <!-- Account Holder Name -->
                    <div class="bg-teal-50 p-4 rounded-lg shadow-inner">
                        <label class="text-gray-500 font-semibold block mb-1">Account Holder Name</label>
                        <input type="text" name="account_holder_name"
                            value="{{ old('account_holder_name', $cashInHand->account_holder_name) }}"
                            class="w-full p-2 border rounded-lg">
                    </div>

                </div>

                <!-- Save Button -->
                <div class="mt-6">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
