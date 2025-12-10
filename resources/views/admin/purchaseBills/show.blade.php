@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.purchase-bills.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Purchase Bill Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.show') }} {{ trans('cruds.purchaseBill.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- ID -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.id') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $purchaseBill->id }}</span>
                </div>

                <!-- Select Customer -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.select_customer') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $purchaseBill->select_customer->party_name ?? '' }}
                    </span>
                </div>

                <!-- Billing Name -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.billing_name') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $purchaseBill->billing_name }}</span>
                </div>

                <!-- Phone Number -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.phone_number') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $purchaseBill->phone_number }}</span>
                </div>

                <!-- E-Way Bill -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.e_way_bill_no') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $purchaseBill->e_way_bill_no }}</span>
                </div>

                <!-- PO No -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.po_no') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $purchaseBill->po_no }}</span>
                </div>

                <!-- PO Date -->
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.po_date') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $purchaseBill->po_date }}</span>
                </div>

                <!-- Quantity -->
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.qty') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $purchaseBill->qty }}</span>
                </div>

                <!-- Billing Address -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner ">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.billing_address') }}
                    </span>
                    <span class="text-gray-800 font-medium">{!! $purchaseBill->billing_address !!}</span>
                </div>

                <!-- Shipping Address -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.shipping_address') }}
                    </span>
                    <span class="text-gray-800 font-medium">{!! $purchaseBill->shipping_address !!}</span>
                </div>

                <!-- Items -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.item') }}
                    </span>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($purchaseBill->items as $item)
                            <span class="px-3 py-1 bg-pink-200 text-gray-800 rounded-full text-xs font-medium">
                                {{ $item->item_name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.description') }}
                    </span>
                    <span class="text-gray-800 font-medium">{!! $purchaseBill->description !!}</span>
                </div>

                <!-- Image -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.image') }}
                    </span>
                    @if($purchaseBill->image)
                        <a href="{{ $purchaseBill->image->getUrl() }}" target="_blank">
                            <img src="{{ $purchaseBill->image->getUrl('thumb') }}" class="rounded shadow">
                        </a>
                    @endif
                </div>

                <!-- Document -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.document') }}
                    </span>
                    @if($purchaseBill->document)
                        <a href="{{ $purchaseBill->document->getUrl() }}" target="_blank" class="text-blue-600 font-semibold">
                            {{ trans('global.view_file') }}
                        </a>
                    @endif
                </div>

                <!-- Payment Type -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.payment_type') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $purchaseBill->payment_type->account_name ?? '' }}
                    </span>
                </div>

                <!-- Reference No -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.purchaseBill.fields.reference_no') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $purchaseBill->reference_no }}</span>
                </div>

            </div>

            <!-- Bottom Back Button -->
            <div class="mt-6">
                <a href="{{ route('admin.purchase-bills.index') }}" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
