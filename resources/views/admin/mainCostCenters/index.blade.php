@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    {{-- Top Actions --}}
    @can('main_cost_center_create')
    <div class="flex flex-wrap items-center gap-3 mb-6">
        <a href="{{ route('admin.main-cost-centers.create') }}"
           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
            <i class="fas fa-plus mr-2"></i>
            {{ trans('global.add') }} {{ trans('cruds.mainCostCenter.title_singular') }}
        </a>
        <button class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow"
                data-toggle="modal" data-target="#csvImportModal">
            <i class="fas fa-file-csv mr-2"></i>
            {{ trans('global.app_csvImport') }}
        </button>
        @include('csvImport.modal', ['model' => 'MainCostCenter', 'route' => 'admin.main-cost-centers.parseCsvImport'])
    </div>
    @endcan

    {{-- Main Card --}}
    <div class="px-6 py-4 border-b border-gray-200">
      
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-project-diagram mr-2"></i>
                {{ trans('cruds.mainCostCenter.title_singular') }} {{ trans('global.list') }}
            </h3>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700 datatable datatable-MainCostCenter">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-center w-10 p-3"></th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.mainCostCenter.fields.id') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.mainCostCenter.fields.cost_center_name') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.mainCostCenter.fields.unique_code') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.mainCostCenter.fields.link_with_company') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.addBusiness.fields.legal_name') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.mainCostCenter.fields.responsible_manager') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.user.fields.email') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.mainCostCenter.fields.budget_amount') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.mainCostCenter.fields.actual_amount') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.mainCostCenter.fields.start_date') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('cruds.mainCostCenter.fields.status') }}</th>
                        <th class="px-4 py-3 text-left font-semibold">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($mainCostCenters as $mainCostCenter)
                    <tr data-entry-id="{{ $mainCostCenter->id }}" class="hover:bg-gray-50">
                        <td class="px-4 py-3"></td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $mainCostCenter->id ?? '' }}</td>
                        <td class="px-4 py-3">{{ $mainCostCenter->cost_center_name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $mainCostCenter->unique_code ?? '' }}</td>
                        <td class="px-4 py-3">{{ $mainCostCenter->link_with_company->company_name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $mainCostCenter->link_with_company->legal_name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $mainCostCenter->responsible_manager->name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $mainCostCenter->responsible_manager->email ?? '' }}</td>
                        <td class="px-4 py-3">{{ $mainCostCenter->budget_amount ?? '' }}</td>
                        <td class="px-4 py-3">{{ $mainCostCenter->actual_amount ?? '' }}</td>
                        <td class="px-4 py-3">{{ $mainCostCenter->start_date ?? '' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $mainCostCenter->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ App\Models\MainCostCenter::STATUS_SELECT[$mainCostCenter->status] ?? '' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            @can('main_cost_center_show')
                                <a href="{{ route('admin.main-cost-centers.show', $mainCostCenter->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">
                                           <i class="fas fa-eye mr-1"></i>{{ trans('global.view') }}
                                      
                                </a>
                            @endcan
                            @can('main_cost_center_edit')
                                <a href="{{ route('admin.main-cost-centers.edit', $mainCostCenter->id) }}"
                                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                                           <i class="fas fa-edit mr-1"></i>
                                    {{ trans('global.edit') }}
                                </a>
                            @endcan
                            @can('main_cost_center_delete')
                                <form action="{{ route('admin.main-cost-centers.destroy', $mainCostCenter->id) }}" method="POST" 
                                      onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                     <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200">
                                                <i class="fas fa-trash mr-1"></i>
                                        {{ trans('global.delete') }}
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
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        @can('main_cost_center_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.main-cost-centers.massDestroy') }}",
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
                        data: { ids: ids, _method: 'DELETE' }
                    }).done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 25,
        });
        let table = $('.datatable-MainCostCenter:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    })
</script>
@endsection
