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
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.currentStock.fields.id') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.currentStock.fields.item') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.currentStock.fields.parties') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.currentStock.fields.Pdetails') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.currentStock.fields.qty') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.currentStock.fields.type') }}
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $currentStock->user->name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @php
                                    $json = $currentStock->json_data ? json_decode($currentStock->json_data, true) : null;
                                @endphp

                                @if($json)
                                    <div class="space-y-1">
                                        <div><strong>Item Type:</strong> {{ $json['item_type'] ?? 'N/A' }}</div>
                                        <div><strong>Item Code:</strong> {{ $json['item_code'] ?? 'N/A' }}</div>
                                        <div><strong>Sale Price:</strong> ₹{{ $json['pricing']['sale_price'] ?? 'N/A' }}</div>
                                        <div><strong>Purchase Price:</strong> ₹{{ $json['purchase']['purchase_price'] ?? 'N/A' }}</div>
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
                            <td class="px-4 py-3 text-center space-x-1">
                                @can('current_stock_show')
                                    <a href="{{ route('admin.current-stocks.show', $currentStock->id) }}"
                                       class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('current_stock_edit')
                                    <a href="{{ route('admin.current-stocks.edit', $currentStock->id) }}"
                                       class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('current_stock_delete')
                                    <form action="{{ route('admin.current-stocks.destroy', $currentStock->id) }}" method="POST" 
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- JSON Modal Alpine -->
       <div x-data="{ open: false, jsonData: {} }"
     x-on:open-json-modal.window="jsonData = $event.detail; open = true"
     x-show="open"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     style="display: none;">

            
            <div x-show="open" x-transition.scale class="bg-white rounded-xl shadow-xl max-w-3xl w-full overflow-hidden">
                <!-- Header -->
                <div class="flex justify-between items-center bg-indigo-600 text-white px-4 py-3">
                    <h3 class="text-lg font-semibold">Complete JSON Data</h3>
                    <button @click="open = false" class="text-white text-xl">&times;</button>
                </div>

               <!-- Body -->
<div class="p-4 max-h-96 overflow-y-auto space-y-2 text-sm">

    <!-- Top-level fields -->
    <template x-for="(value, key) in jsonData" :key="key">
        <div x-show="typeof value !== 'object'">
            <span class="font-semibold capitalize" x-text="key.replace(/_/g, ' ') + ':'"></span>
            <span class="ml-2" x-text="value"></span>
        </div>
    </template>

    <td class="px-4 py-3 text-sm text-gray-700">
    @php
        $json = $currentStock->json_data ? json_decode($currentStock->json_data, true) : null;
    @endphp

    @if($json)
        <div x-data="{ jsonData: @js($json) }" class="text-xs max-h-64 overflow-y-auto">
            
            <template x-for="[key, value] in Object.entries(jsonData)" :key="key">
                <div>
                    <template x-if="typeof value === 'object' && value !== null">
                        <div class="ml-2">
                            <span class="font-semibold capitalize" x-text="key.replace(/_/g,' ') + ':'"></span>
                            <div class="ml-4" x-html="formatNested(value)"></div>
                        </div>
                    </template>
                    <template x-if="typeof value !== 'object' || value === null">
                        <div>
                            <span class="font-semibold capitalize" x-text="key.replace(/_/g,' ') + ':'"></span>
                            <span class="ml-1" x-text="value"></span>
                        </div>
                    </template>
                </div>
            </template>

        </div>
    @else
        <span class="text-gray-500 italic">No Data</span>
    @endif
</td>


<script>
function formatNested(obj) {
    let html = '';
    for (const [key, value] of Object.entries(obj)) {
        if (value && typeof value === 'object') {
            html += `<div class="ml-4"><span class="font-semibold capitalize">${key.replace(/_/g,' ')}:</span>${formatNested(value)}</div>`;
        } else {
            html += `<div><span class="font-semibold capitalize">${key.replace(/_/g,' ')}:</span> <span class="ml-1">${value}</span></div>`;
        }
    }
    return html;
}
</script>


                <!-- Footer -->
                <div class="flex justify-end p-4 border-t">
                    <button @click="open = false" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Close</button>
                </div>
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
