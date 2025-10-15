@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">

    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-indigo-700">
                {{ trans('global.show') }} {{ trans('cruds.paymentOut.title') }}
            </h2>
            <a href="{{ route('admin.payment-outs.index') }}" 
               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- PaymentOut Details Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">ID</th>
                        <td class="px-4 py-2 text-gray-700">{{ $paymentOut->id }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">{{ trans('cruds.paymentOut.fields.parties') }}</th>
                        <td class="px-4 py-2 text-gray-700">{{ $paymentOut->parties->party_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">{{ trans('cruds.paymentOut.fields.payment_type') }}</th>
                        <td class="px-4 py-2 text-gray-700">{{ $paymentOut->payment_type->account_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">{{ trans('cruds.paymentOut.fields.date') }}</th>
                        <td class="px-4 py-2 text-gray-700">{{ $paymentOut->date }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">{{ trans('cruds.paymentOut.fields.reference_no') }}</th>
                        <td class="px-4 py-2 text-gray-700">{{ $paymentOut->reference_no }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">{{ trans('cruds.paymentOut.fields.amount') }}</th>
                        <td class="px-4 py-2 text-gray-700">{{ $paymentOut->amount }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">{{ trans('cruds.paymentOut.fields.discount') }}</th>
                        <td class="px-4 py-2 text-gray-700">{{ $paymentOut->discount }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">{{ trans('cruds.paymentOut.fields.total') }}</th>
                        <td class="px-4 py-2 text-gray-700">{{ $paymentOut->total }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">{{ trans('cruds.paymentOut.fields.description') }}</th>
                        <td class="px-4 py-2 text-gray-700">{!! $paymentOut->description !!}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">{{ trans('cruds.paymentOut.fields.attechment') }}</th>
                        <td class="px-4 py-2">
                            @if($paymentOut->attechment)
                                <a href="{{ $paymentOut->attechment->getUrl() }}" target="_blank" class="inline-block">
                                    <img src="{{ $paymentOut->attechment->getUrl('thumb') }}" class="h-16 w-16 rounded border">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Back button -->
        <div class="mt-4">
            <a href="{{ route('admin.payment-outs.index') }}" 
               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-lg shadow">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

    </div>
</div>
@endsection
