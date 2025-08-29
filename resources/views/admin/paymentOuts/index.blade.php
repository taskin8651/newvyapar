@extends('layouts.admin')
@section('content')
<div class="content">
    @can('payment_out_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.payment-outs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.paymentOut.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'PaymentOut', 'route' => 'admin.payment-outs.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.paymentOut.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PaymentOut">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.parties') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.partyDetail.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.payment_type') }}
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
                                        {{ trans('cruds.paymentOut.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.reference_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.discount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.total') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.paymentOut.fields.attechment') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($paymentOuts as $key => $paymentOut)
                                    <tr data-entry-id="{{ $paymentOut->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $paymentOut->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->parties->party_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->parties->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->payment_type->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->payment_type->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->payment_type->ifsc_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->payment_type->bank_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->reference_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->discount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $paymentOut->total ?? '' }}
                                        </td>
                                        <td>
                                            @if($paymentOut->attechment)
                                                <a href="{{ $paymentOut->attechment->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $paymentOut->attechment->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('payment_out_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.payment-outs.show', $paymentOut->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('payment_out_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.payment-outs.edit', $paymentOut->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('payment_out_delete')
                                                <form action="{{ route('admin.payment-outs.destroy', $paymentOut->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('payment_out_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.payment-outs.massDestroy') }}",
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
  let table = $('.datatable-PaymentOut:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection