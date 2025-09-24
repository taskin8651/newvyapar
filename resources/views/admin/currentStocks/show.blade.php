@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    <!-- Back button -->
    <div class="mb-4">
        <a href="{{ route('admin.current-stocks.index') }}"
           class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
            ← {{ trans('global.back_to_list') }}
        </a>
    </div>

    <!-- Card -->
    <div class="bg-white shadow-md rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ trans('global.show') }} {{ trans('cruds.currentStock.title') }}
            </h2>
        </div>

        <div class="px-6 py-6 space-y-8">
            <!-- Stock Info -->
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        {{ trans('cruds.currentStock.fields.id') }}
                    </dt>
                    <dd class="mt-1 text-base text-gray-900">
                        {{ $currentStock->id }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        {{ trans('cruds.currentStock.fields.qty') }}
                    </dt>
                    <dd class="mt-1 text-base text-gray-900">
                        {{ $currentStock->qty }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        {{ trans('cruds.currentStock.fields.type') }}
                    </dt>
                    <dd class="mt-1 text-base text-gray-900">
                        {{ $currentStock->type }}
                    </dd>
                </div>

                <!-- Party Detail -->
                <div>
                    <dt class="text-sm font-medium text-gray-500">
                        {{ trans('cruds.currentStock.fields.parties') }}
                    </dt>
                    <dd class="mt-1 text-base text-gray-900">
                        {{ $currentStock->party->party_name ?? 'N/A' }}
                        <div class="text-sm text-gray-600">
                            📞 {{ $currentStock->party->phone_number ?? '-' }} <br>
                            ✉️ {{ $currentStock->party->email ?? '-' }} <br>
                            📍 {{ $currentStock->party->city ?? '' }}, {{ $currentStock->party->state ?? '' }}
                        </div>
                    </dd>
                </div>
            </dl>

            <!-- Item Details Table -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    {{ trans('cruds.currentStock.fields.item') }} Details
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Code</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">HSN</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Quantity</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Sale Price</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Purchase Price</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Tax</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($currentStock->items as $item)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $item->item_name }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $item->item_code }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $item->item_hsn }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">₹{{ number_format($item->sale_price, 2) }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">₹{{ number_format($item->purchase_price, 2) }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-600">{{ $item->select_tax->name ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 text-right">
            <a href="{{ route('admin.current-stocks.index') }}"
               class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection
