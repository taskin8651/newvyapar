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

            <div class="flex gap-2 items-center">
                @can('expense_list_create')
                    <a href="{{ route('admin.expense-lists.create') }}"
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-plus mr-1"></i>
                        {{ trans('global.add') }} {{ trans('cruds.expenseList.title_singular') }}
                    </a>
                @endcan

                <input type="text" id="expenseListSearch"
                       placeholder="Search expenses..."
                       class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm
                              focus:ring focus:ring-blue-200 focus:border-blue-500
                              text-sm w-64">
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
                            Ledger
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
                            {{ trans('cruds.expenseList.fields.tax_include') }}
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                            {{ trans('global.actions') }}
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($expenseLists as $expenseList)
                    <tr data-entry-id="{{ $expenseList->id }}" class="hover:bg-gray-50">

                        <td class="px-4 py-3"></td>

                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $expenseList->id }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $expenseList->entry_date }}
                        </td>

                        <!-- Ledger -->
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ optional($expenseList->ledger)->ledger_name ?? 'N/A' }}
                        </td>

                        <!-- Expense Category -->
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ optional(optional($expenseList->ledger)->expense_category)->expense_category ?? 'N/A' }}
                        </td>

                        <!-- Category Type -->
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ optional(optional($expenseList->ledger)->expense_category)->type ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $expenseList->amount }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $expenseList->description }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ optional($expenseList->payment)->account_name ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ App\Models\ExpenseList::TAX_INCLUDE_RADIO[$expenseList->tax_include] ?? '' }}
                        </td>

                        <!-- Actions -->
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
                                <form action="{{ route('admin.expense-lists.destroy', $expenseList->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                    @csrf
                                    @method('DELETE')
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
    let table = $('.datatable-ExpenseList:not(.ajaxTable)').DataTable({
        orderCellsTop: true,
        order: [[1, 'desc']],
        pageLength: 25,
        dom: 'lrtip'
    });

    $('#expenseListSearch').on('keyup change clear', function () {
        table.search(this.value).draw();
    });
});
</script>
@endsection
