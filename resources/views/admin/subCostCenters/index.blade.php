@extends('layouts.admin')
@section('content')
<script src="//unpkg.com/alpinejs" defer></script>

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
                           <td class="px-4 py-3 text-center relative" 
    x-data="{ open: false }" 
    @mouseenter="open = true" 
    @mouseleave="open = false">

    <!-- Ellipsis icon -->
    <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
        <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
    </button>

    <!-- Dropdown menu (top-left of icon) -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform translate-y-1"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-1"
         class="absolute bottom-full left-0 mb-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-20">

        @can('main_cost_center_show')
            <a href="{{ route('admin.sub-cost-centers.show', $subCostCenter->id) }}"
               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                <i class="fas fa-eye mr-2"></i> {{ trans('global.view') }}
            </a>
        @endcan

        @can('main_cost_center_edit')
            <a href="{{ route('admin.sub-cost-centers.edit', $subCostCenter->id) }}"
               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 rounded-lg transition-colors">
                <i class="fas fa-edit mr-2"></i> {{ trans('global.edit') }}
            </a>
        @endcan

        @can('main_cost_center_delete')
            <form action="{{ route('admin.sub-cost-centers.destroy', $subCostCenter->id) }}" 
                  method="POST" 
                  onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                @method('DELETE')
                @csrf
                <button type="submit" 
                        class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-colors">
                    <i class="fas fa-trash mr-2"></i> {{ trans('global.delete') }}
                </button>
            </form>
        @endcan

        @can('main_cost_center_pdf')
            <a href="{{ route('admin.main-cost-centers.pdf', $mainCostCenter->id) }}" target="_blank"
               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors">
                <i class="fas fa-file-pdf mr-2"></i> {{ trans('global.print') }}
            </a>
        @endcan

    </div>
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