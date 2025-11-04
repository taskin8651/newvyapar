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
                        <i class="fas fa-plus mr-1"></i> Add Invoice
                    </a>

                    <button @click="openCsvModal = true"
                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-file-csv mr-1"></i> Import CSV
                    </button>

                    @include('csvImport.modal', [
                        'model' => 'SaleInvoice',
                        'route' => 'admin.sale-invoices.parseCsvImport'
                    ])
                @endcan

                <input type="text" id="saleInvoiceSearch"
                       placeholder="Search invoices..."
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
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">PO No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">PO Date</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($saleInvoices as $saleInvoice)
                        <tr data-entry-id="{{ $saleInvoice->id }}" class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3"></td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->id }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->select_customer->party_name ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->po_no ?? '—' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $saleInvoice->po_date ?? '—' }}</td>

                            <td class="px-4 py-3 text-sm text-center">
                                {{ $saleInvoice->status ?? '—' }}
                            </td>

                            <td class="px-4 py-3 text-center relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                                <button class="text-gray-600 hover:text-gray-900"><i class="fa-solid fa-ellipsis-vertical text-lg"></i></button>

                                <div x-show="open" x-transition
                                     class="absolute top-full left-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                                     style="display: none;">

                                    <a href="{{ route('admin.sale-invoices.show', $saleInvoice->id) }}"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-lg">
                                        <i class="fas fa-eye mr-2"></i> View
                                    </a>

                                    <a href="{{ route('admin.sale-invoices.edit', $saleInvoice->id) }}"
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 rounded-lg">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </a>

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

            <div class="mt-4">{{ $saleInvoices->links() }}</div>
        </div>
    </div>
</div>

<!-- Profit/Loss Modal -->
<div id="profitLossModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-6 relative overflow-y-auto max-h-[90vh]">
        <h2 class="text-lg font-semibold text-indigo-700 mb-3">Profit & Loss Details</h2>
        <div id="profitLossContent" class="text-sm text-gray-700 space-y-4"></div>
        <div class="flex justify-end mt-6">
            <button onclick="closeProfitLossModal()" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Close</button>
        </div>
    </div>
</div>

<!-- Manufacture Modal -->
<div id="manufactureModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
        <h2 class="text-lg font-semibold text-indigo-700 mb-3">Confirm Manufacture</h2>
        <p class="text-sm text-gray-600 mb-6">Confirming manufacture will update Profit & Loss details automatically.</p>
        <div id="loadingSpinner" class="hidden absolute inset-0 bg-white bg-opacity-80 flex items-center justify-center rounded-2xl">
            <i class="fas fa-spinner fa-spin text-indigo-600 text-2xl"></i>
        </div>
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

function openManufactureModal(id) {
    selectedInvoiceId = id;
    document.getElementById('manufactureModal').classList.remove('hidden');
    document.getElementById('manufactureModal').classList.add('flex');
}

function closeManufactureModal() {
    document.getElementById('manufactureModal').classList.add('hidden');
    document.getElementById('manufactureModal').classList.remove('flex');
}

function closeProfitLossModal() {
    document.getElementById('profitLossModal').classList.add('hidden');
    document.getElementById('profitLossModal').classList.remove('flex');
}

document.getElementById('confirmManufactureBtn').addEventListener('click', async function() {
    if (!selectedInvoiceId) return;
    const spinner = document.getElementById('loadingSpinner');
    spinner.classList.remove('hidden');
    try {
        const url = `{{ url('admin/sale-invoices') }}/${selectedInvoiceId}/confirm-manufacture`;
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        });
        const result = await res.json();
        if (result.status === 'success') {
            closeManufactureModal();
            renderProfitLossModal(result.data);
        } else {
            alert(result.message || 'Error occurred');
        }
    } catch (e) {
        alert('⚠️ ' + e.message);
    } finally {
        spinner.classList.add('hidden');
    }
});

function renderProfitLossModal(data) {
    const i = data.invoice;
    const p = data.profit_loss;
    let html = `
        <div class="grid grid-cols-2 gap-4 border-b pb-3">
            <p><strong>Customer:</strong> ${i.select_customer?.party_name ?? i.select_customer?.phone_number ?? '—'}</p>
            <p><strong>State:</strong> ${i.select_customer?.state ?? '—'}</p>
            <p><strong>Docket No:</strong> ${i.docket_no ?? '—'}</p>
            <p><strong>Billing Date:</strong> ${i.billing_date ?? '—'}</p>
            <p><strong>Cost Center:</strong> ${i.main_cost_center?.name ?? '—'}</p>
            <p><strong>Sub Cost Center:</strong> ${i.sub_cost_center?.name ?? '—'}</p>
        </div>
        <h3 class="text-indigo-700 font-semibold mt-4 mb-2">Items Sold</h3>
        <table class="min-w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">Product</th>
                    <th class="border px-2 py-1">Qty</th>
                    <th class="border px-2 py-1">Sale Price</th>
                    <th class="border px-2 py-1">Purchase Price</th>
                    <th class="border px-2 py-1">Total</th>
                </tr>
            </thead><tbody>`;

    p.composition_json.forEach(item => {
        html += `
            <tr>
                <td class="border px-2 py-1">${item.product_name}</td>
                <td class="border px-2 py-1 text-center">${item.qty}</td>
                <td class="border px-2 py-1 text-right">₹${item.sale_price}</td>
                <td class="border px-2 py-1 text-right">₹${item.purchase_price}</td>
                <td class="border px-2 py-1 text-right">₹${item.total}</td>
            </tr>`;

        if (item.raw_materials && item.raw_materials.length > 0) {
            html += `
                <tr><td colspan="5" class="bg-gray-50 text-xs text-gray-600 px-2 py-1">
                    <strong>Raw Materials Used:</strong>
                </td></tr>`;
            item.raw_materials.forEach(rm => {
                html += `
                    <tr class="text-xs text-gray-500">
                        <td class="border px-2 py-1 pl-6">- ${rm.raw_material_name}</td>
                        <td class="border px-2 py-1 text-center">${rm.qty}</td>
                        <td class="border px-2 py-1 text-right">₹${rm.sale_price}</td>
                        <td class="border px-2 py-1 text-right">₹${rm.purchase_price}</td>
                        <td class="border px-2 py-1 text-right">₹${rm.total_purchase_value}</td>
                    </tr>`;
            });
        }
    });

    html += `
        </tbody></table>
        <div class="mt-4 border-t pt-3 text-right">
            <p><strong>Total Purchase:</strong> ₹${p.total_purchase_value}</p>
            <p><strong>Total Sale:</strong> ₹${p.total_sale_value}</p>
            <p class="${p.is_profit ? 'text-green-600' : 'text-red-600'} font-bold">
                ${p.is_profit ? 'Profit' : 'Loss'}: ₹${p.profit_loss_amount}
            </p>
        </div>`;

    document.getElementById('profitLossContent').innerHTML = html;
    document.getElementById('profitLossModal').classList.remove('hidden');
    document.getElementById('profitLossModal').classList.add('flex');
}

// DataTable Live Search
$(function () {
    let table = $('.datatable-SaleInvoice:not(.ajaxTable)').DataTable({
        order: [[1, 'desc']],
        dom: 'lrtip',
        pageLength: 10,
    });
    $('#saleInvoiceSearch').on('keyup', function () {
        table.search(this.value).draw();
    });
});
</script>
@endsection
