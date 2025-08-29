@extends('layouts.admin')
@section('content')
<div class="content">
    @can('purchase_bill_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.purchase-bills.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.purchaseBill.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'PurchaseBill', 'route' => 'admin.purchase-bills.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.purchaseBill.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PurchaseBill">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.select_customer') }}
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
                                        {{ trans('cruds.purchaseBill.fields.billing_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.e_way_bill_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.po_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.po_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.item') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.qty') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.document') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseBill.fields.payment_type') }}
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
                                        {{ trans('cruds.purchaseBill.fields.reference_no') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseBills as $key => $purchaseBill)
                                    <tr data-entry-id="{{ $purchaseBill->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $purchaseBill->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->select_customer->party_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->select_customer->gstin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->select_customer->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->select_customer->pan_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->billing_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->e_way_bill_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->po_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->po_date ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($purchaseBill->items as $key => $item)
                                                <span class="label label-info label-many">{{ $item->item_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $purchaseBill->qty ?? '' }}
                                        </td>
                                        <td>
                                            @if($purchaseBill->image)
                                                <a href="{{ $purchaseBill->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $purchaseBill->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($purchaseBill->document)
                                                <a href="{{ $purchaseBill->document->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $purchaseBill->payment_type->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->payment_type->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->payment_type->ifsc_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->payment_type->bank_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->payment_type->account_holder_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseBill->reference_no ?? '' }}
                                        </td>
                                        <td>
                                            @can('purchase_bill_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.purchase-bills.show', $purchaseBill->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('purchase_bill_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.purchase-bills.edit', $purchaseBill->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('purchase_bill_delete')
                                                <form action="{{ route('admin.purchase-bills.destroy', $purchaseBill->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('purchase_bill_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.purchase-bills.massDestroy') }}",
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
  let table = $('.datatable-PurchaseBill:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection