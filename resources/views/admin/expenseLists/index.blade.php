@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-wallet text-indigo-600"></i>
                {{ trans('cruds.expenseList.title_singular') }} {{ trans('global.list') }}
            </h2>

            <div class="flex gap-2 items-center" x-data="{ openCsvModal: false }">
                @can('expense_list_create')
                    <!-- Add New -->
                    <a href="{{ route('admin.expense-lists.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.expenseList.title_singular') }}
                    </a>

                    <!-- CSV Import -->
                    <button 
                        @click="openCsvModal = true"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                    </button>

                    <!-- Modal Include -->
                    @include('csvImport.modal', [
                        'model' => 'ExpenseList', 
                        'route' => 'admin.expense-lists.parseCsvImport'
                    ])
                @endcan

                <!-- Search bar -->
                <div>
                    <input type="text" id="expenseListSearch" placeholder="Search expenses..."
                        class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-ExpenseList">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.expenseList.fields.id') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.expenseList.fields.entry_date') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.expenseList.fields.category') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.expenseCategory.fields.type') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.expenseList.fields.amount') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.expenseList.fields.description') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.expenseList.fields.payment') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.bankAccount.fields.account_number') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.bankAccount.fields.ifsc_code') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.bankAccount.fields.bank_name') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            {{ trans('cruds.expenseList.fields.tax_include') }}
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                            {{ trans('global.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($expenseLists as $key => $expenseList)
                        <tr data-entry-id="{{ $expenseList->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseList->id ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseList->entry_date ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseList->category->expense_category ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @if($expenseList->category)
                                   {{ \App\Models\ExpenseCategory::CATEGORY_TYPE_SELECT[$expenseList->category->category_type] ?? '' }}

                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseList->amount ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseList->description ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseList->payment->account_name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseList->payment->account_number ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseList->payment->ifsc_code ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $expenseList->payment->bank_name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ App\Models\ExpenseList::TAX_INCLUDE_RADIO[$expenseList->tax_include] ?? '' }}</td>
                            <td class="px-4 py-3 text-center space-x-1">
                                @can('expense_list_show')
                                    <a href="{{ route('admin.expense-lists.show', $expenseList->id) }}" 
                                       class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('expense_list_edit')
                                    <a href="{{ route('admin.expense-lists.edit', $expenseList->id) }}" 
                                       class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('expense_list_delete')
                                    <form action="{{ route('admin.expense-lists.destroy', $expenseList->id) }}" method="POST" 
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" 
                                            class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
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

        @can('expense_list_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.expense-lists.massDestroy') }}",
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
            dom: 'lrtip' // 👈 disables default search box
        });

        let table = $('.datatable-ExpenseList:not(.ajaxTable)').DataTable({ buttons: dtButtons })

        // ✅ Custom search input
        $('#expenseListSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
