@extends('layouts.admin')
@section('content')
<div class="content">
    @can('bank_to_bank_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.bank-to-banks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.bankToBank.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'BankToBank', 'route' => 'admin.bank-to-banks.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.bankToBank.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BankToBank">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.from') }}
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
                                        {{ trans('cruds.bankToBank.fields.to') }}
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
                                        {{ trans('cruds.bankToBank.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.adjustment_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bankToBank.fields.attechment') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bankToBanks as $key => $bankToBank)
                                    <tr data-entry-id="{{ $bankToBank->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $bankToBank->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->from->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->from->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->from->ifsc_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->from->bank_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->from->account_holder_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->to->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->to->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->to->ifsc_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->to->bank_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->to->account_holder_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bankToBank->adjustment_date ?? '' }}
                                        </td>
                                        <td>
                                            @if($bankToBank->attechment)
                                                <a href="{{ $bankToBank->attechment->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $bankToBank->attechment->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('bank_to_bank_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.bank-to-banks.show', $bankToBank->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bank_to_bank_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.bank-to-banks.edit', $bankToBank->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bank_to_bank_delete')
                                                <form action="{{ route('admin.bank-to-banks.destroy', $bankToBank->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bank_to_bank_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bank-to-banks.massDestroy') }}",
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
  let table = $('.datatable-BankToBank:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection