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
                    <input type="text" name="account_name" id="account_name"
                           value="{{ old('account_name', $bankAccount->account_name) }}" required
                           class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                    @error('account_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Opening Balance -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1 required" for="opening_balance">
                        {{ trans('cruds.bankAccount.fields.opening_balance') }}
                    </label>
                    <input type="text" name="opening_balance" id="opening_balance"
                           value="{{ old('opening_balance', $bankAccount->opening_balance) }}" required
                           class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                    @error('opening_balance') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- As of Date -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="as_of_date">
                        {{ trans('cruds.bankAccount.fields.as_of_date') }}
                    </label>
                    <input type="text" name="as_of_date" id="as_of_date"
                           value="{{ old('as_of_date', $bankAccount->as_of_date) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                    @error('as_of_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Account Number -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="account_number">
                        {{ trans('cruds.bankAccount.fields.account_number') }}
                    </label>
                    <input type="text" name="account_number" id="account_number"
                           value="{{ old('account_number', $bankAccount->account_number) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                    @error('account_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- IFSC Code -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="ifsc_code">
                        {{ trans('cruds.bankAccount.fields.ifsc_code') }}
                    </label>
                    <input type="text" name="ifsc_code" id="ifsc_code"
                           value="{{ old('ifsc_code', $bankAccount->ifsc_code) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                    @error('ifsc_code') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Bank Name -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="bank_name">
                        {{ trans('cruds.bankAccount.fields.bank_name') }}
                    </label>
                    <input type="text" name="bank_name" id="bank_name"
                           value="{{ old('bank_name', $bankAccount->bank_name) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-purple-200">
                    @error('bank_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Account Holder Name -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="account_holder_name">
                        {{ trans('cruds.bankAccount.fields.account_holder_name') }}
                    </label>
                    <input type="text" name="account_holder_name" id="account_holder_name"
                           value="{{ old('account_holder_name', $bankAccount->account_holder_name) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-purple-200">
                    @error('account_holder_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- UPI -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                    <label class="block font-semibold text-gray-700 mb-1" for="upi">
                        {{ trans('cruds.bankAccount.fields.upi') }}
                    </label>
                    <input type="text" name="upi" id="upi"
                           value="{{ old('upi', $bankAccount->upi) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-pink-200">
                    @error('upi') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Print UPI QR -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner flex items-center gap-4">
                    <input type="hidden" name="print_upi_qr" value="0">
                    <input type="checkbox" name="print_upi_qr" id="print_upi_qr" value="1" 
                           {{ $bankAccount->print_upi_qr ? 'checked' : '' }}
                           class="accent-blue-500 w-5 h-5">
                    <label for="print_upi_qr" class="text-gray-700 font-medium">
                        {{ trans('cruds.bankAccount.fields.print_upi_qr') }}
                    </label>
                </div>

                <!-- Print Bank Details -->
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner flex items-center gap-2">
                    <input type="hidden" name="print_bank_details" value="0">
                    <input type="checkbox" name="print_bank_details" id="print_bank_details" value="1" 
                           {{ $bankAccount->print_bank_details ? 'checked' : '' }}
                           class="accent-green-500 w-5 h-5">
                    <label for="print_bank_details" class="text-gray-700 font-medium">
                        {{ trans('cruds.bankAccount.fields.print_bank_details') }}
                    </label>
                </div>
            </div>

            <!-- UPI QR Code Upload (Spatie Media Library) -->
            @php
                $upiQr = $bankAccount->getMedia('upi_qr');
            @endphp

            <div class="bg-blue-50 p-4 rounded-lg shadow-inner mt-4">
                <label class="block font-semibold text-gray-700 mb-2">
                    Upload UPI QR Code (Optional)
                </label>

                <div class="flex items-start gap-6">
                    <div class="w-40 h-40 border-2 border-dashed border-gray-300 rounded-xl 
                                flex flex-col items-center justify-center cursor-pointer 
                                hover:border-blue-500 transition relative bg-gray-50"
                         onclick="document.getElementById('upi_qr').click()">

                        <input type="file" name="upi_qr" id="upi_qr" accept="image/*" class="hidden" onchange="previewQR(event)">

                        @if($upiQr->count() > 0)
                            <div id="qrPreviewContainer" class="w-full h-full relative">
                                <img id="qrPreview" src="{{ $upiQr[0]->getUrl() }}" 
                                     class="w-full h-full object-contain p-2 rounded-xl" />

                                <button type="button" 
                                        onclick="removeQR(event)" 
                                        class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center shadow">
                                    ✕
                                </button>
                            </div>
                        @else
                            <div id="qrPreviewContainer" class="hidden w-full h-full relative">
                                <img id="qrPreview" class="w-full h-full object-contain p-2 rounded-xl" />
                                <button type="button" 
                                        onclick="removeQR(event)" 
                                        class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center shadow">
                                    ✕
                                </button>
                            </div>
                        @endif

                        <div id="qrPlaceholder" class="{{ $upiQr->count() ? 'hidden' : '' }} flex flex-col items-center text-center text-gray-500">
                            <i class="fas fa-upload text-2xl mb-1"></i>
                            <p class="text-xs">Click to Upload QR</p>
                        </div>
                    </div>

                    <p class="text-xs text-gray-500 w-64 leading-5">
                        Upload your UPI QR code to display on invoices.<br>
                        Recommended: <strong>400 × 400 px (JPG/PNG)</strong>
                    </p>
                </div>

                @error('upi_qr')
                    <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                @enderror
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

<script>
function previewQR(event) {
    const file = event.target.files[0];
    if (!file) return;

    document.getElementById('qrPreview').src = URL.createObjectURL(file);
    document.getElementById('qrPreviewContainer').classList.remove('hidden');
    document.getElementById('qrPlaceholder').classList.add('hidden');
}

function removeQR(event) {
    event.stopPropagation();

    const input = document.getElementById('upi_qr');
    input.value = "";

    document.getElementById('qrPreviewContainer').classList.add('hidden');
    document.getElementById('qrPlaceholder').classList.remove('hidden');
}
</script>

@endsection
