@extends('layouts.admin')
@section('content')

<div class="space-y-6">

    {{-- Add Party Button + CSV Import --}}
    @can('party_detail_create')
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.party-details.create') }}"
               class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                <i class="fas fa-plus mr-2"></i>
                {{ trans('global.add') }} {{ trans('cruds.partyDetail.title_singular') }}
            </a>
<div x-data="{ openCsvModal: false }"> {{-- AlpineJS wrapper --}}

    {{-- CSV Import Button --}}
    <button 
        @click="openCsvModal = true"
        class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition">
        <i class="fas fa-file-csv mr-2"></i>
        {{ trans('global.app_csvImport') }}
    </button>

    {{-- आपका table / बाकी content यहाँ --}}

    {{-- Modal को नीचे include करो --}}
    @include('csvImport.modal', ['model' => 'PartyDetail', 'route' => 'admin.party-details.parseCsvImport'])

</div>
        </div>
    @endcan

    {{-- Card --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">
                {{ trans('cruds.partyDetail.title_singular') }} {{ trans('global.list') }}
            </h3>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600 datatable datatable-PartyDetail">
                    <thead class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 w-12"></th>
                            <th class="px-4 py-3">{{ trans('cruds.partyDetail.fields.id') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.partyDetail.fields.party_name') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.partyDetail.fields.gstin') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.partyDetail.fields.phone_number') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.partyDetail.fields.email') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.partyDetail.fields.state') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.partyDetail.fields.city') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.partyDetail.fields.opening_balance') }}</th>
                            <th class="px-4 py-3">{{ trans('cruds.partyDetail.fields.status') }}</th>
                            <th class="px-4 py-3 text-center">{{ trans('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($partyDetails as $key => $partyDetail)
                            <tr class="hover:bg-gray-50" data-entry-id="{{ $partyDetail->id }}">
                                <td class="px-4 py-3"></td>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $partyDetail->id ?? '' }}</td>
                                <td class="px-4 py-3">{{ $partyDetail->party_name ?? '' }}</td>
                                <td class="px-4 py-3">{{ $partyDetail->gstin ?? '' }}</td>
                                <td class="px-4 py-3">{{ $partyDetail->phone_number ?? '' }}</td>
                                <td class="px-4 py-3">{{ $partyDetail->email ?? '' }}</td>
                                <td class="px-4 py-3">{{ $partyDetail->state ?? '' }}</td>
                                <td class="px-4 py-3">{{ $partyDetail->city ?? '' }}</td>
                                <td class="px-4 py-3">{{ $partyDetail->opening_balance ?? '' }}</td>
                                <td class="px-4 py-3">
                                    {{ App\Models\PartyDetail::STATUS_SELECT[$partyDetail->status] ?? '' }}
                                </td>
                                <td class="px-4 py-3 flex items-center justify-center gap-2">
                                    @can('party_detail_show')
                                        <a href="{{ route('admin.party-details.show', $partyDetail->id) }}"
                                           class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200">
                                           <i class="fas fa-eye mr-1"></i>{{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('party_detail_edit')
                                        <a href="{{ route('admin.party-details.edit', $partyDetail->id) }}"
                                           class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                                           <i class="fas fa-edit mr-1"></i>{{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('party_detail_delete')
                                        <form action="{{ route('admin.party-details.destroy', $partyDetail->id) }}" method="POST"
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
        @can('party_detail_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.party-details.massDestroy') }}",
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
                        data: { ids: ids, _method: 'DELETE' }
                    }).done(function () { location.reload() })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 50,
        });

        let table = $('.datatable-PartyDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    })
</script>
@endsection
