@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.adjust-bank-balances.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Adjust Bank Balance Details Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.show') }} {{ trans('cruds.adjustBankBalance.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- ID --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.id') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $adjustBankBalance->id }}</span>
                </div>

                {{-- From Account --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-2">
                        {{ trans('cruds.adjustBankBalance.fields.from') }}
                    </span>

                    @if($adjustBankBalance->from)
                        <div class="text-gray-800 font-medium">
                            <p><strong>Account Name:</strong> {{ $adjustBankBalance->from->account_name ?? '-' }}</p>
                            <p><strong>Account Number:</strong> {{ $adjustBankBalance->from->account_number ?? '-' }}</p>
                            <p><strong>IFSC Code:</strong> {{ $adjustBankBalance->from->ifsc_code ?? '-' }}</p>
                        </div>
                    @else
                        <span class="text-gray-400 italic">No account info</span>
                    @endif
                </div>

                {{-- Type --}}
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.type') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ App\Models\AdjustBankBalance::TYPE_SELECT[$adjustBankBalance->type] ?? '-' }}
                    </span>
                </div>

                {{-- Amount --}}
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.amount') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $adjustBankBalance->amount }}</span>
                </div>

                {{-- Adjustment Date --}}
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.adjustment_date') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $adjustBankBalance->adjustment_date }}</span>
                </div>

                {{-- Attachment --}}
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.attechment') }}
                    </span>
                    @if($adjustBankBalance->attechment)
                        <a href="{{ $adjustBankBalance->attechment->getUrl() }}" target="_blank" class="inline-block mt-2">
                            <img src="{{ $adjustBankBalance->attechment->getUrl('thumb') }}" class="rounded-lg border shadow-sm">
                        </a>
                    @else
                        <span class="text-gray-400 text-sm italic">No attachment uploaded</span>
                    @endif
                </div>

                {{-- Description --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.description') }}
                    </span>
                    <span class="text-gray-800 font-medium">{!! $adjustBankBalance->description !!}</span>
                </div>

            </div>

            <!-- Back Button at Bottom -->
            <div class="mt-6">
                <a href="{{ route('admin.adjust-bank-balances.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>

</div>

@endsection