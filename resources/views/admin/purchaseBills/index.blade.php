@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-file-invoice-dollar text-indigo-600"></i>
                {{ trans('cruds.purchaseBill.title_singular') }} {{ trans('global.list') }}
            </h2>
            <div class="flex gap-2">
                <div x-data="{ openCsvModal: false }" class="flex gap-2">
                @can('purchase_bill_create')
                    <a href="{{ route('admin.purchase-bills.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.purchaseBill.title_singular') }}
                    </a>

                      <button 
                            @click="openCsvModal = true"
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                            <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                        </button>
                    @include('csvImport.modal', [
                        'model' => 'PurchaseBill', 
                        'route' => 'admin.purchase-bills.parseCsvImport'
                    ])
                @endcan

                <!-- Search bar -->
                <div>
                    <input type="text" id="purchaseSearch" placeholder="Search bills..."
                        class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
                </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-PurchaseBill">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.purchaseBill.fields.billing_name') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.purchaseBill.fields.select_customer') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.purchaseBill.fields.e_way_bill_no') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.purchaseBill.fields.po_no') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.purchaseBill.fields.po_date') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.purchaseBill.fields.item') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.purchaseBill.fields.qty') }}</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($purchaseBills as $purchaseBill)
                        @php
                            $itemCount = $purchaseBill->items->count();
                        @endphp
                        <tr data-entry-id="{{ $purchaseBill->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $purchaseBill->id ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $purchaseBill->purchase_invoice_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $purchaseBill->select_customer->party_name ?? '' }}</td>
                            
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $purchaseBill->total ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $purchaseBill->e_way_bill_no ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $purchaseBill->po_no ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $purchaseBill->po_date ?? '' }}</td>

                            <!-- Items -->
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($purchaseBill->items as $item)
                                    <span class="inline-block bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded mb-1">
                                        {{ $item->item_name }}
                                    </span>
                                @endforeach
                            </td>

                            <!-- Qty -->
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($purchaseBill->items as $item)
                                    <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded mb-1">
                                        {{ $item->pivot->qty }}
                                    </span>
                                @endforeach
                            </td>

                            
                            <!-- Actions -->
                            <td class="px-4 py-3 text-center relative"
                                x-data="{ open: false }"
                                @mouseenter="open = true"
                                @mouseleave="open = false">

                                <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
                                    <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                </button>

                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform translate-y-1"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform translate-y-0"
                                     x-transition:leave-end="opacity-0 transform translate-y-1"
                                     class="absolute top-full left-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                                     style="display: none;">

                                    @can('purchase_bill_show')
                                        <a href="{{ route('admin.purchase-bills.show', $purchaseBill->id) }}"
                                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                                            <i class="fas fa-eye mr-2"></i> {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('purchase_bill_edit')
                                        <a href="{{ route('admin.purchase-bills.edit', $purchaseBill->id) }}"
                                           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 rounded-lg transition-colors">
                                            <i class="fas fa-edit mr-2"></i> {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('purchase_bill_delete')
                                        <form action="{{ route('admin.purchase-bills.destroy', $purchaseBill->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                    class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors">
                                                <i class="fas fa-trash mr-2"></i> {{ trans('global.delete') }}
                                            </button>
                                        </form>
                                    @endcan

                                    <a href="{{ route('admin.purchase-bills.pdf', $purchaseBill->id) }}" target="_blank"
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

    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        @can('purchase_bill_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.purchase-bills.massDestroy') }}",
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

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 25,
            dom: 'Brtip',
        });

        let table = $('.datatable-PurchaseBill:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        });

        $('#purchaseSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
