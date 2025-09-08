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

                    <!-- Modal Include -->
                    @include('csvImport.modal', [
                        'model' => 'CurrentStock', 
                        'route' => 'admin.current-stocks.parseCsvImport'
                    ])
                @endcan

                <!-- Search bar -->
                <div>
                    <input type="text" id="currentStockSearch" placeholder="Search stocks..."
                        class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
                </div>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.currentStock.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CurrentStock">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.currentStock.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.currentStock.fields.item') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.currentStock.fields.parties') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.partyDetail.fields.gstin') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.partyDetail.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.partyDetail.fields.pan_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.currentStock.fields.qty') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.currentStock.fields.type') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($currentStocks as $key => $currentStock)
                                    <tr data-entry-id="{{ $currentStock->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $currentStock->id ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($currentStock->items as $key => $item)
                                                <span class="label label-info label-many">{{ $item->item_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $currentStock->parties->party_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $currentStock->parties->gstin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $currentStock->parties->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $currentStock->parties->pan_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $currentStock->qty ?? '' }}
                                        </td>
                                        <td>
                                            {{ $currentStock->type ?? '' }}
                                        </td>
                                        <td>
                                            @can('current_stock_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.current-stocks.show', $currentStock->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('current_stock_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.current-stocks.edit', $currentStock->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('current_stock_delete')
                                                <form action="{{ route('admin.current-stocks.destroy', $currentStock->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 25,
            dom: 'lrtip' // disable default search box
        });

        let table = $('.datatable-CurrentStock:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        // ✅ Custom search input
        $('#currentStockSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
