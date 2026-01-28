@extends('layouts.admin')

@section('content')

{{-- ================= DATATABLE CDN ================= --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="space-y-6">

    {{-- ================= FILTER ================= --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">GST-1 Report</h2>
                <p class="text-sm text-gray-500">Sales GST summary & invoice details</p>
            </div>

            <button type="button"
                    onclick="openPdfModal()"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2">
                ⬇ Download PDF
            </button>
        </div>

        <form method="GET" class="grid md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="text-sm font-medium text-gray-600">Month</label>
                <input type="month" name="month" value="{{ $month }}"
                       class="w-full rounded-lg border-gray-300 focus:ring focus:ring-indigo-200">
            </div>

            <div>
                <label class="text-sm font-medium text-gray-600">Party</label>
                <select name="select_customer_id"
                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-indigo-200">
                    <option value="">All Parties</option>
                    @foreach($parties as $party)
                        <option value="{{ $party->id }}"
                            {{ $partyId == $party->id ? 'selected' : '' }}>
                            {{ $party->party_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2 mt-6">
                <input type="checkbox" name="show_no_gst" value="1"
                       {{ $showNoGst ? 'checked' : '' }}>
                <span class="text-sm text-gray-600">Show without GST</span>
            </div>

            <button class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2 rounded-lg">
                Apply
            </button>
        </form>
    </div>

    {{-- ================= PDF MODAL ================= --}}
    <div id="pdfModal"
         class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                📄 Download GST-1 PDF
            </h3>

            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Month <span class="text-red-500">*</span>
                    </label>
                    <input type="month" id="pdfMonth"
                           class="w-full rounded-lg border-gray-300">
                    <p id="monthError" class="text-xs text-red-500 hidden">
                        Please select month
                    </p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">
                        Party (Optional)
                    </label>
                    <select id="pdfParty"
                            class="w-full rounded-lg border-gray-300">
                        <option value="">All Parties</option>
                        @foreach($parties as $party)
                            <option value="{{ $party->id }}">
                                {{ $party->party_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button onclick="closePdfModal()"
                        class="px-4 py-2 rounded-lg border">
                    Cancel
                </button>

                <button onclick="downloadPdf()"
                        class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg">
                    Download
                </button>
            </div>
        </div>
    </div>

    {{-- ================= PARTY MODE ================= --}}
    @if($selectedParty)

        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-2xl shadow p-6">
            <h2 class="text-2xl font-bold">{{ $selectedParty->party_name }}</h2>

            <div class="grid md:grid-cols-3 gap-4 mt-4 text-sm">
                <div><b>GSTIN:</b> {{ $selectedParty->gstin ?? '-' }}</div>
                <div><b>Phone:</b> {{ $selectedParty->phone_number ?? '-' }}</div>
                <div><b>Email:</b> {{ $selectedParty->email ?? '-' }}</div>
                <div><b>State:</b> {{ $selectedParty->state ?? '-' }}</div>
                <div><b>City:</b> {{ $selectedParty->city ?? '-' }}</div>
                <div>
                    <b>Balance:</b>
                    {{ number_format($selectedParty->current_balance ?? 0,2) }}
                    ({{ $selectedParty->current_balance_type ?? '-' }})
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Sales Invoices</h3>

            <table id="invoiceTable" class="display w-full">
                <thead>
                    <tr>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th>Subtotal</th>
                        <th>GST</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->sale_invoice_number }}</td>
                            <td>{{ $invoice->po_date }}</td>
                            <td>{{ number_format($invoice->subtotal,2) }}</td>
                            <td>{{ number_format($invoice->tax,2) }}</td>
                            <td>{{ number_format($invoice->total,2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else

<div class="space-y-6">

    <!-- Header -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800">
            GST-1 (Sales GST Report)
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Party wise & invoice wise GST summary
        </p>
    </div>

    <!-- Party Wise GST Summary -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Party Wise GST Summary
        </h3>

        <div class="overflow-x-auto">
            <table id="invoiceTable"
                   class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">Party</th>
                        <th class="px-4 py-3 text-left">GSTIN</th>
                        <th class="px-4 py-3 text-left">State</th>
                        <th class="px-4 py-3 text-right">Taxable Amount</th>
                        <th class="px-4 py-3 text-right">GST Amount</th>
                        <th class="px-4 py-3 text-right">Total Sales</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($partyWise as $partyInvoices)
                        @php
                            $taxable = $partyInvoices->sum('total') - $partyInvoices->sum('tax');
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">
                                {{ $partyInvoices->first()->select_customer->party_name ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $partyInvoices->first()->select_customer->gstin ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $partyInvoices->first()->select_customer->state ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                ₹ {{ number_format($taxable, 2) }}
                            </td>
                            <td class="px-4 py-3 text-right font-semibold text-primary-700">
                                ₹ {{ number_format($partyInvoices->sum('tax'), 2) }}
                            </td>
                            <td class="px-4 py-3 text-right font-semibold">
                                ₹ {{ number_format($partyInvoices->sum('total'), 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-100 font-semibold">
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-right">Grand Total</td>
                        <td class="px-4 py-3 text-right">
                            ₹ {{ number_format($grandTotalSales - $grandTotalGst, 2) }}
                        </td>
                        <td class="px-4 py-3 text-right text-primary-700">
                            ₹ {{ number_format($grandTotalGst, 2) }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            ₹ {{ number_format($grandTotalSales, 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Invoice Level Details -->
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            Invoice Level GST Details
        </h3>

        <div class="overflow-x-auto">
            <table id="invoiceLevelTable"
                   class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-sm">
                    <tr>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Invoice No</th>
                        <th class="px-4 py-3">Party</th>
                        <th class="px-4 py-3 text-right">Taxable</th>
                        <th class="px-4 py-3 text-right">GST %</th>
                        <th class="px-4 py-3 text-right">GST Amt</th>
                        <th class="px-4 py-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($invoices as $invoice)
                        @php
                            $taxable = $invoice->total - $invoice->tax;
                            $gstPercent = $taxable > 0 ? ($invoice->tax / $taxable) * 100 : 0;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">
                                {{ $invoice->po_date }}
                            </td>
                            <td class="px-4 py-3 text-sm font-medium">
                                {{ $invoice->sale_invoice_number }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $invoice->select_customer->party_name ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                ₹ {{ number_format($taxable, 2) }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                {{ number_format($gstPercent, 2) }} %
                            </td>
                            <td class="px-4 py-3 text-right text-primary-700 font-medium">
                                ₹ {{ number_format($invoice->tax, 2) }}
                            </td>
                            <td class="px-4 py-3 text-right font-semibold">
                                ₹ {{ number_format($invoice->total, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                No records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>



    @endif
</div>
@endsection

@section('scripts')
@parent

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

<script>
/* ================= GLOBAL DATA ================= */
window.gstInvoices = {!! json_encode($gstInvoices) !!};
window.authUser    = {!! json_encode($authUserData) !!};

/* ================= MODAL ================= */
function openPdfModal() {
    const modal = document.getElementById('pdfModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closePdfModal() {
    document.getElementById('pdfModal').classList.add('hidden');
}

/* ================= DATE HELPERS ================= */
function formatDate(date) {
    return date.toLocaleDateString('en-GB');
}

function monthShortName(index) {
    return ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'][index];
}

function getDateRange(monthValue) {

    const selected = new Date(monthValue + '-01');
    const today = new Date();

    const startDate = new Date(
        selected.getFullYear(),
        selected.getMonth(),
        1
    );

    let endDate;

    // Same month download
    if (
        selected.getMonth() === today.getMonth() &&
        selected.getFullYear() === today.getFullYear()
    ) {
        endDate = today;
    } else {
        // Full selected month
        endDate = new Date(
            selected.getFullYear(),
            selected.getMonth() + 1,
            0
        );
    }

    return { startDate, endDate };
}

/* ================= DOWNLOAD HANDLER ================= */
function downloadPdf() {

    if (!window.gstInvoices || window.gstInvoices.length === 0) {
        alert('No invoice data available');
        return;
    }

    const monthValue = document.getElementById('pdfMonth').value;
    const partySelect = document.getElementById('pdfParty');
    const partyName = partySelect.selectedOptions[0].text;
    const error = document.getElementById('monthError');

    if (!monthValue) {
        error.classList.remove('hidden');
        return;
    }

    error.classList.add('hidden');
    generateCleanPdf(monthValue, partyName);
}

/* ================= PDF GENERATOR ================= */
function generateCleanPdf(monthValue, partyName) {

    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('l', 'mm', 'a4'); // 👈 LANDSCAPE


    const today = new Date();
    const selected = new Date(monthValue + '-01');

    const { startDate, endDate } = getDateRange(monthValue);

    /* ================= TOTAL CALCULATIONS ================= */
    let totalTaxable = 0;
    let totalGst = 0;
    let grandTotal = 0;

    window.gstInvoices.forEach(inv => {
        totalTaxable += parseFloat((inv.taxable || '0').toString().replace(/,/g,'')) || 0;
        totalGst     += parseFloat((inv.gst || '0').toString().replace(/,/g,'')) || 0;
        grandTotal   += parseFloat((inv.total || '0').toString().replace(/,/g,'')) || 0;
    });

    /* ================= HEADER ================= */
    pdf.setFontSize(14);
    pdf.text('GST-1 Report', 14, 15);

    pdf.setFontSize(10);
    pdf.text(`Party: ${partyName}`, 14, 22);
    pdf.text(
        `Period: ${formatDate(startDate)} to ${formatDate(endDate)}`,
        14,
        28
    );
    pdf.text(`Downloaded On: ${formatDate(today)}`, 14, 34);
    pdf.text(
        `Downloaded By: ${authUser.name} (${authUser.roles.join(', ')})`,
        14,
        40
    );

    /* ================= TABLE ================= */
    const rows = window.gstInvoices.map(inv => [
        inv.date ?? '',
        inv.invoice ?? '',
        inv.party ?? '',
        inv.gstin ?? '',
        inv.taxable ?? '0.00',
        inv.gst ?? '0.00',
        inv.total ?? '0.00'
        
    ]);

    pdf.autoTable({
        startY: 48,
        head: [[
            'Date',
            'Invoice No',
            'Party',
            'GST NO',
            'Taxable Amount',
            'GST Amount',
            'Total Amount'
        ]],
        body: rows,
        styles: {
            fontSize: 9,
            cellPadding: 3
        },
        headStyles: {
            fillColor: [79, 70, 229],
            textColor: 255
        }
    });

    /* ================= TOTALS ================= */
    const finalY = pdf.lastAutoTable.finalY + 8;

    pdf.setFontSize(10);
    pdf.text(`Total Taxable Amount : ₹ ${totalTaxable.toFixed(2)}`, 14, finalY);
    pdf.text(`Total GST Amount     : ₹ ${totalGst.toFixed(2)}`, 14, finalY + 6);
    pdf.text(`Grand Total          : ₹ ${grandTotal.toFixed(2)}`, 14, finalY + 12);

    /* ================= FOOTER ================= */
    pdf.setFontSize(9);
    pdf.text(
        'System Generated GST-1 Report',
        14,
        pdf.internal.pageSize.height - 10
    );

    /* ================= FILE NAME ================= */
    const fileName =
        `GST-1_${monthShortName(selected.getMonth())}-${selected.getFullYear()}_Downloaded-${formatDate(today).replace(/\//g,'-')}.pdf`;

    pdf.save(fileName);
    closePdfModal();
}

/* ================= DATATABLE ================= */
$(document).ready(function () {
    if ($('#invoiceTable').length) {
        $('#invoiceTable').DataTable({
            pageLength: 10,
            order: [[1, 'desc']]
        });
    }
});
</script>
        
@endsection
