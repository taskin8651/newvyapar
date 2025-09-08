@extends('layouts.admin')
@section('content')

<div class="space-y-6">

    {{-- Add Item Button --}}
    @can('add_item_create')
        <div class="flex space-x-2">
            <a href="{{ route('admin.add-items.create') }}"
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                <i class="fas fa-plus mr-2"></i>
                {{ trans('global.add') }} {{ trans('cruds.addItem.title_singular') }}
            </a>

           {{-- CSV Import Button --}}
           <div x-data="{ openCsvModal: false }"> {{-- AlpineJS wrapper --}}
    <button 
        @click="openCsvModal = true"
        class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition">
        <i class="fas fa-file-csv mr-2"></i>
        {{ trans('global.app_csvImport') }}
    </button>

   

            @include('csvImport.modal', ['model' => 'AddItem', 'route' => 'admin.add-items.parseCsvImport'])
        </div>
        </div>
    @endcan

    {{-- Items Table Card --}}
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
                        <!-- <th class="px-4 py-3">{{ trans('cruds.addItem.fields.disc_on_sale_price') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.disc_type') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.wholesale_price') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.select_type_wholesale') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.minimum_wholesale_qty') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.purchase_price') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.select_purchase_type') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.addItem.fields.select_tax') }}</th> -->
                        <th class="px-4 py-3">{{ trans('cruds.taxRate.fields.parcentage') }}</th>
                        <th class="px-4 py-3 text-center">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($addItems as $key => $addItem)
                        <tr class="hover:bg-gray-50" data-entry-id="{{ $addItem->id }}">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $addItem->id ?? '' }}</td>
                            <td class="px-4 py-3">{{ App\Models\AddItem::ITEM_TYPE_SELECT[$addItem->item_type] ?? '' }}</td>
                            <td class="px-4 py-3">{{ $addItem->item_name ?? '' }}</td>
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
                            <!-- <td class="px-4 py-3">{{ $addItem->disc_on_sale_price ?? '' }}</td>
                            <td class="px-4 py-3">{{ $addItem->disc_type ?? '' }}</td>
                            <td class="px-4 py-3">{{ $addItem->wholesale_price ?? '' }}</td>
                            <td class="px-4 py-3">{{ App\Models\AddItem::SELECT_TYPE_WHOLESALE_SELECT[$addItem->select_type_wholesale] ?? '' }}</td>
                            <td class="px-4 py-3">{{ $addItem->minimum_wholesale_qty ?? '' }}</td>
                            <td class="px-4 py-3">{{ $addItem->purchase_price ?? '' }}</td>
                            <td class="px-4 py-3">{{ App\Models\AddItem::SELECT_PURCHASE_TYPE_SELECT[$addItem->select_purchase_type] ?? '' }}</td>
                            <td class="px-4 py-3">{{ $addItem->select_tax->name ?? '' }}</td> -->
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
                                    <form action="{{ route('admin.add-items.destroy', $addItem->id) }}" method="POST"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                        @method('DELETE')
                                        @csrf
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
<script>
    $(function () {
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

        let table = $('.datatable-AddItem:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
