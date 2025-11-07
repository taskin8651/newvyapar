@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.bank-to-cashes.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Bank to Cash Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.show') }} {{ trans('cruds.bankToCash.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- ID --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToCash.fields.id') }}</span>
                    <span class="text-gray-800 font-medium">{{ $bankToCash->id }}</span>
                </div>

                {{-- From --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToCash.fields.from') }}</span>
                    <span class="text-gray-800 font-medium">{{ $bankToCash->from->account_name ?? '' }}</span>
                </div>

                {{-- To --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToCash.fields.to') }}</span>
                    <span class="text-gray-800 font-medium">{{ $bankToCash->to }}</span>
                </div>

                {{-- Amount --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToCash.fields.amount') }}</span>
                    <span class="text-gray-800 font-medium">{{ $bankToCash->amount }}</span>
                </div>

                {{-- Adjustment Date --}}
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToCash.fields.adjustment_date') }}</span>
                    <span class="text-gray-800 font-medium">{{ $bankToCash->adjustment_date }}</span>
                </div>

                {{-- Attachment --}}
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToCash.fields.attechment') }}</span>
                    @if($bankToCash->attechment)
                        <a href="{{ $bankToCash->attechment->getUrl() }}" target="_blank" class="inline-block mt-2">
                            <img src="{{ $bankToCash->attechment->getUrl('thumb') }}" class="rounded-lg border shadow-sm">
                        </a>
                    @else
                        <span class="text-gray-400 text-sm italic">No attachment uploaded</span>
                    @endif
                </div>

                {{-- Description --}}
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">{{ trans('cruds.bankToCash.fields.description') }}</span>
                    <span class="text-gray-800 font-medium">{!! $bankToCash->description !!}</span>
                </div>

            </div>

            <!-- Back Button at Bottom -->
            <div class="mt-6">
                <a href="{{ route('admin.bank-to-cashes.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>

</div>

@endsection