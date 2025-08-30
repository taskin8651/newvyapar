@extends('layouts.admin')
@section('content')
<div class="content" x-data="{ }">

    <div class="max-w-full mx-auto bg-white shadow-lg rounded-2xl overflow-hidden">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between px-6 py-4 border-b bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800">
                {{ trans('cruds.auditLog.title_singular') }} {{ trans('global.list') }}
            </h3>
            <!-- Search bar -->
            <div class="mt-3 sm:mt-0">
                <input type="text" id="auditSearch" placeholder="Search logs..."
                    class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
            </div>
        </div>

        <!-- Table -->
        <div class="p-6 overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg datatable datatable-AuditLog">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="p-3 text-left">#</th>
                        <th class="p-3 text-left">{{ trans('cruds.auditLog.fields.id') }}</th>
                        <th class="p-3 text-left">{{ trans('cruds.auditLog.fields.description') }}</th>
                        <th class="p-3 text-left">{{ trans('cruds.auditLog.fields.subject_id') }}</th>
                        <th class="p-3 text-left">{{ trans('cruds.auditLog.fields.subject_type') }}</th>
                        <th class="p-3 text-left">{{ trans('cruds.auditLog.fields.user_id') }}</th>
                        <th class="p-3 text-left">{{ trans('cruds.auditLog.fields.host') }}</th>
                        <th class="p-3 text-left">{{ trans('cruds.auditLog.fields.created_at') }}</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600 divide-y divide-gray-200">
                    @foreach($auditLogs as $key => $auditLog)
                        <tr class="hover:bg-gray-50" data-entry-id="{{ $auditLog->id }}">
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $auditLog->id ?? '' }}</td>
                            <td class="p-3">{{ $auditLog->description ?? '' }}</td>
                            <td class="p-3">{{ $auditLog->subject_id ?? '' }}</td>
                            <td class="p-3">{{ $auditLog->subject_type ?? '' }}</td>
                            <td class="p-3">{{ $auditLog->user_id ?? '' }}</td>
                            <td class="p-3">{{ $auditLog->host ?? '' }}</td>
                            <td class="p-3">{{ $auditLog->created_at ?? '' }}</td>
                            <td class="p-3 text-center">
                                @can('audit_log_show')
                                    <a href="{{ route('admin.audit-logs.show', $auditLog->id) }}" 
                                       class="inline-flex items-center px-3 py-1.5 text-xs font-medium bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm">
                                        <i class="fas fa-eye mr-1"></i> {{ trans('global.view') }}
                                    </a>
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
@section('scripts')
@parent
<script>
    $(document).ready(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 25,
        });

        // DataTable initialize
        let table = $('.datatable-AuditLog:not(.ajaxTable)').DataTable({
            buttons: dtButtons,
            dom: 'lrtip' // 👈 Default search box hata diya (l=length, r=processing, t=table, i=info, p=pagination)
        });

        // Custom search kaam karega
        $('#auditSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });

        // Tabs adjust
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endsection

@endsection
