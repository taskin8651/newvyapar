@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-file-invoice text-indigo-600"></i>
                {{ trans('cruds.saleInvoice.title_singular') }} {{ trans('global.list') }}
            </h2>
            <div class="flex gap-2 items-center" x-data="{ openCsvModal: false }">
                @can('sale_invoice_create')
                    <a href="{{ route('admin.sale-invoices.create') }}"
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.saleInvoice.title_singular') }}
                    </a>

                    <button @click="openCsvModal = true"
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                    </button>

                    <!-- CSV Modal -->
                    @include('csvImport.modal', [
                        'model' => 'SaleInvoice',
                        'route' => 'admin.sale-invoices.parseCsvImport'
                    ])
                @endcan

                <!-- Search -->
                <input type="text" id="saleInvoiceSearch" placeholder="Search invoices..."
                    class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-SaleInvoice">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.select_customer') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.gstin') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.partyDetail.fields.phone_number') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.billing_name') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.po_no') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ trans('cruds.saleInvoice.fields.po_date') }}</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Items</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Profit/Loss</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">{{ trans('global.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($saleInvoices as $saleInvoice)
                        <tr data-entry-id="{{ $saleInvoice->id }}" class="hover:bg-gray-50">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->id }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->select_customer->party_name ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->select_customer->gstin ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->select_customer->phone_number ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->billing_name ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->po_no ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->po_date ?? '—' }}</td>

                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($saleInvoice->items as $item)
                                    <span class="inline-block bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded">{{ $item->item_name }}</span>
                                @endforeach
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                @foreach($saleInvoice->items as $item)
                                    <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded mb-1">
                                        {{ $item->pivot->qty }}
                                    </span>
                                @endforeach
                            </td>

                            <!-- Profit/Loss -->
                            <td class="px-4 py-3 text-sm text-gray-700 text-center">
                                @php
                                    $profitLoss = $saleInvoice->profit_loss ?? null;
                                @endphp
                                @if($profitLoss)
                                    @if($profitLoss->is_profit)
                                        <span class="text-green-600 font-semibold">+ ₹{{ number_format($profitLoss->profit_loss_amount, 2) }}</span>
                                    @else
                                        <span class="text-red-600 font-semibold">- ₹{{ number_format($profitLoss->profit_loss_amount, 2) }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400 text-xs">Pending</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-4 py-3 text-center relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                                <button class="text-gray-600 hover:text-gray-900"><i class="fa-solid fa-ellipsis-vertical text-lg"></i></button>
                                <div x-show="open" x-transition
                                    class="absolute top-full left-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-50" style="display: none;">

                                    <a href="{{ route('admin.sale-invoices.show', $saleInvoice->id) }}"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg">
                                        <i class="fas fa-eye mr-2"></i> View
                                    </a>

                                    <a href="{{ route('admin.sale-invoices.edit', $saleInvoice->id) }}"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 rounded-lg">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </a>

                                    <!-- Confirm Manufacture Button -->
                                    <button onclick="openManufactureModal({{ $saleInvoice->id }})"
                                            class="w-full text-left flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-lg">
                                        <i class="fas fa-industry mr-2"></i> Confirm Manufacture
                                    </button>

                                    <a href="{{ route('admin.sale-invoices.pdf', $saleInvoice->id) }}" target="_blank"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg">
                                        <i class="fas fa-file-pdf mr-2"></i> Print
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $saleInvoices->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Manufacture Confirmation Modal -->
<div id="manufactureModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
        <h2 class="text-lg font-semibold text-indigo-700 mb-3">Confirm Manufacture</h2>
        <p class="text-sm text-gray-600 mb-6">Are you sure you want to confirm this manufacture and deduct stock?</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeManufactureModal()" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</button>
            <button id="confirmManufactureBtn" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Confirm</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
    let selectedInvoiceId = null;

    function openManufactureModal(invoiceId) {
        selectedInvoiceId = invoiceId;
        document.getElementById('manufactureModal').classList.remove('hidden');
        document.getElementById('manufactureModal').classList.add('flex');
    }

    function closeManufactureModal() {
        document.getElementById('manufactureModal').classList.add('hidden');
        document.getElementById('manufactureModal').classList.remove('flex');
        selectedInvoiceId = null;
    }

    document.getElementById('confirmManufactureBtn').addEventListener('click', function () {
        if (!selectedInvoiceId) return;

        fetch(`/admin/sale-invoices/${selectedInvoiceId}/confirm-manufacture`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Manufacture confirmed and stock deducted!');
                window.location.reload();
            } else {
                alert(data.message || 'Something went wrong.');
            }
        })
        .catch(err => console.error(err))
        .finally(() => closeManufactureModal());
    });

    // DataTables config
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 10,
            dom: 'lrtip'
        });

        let table = $('.datatable-SaleInvoice:not(.ajaxTable)').DataTable({ buttons: dtButtons });
        $('#saleInvoiceSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });
    });
</script>
@endsection
