@extends('layouts.admin')
@section('content')
<div class="content">
    @can('sub_cost_center_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a href="{{ route('admin.sub-cost-centers.create') }}"
                     class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
            <i class="fas fa-plus mr-2"></i>
                    {{ trans('global.add') }} {{ trans('cruds.subCostCenter.title_singular') }}
                </a>
                <button class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow" data-toggle="modal" data-target="#csvImportModal">
                     <i class="fas fa-file-csv mr-2"></i>
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'SubCostCenter', 'route' => 'admin.sub-cost-centers.parseCsvImport'])
            </div>
        </div>
    @endcan
<div class="bg-white shadow rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">
            {{ trans('cruds.subCostCenter.title_singular') }} {{ trans('global.list') }}
        </h3>
    </div>

    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600 datatable datatable-SubCostCenter">
                <thead class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 w-12"></th>
                        <th class="px-4 py-3">{{ trans('cruds.subCostCenter.fields.id') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.subCostCenter.fields.main_cost_center') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.mainCostCenter.fields.unique_code') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.mainCostCenter.fields.status') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.subCostCenter.fields.sub_cost_center_name') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.subCostCenter.fields.unique_code') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.subCostCenter.fields.responsible_manager') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.subCostCenter.fields.budget_allocated') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.subCostCenter.fields.actual_expense') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.subCostCenter.fields.start_date') }}</th>
                        <th class="px-4 py-3">{{ trans('cruds.subCostCenter.fields.status') }}</th>
                        <th class="px-4 py-3 text-center">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($subCostCenters as $key => $subCostCenter)
                        <tr class="hover:bg-gray-50" data-entry-id="{{ $subCostCenter->id }}">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $subCostCenter->id ?? '' }}</td>
                            <td class="px-4 py-3">{{ $subCostCenter->main_cost_center->cost_center_name ?? '' }}</td>
                            <td class="px-4 py-3">{{ $subCostCenter->main_cost_center->unique_code ?? '' }}</td>
                            <td class="px-4 py-3">
                                @if($subCostCenter->main_cost_center)
                                    {{ $subCostCenter->main_cost_center::STATUS_SELECT[$subCostCenter->main_cost_center->status] ?? '' }}
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $subCostCenter->sub_cost_center_name ?? '' }}</td>
                            <td class="px-4 py-3">{{ $subCostCenter->unique_code ?? '' }}</td>
                            <td class="px-4 py-3">{{ $subCostCenter->responsible_manager ?? '' }}</td>
                            <td class="px-4 py-3">{{ $subCostCenter->budget_allocated ?? '' }}</td>
                            <td class="px-4 py-3">{{ $subCostCenter->actual_expense ?? '' }}</td>
                            <td class="px-4 py-3">{{ $subCostCenter->start_date ?? '' }}</td>
                            <td class="px-4 py-3">
                                {{ App\Models\SubCostCenter::STATUS_SELECT[$subCostCenter->status] ?? '' }}
                            </td>
                            <td class="px-4 py-3 flex items-center justify-center gap-2">
                                @can('sub_cost_center_show')
                                    <a href="{{ route('admin.sub-cost-centers.show', $subCostCenter->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">
                                       <i class="fas fa-eye mr-1"></i>{{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sub_cost_center_edit')
                                    <a href="{{ route('admin.sub-cost-centers.edit', $subCostCenter->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                                       <i class="fas fa-edit mr-1"></i>{{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sub_cost_center_delete')
                                    <form action="{{ route('admin.sub-cost-centers.destroy', $subCostCenter->id) }}" method="POST"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200">
                                            <i class="fas fa-trash mr-1"></i>{{ trans('global.delete') }}
                                        </button>
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