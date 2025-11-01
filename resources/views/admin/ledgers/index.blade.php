@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 border-b pb-4 gap-3">
            <h6 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-book text-indigo-600"></i>
                Ledger {{ trans('global.list') }}
            </h6>

            <div class="flex flex-wrap gap-2 items-center">
               
                    <!-- Add Ledger -->
                    <a href="{{ route('admin.ledgers.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        Add Ledger
                    </a>
               

                <!-- Back to Expense Category -->
                <a href="{{ route('admin.expense-categories.index') }}"
                   class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow flex items-center gap-2">
                    <i class="fas fa-tags"></i>
                    Expense Categories
                </a>

                <!-- Search bar -->
                <input type="text" id="ledgerSearch" placeholder="Search ledgers..."
                    class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-Ledger">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ledger Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Opening Balance</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expense Category</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($ledgers as $ledger)
                        <tr data-entry-id="{{ $ledger->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $ledger->id }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $ledger->ledger_name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ number_format($ledger->opening_balance, 2) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $ledger->expense_category->expense_category ?? '—' }}
                            </td>
                            <td class="px-4 py-3 text-center space-x-1">
                              
                                    <a href="{{ route('admin.ledgers.show', $ledger->id) }}" 
                                       class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                
                             
                                    <a href="{{ route('admin.ledgers.edit', $ledger->id) }}" 
                                       class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                            
                                    <form action="{{ route('admin.ledgers.destroy', $ledger->id) }}" method="POST" 
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                            
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

    @can('ledger_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.ledgers.massDestroy') }}",
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
        order: [[0, 'desc']],
        pageLength: 25,
        dom: 'lrtip'
    });

    let table = $('.datatable-Ledger:not(.ajaxTable)').DataTable({ buttons: dtButtons })

    // ✅ Custom Search
    $('#ledgerSearch').on('keyup change clear', function () {
        table.search(this.value).draw();
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });
})
</script>
@endsection
