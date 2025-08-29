@extends('layouts.admin')
@section('content')
<div class="content">
    @can('expense_list_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.expense-lists.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.expenseList.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'ExpenseList', 'route' => 'admin.expense-lists.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.expenseList.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ExpenseList">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.entry_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expenseCategory.fields.type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.payment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.account_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.ifsc_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.bank_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.expenseList.fields.tax_include') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expenseLists as $key => $expenseList)
                                    <tr data-entry-id="{{ $expenseList->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $expenseList->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expenseList->entry_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expenseList->category->expense_category ?? '' }}
                                        </td>
                                        <td>
                                            @if($expenseList->category)
                                                {{ $expenseList->category::TYPE_SELECT[$expenseList->category->type] ?? '' }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $expenseList->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expenseList->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expenseList->payment->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expenseList->payment->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expenseList->payment->ifsc_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $expenseList->payment->bank_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\ExpenseList::TAX_INCLUDE_RADIO[$expenseList->tax_include] ?? '' }}
                                        </td>
                                        <td>
                                            @can('expense_list_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.expense-lists.show', $expenseList->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('expense_list_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.expense-lists.edit', $expenseList->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('expense_list_delete')
                                                <form action="{{ route('admin.expense-lists.destroy', $expenseList->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-ExpenseList:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection