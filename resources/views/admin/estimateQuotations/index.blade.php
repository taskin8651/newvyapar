@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-file-signature text-indigo-600"></i>
                {{ trans('cruds.estimateQuotation.title_singular') }} {{ trans('global.list') }}
            </h2>
            <div class="flex gap-2">
                <div x-data="{ openCsvModal: false }" class="flex gap-2">
                @can('estimate_quotation_create')
                    <a href="{{ route('admin.estimate-quotations.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.estimateQuotation.title_singular') }}
                    </a>

                    <button 
                            @click="openCsvModal = true"
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                            <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                        </button>

                    <!-- Modal Include -->
                    @include('csvImport.modal', [
                        'model' => 'EstimateQuotation', 
                        'route' => 'admin.estimate-quotations.parseCsvImport'
                    ])
                @endcan

                <!-- Search bar -->
                <div>
                    <input type="text" id="estimateSearch" placeholder="Search quotations..."
                        class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
                </div>
            </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-EstimateQuotation">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.select_customer') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.gstin') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.phone_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.pan_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.billing_name') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.phone_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.e_way_bill_no') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.po_no') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.po_date') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.item') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.qty') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.image') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.estimateQuotation.fields.document') }}</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($estimateQuotations as $estimateQuotation)
                        <tr data-entry-id="{{ $estimateQuotation->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->id ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->select_customer->party_name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->select_customer->gstin ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->select_customer->phone_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->select_customer->pan_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->billing_name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->phone_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->e_way_bill_no ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->po_no ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->po_date ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($estimateQuotation->items as $item)
                                    <span class="inline-block bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded">{{ $item->item_name }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $estimateQuotation->qty ?? '' }}</td>
                            <td class="px-4 py-3">
                                @if($estimateQuotation->image)
                                    <a href="{{ $estimateQuotation->image->getUrl() }}" target="_blank" class="inline-block">
                                        <img src="{{ $estimateQuotation->image->getUrl('thumb') }}" class="h-10 w-10 rounded border">
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($estimateQuotation->document)
                                    <a href="{{ $estimateQuotation->document->getUrl() }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center space-x-1">
                                @can('estimate_quotation_show')
                                    <a href="{{ route('admin.estimate-quotations.show', $estimateQuotation->id) }}" class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('estimate_quotation_edit')
                                    <a href="{{ route('admin.estimate-quotations.edit', $estimateQuotation->id) }}" class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('estimate_quotation_delete')
                                    <form action="{{ route('admin.estimate-quotations.destroy', $estimateQuotation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                                @can('estimate_quotation_show')
                                    <a href="{{ route('admin.estimate-quotations.invoice', $estimateQuotation->id) }}" 
                                    class="px-2 py-1 bg-purple-600 text-white rounded text-xs hover:bg-purple-700">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>
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

        @can('estimate_quotation_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.estimate-quotations.massDestroy') }}",
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
            dom: 'lrtip' // 👈 default search disable
        });

        let table = $('.datatable-EstimateQuotation:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        // Custom search bar
        $('#estimateSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
