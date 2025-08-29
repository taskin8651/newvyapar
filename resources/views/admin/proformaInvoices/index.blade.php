@extends('layouts.admin')
@section('content')
<div class="content">
    @can('proforma_invoice_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.proforma-invoices.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.proformaInvoice.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'ProformaInvoice', 'route' => 'admin.proforma-invoices.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.proformaInvoice.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ProformaInvoice">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.select_customer') }}
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
                                        {{ trans('cruds.proformaInvoice.fields.billing_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.e_way_bill_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.po_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.po_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.item') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.qty') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.proformaInvoice.fields.document') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proformaInvoices as $key => $proformaInvoice)
                                    <tr data-entry-id="{{ $proformaInvoice->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $proformaInvoice->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->select_customer->party_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->select_customer->gstin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->select_customer->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->select_customer->pan_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->billing_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->e_way_bill_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->po_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->po_date ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($proformaInvoice->items as $key => $item)
                                                <span class="label label-info label-many">{{ $item->item_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $proformaInvoice->qty ?? '' }}
                                        </td>
                                        <td>
                                            @if($proformaInvoice->image)
                                                <a href="{{ $proformaInvoice->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $proformaInvoice->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($proformaInvoice->document)
                                                <a href="{{ $proformaInvoice->document->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('proforma_invoice_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.proforma-invoices.show', $proformaInvoice->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('proforma_invoice_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.proforma-invoices.edit', $proformaInvoice->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('proforma_invoice_delete')
                                                <form action="{{ route('admin.proforma-invoices.destroy', $proformaInvoice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('proforma_invoice_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.proforma-invoices.massDestroy') }}",
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
  let table = $('.datatable-ProformaInvoice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection