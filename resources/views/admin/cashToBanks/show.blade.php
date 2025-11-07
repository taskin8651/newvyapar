@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.cash-to-banks.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Cash To Bank Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-indigo-600">
                {{ trans('global.show') }} {{ trans('cruds.cashToBank.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- ID --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.cashToBank.fields.id') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $cashToBank->id }}</span>
                </div>

                {{-- From --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.cashToBank.fields.from') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $cashToBank->from }}</span>
                </div>

                {{-- To --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.cashToBank.fields.to') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $cashToBank->to->account_name ?? '' }}</span>
                </div>

                {{-- Amount --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.cashToBank.fields.amount') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $cashToBank->amount }}</span>
                </div>

                {{-- Adjustment Date --}}
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.cashToBank.fields.adjustment_date') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $cashToBank->adjustment_date }}</span>
                </div>

                {{-- Attachment --}}
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.cashToBank.fields.attechment') }}
                    </span>
                    @if($cashToBank->attechment)
                        <a href="{{ $cashToBank->attechment->getUrl() }}" target="_blank" class="inline-block mt-2">
                            <img src="{{ $cashToBank->attechment->getUrl('thumb') }}" class="rounded-lg border shadow-sm">
                        </a>
                    @else
                        <span class="text-gray-400 text-sm italic">No attachment uploaded</span>
                    @endif
                </div>

                {{-- Description --}}
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.cashToBank.fields.description') }}
                    </span>
                    <span class="text-gray-800 font-medium">{!! $cashToBank->description !!}</span>
                </div>

            </div>

            <!-- Back Button at Bottom -->
            <div class="mt-6">
                <a href="{{ route('admin.cash-to-banks.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>

</div>

@endsection