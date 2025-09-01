@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-users text-indigo-600"></i>
                {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
            </h2>
            <div class="flex gap-2">
              <div x-data="{ openCsvModal: false }">
    <div class="flex gap-2">
        @can('user_create')
            <!-- Add User Button -->
            <a href="{{ route('admin.users.create') }}" 
               class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>

            <!-- CSV Import Button -->
            <button 
                @click="openCsvModal = true"
                class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
            </button>

            <!-- Modal Include -->
            @include('csvImport.modal', [
                'model' => 'User', 
                'route' => 'admin.users.parseCsvImport'
            ])
        @endcan
    </div>
</div>

            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-User">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.user.fields.id') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.user.fields.name') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.user.fields.email') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.user.fields.select_companies') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.user.fields.email_verified_at') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.user.fields.roles') }}</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $user->id ?? '' }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $user->name ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $user->email ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($user->select_companies as $item)
                                    <span class="inline-block bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded text-xs font-medium">
                                        {{ $item->company_name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $user->email_verified_at ?? '' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($user->roles as $item)
                                    <span class="inline-block bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-medium">
                                        {{ $item->title }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-center space-x-1">
                                @can('user_show')
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                       class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('user_edit')
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('user_delete')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" 
                                                class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                            <i class="fas fa-trash"></i>
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
        @can('user_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.users.massDestroy') }}",
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
        let table = $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
