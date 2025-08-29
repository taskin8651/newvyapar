@extends('layouts.admin')
@section('content')
<div class="content">
    @can('cash_to_bank_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.cash-to-banks.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.cashToBank.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'CashToBank', 'route' => 'admin.cash-to-banks.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.cashToBank.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CashToBank">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.from') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.to') }}
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
                                        {{ trans('cruds.cashToBank.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.adjustment_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.cashToBank.fields.attechment') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cashToBanks as $key => $cashToBank)
                                    <tr data-entry-id="{{ $cashToBank->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $cashToBank->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashToBank->from ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashToBank->to->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashToBank->to->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashToBank->to->ifsc_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashToBank->to->bank_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashToBank->to->account_holder_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashToBank->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashToBank->adjustment_date ?? '' }}
                                        </td>
                                        <td>
                                            @if($cashToBank->attechment)
                                                <a href="{{ $cashToBank->attechment->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $cashToBank->attechment->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('cash_to_bank_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.cash-to-banks.show', $cashToBank->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('cash_to_bank_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.cash-to-banks.edit', $cashToBank->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('cash_to_bank_delete')
                                                <form action="{{ route('admin.cash-to-banks.destroy', $cashToBank->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('cash_to_bank_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cash-to-banks.massDestroy') }}",
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
  let table = $('.datatable-CashToBank:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection