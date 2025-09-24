@extends('layouts.admin')
@section('content')
<div class="content">

<div class="p-6 max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.bank-accounts.index') }}" 
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <!-- Edit Bank Account Card -->
    <div class="bg-white shadow-lg rounded-xl p-6 text-sm">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">
            {{ trans('global.edit') }} {{ trans('cruds.bankAccount.title_singular') }}
        </h2>

        <form method="POST" action="{{ route('admin.bank-accounts.update', [$bankAccount->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Account Name -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1 required" for="account_name">
                        {{ trans('cruds.bankAccount.fields.account_name') }}
                    </label>
                    <input type="text" name="account_name" id="account_name" value="{{ old('account_name', $bankAccount->account_name) }}" required
                           class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                    @error('account_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Opening Balance -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1 required" for="opening_balance">
                        {{ trans('cruds.bankAccount.fields.opening_balance') }}
                    </label>
                    <input type="text" name="opening_balance" id="opening_balance" value="{{ old('opening_balance', $bankAccount->opening_balance) }}" required
                           class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                    @error('opening_balance') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- As of Date -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="as_of_date">
                        {{ trans('cruds.bankAccount.fields.as_of_date') }}
                    </label>
                    <input type="text" name="as_of_date" id="as_of_date" value="{{ old('as_of_date', $bankAccount->as_of_date) }}" 
                           class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                    @error('as_of_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Account Number -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="account_number">
                        {{ trans('cruds.bankAccount.fields.account_number') }}
                    </label>
                    <input type="text" name="account_number" id="account_number" value="{{ old('account_number', $bankAccount->account_number) }}" 
                           class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                    @error('account_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- IFSC Code -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="ifsc_code">
                        {{ trans('cruds.bankAccount.fields.ifsc_code') }}
                    </label>
                    <input type="text" name="ifsc_code" id="ifsc_code" value="{{ old('ifsc_code', $bankAccount->ifsc_code) }}" 
                           class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                    @error('ifsc_code') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Bank Name -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="bank_name">
                        {{ trans('cruds.bankAccount.fields.bank_name') }}
                    </label>
                    <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $bankAccount->bank_name) }}" 
                           class="w-full p-2 border rounded-md focus:ring focus:ring-purple-200">
                    @error('bank_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Account Holder Name -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="account_holder_name">
                        {{ trans('cruds.bankAccount.fields.account_holder_name') }}
                    </label>
                    <input type="text" name="account_holder_name" id="account_holder_name" value="{{ old('account_holder_name', $bankAccount->account_holder_name) }}" 
                           class="w-full p-2 border rounded-md focus:ring focus:ring-purple-200">
                    @error('account_holder_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- UPI -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="upi">
                        {{ trans('cruds.bankAccount.fields.upi') }}
                    </label>
                    <input type="text" name="upi" id="upi" value="{{ old('upi', $bankAccount->upi) }}" 
                           class="w-full p-2 border rounded-md focus:ring focus:ring-pink-200">
                    @error('upi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Print UPI QR -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner flex items-center gap-2">
                    <input type="hidden" name="print_upi_qr" value="0">
                    <input type="checkbox" name="print_upi_qr" id="print_upi_qr" value="1" 
                           {{ $bankAccount->print_upi_qr || old('print_upi_qr', 0) === 1 ? 'checked' : '' }}
                           class="accent-blue-500 w-5 h-5">
                    <label for="print_upi_qr" class="text-gray-700 font-medium">
                        {{ trans('cruds.bankAccount.fields.print_upi_qr') }}
                    </label>
                    @error('print_upi_qr') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Print Bank Details -->
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner flex items-center gap-2">
                    <input type="hidden" name="print_bank_details" value="0">
                    <input type="checkbox" name="print_bank_details" id="print_bank_details" value="1" 
                           {{ $bankAccount->print_bank_details || old('print_bank_details', 0) === 1 ? 'checked' : '' }}
                           class="accent-green-500 w-5 h-5">
                    <label for="print_bank_details" class="text-gray-700 font-medium">
                        {{ trans('cruds.bankAccount.fields.print_bank_details') }}
                    </label>
                    @error('print_bank_details') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Save Button -->
            <div class="mt-6">
                <button type="submit" class="px-6 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

</div>
@endsection