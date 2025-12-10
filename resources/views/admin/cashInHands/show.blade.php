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

        <!-- Cash In Hand Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">
            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.show') }} {{ trans('cruds.cashInHand.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.cashInHand.fields.id') }}</span>
                    <span class="text-gray-800 font-medium">{{ $cashInHand->id }}</span>
                </div>

                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">Account Name</span>
                    <span class="text-gray-800 font-medium">{{ $cashInHand->account_name }}</span>
                </div>

                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">Opening Balance</span>
                    <span class="text-gray-800 font-medium">{{ $cashInHand->opening_balance }}</span>
                </div>

                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">As of Date</span>
                    <span class="text-gray-800 font-medium">{{ $cashInHand->as_of_date }}</span>
                </div>

                <div class="bg-red-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">Account Number</span>
                    <span class="text-gray-800 font-medium">{{ $cashInHand->account_number }}</span>
                </div>

                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">IFSC Code</span>
                    <span class="text-gray-800 font-medium">{{ $cashInHand->ifsc_code }}</span>
                </div>

                <div class="bg-orange-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">Bank Name</span>
                    <span class="text-gray-800 font-medium">{{ $cashInHand->bank_name }}</span>
                </div>

                <div class="bg-teal-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">Account Holder Name</span>
                    <span class="text-gray-800 font-medium">{{ $cashInHand->account_holder_name }}</span>
                </div>

            </div>

            <!-- Back Button at Bottom -->
            <div class="mt-6">
                <a href="{{ route('admin.cash-in-hands.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
