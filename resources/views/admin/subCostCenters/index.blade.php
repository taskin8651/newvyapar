@extends('layouts.admin')
@section('content')
<div class="content">
    @can('sub_cost_center_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.sub-cost-centers.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.subCostCenter.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'SubCostCenter', 'route' => 'admin.sub-cost-centers.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.subCostCenter.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SubCostCenter">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.main_cost_center') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.unique_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.mainCostCenter.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.sub_cost_center_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.unique_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.responsible_manager') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.budget_allocated') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.actual_expense') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.start_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.subCostCenter.fields.status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subCostCenters as $key => $subCostCenter)
                                    <tr data-entry-id="{{ $subCostCenter->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $subCostCenter->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subCostCenter->main_cost_center->cost_center_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subCostCenter->main_cost_center->unique_code ?? '' }}
                                        </td>
                                        <td>
                                            @if($subCostCenter->main_cost_center)
                                                {{ $subCostCenter->main_cost_center::STATUS_SELECT[$subCostCenter->main_cost_center->status] ?? '' }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $subCostCenter->sub_cost_center_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subCostCenter->unique_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subCostCenter->responsible_manager ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subCostCenter->budget_allocated ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subCostCenter->actual_expense ?? '' }}
                                        </td>
                                        <td>
                                            {{ $subCostCenter->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\SubCostCenter::STATUS_SELECT[$subCostCenter->status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('sub_cost_center_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.sub-cost-centers.show', $subCostCenter->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('sub_cost_center_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.sub-cost-centers.edit', $subCostCenter->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('sub_cost_center_delete')
                                                <form action="{{ route('admin.sub-cost-centers.destroy', $subCostCenter->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('sub_cost_center_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sub-cost-centers.massDestroy') }}",
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
  let table = $('.datatable-SubCostCenter:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection