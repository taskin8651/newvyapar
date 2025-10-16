@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-boxes text-indigo-600"></i>
                {{ trans('cruds.currentStock.title_singular') }} {{ trans('global.list') }}
            </h2>

            <div class="flex gap-2 items-center" x-data="{ openCsvModal: false }">
                @can('current_stock_create')
                    <!-- Add New -->
                    <a href="{{ route('admin.current-stocks.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.currentStock.title_singular') }}
                    </a>

                    <!-- CSV Import -->
                    <button 
                        @click="openCsvModal = true"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                    </button>

                    @include('csvImport.modal', [
                        'model' => 'CurrentStock', 
                        'route' => 'admin.current-stocks.parseCsvImport'
                    ])
                @endcan

                <!-- Custom Search -->
                <div>
                    <input type="text" id="currentStockSearch" placeholder="Search stocks..."
                        class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable-CurrentStock">
                <thead class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white">
                <tr>
                    <th class="px-4 py-3 w-10"></th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                    {{ trans('cruds.currentStock.fields.id') }}
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                    {{ trans('cruds.currentStock.fields.item') }}
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                    {{ trans('cruds.currentStock.fields.parties') }}
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                    {{ trans('cruds.currentStock.fields.Pdetails') }}
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                    {{ trans('cruds.currentStock.fields.qty') }}
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider">
                    {{ trans('cruds.currentStock.fields.type') }}
                    </th>
                    <th class="px-4 py-3 text-center text-sm font-semibold uppercase tracking-wider">
                    {{ trans('global.actions') }}
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($currentStocks as $currentStock)
                        <tr data-entry-id="{{ $currentStock->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $currentStock->id }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($currentStock->items as $item)
                                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs mr-1">{{ $item->item_name }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $currentStock->user->item_name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @php
                                    $json = $currentStock->json_data ? json_decode($currentStock->json_data, true) : null;
                                @endphp

                                @if($json)
                                    <div class="space-y-1">
                                        <div><strong>Item Type:</strong> {{ $json['item_type'] ?? 'N/A' }}</div>
                                        <div><strong>Item Code:</strong> {{ $json['item_code'] ?? 'N/A' }}</div>
                                        <div><strong class="text-green-500">Sale Price:</strong> ₹{{ $json['pricing']['sale_price'] ?? 'N/A' }}</div>
                                        <div><strong class="text-red-500">Purchase Price:</strong> ₹{{ $json['purchase']['purchase_price'] ?? 'N/A' }}</div>
                                        <div><strong>Warehouse:</strong> {{ $json['stock']['warehouse_location'] ?? 'N/A' }}</div>
                                        <div><strong>Title:</strong> {{ $json['online']['title'] ?? 'N/A' }}</div>
                                    </div>
                                    <script src="//unpkg.com/alpinejs" defer></script>

                                                                        <!-- Tailwind Alpine Modal Trigger -->
                                                                    <button 
                                        @click="$dispatch('open-json-modal', @js($json))"
                                        class="px-2 py-1 bg-indigo-600 text-white text-xs rounded hover:bg-indigo-700 mt-1">
                                        View More
                                    </button>


                                @else
                                    <span class="text-gray-500 italic">No Data</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $currentStock->qty ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $currentStock->type ?? '' }}</td>
                            <td class="px-4 py-3 text-center relative" x-data="{ open: false }" 
    @mouseenter="open = true" @mouseleave="open = false">

    <!-- Ellipsis icon -->
    <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
        <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
    </button>

    <!-- Dropdown menu -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-1"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-1"
         class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-20">

        @can('current_stock_show')
            <a href="{{ route('admin.current-stocks.show', $currentStock->id) }}"
               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <i class="fas fa-eye mr-2"></i> View
            </a>
        @endcan

        @can('current_stock_edit')
            <a href="{{ route('admin.current-stocks.edit', $currentStock->id) }}"
               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg transition-colors">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
        @endcan

        @can('current_stock_delete')
            <form action="{{ route('admin.current-stocks.destroy', $currentStock->id) }}" method="POST" 
                  onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                @method('DELETE')
                @csrf
                <button type="submit" 
                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        @endcan

           <a href="{{ route('admin.current-stocks.pdf', $currentStock->id) }}" target="_blank"
   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors">
    <i class="fas fa-file-pdf mr-2"></i> Print
</a>


    </div>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- JSON Modal Alpine -->
<div x-data="{ open: false, jsonData: {}, activeTab: 'overview' }"
     x-on:open-json-modal.window="jsonData = $event.detail; open = true"
     x-show="open"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     style="display: none;">

    <div x-show="open" x-transition.scale class="bg-white rounded-xl shadow-xl max-w-5xl w-full overflow-hidden">
        
        <!-- Header -->
        <div class="flex justify-between items-center bg-indigo-600 text-white px-4 py-3">
            <h3 class="text-lg font-semibold">Complete JSON Data</h3>
            <button @click="open = false" class="text-white text-xl">&times;</button>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200 bg-gray-50">
            <nav class="flex space-x-4 px-4">
                <template x-for="tab in ['overview','pricing','wholesale','purchase','stock','online']" :key="tab">
                    <button 
                        @click="activeTab = tab"
                        class="px-4 py-2 text-sm font-medium rounded-t-md"
                        :class="activeTab === tab 
                            ? 'bg-white text-indigo-600 border-b-2 border-indigo-600' 
                            : 'text-gray-600 hover:text-indigo-500'">
                        <span x-text="tab.charAt(0).toUpperCase() + tab.slice(1)"></span>
                    </button>
                </template>
            </nav>
        </div>

        <!-- Body -->
        <div class="p-4 max-h-[28rem] overflow-y-auto text-sm space-y-3">

            <!-- Overview -->
          <div x-show="activeTab === 'overview'" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <template x-for="field in ['item_type','unit_id','select_category','quantity','item_code']" :key="field">
        <div x-show="jsonData[field]" class="p-4 border rounded-lg shadow-sm bg-white">
            <span class="block text-gray-500 font-semibold capitalize mb-1" 
                  x-text="field.replace(/_/g,' ')"></span>
            <span class="block text-gray-800 font-medium" x-text="jsonData[field]"></span>
        </div>
    </template>
</div>

            <!-- Pricing -->
            <div x-show="activeTab === 'pricing'"  class="space-y-2">
                <h4 class="font-bold text-indigo-600 mb-2">Pricing</h4>
                <template x-for="field in ['sale_price','select_type','disc_on_sale_price','disc_type','select_tax_id']" :key="field">
                    <div x-show="jsonData.pricing && jsonData.pricing[field]">
                        <span class="font-semibold capitalize" x-text="field.replace(/_/g,' ') + ':'"></span>
                        <span class="ml-1" x-text="jsonData.pricing[field]"></span>
                    </div>
                </template>
            </div>

            <!-- Wholesale -->
            <div x-show="activeTab === 'wholesale'"  class="space-y-2">
                <h4 class="font-bold text-indigo-600 mb-2">Wholesale</h4>
                <template x-for="field in ['wholesale_price','select_type_wholesale','minimum_wholesale_qty']" :key="field">
                    <div x-show="jsonData.wholesale && jsonData.wholesale[field]">
                        <span class="font-semibold capitalize" x-text="field.replace(/_/g,' ') + ':'"></span>
                        <span class="ml-1" x-text="jsonData.wholesale[field]"></span>
                    </div>
                    
                </template>
            </div>

            <!-- Purchase -->
            <div x-show="activeTab === 'purchase'"  class="space-y-2">
                <h4 class="font-bold text-indigo-600 mb-2">Purchase</h4>
                <template x-for="field in ['purchase_price','select_purchase_type']" :key="field">
                    <div x-show="jsonData.purchase && jsonData.purchase[field]">
                        <span class="font-semibold capitalize" x-text="field.replace(/_/g,' ') + ':'"></span>
                        <span class="ml-1" x-text="jsonData.purchase[field]"></span>
                    </div>
                </template>
            </div>

            <!-- Stock -->
            <div x-show="activeTab === 'stock'"  class="space-y-2">
                <h4 class="font-bold text-indigo-600 mb-2">Stock</h4>
                <template x-for="field in ['opening_stock','low_stock_warning','warehouse_location']" :key="field">
                    <div x-show="jsonData.stock && jsonData.stock[field]">
                        <span class="font-semibold capitalize" x-text="field.replace(/_/g,' ') + ':'"></span>
                        <span class="ml-1" x-text="jsonData.stock[field]"></span>
                    </div>
                </template>
            </div>

            <!-- Online -->
            <div x-show="activeTab === 'online'"  class="space-y-2">
                <h4 class="font-bold text-indigo-600 mb-2">Online</h4>
                <template x-for="field in ['title','description']" :key="field">
                    <div x-show="jsonData.online && jsonData.online[field]">
                        <span class="font-semibold capitalize" x-text="field.replace(/_/g,' ') + ':'"></span>
                        <span class="ml-1" x-text="jsonData.online[field]"></span>
                    </div>
                </template>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end p-4 border-t">
            <button @click="open = false" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Close</button>
        </div>
    </div>
</div>

</div>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        @can('current_stock_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.current-stocks.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')
                    return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }
                    }).done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        let table = $('.datatable-CurrentStock:not(.ajaxTable)').DataTable({
            buttons: dtButtons,
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 25,
            dom: 'lrtip'
        });

        // Bind custom search input
        $('#currentStockSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endsection
