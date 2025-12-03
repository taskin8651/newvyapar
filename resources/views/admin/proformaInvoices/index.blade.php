@extends('layouts.admin')

@section('content')
<style>
/* ==================== MODAL CSS ==================== */

/* Overlay */
.modal-overlay {
    display: none; /* start hidden */
    position: fixed ! important;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(2px);
    z-index: 99999 !important;
    justify-content: center;
    align-items: center;
    transition: opacity .15s ease-in-out;
}
#itemModal .modal-box {
    z-index: 1000000 !important;
    position: relative !important;
}

    .watermarked > * {
        position: relative !important;
        z-index: 1; /* content upar */
    }
/* Modal box */
.modal-box {
    background: #fff;
    padding: 20px 25px;
    border-radius: 12px;
    width: 450px;
    max-width: 95%;
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    animation: fadeIn .18s ease-out;
}

/* Table */
.modal-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
}

.modal-table td {
    font-size: 14px;
    padding: 6px 8px;
    border-bottom: 1px solid #f1f1f1;
}

.modal-table td:first-child {
    font-weight: 600;
    width: 140px;
}

/* Close button */
.modal-close-btn {
    background: #e3342f;
    border: none;
    color: #fff;
    padding: 8px 18px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 13px;
}

.modal-close-btn:hover {
    background: #cc1f1a;
}

/* Fade animation */
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.92); }
    to   { opacity: 1; transform: scale(1); }
}
</style>

<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-file-invoice text-indigo-600"></i>
                {{ trans('cruds.proformaInvoice.title_singular') }} {{ trans('global.list') }}
            </h2>

            <div class="flex gap-2">
                @can('proforma_invoice_create')
                    <a href="{{ route('admin.proforma-invoices.create') }}" 
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }} {{ trans('cruds.proformaInvoice.title_singular') }}
                    </a>
                @endcan

                @can('proforma_invoice_create')
                <div x-data="{ openCsvModal: false }">
                    <button 
                        @click="openCsvModal = true"
                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg shadow">
                        <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                    </button>
                    @include('csvImport.modal', [
                        'model' => 'ProformaInvoice', 
                        'route' => 'admin.proforma-invoices.parseCsvImport'
                    ])
                </div>
                @endcan

                <!-- Search bar -->
                <input type="text" id="proformaSearch" placeholder="Search invoices..."
                    class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500 text-sm w-64">

            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-ProformaInvoice">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 w-10"></th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">GSTIN</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">PAN</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Billing Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">E-Way Bill</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">PO No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">PO Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Items</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Document</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($challans as $proformaInvoice)
                    <tr data-entry-id="{{ $proformaInvoice->id }}" class="hover:bg-gray-50">

                        <td class="px-4 py-3"></td>

                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->select_customer->party_name ?? '' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->select_customer->gstin ?? '' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->select_customer->phone_number ?? '' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->select_customer->pan_number ?? '' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->billing_name ?? '' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->phone_number ?? '' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->e_way_bill_no ?? '' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->po_no ?? '' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proformaInvoice->po_date ?? '' }}</td>

                        <!-- Item Names -->
                        <td class="px-4 py-3 text-sm">
                            @foreach($proformaInvoice->items as $item)
                                <span class="inline-block bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded">
                                    {{ $item->item_name }}
                                </span>
                            @endforeach
                        </td>

                        <!-- Qty -->
                        <td class="px-4 py-3 text-sm">
                            @foreach($proformaInvoice->items as $item)
                                <span 
                                    class="cursor-pointer text-blue-600 hover:underline item-details"
                                    data-name="{{ $item->item_name }}"
                                    data-description="{{ $item->pivot->description }}"
                                    data-qty="{{ $item->pivot->qty }}"
                                    data-unit="{{ $item->pivot->unit }}"
                                    data-price="{{ $item->pivot->price }}"
                                    data-discount_type="{{ $item->pivot->discount_type }}"
                                    data-discount="{{ $item->pivot->discount }}"
                                    data-tax_type="{{ $item->pivot->tax_type }}"
                                    data-tax="{{ $item->pivot->tax }}"
                                    data-amount="{{ $item->pivot->amount }}"
                                >
                                    {{ $item->pivot->qty }}
                                </span><br>
                            @endforeach
                        </td>

                        <!-- Image -->
                        <td class="px-4 py-3 text-sm">
                            @if($proformaInvoice->image)
                                <a href="{{ $proformaInvoice->image->getUrl() }}" target="_blank">
                                    <img src="{{ $proformaInvoice->image->getUrl('thumb') }}" class="h-10 w-10 rounded border">
                                </a>
                            @endif
                        </td>

                        <!-- Document -->
                        <td class="px-4 py-3 text-sm">
                            @if($proformaInvoice->document)
                                <a href="{{ $proformaInvoice->document->getUrl() }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-4 py-3 text-center space-x-1">
                            @can('proforma_invoice_show')
                                <a href="{{ route('admin.proforma-invoices.show', $proformaInvoice->id) }}" class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            @can('proforma_invoice_edit')
                                <a href="{{ route('admin.proforma-invoices.edit', $proformaInvoice->id) }}" class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endcan
                            @can('proforma_invoice_delete')
                                <form action="{{ route('admin.proforma-invoices.destroy', $proformaInvoice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline-block">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
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


<!-- ================= MODAL HTML ================= -->
<div id="itemModal" class="modal-overlay">

    <div class="modal-box" onclick="event.stopPropagation()">

        <h3 style="font-size: 18px; font-weight:600; margin-bottom:10px;">
            Item Details
        </h3>

        <table class="modal-table">
            <tr><td>Item</td><td id="m_name"></td></tr>
            <tr><td>Description</td><td id="m_description"></td></tr>
            <tr><td>Qty</td><td id="m_qty"></td></tr>
            <tr><td>Unit</td><td id="m_unit"></td></tr>
            <tr><td>Price</td><td id="m_price"></td></tr>
            <tr><td>Discount Type</td><td id="m_discount_type"></td></tr>
            <tr><td>Discount</td><td id="m_discount"></td></tr>
            <tr><td>Tax Type</td><td id="m_tax_type"></td></tr>
            <tr><td>Tax</td><td id="m_tax"></td></tr>
            <tr><td>Amount</td><td id="m_amount"></td></tr>
        </table>

        <button onclick="closeModal()" class="modal-close-btn">Close</button>

    </div>

</div>

@endsection


@section('scripts')
@parent
<script>

// Open modal
document.querySelectorAll('.item-details').forEach(el => {
    el.addEventListener('click', function () {

        document.getElementById("m_name").innerText = this.dataset.name || "-";
        document.getElementById("m_description").innerText = this.dataset.description || "-";
        document.getElementById("m_qty").innerText = this.dataset.qty || "-";
        document.getElementById("m_unit").innerText = this.dataset.unit || "-";
        document.getElementById("m_price").innerText = this.dataset.price || "-";
        document.getElementById("m_discount_type").innerText = this.dataset.discount_type || "-";
        document.getElementById("m_discount").innerText = this.dataset.discount || "-";
        document.getElementById("m_tax_type").innerText = this.dataset.tax_type || "-";
        document.getElementById("m_tax").innerText = this.dataset.tax || "-";
        document.getElementById("m_amount").innerText = this.dataset.amount || "-";

        const modal = document.getElementById("itemModal");
        modal.style.display = "flex";
        modal.style.opacity = "1";
        document.body.style.overflow = "hidden";
    });
});

// Close modal
function closeModal() {
    const modal = document.getElementById("itemModal");
    modal.style.opacity = "0";

    setTimeout(() => {
        modal.style.display = "none";
    }, 150);

    document.body.style.overflow = "auto";
}

// Close on overlay click
document.getElementById('itemModal').addEventListener('click', function(e){
    if (e.target === this) closeModal();
});

// Close on ESC
document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") closeModal();
});


/* ================= DATATABLE + SEARCH ================= */

$(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

    @can('proforma_invoice_delete')
    dtButtons.push({
        text: '{{ trans('global.datatables.delete') }}',
        url: "{{ route('admin.proforma-invoices.massDestroy') }}",
        className: 'btn-danger',
        action: function (e, dt, node, config) {
            var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
            });

            if (!ids.length) {
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
    })
    @endcan

    $.extend(true, $.fn.dataTable.defaults, {
        orderCellsTop: true,
        order: [[1, 'desc']],
        pageLength: 25,
        dom: 'lrtip'
    });

    let table = $('.datatable-ProformaInvoice:not(.ajaxTable)').DataTable({ buttons: dtButtons })

    $('#proformaSearch').on('keyup change clear', function () {
        table.search(this.value).draw();
    });
})

</script>
@endsection
