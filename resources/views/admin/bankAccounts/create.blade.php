@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md border border-gray-200">

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
                <i class="fas fa-university text-indigo-600"></i>
                <span>{{ trans('global.create') }} {{ trans('cruds.bankAccount.title_singular') }}</span>
            </h2>
            <a href="{{ route('admin.bank-accounts.index') }}" 
               class="text-sm text-gray-500 hover:text-indigo-600 transition flex items-center gap-1">
                <i class="fas fa-arrow-left"></i> {{ trans('global.back_to_list') }}
            </a>
        </div>

        {{-- Progress Bar --}}
        <div class="px-6 pt-4">
            <div class="flex justify-between items-center text-sm text-gray-500 mb-2">
                <span>Account Setup Progress</span>
                <span id="progress-text">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4">
                <div id="progress-bar" class="bg-indigo-600 h-1.5 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>

        {{-- Form --}}
        <div class="px-6 py-6">
            <form method="POST" action="{{ route('admin.bank-accounts.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Left Column --}}
                    <div class="space-y-5">
                        <h3 class="text-lg font-medium text-gray-800 border-b border-gray-100 pb-2">Account Information</h3>

                        <div>
                            <label for="account_name" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ trans('cruds.bankAccount.fields.account_name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="account_name" id="account_name" data-required="1"
                                   value="{{ old('account_name') }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('account_name') border-red-500 @enderror">
                            @error('account_name')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="opening_balance" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ trans('cruds.bankAccount.fields.opening_balance') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">₹</span>
                                <input type="text" name="opening_balance" id="opening_balance" data-required="1"
                                       value="{{ old('opening_balance') }}"
                                       class="w-full pl-7 pr-3 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('opening_balance') border-red-500 @enderror">
                            </div>
                            @error('opening_balance')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="as_of_date" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ trans('cruds.bankAccount.fields.as_of_date') }}
                            </label>
                            <input type="date" name="as_of_date" id="as_of_date" data-required="1"
              ₹                    value="{{ old('as_of_date') }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('as_of_date') border-red-500 @enderror">
                            @error('as_of_date')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="account_number" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ trans('cruds.bankAccount.fields.account_number') }}
                            </label>
                            <input type="text" name="account_number" id="account_number" data-required="1"
                                   value="{{ old('account_number') }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('account_number') border-red-500 @enderror">
                            @error('account_number')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="space-y-5">
                        <h3 class="text-lg font-medium text-gray-800 border-b border-gray-100 pb-2">Bank Details</h3>

                        <div>
                            <label for="ifsc_code" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ trans('cruds.bankAccount.fields.ifsc_code') }}
                            </label>
                            <input type="text" name="ifsc_code" id="ifsc_code" data-required="1"
                                   value="{{ old('ifsc_code') }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('ifsc_code') border-red-500 @enderror">
                            @error('ifsc_code')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ trans('cruds.bankAccount.fields.bank_name') }}
                            </label>
                            <input type="text" name="bank_name" id="bank_name" data-required="1"
                                   value="{{ old('bank_name') }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('bank_name') border-red-500 @enderror">
                            @error('bank_name')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="account_holder_name" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ trans('cruds.bankAccount.fields.account_holder_name') }}
                            </label>
                            <input type="text" name="account_holder_name" id="account_holder_name" data-required="1"
                                   value="{{ old('account_holder_name') }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('account_holder_name') border-red-500 @enderror">
                            @error('account_holder_name')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="upi" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ trans('cruds.bankAccount.fields.upi') }}
                            </label>
                            <input type="text" name="upi" id="upi" data-required="1"
                                   value="{{ old('upi') }}"
                                   class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 @error('upi') border-red-500 @enderror">
                            @error('upi')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Switches --}}
                <div class="flex items-center space-x-6 pt-4 border-t border-gray-100">
                    <label class="flex items-center cursor-pointer text-sm text-gray-700">
                        <input type="hidden" name="print_upi_qr" value="0">
                        <input type="checkbox" name="print_upi_qr" value="1" {{ old('print_upi_qr') ? 'checked' : '' }}
                               class="w-4 h-4 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2">{{ trans('cruds.bankAccount.fields.print_upi_qr') }}</span>
                    </label>

                    <label class="flex items-center cursor-pointer text-sm text-gray-700">
                        <input type="hidden" name="print_bank_details" value="0">
                        <input type="checkbox" name="print_bank_details" value="1" {{ old('print_bank_details') ? 'checked' : '' }}
                               class="w-4 h-4 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500">
                        <span class="ml-2">{{ trans('cruds.bankAccount.fields.print_bank_details') }}</span>
                    </label>
                </div>

                {{-- Submit --}}
                <div class="pt-6 flex justify-end">
                    <button type="submit" 
                        class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center gap-2">
                        <i class="fas fa-check-circle"></i> {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Progress Bar JS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('input[data-required]');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');

    function updateProgress() {
        let filled = 0;
        inputs.forEach(input => {
            if (input.value.trim() !== '') filled++;
        });
        const percent = Math.round((filled / inputs.length) * 100);
        progressBar.style.width = percent + '%';
        progressText.textContent = percent + '%';
    }

    inputs.forEach(input => input.addEventListener('input', updateProgress));

    // Initialize progress on page load
    updateProgress();
});
</script>
@endsection
