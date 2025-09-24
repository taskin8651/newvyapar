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

    <!-- Bank Account Card -->
    <div class="bg-white shadow-lg rounded-xl p-6 text-sm">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">
            {{ trans('global.show') }} {{ trans('cruds.bankAccount.title') }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankAccount.fields.id') }}</span>
                <span class="text-gray-800 font-medium">{{ $bankAccount->id }}</span>
            </div>

            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankAccount.fields.account_name') }}</span>
                <span class="text-gray-800 font-medium">{{ $bankAccount->account_name }}</span>
            </div>

            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankAccount.fields.opening_balance') }}</span>
                <span class="text-green-700 font-semibold">{{ $bankAccount->opening_balance }}</span>
            </div>

            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankAccount.fields.as_of_date') }}</span>
                <span class="text-gray-800 font-medium">{{ $bankAccount->as_of_date }}</span>
            </div>

            <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankAccount.fields.account_number') }}</span>
                <span class="text-gray-800 font-medium">{{ $bankAccount->account_number }}</span>
            </div>

            <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankAccount.fields.ifsc_code') }}</span>
                <span class="text-gray-800 font-medium">{{ $bankAccount->ifsc_code }}</span>
            </div>

            <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankAccount.fields.bank_name') }}</span>
                <span class="text-gray-800 font-medium">{{ $bankAccount->bank_name }}</span>
            </div>

            <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankAccount.fields.account_holder_name') }}</span>
                <span class="text-gray-800 font-medium">{{ $bankAccount->account_holder_name }}</span>
            </div>

            <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankAccount.fields.upi') }}</span>
                <span class="text-gray-800 font-medium">{{ $bankAccount->upi }}</span>
            </div>

            <div class="bg-pink-50 p-4 rounded-lg shadow-inner flex items-center gap-2">
                <span class="text-gray-500 font-semibold block">{{ trans('cruds.bankAccount.fields.print_upi_qr') }}</span>
                <input type="checkbox" disabled class="accent-blue-500 w-5 h-5" {{ $bankAccount->print_upi_qr ? 'checked' : '' }}>
            </div>

            <div class="bg-indigo-50 p-4 rounded-lg shadow-inner flex items-center gap-2">
                <span class="text-gray-500 font-semibold block">{{ trans('cruds.bankAccount.fields.print_bank_details') }}</span>
                <input type="checkbox" disabled class="accent-green-500 w-5 h-5" {{ $bankAccount->print_bank_details ? 'checked' : '' }}>
            </div>
        </div>

        <!-- Back Button at Bottom -->
        <div class="mt-6">
            <a href="{{ route('admin.bank-accounts.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>

@endsection