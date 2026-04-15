@extends('layouts.admin')
@section('content')

<div class="max-w-7xl mx-auto py-8 space-y-6">

    <!-- 🔷 Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-layer-group text-indigo-600"></i>
                {{ trans('cruds.currentStock.title_singular') }} {{ trans('global.list') }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Manage and monitor all available stock records
            </p>
        </div>

        @can('current_stock_create')
        <a href="{{ route('admin.current-stocks.create') }}"
           class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-medium rounded-xl shadow hover:scale-105 transition">
            <i class="fas fa-plus mr-2"></i>
            Add Stock
        </a>
        @endcan
    </div>

    <!-- 🔷 Search + Card Wrapper -->
    <div class="bg-white rounded-2xl shadow-lg p-6">

        <!-- Search -->
        <div class="flex justify-end mb-4">
            <div class="relative w-72">
                <input type="text" id="currentStockSearch"
                       placeholder="Search stock..."
                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:outline-none text-sm">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>

        <!-- 🔷 Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable-CurrentStock">
                <thead class="bg-gray-50">
                <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th width="10"></th>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Item</th>
                    <th class="px-4 py-3">Warehouse</th>
                    <th class="px-4 py-3">Quantity</th>
                    <th class="px-4 py-3">Stock Type</th>
                    <th class="px-4 py-3">Created By</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                @foreach($currentStocks as $stock)

                    @php
                        $json = $stock->json_data ? json_decode($stock->json_data, true) : null;
                        $isLow = $stock->qty <= 5;
                    @endphp

                    <tr data-entry-id="{{ $stock->id }}"
                        class="hover:bg-gray-50 transition">

                        <td></td>

                        <!-- ID -->
                        <td class="px-4 py-3 font-medium text-gray-700">
                            #{{ $stock->id }}
                        </td>

                        <!-- Item -->
                        <td class="px-4 py-3">
                            @if(method_exists($stock, 'addItems') && $stock->addItems && $stock->addItems->count())
                                @foreach($stock->addItems as $item)
                                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium mr-1">
                                        {{ $item->item_name }}
                                    </span>
                                @endforeach
                            @elseif($stock->rawMaterial)
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                    {{ $stock->rawMaterial->title }}
                                </span>
                            @elseif($json && isset($json['title']))
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                    {{ $json['title'] }}
                                </span>
                            @else
                                <span class="text-gray-400 italic text-sm">No Item</span>
                            @endif
                        </td>

                        <!-- Warehouse -->
                        <td class="px-4 py-3 text-gray-600 text-sm">
                            {{ $stock->rawMaterial->warehouse_location ?? ($json['warehouse_location'] ?? 'N/A') }}
                        </td>

                        <!-- Quantity -->
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $isLow ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $stock->qty }}
                            </span>
                        </td>

                        <!-- Type -->
                        <td class="px-4 py-3 text-gray-600 text-sm">
                            {{ $stock->type ?? '-' }}
                        </td>

                        <!-- Created By -->
                        <td class="px-4 py-3 text-gray-600 text-sm">
                            {{ $stock->createdBy->name ?? $stock->user->name ?? 'N/A' }}
                        </td>

                        <!-- Actions -->
                        <td class="px-4 py-3 text-center relative"
                            x-data="{ open: false }"
                            @mouseenter="open = true"
                            @mouseleave="open = false">

                            <button class="text-gray-500 hover:text-gray-800">
                                <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                            </button>

                            <div x-show="open"
                                 x-transition
                                 class="absolute right-0 mt-2 w-40 bg-white border rounded-xl shadow-lg z-20">

                                <a href="{{ route('admin.current-stocks.show', $stock->id) }}"
                                   class="block px-4 py-2 text-sm hover:bg-indigo-50">
                                    <i class="fas fa-eye mr-2 text-indigo-500"></i> View
                                </a>

                                <a href="{{ route('admin.current-stocks.edit', $stock->id) }}"
                                   class="block px-4 py-2 text-sm hover:bg-yellow-50">
                                    <i class="fas fa-edit mr-2 text-yellow-500"></i> Edit
                                </a>

                                <form action="{{ route('admin.current-stocks.destroy', $stock->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure?');">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-trash mr-2"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection


@section('scripts')
@parent
<script>
$(function () {

    let table = $('.datatable-CurrentStock').DataTable({
        orderCellsTop: true,
        order: [[1, 'desc']],
        pageLength: 25,
        dom: 'lrtip'
    });

    $('#currentStockSearch').on('keyup change clear', function () {
        table.search(this.value).draw();
    });

});
</script>
@endsection
