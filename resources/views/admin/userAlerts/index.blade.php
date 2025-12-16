@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-bell text-indigo-600"></i>
                {{ trans('cruds.userAlert.title_singular') }} {{ trans('global.list') }}
            </h2>

            <div class="flex gap-2 items-center">
                @can('user_alert_create')
                    <a href="{{ route('admin.user-alerts.create') }}"
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }}
                    </a>
                @endcan

                <input type="text" id="userAlertSearch" placeholder="Search alerts..."
                       class="px-3 py-2 border rounded-lg text-sm w-64">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-UserAlert">
                <thead class="bg-gray-50">
                    <tr>
                        <th width="10"></th>
                        <th>ID</th>
                        <th>Alert Text</th>
                        <th>Alert Link</th>
                        <th>User</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
/* ✅ Blade permissions converted to JS flags */
const canView   = {{ auth()->user()->can('user_alert_show') ? 'true' : 'false' }};
const canEdit   = {{ auth()->user()->can('user_alert_edit') ? 'true' : 'false' }};
const canDelete = {{ auth()->user()->can('user_alert_delete') ? 'true' : 'false' }};

$(function () {

    let table = $('.datatable-UserAlert').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.user-alerts.index') }}",
        order: [[1, 'desc']],
        pageLength: 25,
        dom: 'lrtip',

        columns: [
            { data: 'placeholder', searchable: false, sortable: false },
            { data: 'id' },
            { data: 'alert_text' },
            { data: 'alert_link' },
            { data: 'user' },
            { data: 'created_at' },

            {
                data: 'id',
                className: 'text-center',
                searchable: false,
                sortable: false,
                render: function (id) {

                    let buttons = `<div class="flex justify-center gap-2">`;

                    if (canView) {
                        buttons += `
                        <a href="/admin/user-alerts/${id}"
                           class="px-2 py-1 bg-green-500 text-white text-xs rounded">
                            <i class="fas fa-eye"></i>
                        </a>`;
                    }

                    if (canEdit) {
                        buttons += `
                        <a href="/admin/user-alerts/${id}/edit"
                           class="px-2 py-1 bg-blue-500 text-white text-xs rounded">
                            <i class="fas fa-edit"></i>
                        </a>`;
                    }

                    if (canDelete) {
                        buttons += `
                        <button onclick="deleteUserAlert(${id})"
                                class="px-2 py-1 bg-red-500 text-white text-xs rounded">
                            <i class="fas fa-trash"></i>
                        </button>`;
                    }

                    buttons += `</div>`;
                    return buttons;
                }
            }
        ]
    });

    $('#userAlertSearch').on('keyup change', function () {
        table.search(this.value).draw();
    });

});

function deleteUserAlert(id) {
    if (!confirm('Are you sure?')) return;

    $.ajax({
        headers: { 'x-csrf-token': _token },
        method: 'POST',
        url: `/admin/user-alerts/${id}`,
        data: { _method: 'DELETE' },
        success: function () {
            $('.datatable-UserAlert').DataTable().ajax.reload();
        }
    });
}
</script>
@endsection
