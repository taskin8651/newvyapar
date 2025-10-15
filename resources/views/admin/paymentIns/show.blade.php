@extends('layouts.admin')
@section('content')
<div class="max-w-3xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-xl font-bold text-indigo-700 mb-6">Payment In Details</h2>

        <table class="min-w-full table-auto">
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left font-medium">ID</th>
                    <td class="px-4 py-2">{{ $paymentIn->id }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Party</th>
                    <td class="px-4 py-2">{{ $paymentIn->parties->party_name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Payment Type</th>
                    <td class="px-4 py-2">{{ $paymentIn->payment_type->account_name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Date</th>
                    <td class="px-4 py-2">{{ $paymentIn->date }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Reference No</th>
                    <td class="px-4 py-2">{{ $paymentIn->reference_no }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Amount</th>
                    <td class="px-4 py-2">{{ $paymentIn->amount }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Discount</th>
                    <td class="px-4 py-2">{{ $paymentIn->discount }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Total</th>
                    <td class="px-4 py-2">{{ $paymentIn->total }}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Description</th>
                    <td class="px-4 py-2">{!! $paymentIn->description !!}</td>
                </tr>
                <tr>
                    <th class="px-4 py-2 text-left font-medium">Attachment</th>
                    <td class="px-4 py-2">
                        @if($paymentIn->attechment)
                            <a href="{{ $paymentIn->attechment->getUrl() }}" target="_blank">
                                <img src="{{ $paymentIn->attechment->getUrl('thumb') }}" class="h-10 w-10 rounded border">
                            </a>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="{{ route('admin.payment-ins.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back to list</a>
        </div>
    </div>
</div>
@endsection
