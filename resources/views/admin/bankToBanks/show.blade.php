@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.bank-to-banks.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Bank to Bank Details Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.show') }} {{ trans('cruds.bankToBank.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- ID --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToBank.fields.id') }}</span>
                    <span class="text-gray-800 font-medium">{{ $bankToBank->id }}</span>
                </div>

                {{-- From Account --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-2">{{ trans('cruds.bankToBank.fields.from') }}</span>

                    @if($bankToBank->from)
                        <div class="text-gray-800 font-medium">
                            <p><strong>Account Name:</strong> {{ $bankToBank->from->account_name ?? '-' }}</p>
                            <p><strong>Account Number:</strong> {{ $bankToBank->from->account_number ?? '-' }}</p>
                            <p><strong>IFSC Code:</strong> {{ $bankToBank->from->ifsc_code ?? '-' }}</p>
                        </div>
                    @else
                        <span class="text-gray-400 italic">No account info</span>
                    @endif
                </div>

                {{-- To Account --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-2">{{ trans('cruds.bankToBank.fields.to') }}</span>

                    @if($bankToBank->to)
                        <div class="text-gray-800 font-medium">
                            <p><strong>Account Name:</strong> {{ $bankToBank->to->account_name ?? '-' }}</p>
                            <p><strong>Account Number:</strong> {{ $bankToBank->to->account_number ?? '-' }}</p>
                            <p><strong>IFSC Code:</strong> {{ $bankToBank->to->ifsc_code ?? '-' }}</p>
                        </div>
                    @else
                        <span class="text-gray-400 italic">No account info</span>
                    @endif
                </div>

                {{-- Amount --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToBank.fields.amount') }}</span>
                    <span class="text-gray-800 font-medium">{{ $bankToBank->amount }}</span>
                </div>

                {{-- Adjustment Date --}}
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToBank.fields.adjustment_date') }}</span>
                    <span class="text-gray-800 font-medium">{{ $bankToBank->adjustment_date }}</span>
                </div>

                {{-- Created By --}}
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToBank.fields.created_by') }}</span>
                    <span class="text-gray-800 font-medium">{{ $bankToBank->created_by->name ?? '-' }}</span>
                </div>

                {{-- Created At --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">Created At</span>
                    <span class="text-gray-800 font-medium">{{ $bankToBank->created_at ? $bankToBank->created_at->format('Y-m-d H:i') : '-' }}</span>
                </div>

                {{-- Updated At --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">Updated At</span>
                    <span class="text-gray-800 font-medium">{{ $bankToBank->updated_at ? $bankToBank->updated_at->format('Y-m-d H:i') : '-' }}</span>
                </div>

                {{-- Attachment --}}
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToBank.fields.attechment') }}</span>
                    @if($bankToBank->attechment)
                        <a href="{{ $bankToBank->attechment->getUrl() }}" target="_blank" class="inline-block mt-2">
                            <img src="{{ $bankToBank->attechment->getUrl('thumb') }}" class="rounded-lg border shadow-sm">
                        </a>
                    @else
                        <span class="text-gray-400 text-sm italic">No attachment uploaded</span>
                    @endif
                </div>

                {{-- Description --}}
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToBank.fields.description') }}</span>
                    <span class="text-gray-800 font-medium">{!! $bankToBank->description !!}</span>
                </div>

            </div>

            <!-- Back Button at Bottom -->
            <div class="mt-6">
                <a href="{{ route('admin.bank-to-banks.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
