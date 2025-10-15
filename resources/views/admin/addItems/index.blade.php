@extends('layouts.admin')
@section('content')

<div class="space-y-6">

    {{-- Add Item Button --}}
    @can('add_item_create')
    <div class="flex space-x-2 mb-4">
        <a href="{{ route('admin.add-items.create') }}"
           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
            <i class="fas fa-plus mr-2"></i> {{ trans('global.add') }} {{ trans('cruds.addItem.title_singular') }}
        </a>
    </div>
    @endcan

    {{-- Items Table --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">
                {{ trans('cruds.addItem.title_singular') }} {{ trans('global.list') }}
            </h3>
        </div>

        <div class="p-6 overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600 datatable datatable-AddItem">
                <thead class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 w-12"></th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.id') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.item_type') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.item_name') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.item_hsn') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.select_unit') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.select_category') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.item_code') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.sale_price') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.select_type') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.taxRate.fields.parcentage') }}</th>
                        <th class="px-4 py-3 text-center">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($addItems as $addItem)
                        <tr class="hover:bg-gray-50">
                            <td></td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $addItem->id ?? '' }}</td>
                            <td class="px-4 py-3">{{ App\Models\AddItem::ITEM_TYPE_SELECT[$addItem->item_type] ?? '' }}</td>

                            {{-- Item Name with Modal --}}
                            <td class="px-4 py-3" x-data="{ open: false }" x-init="$watch('open', value => value ? $nextTick(() => initModal({{ $addItem->id }})) : '')">
                                <span @click="open = true" class="text-blue-600 cursor-pointer hover:underline">
                                    {{ $addItem->item_name ?? '' }}
                                </span>

                                {{-- Modal --}}
                                <div x-show="open" x-cloak
                                     x-transition
                                     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 overflow-auto">
                                    <div @click.away="open = false"
                                         class="bg-white rounded-lg shadow-lg max-w-5xl w-full p-6 relative">

                                        <h3 class="text-lg font-semibold mb-4">Details for {{ $addItem->item_name }}</h3>

                                        {{-- Modal Table --}}
                                        <table id="modalTable-{{ $addItem->id }}" class="min-w-full text-left text-gray-700 border border-gray-200 table-auto">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="px-4 py-2 border-b">Type</th>
                                                    <th class="px-4 py-2 border-b">Key / Name</th>
                                                    <th class="px-4 py-2 border-b">Value / Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $json = json_decode($addItem->json_data, true); @endphp

                                                {{-- JSON Data --}}
                                                @if(is_array($json))
                                                    @foreach($json as $key => $value)
                                                        <tr>
                                                            <td class="px-4 py-2 border-b font-medium">JSON</td>
                                                            <td class="px-4 py-2 border-b">{{ $key }}</td>
                                                            <td class="px-4 py-2 border-b">{{ is_array($value) ? json_encode($value) : $value }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                                {{-- Raw Materials --}}
                                                @foreach($addItem->rawMaterials as $rm)
                                                    <tr>
                                                        <td class="px-4 py-2 border-b font-medium">Raw Material</td>
                                                        <td class="px-4 py-2 border-b">{{ $rm->item_name }}</td>
                                                        <td class="px-4 py-2 border-b">{{ $rm->pivot->qty ?? 0 }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <button @click="open = false"
                                                class="mt-4 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3">{{ $addItem->item_hsn ?? '' }}</td>
                            <td class="px-4 py-3">{{ $addItem->select_unit->base_unit ?? '' }}</td>
                            <td class="px-4 py-3">
                                @foreach($addItem->select_categories as $category)
                                    <span class="inline-block px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-medium rounded">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3">{{ $addItem->item_code ?? '' }}</td>
                            <td class="px-4 py-3">{{ $addItem->sale_price ?? '' }}</td>
                            <td class="px-4 py-3">{{ App\Models\AddItem::SELECT_TYPE_SELECT[$addItem->select_type] ?? '' }}</td>
                            <td class="px-4 py-3">{{ $addItem->select_tax->parcentage ?? '' }}</td>
                            <td class="px-4 py-3 flex items-center justify-center gap-2">
                                @can('add_item_show')
                                    <a href="{{ route('admin.add-items.show', $addItem->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">
                                        <i class="fas fa-eye mr-1"></i>{{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('add_item_edit')
                                    <a href="{{ route('admin.add-items.edit', $addItem->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                                        <i class="fas fa-edit mr-1"></i>{{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('add_item_delete')
                                    <form action="{{ route('admin.add-items.destroy', $addItem->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200">
                                            <i class="fas fa-trash mr-1"></i>{{ trans('global.delete') }}
                                        </button>
                                    </form>
                                @endcan
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
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwind.min.js"></script>

<script>
$(function () {
    // Main DataTable
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('add_item_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.add-items.massDestroy') }}",
        className: 'bg-red-600 text-white px-3 py-1 rounded-md',
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

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [[ 1, 'desc' ]],
        pageLength: 25,
    });

    $('.datatable-AddItem:not(.ajaxTable)').DataTable({ buttons: dtButtons });
});

// Modal table init function
function initModal(id) {
    let tableId = '#modalTable-' + id;
    if (!$.fn.DataTable.isDataTable(tableId)) {
        $(tableId).DataTable({
            pageLength: 25,
            lengthMenu: [25, 50, 100, 500, -1],
            scrollY: "400px",
            scrollCollapse: true,
            responsive: true,
            autoWidth: false,
        });
    }
}
</script>
@endsection
