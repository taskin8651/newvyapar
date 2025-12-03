@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-briefcase text-indigo-600"></i>
                {{ trans('cruds.addBusiness.title_singular') }} {{ trans('global.list') }}
            </h2>
            <div class="flex gap-2 items-center">
                <div x-data="{ openCsvModal: false }" class="flex gap-2">
                    @can('add_business_create')
                        <!-- Add New -->
                        <a href="{{ route('admin.add-businesses.create') }}" 
                           class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                            <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.addBusiness.title_singular') }}
                        </a>

                        <!-- CSV Import -->
                        <button 
                            @click="openCsvModal = true"
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                            <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                        </button>

                        <!-- Modal Include -->
                        @include('csvImport.modal', [
                            'model' => 'AddBusiness', 
                            'route' => 'admin.add-businesses.parseCsvImport'
                        ])
                    @endcan
                </div>

                <!-- Custom Search -->
                <div>
                    <input type="text" id="addBusinessSearch" placeholder="Search businesses..."
                        class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable-AddBusiness">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.addBusiness.fields.id') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.addBusiness.fields.company_name') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.addBusiness.fields.legal_name') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.addBusiness.fields.business_type') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.addBusiness.fields.industry_type') }}
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('cruds.addBusiness.fields.logo_upload') }}
                        </th>
                        <th>GST</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ trans('global.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($addBusinesses as $addBusiness)
                        <tr data-entry-id="{{ $addBusiness->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $addBusiness->id }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                {{ $addBusiness->company_name }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $addBusiness->legal_name }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ App\Models\AddBusiness::BUSINESS_TYPE_SELECT[$addBusiness->business_type] ?? '' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ App\Models\AddBusiness::INDUSTRY_TYPE_SELECT[$addBusiness->industry_type] ?? '' }}
                            </td>
                            <td class="px-4 py-3">
                                @foreach($addBusiness->logo_upload as $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" class="inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}" class="h-10 w-10 rounded border">
                                    </a>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $addBusiness->gst_number }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $addBusiness->phone_number }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $addBusiness->email }}
                            </td>    
                            <td class="px-4 py-3 text-sm text-gray-700">
                                {{ $addBusiness->address }}
                            </td>
                            <td class="px-4 py-3 text-center space-x-1">
                                @can('add_business_show')
                                    <a href="{{ route('admin.add-businesses.show', $addBusiness->id) }}"
                                       class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('add_business_edit')
                                    <a href="{{ route('admin.add-businesses.edit', $addBusiness->id) }}"
                                       class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                                @can('add_business_delete')
                                    <form action="{{ route('admin.add-businesses.destroy', $addBusiness->id) }}" method="POST" 
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

        @can('add_business_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.add-businesses.massDestroy') }}",
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

        // Init DataTable
        let table = $('.datatable-AddBusiness').DataTable({
            buttons: dtButtons,
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 25,
        });

        // Bind search input
        $('#addBusinessSearch').on('keyup', function () {
            table.search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
