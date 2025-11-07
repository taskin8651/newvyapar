@extends('layouts.admin')
@section('content')
<div class="content">
     @can('bank_to_cash_create')
    <div class="mb-4">
        <a href="{{ route('admin.bank-to-cashes.create') }}"
           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
            <i class="fas fa-plus mr-2"></i>
            {{ trans('global.add') }} {{ trans('cruds.bankToCash.title_singular') }}
        </a>
        <button class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow"
                data-toggle="modal" data-target="#csvImportModal">
            <i class="fas fa-file-csv mr-2"></i>
            {{ trans('global.app_csvImport') }}
        </button>
        @include('csvImport.modal', ['model' => 'BankToCash', 'route' => 'admin.bank-to-cashes.parseCsvImport'])
    </div>
@endcan
  

<div class="bg-white shadow rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">
            {{ trans('cruds.bankToCash.title_singular') }} {{ trans('global.list') }}
        </h3>
    </div>


  <div class="bg-white shadow rounded-lg overflow-hidden p-2">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-600 datatable datatable-BankToCash">
            <thead class="bg-gray-50 text-gray-700 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 w-12"></th>
                    <th class="px-4 py-3">{{ trans('cruds.bankToCash.fields.id') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankToCash.fields.from') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankAccount.fields.opening_balance') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankAccount.fields.as_of_date') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankAccount.fields.account_number') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankAccount.fields.ifsc_code') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankAccount.fields.bank_name') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankAccount.fields.account_holder_name') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankToCash.fields.to') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankToCash.fields.amount') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankToCash.fields.adjustment_date') }}</th>
                    <th class="px-4 py-3">{{ trans('cruds.bankToCash.fields.attechment') }}</th>
                    <th class="px-4 py-3 text-center">{{ trans('global.actions') }}</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach($bankToCashes as $key => $bankToCash)
                    <tr class="hover:bg-gray-50" data-entry-id="{{ $bankToCash->id }}">
                        <td class="px-4 py-3"></td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $bankToCash->id ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->from->account_name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->from->opening_balance ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->from->as_of_date ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->from->account_number ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->from->ifsc_code ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->from->bank_name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->from->account_holder_name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->to ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->amount ?? '' }}</td>
                        <td class="px-4 py-3">{{ $bankToCash->adjustment_date ?? '' }}</td>

                        <td class="px-4 py-3">
                            @if($bankToCash->attechment)
                                <a href="{{ $bankToCash->attechment->getUrl() }}" target="_blank" class="inline-block">
                                    <img src="{{ $bankToCash->attechment->getUrl('thumb') }}" class="h-10 rounded shadow">
                                </a>
                            @endif
                        </td>

                        {{-- Actions Dropdown --}}
                        <td class="px-4 py-3 text-center relative"
                            x-data="{ open: false }"
                            @mouseenter="open = true"
                            @mouseleave="open = false">

                            <!-- Ellipsis icon -->
                            <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
                                <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                            </button>

                            <!-- Dropdown menu -->
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform translate-y-1"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform translate-y-1"
                                 class="absolute top-full left-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                                 style="display: none;">

                                @can('bank_to_cash_show')
                                    <a href="{{ route('admin.bank-to-cashes.show', $bankToCash->id) }}"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg transition-colors">
                                        <i class="fas fa-eye mr-2"></i> {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('bank_to_cash_edit')
                                    <a href="{{ route('admin.bank-to-cashes.edit', $bankToCash->id) }}"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 rounded-lg transition-colors">
                                        <i class="fas fa-edit mr-2"></i> {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('bank_to_cash_delete')
                                    <form action="{{ route('admin.bank-to-cashes.destroy', $bankToCash->id) }}"
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
@can('bank_to_cash_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bank-to-cashes.massDestroy') }}",
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
  let table = $('.datatable-BankToCash:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection