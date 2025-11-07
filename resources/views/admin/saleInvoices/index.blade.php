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
                                        <i class="fas fa-industry mr-2"></i> Profit/Loss
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

<!-- Profit/Loss Modal (Centered Creative with Tabs) -->
<div id="profitLossModal" class="fixed inset-0 hidden items-center justify-center z-[9999]">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeProfitLossModal()"></div>

    <!-- Modal Card -->
    <div class="relative w-full max-w-5xl mx-4 rounded-2xl shadow-2xl overflow-hidden
                bg-white/80 backdrop-blur-xl border border-white/60"
         style="box-shadow: 0 25px 50px -12px rgba(0,0,0,0.35);">

        <!-- Gradient Top Bar -->
        <div class="h-2 w-full bg-gradient-to-r from-indigo-500 via-fuchsia-500 to-cyan-500"></div>

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 bg-white">
            <div>
                <h2 class="text-lg font-semibold text-indigo-700">Profit &amp; Loss Details</h2>
                <p class="text-xs text-gray-500" id="plInvoiceMeta">—</p>
            </div>
            <div class="flex items-center gap-2">
                <button id="btnDownloadPdf"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium
                               bg-emerald-600 hover:bg-emerald-700 text-white shadow">
                    <i class="fas fa-file-download"></i>
                    Download PDF
                </button>
                <button onclick="closeProfitLossModal()"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-xl
                               bg-gray-100 hover:bg-gray-200 text-gray-700 shadow">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Tabs (Icon + Text) -->
        <div class="px-6 pt-2 bg-white">
            <div class="flex gap-2">
                <button class="plTab active"
                        data-target="#tab-table">
                    <i class="fas fa-table"></i>
                    <span>Items Table</span>
                </button>
                <button class="plTab"
                        data-target="#tab-bar">
                    <i class="fas fa-chart-bar"></i>
                    <span>Bar Chart</span>
                </button>
                <button class="plTab"
                        data-target="#tab-pie">
                    <i class="fas fa-chart-pie"></i>
                    <span>Pie Chart</span>
                </button>
            </div>
        </div>

        <!-- Body (Tabs Content) -->
        <div id="profitLossContent" class="px-6 py-4 max-h-[67vh] overflow-y-auto text-sm text-gray-700">
            <div id="plTabsContainer" class="space-y-4">
                <!-- Header band inside PDF scope -->
                <div id="plHeaderBand" class="rounded-xl border bg-white/70 p-4">
                    <h3 class="text-xl font-bold text-indigo-700">Profit &amp; Loss Report</h3>
                    <p class="text-xs text-gray-500" id="plGeneratedAt">—</p>
                </div>

                <!-- TAB: TABLE -->
                <section id="tab-table" class="plTabPane">
                    <div class="rounded-xl border overflow-hidden">
                        <table class="min-w-full border text-sm">
                            <thead class="bg-gradient-to-r from-indigo-50 to-cyan-50">
                                <tr>
                                    <th class="border px-2 py-2 text-left">Product</th>
                                    <th class="border px-2 py-2 text-center">Qty</th>
                                    <th class="border px-2 py-2 text-right">Sale Price</th>
                                    <th class="border px-2 py-2 text-right">Purchase Price</th>
                                    <th class="border px-2 py-2 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody id="plItemsBody"><!-- rows inject --></tbody>
                        </table>
                    </div>
                </section>

                <!-- TAB: BAR -->
                <section id="tab-bar" class="plTabPane hidden">
                    <div class="rounded-xl border p-4 bg-white/70 h-[310px]">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Sale vs Purchase (Bar)</h4>
                        <div class="h-[260px]">
                            <canvas id="plBarChart"></canvas>
                        </div>
                    </div>
                </section>

                <!-- TAB: PIE -->
                <section id="tab-pie" class="plTabPane hidden">
                    <div class="rounded-xl border p-4 bg-white/70 h-[310px]">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Profit vs Loss (Pie)</h4>
                        <div class="h-[260px]">
                            <canvas id="plPieChart"></canvas>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Footer Summary -->
        <div class="px-6 py-4 bg-white border-t">
            <div id="profitLossTotals" class="text-right text-sm">—</div>
        </div>
    </div>
</div>

<!-- Manufacture Modal -->
<div id="manufactureModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm hidden items-center justify-center z-[9998]">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
        <h2 class="text-lg font-semibold text-indigo-700 mb-3">Confirm Manufacture</h2>
        <p class="text-sm text-gray-600 mb-6">Confirming manufacture will update Profit &amp; Loss details automatically.</p>
        <div id="loadingSpinner" class="hidden absolute inset-0 bg-white/80 flex items-center justify-center rounded-2xl">
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
<!-- Chart.js + html2pdf bundle -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2pdf.js@0.10.1/dist/html2pdf.bundle.min.js"></script>

<script>
let selectedInvoiceId = null;
let currentPLData = null;
let barChartInstance = null;
let pieChartInstance = null;
let chartsReady = { bar: false, pie: false };

function openManufactureModal(id) {
    selectedInvoiceId = id;
    document.getElementById('manufactureModal').classList.remove('hidden');
    document.getElementById('manufactureModal').classList.add('flex');
}

function closeManufactureModal() {
    document.getElementById('manufactureModal').classList.add('hidden');
    document.getElementById('manufactureModal').classList.remove('flex');
}

function openProfitLossModal() {
    const modal = document.getElementById('profitLossModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeProfitLossModal() {
    destroyCharts();
    const modal = document.getElementById('profitLossModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function destroyCharts() {
    if (barChartInstance) { barChartInstance.destroy(); barChartInstance = null; }
    if (pieChartInstance) { pieChartInstance.destroy(); pieChartInstance = null; }
    chartsReady = { bar: false, pie: false };
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
            openProfitLossModal();
            // default active tab: table (already active)
        } else {
            alert(result.message || 'Error occurred');
        }
    } catch (e) {
        alert('⚠️ ' + e.message);
    } finally {
        spinner.classList.add('hidden');
    }
});

function fmtRupee(n) {
    if (n === null || n === undefined || n === '') return '₹0';
    const v = Number(n) || 0;
    return '₹' + v.toLocaleString('en-IN', { maximumFractionDigits: 2, minimumFractionDigits: 0 });
}

function renderProfitLossModal(data) {
    currentPLData = data;
    const i = data.invoice;
    const p = data.profit_loss;

    // Header meta
    const meta = [];
    meta.push(`<strong>Customer:</strong> ${i?.select_customer?.party_name ?? i?.select_customer?.phone_number ?? '—'}`);
    meta.push(`<strong>State:</strong> ${i?.select_customer?.state ?? '—'}`);
    meta.push(`<strong>Docket No:</strong> ${i?.docket_no ?? '—'}`);
    meta.push(`<strong>Billing Date:</strong> ${i?.billing_date ?? '—'}`);
    meta.push(`<strong>Cost Center:</strong> ${i?.main_cost_center?.name ?? '—'}`);
    meta.push(`<strong>Sub Cost Center:</strong> ${i?.sub_cost_center?.name ?? '—'}`);
    document.getElementById('plInvoiceMeta').innerHTML = meta.join(' &nbsp;•&nbsp; ');

    // Header band timestamp
    document.getElementById('plGeneratedAt').innerText = `Sale Invoice #${i?.id ?? '—'} • Generated ${new Date().toLocaleString('en-IN')}`;

    // Build table rows
    const tbody = document.getElementById('plItemsBody');
    tbody.innerHTML = '';
    (p.composition_json || []).forEach(item => {
        const tr = document.createElement('tr');
        tr.className = 'odd:bg-white even:bg-gray-50';
        tr.innerHTML = `
            <td class="border px-2 py-1">${item.product_name ?? '—'}</td>
            <td class="border px-2 py-1 text-center">${item.qty ?? 0}</td>
            <td class="border px-2 py-1 text-right">${fmtRupee(item.sale_price)}</td>
            <td class="border px-2 py-1 text-right">${fmtRupee(item.purchase_price)}</td>
            <td class="border px-2 py-1 text-right">${fmtRupee(item.total)}</td>
        `;
        tbody.appendChild(tr);

        if (item.raw_materials && item.raw_materials.length > 0) {
            const rmHeader = document.createElement('tr');
            rmHeader.innerHTML = `
                <td colspan="5" class="bg-gray-50 text-xs text-gray-600 px-2 py-1">
                    <strong>Raw Materials Used:</strong>
                </td>`;
            tbody.appendChild(rmHeader);

            item.raw_materials.forEach(rm => {
                const rmTr = document.createElement('tr');
                rmTr.className = 'text-xs text-gray-600';
                rmTr.innerHTML = `
                    <td class="border px-2 py-1 pl-6">- ${rm.raw_material_name ?? '—'}</td>
                    <td class="border px-2 py-1 text-center">${rm.qty ?? 0}</td>
                    <td class="border px-2 py-1 text-right">${fmtRupee(rm.sale_price)}</td>
                    <td class="border px-2 py-1 text-right">${fmtRupee(rm.purchase_price)}</td>
                    <td class="border px-2 py-1 text-right">${fmtRupee(rm.total_purchase_value)}</td>
                `;
                tbody.appendChild(rmTr);
            });
        }
    });

    // Totals
    const totalsHtml = `
        <div class="inline-grid grid-cols-3 gap-6 text-right">
            <div><span class="text-gray-500">Total Purchase:</span> <span class="font-semibold">${fmtRupee(p.total_purchase_value)}</span></div>
            <div><span class="text-gray-500">Total Sale:</span> <span class="font-semibold">${fmtRupee(p.total_sale_value)}</span></div>
            <div>
                <span class="text-gray-500">Result:</span>
                <span class="${p.is_profit ? 'text-green-600' : 'text-red-600'} font-bold">
                    ${p.is_profit ? 'Profit' : 'Loss'}: ${fmtRupee(p.profit_loss_amount)}
                </span>
            </div>
        </div>
    `;
    document.getElementById('profitLossTotals').innerHTML = totalsHtml;

    // Reset charts state
    destroyCharts();
    // Charts render lazily when their tab is opened
}

// Tabs logic
document.addEventListener('click', function(e) {
    if (!e.target.closest('.plTab')) return;
    const btn = e.target.closest('.plTab');
    const target = btn.getAttribute('data-target');

    document.querySelectorAll('.plTab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.querySelectorAll('.plTabPane').forEach(p => p.classList.add('hidden'));
    const pane = document.querySelector(target);
    if (pane) pane.classList.remove('hidden');

    // Render charts on demand
    if (target === '#tab-bar') ensureBarChart();
    if (target === '#tab-pie') ensurePieChart();
});

function ensureBarChart() {
    if (chartsReady.bar) return;
    const p = (currentPLData || {}).profit_loss || {};
    const labels = (p.composition_json || []).map(it => it.product_name ?? 'Item');
    const saleData = (p.composition_json || []).map(it => Number(it.sale_price) * Number(it.qty || 0));
    const purchaseData = (p.composition_json || []).map(it => Number(it.purchase_price) * Number(it.qty || 0));

    const barCtx = document.getElementById('plBarChart');
    if (!barCtx) return;

    barChartInstance = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels,
            datasets: [
                { label: 'Sale', data: saleData },
                { label: 'Purchase', data: purchaseData },
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'top' } },
            scales: {
                x: { ticks: { autoSkip: true, maxRotation: 0 } },
                y: { beginAtZero: true }
            }
        }
    });
    chartsReady.bar = true;
}

function ensurePieChart() {
    if (chartsReady.pie) return;
    const p = (currentPLData || {}).profit_loss || {};
    const profitVal = Math.max(Number(p.profit_loss_amount || 0), 0);
    const lossVal = Math.max(-Number(p.profit_loss_amount || 0), 0);

    const pieCtx = document.getElementById('plPieChart');
    if (!pieCtx) return;

    pieChartInstance = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Profit', 'Loss'],
            datasets: [{ data: [profitVal, lossVal] }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
    chartsReady.pie = true;
}

// PDF (includes header + table + both charts)
// If chart tabs not opened yet, render them off-screen for PDF
document.getElementById('btnDownloadPdf').addEventListener('click', async function() {
    if (!currentPLData) return;

    // Make sure charts exist
    const prevActive = document.querySelector('.plTab.active')?.getAttribute('data-target');
    // render charts silently
    ensureBarChart();
    ensurePieChart();

    // Build a printable snapshot container
    const pdfWrap = document.createElement('div');
    pdfWrap.id = 'plPdfArea';
    pdfWrap.style.padding = '8px';

    // Header band clone
    const header = document.getElementById('plHeaderBand').cloneNode(true);
    pdfWrap.appendChild(header);

    // Table clone
    const tableSection = document.getElementById('tab-table').cloneNode(true);
    pdfWrap.appendChild(tableSection);

    // Append chart images (to avoid hidden canvas sizing problems)
    const barImg = document.createElement('img');
    barImg.src = (barChartInstance ? barChartInstance.toBase64Image() : '');
    barImg.style.width = '100%';
    barImg.style.maxHeight = '300px';
    barImg.style.objectFit = 'contain';

    const pieImg = document.createElement('img');
    pieImg.src = (pieChartInstance ? pieChartInstance.toBase64Image() : '');
    pieImg.style.width = '100%';
    pieImg.style.maxHeight = '300px';
    pieImg.style.objectFit = 'contain';

    const chartsBlock = document.createElement('div');
    chartsBlock.style.marginTop = '12px';
    chartsBlock.innerHTML = `
        <div style="font-weight:600;margin-bottom:6px">Sale vs Purchase (Bar)</div>
    `;
    chartsBlock.appendChild(barImg);
    const pieTitle = document.createElement('div');
    pieTitle.style.fontWeight = '600';
    pieTitle.style.margin = '12px 0 6px';
    pieTitle.textContent = 'Profit vs Loss (Pie)';
    chartsBlock.appendChild(pieTitle);
    chartsBlock.appendChild(pieImg);

    pdfWrap.appendChild(chartsBlock);

    // Totals snapshot
    const totals = document.getElementById('profitLossTotals').cloneNode(true);
    totals.style.marginTop = '12px';
    pdfWrap.appendChild(totals);

    // Attach to DOM temporarily
    document.body.appendChild(pdfWrap);

    const opt = {
        margin: [10, 10, 10, 10],
        filename: `profit-loss-invoice-${selectedInvoiceId || 'report'}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['css', 'legacy'] }
    };

    try {
        await html2pdf().set(opt).from(pdfWrap).save();
    } catch (e) {
        alert('PDF generate error: ' + e.message);
    } finally {
        pdfWrap.remove();
        // restore previous active tab (no visual change actually needed)
        if (prevActive) {
            document.querySelectorAll('.plTab').forEach(b => {
                b.classList.toggle('active', b.getAttribute('data-target') === prevActive);
            });
            document.querySelectorAll('.plTabPane').forEach(p => p.classList.add('hidden'));
            const pane = document.querySelector(prevActive);
            if (pane) pane.classList.remove('hidden');
        }
    }
});

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

<style>
/* ---------- Tabs (Icon + Text Pills) ---------- */
.plTab {
    @apply inline-flex items-center gap-2 px-3 py-2 rounded-xl text-sm font-medium
           text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 transition;
}
.plTab.active {
    @apply text-white bg-indigo-600 hover:bg-indigo-700 shadow;
}

/* ---------- Chart height fixes ---------- */
#plBarChart,
#plPieChart {
    max-height: 260px !important;
    height: 260px !important;
}
#profitLossContent canvas { display: block !important; }

/* ---------- Table borders for PDF clarity ---------- */
#plTabsContainer table { border-collapse: collapse; }
#plTabsContainer th, #plTabsContainer td { border: 1px solid #e5e7eb; }

/* ---------- Modal pop animation ---------- */
#profitLossModal .bg-white\/80 {
    animation: popIn .18s ease-out;
}
@keyframes popIn {
  from { transform: translateY(8px) scale(.98); opacity: .6; }
  to   { transform: translateY(0) scale(1); opacity: 1; }
}
</style>
@endsection
