@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-file-invoice text-indigo-600"></i>
                {{ trans('cruds.proformaInvoice.title_singular') }} {{ trans('global.list') }}
            </h2>
            <div class="flex gap-2">
                 <div x-data="{ openCsvModal: false }" class="flex gap-2">
                @can('proforma_invoice_create')
                    <a href="{{ route('admin.proforma-invoices.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.proformaInvoice.title_singular') }}
                    </a>

                     <button 
                            @click="openCsvModal = true"
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                            <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                        </button>

                    <!-- Modal Include -->
                    @include('csvImport.modal', [
                        'model' => 'ProformaInvoice', 
                        'route' => 'admin.proforma-invoices.parseCsvImport'
                    ])
                @endcan

                <!-- Search bar -->
                <div>
                    <input type="text" id="proformaSearch" placeholder="Search invoices..."
                        class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
                </div>
            </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-ProformaInvoice">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.select_customer') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.gstin') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.phone_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.pan_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.billing_name') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.phone_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.e_way_bill_no') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.po_no') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.po_date') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.item') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.qty') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.image') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.proformaInvoice.fields.document') }}</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($proformaInvoices as $proformaInvoice)
                        <tr data-entry-id="{{ $proformaInvoice->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->id ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->select_customer->party_name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->select_customer->gstin ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->select_customer->phone_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->select_customer->pan_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->billing_name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->phone_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->e_way_bill_no ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->po_no ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->po_date ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($proformaInvoice->items as $item)
                                    <span class="inline-block bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded">{{ $item->item_name }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->qty ?? '' }}</td>
                            <td class="px-4 py-3">
                                @if($proformaInvoice->image)
                                    <a href="{{ $proformaInvoice->image->getUrl() }}" target="_blank" class="inline-block">
                                        <img src="{{ $proformaInvoice->image->getUrl('thumb') }}" class="h-10 w-10 rounded border">
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($proformaInvoice->document)
                                    <a href="{{ $proformaInvoice->document->getUrl() }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center space-x-1">
                                @can('proforma_invoice_show')
                                    <a href="{{ route('admin.proforma-invoices.show', $proformaInvoice->id) }}" class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('proforma_invoice_edit')
                                    <a href="{{ route('admin.proforma-invoices.edit', $proformaInvoice->id) }}" class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('proforma_invoice_delete')
                                    <form action="{{ route('admin.proforma-invoices.destroy', $proformaInvoice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
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

    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        @can('proforma_invoice_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.proforma-invoices.massDestroy') }}",
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
            dom: 'lrtip' // disable default search
        });

        let table = $('.datatable-ProformaInvoice:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        // Custom search
        $('#proformaSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
