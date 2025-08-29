@extends('layouts.admin')
@section('content')
<div class="content">
    @can('purchase_order_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.purchase-orders.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.purchaseOrder.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'PurchaseOrder', 'route' => 'admin.purchase-orders.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.purchaseOrder.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PurchaseOrder">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.select_customer') }}
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
                                        {{ trans('cruds.purchaseOrder.fields.billing_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.e_way_bill_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.po_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.po_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.item') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.qty') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.document') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.purchaseOrder.fields.payment_type') }}
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
                                        {{ trans('cruds.purchaseOrder.fields.reference_no') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseOrders as $key => $purchaseOrder)
                                    <tr data-entry-id="{{ $purchaseOrder->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $purchaseOrder->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->select_customer->party_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->select_customer->gstin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->select_customer->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->select_customer->pan_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->billing_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->e_way_bill_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->po_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->po_date ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($purchaseOrder->items as $key => $item)
                                                <span class="label label-info label-many">{{ $item->item_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->qty ?? '' }}
                                        </td>
                                        <td>
                                            @if($purchaseOrder->image)
                                                <a href="{{ $purchaseOrder->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $purchaseOrder->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($purchaseOrder->document)
                                                <a href="{{ $purchaseOrder->document->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->payment_type->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->payment_type->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->payment_type->ifsc_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->payment_type->bank_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->payment_type->account_holder_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $purchaseOrder->reference_no ?? '' }}
                                        </td>
                                        <td>
                                            @can('purchase_order_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.purchase-orders.show', $purchaseOrder->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('purchase_order_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.purchase-orders.edit', $purchaseOrder->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('purchase_order_delete')
                                                <form action="{{ route('admin.purchase-orders.destroy', $purchaseOrder->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('purchase_order_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.purchase-orders.massDestroy') }}",
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
  let table = $('.datatable-PurchaseOrder:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection