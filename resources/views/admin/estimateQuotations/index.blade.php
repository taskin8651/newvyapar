@extends('layouts.admin')
@section('content')
<div class="content">
    @can('estimate_quotation_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.estimate-quotations.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.estimateQuotation.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'EstimateQuotation', 'route' => 'admin.estimate-quotations.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.estimateQuotation.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EstimateQuotation">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.select_customer') }}
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
                                        {{ trans('cruds.estimateQuotation.fields.billing_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.phone_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.e_way_bill_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.po_no') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.po_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.item') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.qty') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.estimateQuotation.fields.document') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($estimateQuotations as $key => $estimateQuotation)
                                    <tr data-entry-id="{{ $estimateQuotation->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $estimateQuotation->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->select_customer->party_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->select_customer->gstin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->select_customer->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->select_customer->pan_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->billing_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->phone_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->e_way_bill_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->po_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->po_date ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($estimateQuotation->items as $key => $item)
                                                <span class="label label-info label-many">{{ $item->item_name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $estimateQuotation->qty ?? '' }}
                                        </td>
                                        <td>
                                            @if($estimateQuotation->image)
                                                <a href="{{ $estimateQuotation->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $estimateQuotation->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($estimateQuotation->document)
                                                <a href="{{ $estimateQuotation->document->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('estimate_quotation_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.estimate-quotations.show', $estimateQuotation->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('estimate_quotation_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.estimate-quotations.edit', $estimateQuotation->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('estimate_quotation_delete')
                                                <form action="{{ route('admin.estimate-quotations.destroy', $estimateQuotation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('estimate_quotation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.estimate-quotations.massDestroy') }}",
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
  let table = $('.datatable-EstimateQuotation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection