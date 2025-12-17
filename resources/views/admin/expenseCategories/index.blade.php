@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 border-b pb-4 gap-3">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-tags text-indigo-600"></i>
                {{ trans('cruds.expenseCategory.title_singular') }} {{ trans('global.list') }}
            </h2>

            <div class="flex flex-wrap gap-2 items-center" x-data="{ openCsvModal: false }">
                @can('expense_category_create')
                    <!-- 🆕 Ledger Button -->
                    <a href="{{ route('admin.ledgers.index') }}"
                       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow flex items-center gap-2">
                        <i class="fas fa-book"></i> Ledger
                    </a>

                    <!-- Add New -->
                    <a href="{{ route('admin.expense-categories.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        {{ trans('global.add') }} {{ trans('cruds.expenseCategory.title_singular') }}
                    </a>

                    <!-- CSV Import -->
                    <button 
                        @click="openCsvModal = true"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow flex items-center gap-2">
                        <i class="fas fa-file-csv"></i> {{ trans('global.app_csvImport') }}
                    </button>

                    <!-- CSV Import Modal -->
                    @include('csvImport.modal', [
                        'model' => 'ExpenseCategory', 
                        'route' => 'admin.expense-categories.parseCsvImport'
                    ])
                @endcan

                <!-- Search bar -->
                <input type="text" id="expenseCategorySearch" placeholder="Search categories..."
                    class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 text-sm w-64">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-ExpenseCategory">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.expenseCategory.fields.id') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.expenseCategory.fields.expense_category') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category Type
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                           Ledger Name
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('global.actions') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($expenseCategories as $expenseCategory)
                        <tr data-entry-id="{{ $expenseCategory->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseCategory->id ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseCategory->expense_category ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ ucfirst($expenseCategory->type ?? '—') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @if($expenseCategory->ledgers->count())
                                    <ul class="mb-0 pl-3">
                                        @foreach($expenseCategory->ledgers as $ledger)
                                            <li>{{ $ledger->ledger_name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center space-x-1">
                                @can('expense_category_show')
                                    <a href="{{ route('admin.expense-categories.show', $expenseCategory->id) }}" 
                                       class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan

                                @can('expense_category_edit')
                                    <a href="{{ route('admin.expense-categories.edit', $expenseCategory->id) }}" 
                                       class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan

                                @can('expense_category_delete')
                                    <form action="{{ route('admin.expense-categories.destroy', $expenseCategory->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');" 
                                          class="inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" 
                                            class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700" title="Delete">
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

    @can('expense_category_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
    let deleteButton = {
        text: deleteButtonTrans,
        url: "{{ route('admin.expense-categories.massDestroy') }}",
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
        dom: 'lrtip'
    });

    let table = $('.datatable-ExpenseCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })

    // ✅ Custom Search
    $('#expenseCategorySearch').on('keyup change clear', function () {
        table.search(this.value).draw();
    });

    $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });
})
</script>
@endsection
