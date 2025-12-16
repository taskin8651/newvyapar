
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
            <form method="POST" action="{{ route('admin.cash-in-hands.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Left Column --}}
                    <div class="space-y-5">
                        <h3 class="text-lg font-medium text-gray-800 border-b border-gray-100 pb-2">Account Information</h3>

            

                        {{-- Account Display Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Account Display Name <span class="text-red-500">*</span>
                            </label>

                            <select name="bank_account_id" id="bank_account_id"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm">
                                <option value="">Select Account</option>
                                @foreach($bankAccounts as $account)
                                    <option value="{{ $account->id }}"
                                        data-json='@json($account)'>
                                        {{ $account->account_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Bank Detail Card --}}
                        <div id="bank-card" class="hidden mt-4 p-4 border rounded-lg bg-gray-50">
                            <h4 class="font-semibold text-gray-700 mb-2">Bank Details</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                <li><strong>Bank:</strong> <span id="bank_name"></span></li>
                                <li><strong>Account No:</strong> <span id="account_number"></span></li>
                                <li><strong>IFSC:</strong> <span id="ifsc_code"></span></li>
                                <li><strong>Holder:</strong> <span id="holder_name"></span></li>
                                <li><strong>Opening Balance:</strong> ₹<span id="opening_balance"></span></li>
                            </ul>
                        </div>

                        <script>
                        document.getElementById('bank_account_id').addEventListener('change', function () {
                            const option = this.options[this.selectedIndex];
                            if (!option.value) return;

                            const data = JSON.parse(option.dataset.json);

                            document.getElementById('bank_name').innerText = data.bank_name;
                            document.getElementById('account_number').innerText = data.account_number;
                            document.getElementById('ifsc_code').innerText = data.ifsc_code;
                            document.getElementById('holder_name').innerText = data.account_holder_name;
                            document.getElementById('opening_balance').innerText = data.opening_balance;

                            document.getElementById('bank-card').classList.remove('hidden');
                        });
                        </script>

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

                        
                    </div>
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
