@extends('layouts.admin')
@section('content')
<div class="content">
    @can('bank_account_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.bank-accounts.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.bankAccount.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'BankAccount', 'route' => 'admin.bank-accounts.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.bankAccount.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BankAccount">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.account_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.opening_balance') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.as_of_date') }}
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
                                        {{ trans('cruds.bankAccount.fields.account_holder_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.upi') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.print_upi_qr') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankAccount.fields.print_bank_details') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bankAccounts as $key => $bankAccount)
                                    <tr data-entry-id="{{ $bankAccount->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $bankAccount->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->opening_balance ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->as_of_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->ifsc_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->bank_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->account_holder_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankAccount->upi ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $bankAccount->print_upi_qr ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $bankAccount->print_upi_qr ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $bankAccount->print_bank_details ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $bankAccount->print_bank_details ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('bank_account_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.bank-accounts.show', $bankAccount->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bank_account_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.bank-accounts.edit', $bankAccount->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bank_account_delete')
                                                <form action="{{ route('admin.bank-accounts.destroy', $bankAccount->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bank_account_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bank-accounts.massDestroy') }}",
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
  let table = $('.datatable-BankAccount:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection