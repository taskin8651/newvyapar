@extends('layouts.admin')
@section('content')

<div class="space-y-6">

    {{-- Add Role Button --}}
    @can('role_create')
        <div>
            <a href="{{ route('admin.roles.create') }}"
               class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                <i class="fas fa-plus mr-2"></i>
                {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
            </a>
        </div>
    @endcan

    {{-- Card --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">
                {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}
            </h3>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600 datatable-Role">
                    <thead class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 w-12"></th>
                            <th class="px-4 py-3">{{ trans('cruds.role.fields.id') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.role.fields.title') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.role.fields.permissions') }}</th>
                            <th class="px-4 py-3 text-center">{{ trans('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($roles as $key => $role)
                            <tr class="hover:bg-gray-50" data-entry-id="{{ $role->id }}">
                                <td class="px-4 py-3"></td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $role->id ?? '' }}</td>
                                <td class="px-4 py-3">{{ $role->title ?? '' }}</td>
                                <td class="px-4 py-3">
                                    @foreach($role->permissions as $item)
                                        <span class="inline-block px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-md mr-1 mb-1">
                                            {{ $item->title }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 flex items-center justify-center gap-2">

                                    @can('role_show')
                                        <a href="{{ route('admin.roles.show', $role->id) }}"
                                           class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">
                                            <i class="fas fa-eye mr-1"></i>{{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('role_edit')
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                           class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                                            <i class="fas fa-edit mr-1"></i>{{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('role_delete')
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
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
        @can('role_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.roles.massDestroy') }}",
            className: 'bg-red-600 text-white px-3 py-1 rounded-md',
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
            pageLength: 25,
        });

        let table = $('.datatable-Role:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
