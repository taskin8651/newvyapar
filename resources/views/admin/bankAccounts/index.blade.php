@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="space-y-6">
    @can('bank_account_create')
        <div class="mb-4 flex flex-wrap gap-3">
    <!-- Add Bank Account Button -->
    <a href="{{ route('admin.bank-accounts.create') }}" 
        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                <i class="fas fa-plus mr-2"></i>
        {{ trans('global.add') }} {{ trans('cruds.bankAccount.title_singular') }}
    </a>
    <!-- CSV Import Button -->
    <button type="button" 
      class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow-sm transition" data-toggle="modal" data-target="#csvImportModal">
        <i class="fas fa-file-csv mr-2"></i>
           
        {{ trans('global.app_csvImport') }}
    </button>

    <!-- CSV Import Modal Include -->
    @include('csvImport.modal', ['model' => 'BankAccount', 'route' => 'admin.bank-accounts.parseCsvImport'])
</div>

    @endcan
    <div class="row">
        <div class="col-lg-12">
             <div class="bg-white shadow rounded-xl overflow-hidden">
                <h3 class="px-6 py-4 border-b border-gray-200">
                    {{ trans('cruds.bankAccount.title_singular') }} {{ trans('global.list') }}
                </h3>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-BankAccount text-sm">
                            <thead class="bg-gradient-to-r from-blue-100 to-blue-200 text-gray-700 uppercase text-xs font-semibold">


    <tr>
        <th class="px-4 py-3 text-center w-10 p-3">
            #
        </th>
        <th class="px-4 py-3">ID</th>
        <th class="px-4 py-3">Account Name</th>
        <th class="px-4 py-3">Opening Balance</th>
        <th class="px-4 py-3">As of Date</th>
        <th class="px-4 py-3">Account Number</th>
        <th class="px-4 py-3">IFSC Code</th>
        <th class="px-4 py-3">Bank Name</th>
        <th class="px-4 py-3">Account Holder Name</th>
        <th class="px-4 py-3">UPI</th>
        <th class="px-4 py-3">Print UPI QR</th>
        <th class="px-4 py-3">Print Bank Details</th>
        <th class="px-4 py-3">&nbsp;</th>
    </tr>
</thead>

                            <tbody class="bg-gray-50">
    @foreach($bankAccounts as $key => $bankAccount)
        <tr class="bg-white rounded-lg shadow-sm mb-3 hover:shadow-md transition-all duration-200" data-entry-id="{{ $bankAccount->id }}">
            <td class="px-4 py-3 text-center">
                {{ $key + 1 }}
            </td>
            <td class="px-4 py-3">{{ $bankAccount->id ?? '' }}</td>
            <td class="px-4 py-3 font-semibold">{{ $bankAccount->account_name ?? '' }}</td>
            <td class="px-4 py-3 text-green-600 font-medium">{{ $bankAccount->opening_balance ?? '' }}</td>
            <td class="px-4 py-3">{{ $bankAccount->as_of_date ?? '' }}</td>
            <td class="px-4 py-3">{{ $bankAccount->account_number ?? '' }}</td>
            <td class="px-4 py-3">{{ $bankAccount->ifsc_code ?? '' }}</td>
            <td class="px-4 py-3">{{ $bankAccount->bank_name ?? '' }}</td>
            <td class="px-4 py-3">{{ $bankAccount->account_holder_name ?? '' }}</td>
            <td class="px-4 py-3">{{ $bankAccount->upi ?? '' }}</td>
            <td class="px-4 py-3 text-center">
                <input type="checkbox" disabled {{ $bankAccount->print_upi_qr ? 'checked' : '' }} class="accent-blue-500 w-5 h-5">
            </td>
            <td class="px-4 py-3 text-center">
                <input type="checkbox" disabled {{ $bankAccount->print_bank_details ? 'checked' : '' }} class="accent-green-500 w-5 h-5">
            </td>
            <td class="px-4 py-3 text-center relative" x-data="{ open: false }">
    <!-- Ellipsis Button -->
    <button @click="open = !open" class="text-gray-600 hover:text-gray-900 focus:outline-none">
        <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open"
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="absolute right-0 mt-2 w-max bg-white border border-gray-200 rounded-lg shadow-lg z-20 flex flex-col gap-1 p-1">

        @can('bank_account_show')
            <a href="{{ route('admin.bank-accounts.show', $bankAccount->id) }}"
               class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 transition">
                <i class="fas fa-eye mr-1"></i> {{ trans('global.view') }}
            </a>
        @endcan

        @can('bank_account_edit')
            <a href="{{ route('admin.bank-accounts.edit', $bankAccount->id) }}"
               class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">
                <i class="fas fa-edit mr-1"></i> {{ trans('global.edit') }}
            </a>
        @endcan

        @can('bank_account_delete')
            <form action="{{ route('admin.bank-accounts.destroy', $bankAccount->id) }}" method="POST"
                  onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                @method('DELETE')
                @csrf
                <button type="submit"
                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition">
                    <i class="fas fa-trash mr-1"></i> {{ trans('global.delete') }}
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
    </div>
</div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('bank_account_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bank-accounts.massDestroy') }}",
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
  let table = $('.datatable-BankAccount:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection