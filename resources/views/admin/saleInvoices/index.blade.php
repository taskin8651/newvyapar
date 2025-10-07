@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-file-invoice text-indigo-600"></i>
                {{ trans('cruds.saleInvoice.title_singular') }} {{ trans('global.list') }}
            </h2>
            <div class="flex gap-2">
                  <div x-data="{ openCsvModal: false }" class="flex gap-2">
                @can('sale_invoice_create')
                    <a href="{{ route('admin.sale-invoices.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.saleInvoice.title_singular') }}
                    </a>

                        <button 
                            @click="openCsvModal = true"
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                            <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                        </button>

                        <!-- Modal Include -->
                        @include('csvImport.modal', [
                            'model' => 'SaleInvoice', 
                            'route' => 'admin.sale-invoices.parseCsvImport'
                        ])
                @endcan

                <!-- Search bar -->
                <div>
                    <input type="text" id="saleInvoiceSearch" placeholder="Search invoices..."
                        class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
                </div>
            </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-SaleInvoice">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.select_customer') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.gstin') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.phone_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.pan_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.billing_name') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.phone_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.e_way_bill_no') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.po_no') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.po_date') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.item') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.qty') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.image') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.document') }}</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($saleInvoices as $key => $saleInvoice)
                        <tr data-entry-id="{{ $saleInvoice->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->id ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->select_customer->party_name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->select_customer->gstin ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->select_customer->phone_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->select_customer->pan_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->billing_name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->phone_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->e_way_bill_no ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->po_no ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->po_date ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($saleInvoice->items as $item)
                                    <span class="inline-block bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded">{{ $item->item_name }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->qty ?? '' }}</td>
                            <td class="px-4 py-3">
                                @if($saleInvoice->image)
                                    <a href="{{ $saleInvoice->image->getUrl() }}" target="_blank" class="inline-block">
                                        <img src="{{ $saleInvoice->image->getUrl('thumb') }}" class="h-10 w-10 rounded border">
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($saleInvoice->document)
                                    <a href="{{ $saleInvoice->document->getUrl() }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                           <td class="px-4 py-3 text-center relative"
    x-data="{ open: false }"
    @mouseenter="open = true"
    @mouseleave="open = false">

    <!-- Ellipsis icon -->
    <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
        <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
    </button>

    <!-- Dropdown menu -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform translate-y-1"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-1"
         class="absolute top-full left-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
         style="display: none;">

        @can('sale_invoice_show')
            <a href="{{ route('admin.sale-invoices.show', $saleInvoice->id) }}"
               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <i class="fas fa-eye mr-2"></i> {{ trans('global.view') }}
            </a>
        @endcan

        @can('sale_invoice_edit')
            <a href="{{ route('admin.sale-invoices.edit', $saleInvoice->id) }}"
               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 rounded-lg transition-colors">
                <i class="fas fa-edit mr-2"></i> {{ trans('global.edit') }}
            </a>
        @endcan

        @can('sale_invoice_delete')
            <form action="{{ route('admin.sale-invoices.destroy', $saleInvoice->id) }}"
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

            <a href="{{ route('admin.sale-invoices.pdf', $saleInvoice->id) }}" target="_blank"
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

        @can('sale_invoice_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.sale-invoices.massDestroy') }}",
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
            dom: 'lrtip' // 👈 default search hide
        });

        let table = $('.datatable-SaleInvoice:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        // Custom search bar
        $('#saleInvoiceSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
