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
                            <td class="px-4 py-3 text-sm text-center">{{ $saleInvoice->status ?? '—' }}</td>

                            <td class="px-4 py-3 text-center relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                                <button class="text-gray-600 hover:text-gray-900">
                                    <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                </button>

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

                                    <!-- Profit/Loss Button -->
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
@endsection

<!-- ✅ Profit/Loss Modal (All Sections Combined) -->
<div id="profitLossModal" class="fixed inset-0 hidden items-center justify-center z-[9999]">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeProfitLossModal()"></div>

    <!-- Modal Card -->
    <div class="relative w-full max-w-5xl mx-4 rounded-2xl shadow-2xl overflow-hidden bg-white/80 backdrop-blur-xl border border-white/60">
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
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium bg-emerald-600 hover:bg-emerald-700 text-white shadow">
                    <i class="fas fa-file-download"></i> Download PDF
                </button>
                <button onclick="closeProfitLossModal()"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 shadow">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Body -->
        <div id="profitLossContent" class="px-6 py-4 max-h-[67vh] overflow-y-auto text-sm text-gray-700">
            <div id="plTabsContainer" class="space-y-4">
                <!-- Header Band -->
                <div id="plHeaderBand" class="rounded-xl border bg-white/70 p-4">
                    <h3 class="text-xl font-bold text-indigo-700">Profit &amp; Loss Report</h3>
                    <p class="text-xs text-gray-500" id="plGeneratedAt">—</p>
                </div>

                <!-- Table Section -->
                <section id="tab-table" class="plTabPane">
                    <div class="rounded-xl border overflow-hidden">
                        <h4 class="text-sm font-semibold text-gray-700 bg-gray-50 px-3 py-2">Items Table</h4>
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
                            <tbody id="plItemsBody"></tbody>
                        </table>
                    </div>
                </section>

                <!-- Bar Chart Section -->
                <section id="tab-bar" class="plTabPane">
                    <div class="rounded-xl border p-4 bg-white/70 h-[310px]">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Sale vs Purchase (Bar Chart)</h4>
                        <div class="h-[260px]"><canvas id="plBarChart"></canvas></div>
                    </div>
                </section>

                <!-- Pie Chart Section -->
                <section id="tab-pie" class="plTabPane">
                    <div class="rounded-xl border p-4 bg-white/70 h-[310px]">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Profit vs Loss (Pie Chart)</h4>
                        <div class="h-[260px]"><canvas id="plPieChart"></canvas></div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Footer -->
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

<!-- Chart.js + html2pdf bundle -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2pdf.js@0.10.1/dist/html2pdf.bundle.min.js"></script>

<!-- ✅ Profit/Loss Modal (All Sections Visible) -->
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

        <!-- Body (All Sections Visible) -->
        <div id="profitLossContent" class="px-6 py-4 max-h-[67vh] overflow-y-auto text-sm text-gray-700">
            <div id="plTabsContainer" class="space-y-4">
                
                <!-- Header Band -->
                <div id="plHeaderBand" class="rounded-xl border bg-white/70 p-4">
                    <h3 class="text-xl font-bold text-indigo-700">Profit &amp; Loss Report</h3>
                    <p class="text-xs text-gray-500" id="plGeneratedAt">—</p>
                </div>

                <!-- TABLE SECTION -->
                <section id="tab-table" class="plTabPane">
                    <div class="rounded-xl border overflow-hidden">
                        <h4 class="text-sm font-semibold text-gray-700 bg-gray-50 px-3 py-2">Items Table</h4>
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
                            <tbody id="plItemsBody"><!-- rows inject dynamically --></tbody>
                        </table>
                    </div>
                </section>

                <!-- BAR CHART SECTION -->
                <section id="tab-bar" class="plTabPane">
                    <div class="rounded-xl border p-4 bg-white/70 h-[310px]">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Sale vs Purchase (Bar Chart)</h4>
                        <div class="h-[260px]">
                            <canvas id="plBarChart"></canvas>
                        </div>
                    </div>
                </section>

                <!-- PIE CHART SECTION -->
                <section id="tab-pie" class="plTabPane">
                    <div class="rounded-xl border p-4 bg-white/70 h-[310px]">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Profit vs Loss (Pie Chart)</h4>
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

<!-- ✅ Manufacture Modal -->
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

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/html2pdf.js@0.10.1/dist/html2pdf.bundle.min.js"></script>

<script>
let selectedInvoiceId = null, currentPLData = null, barChartInstance = null, pieChartInstance = null;

// --- Modal Controls ---
function openManufactureModal(id) {
    selectedInvoiceId = id;
    document.getElementById('manufactureModal').classList.replace('hidden', 'flex');
}
function closeManufactureModal() {
    document.getElementById('manufactureModal').classList.replace('flex', 'hidden');
}
function openProfitLossModal() {
    document.getElementById('profitLossModal').classList.replace('hidden', 'flex');
}
function closeProfitLossModal() {
    destroyCharts();
    document.getElementById('profitLossModal').classList.replace('flex', 'hidden');
}
function destroyCharts() {
    if (barChartInstance) { barChartInstance.destroy(); barChartInstance = null; }
    if (pieChartInstance) { pieChartInstance.destroy(); pieChartInstance = null; }
}

// --- Confirm Manufacture ---
document.getElementById('confirmManufactureBtn').addEventListener('click', async function() {
    if (!selectedInvoiceId) return;
    const spinner = document.getElementById('loadingSpinner');
    spinner.classList.remove('hidden');
    try {
        const res = await fetch(`{{ url('admin/sale-invoices') }}/${selectedInvoiceId}/confirm-manufacture`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' }
        });
        const result = await res.json();
        if (result.status === 'success') {
            closeManufactureModal();
            renderProfitLossModal(result.data);
            ensureBarChart();
            ensurePieChart();
            openProfitLossModal();
        } else {
            alert(result.message || 'Error occurred');
        }
    } catch (e) { alert('⚠️ ' + e.message); }
    spinner.classList.add('hidden');
});

// --- Render Profit/Loss Data ---
function fmtRupee(n){return '₹'+(Number(n)||0).toLocaleString('en-IN',{maximumFractionDigits:2})}
function renderProfitLossModal(data){
    currentPLData=data;
    const i=data.invoice, p=data.profit_loss;
    document.getElementById('plInvoiceMeta').innerHTML=
        `<strong>Customer:</strong> ${i?.select_customer?.party_name ?? '—'} &nbsp;•&nbsp;
         <strong>PO No:</strong> ${i?.po_no ?? '—'} &nbsp;•&nbsp;
         <strong>Date:</strong> ${i?.billing_date ?? '—'}`;
    document.getElementById('plGeneratedAt').innerText=`Invoice #${i?.id ?? '—'} • ${new Date().toLocaleString()}`;
    const tb=document.getElementById('plItemsBody');
    tb.innerHTML='';
    (p.composition_json||[]).forEach(it=>{
        tb.insertAdjacentHTML('beforeend',`
        <tr class="odd:bg-white even:bg-gray-50">
            <td class="border px-2 py-[2px]">${it.product_name}</td>
            <td class="border px-2 py-[2px] text-center">${it.qty}</td>
            <td class="border px-2 py-[2px] text-right">${fmtRupee(it.sale_price)}</td>
            <td class="border px-2 py-[2px] text-right">${fmtRupee(it.purchase_price)}</td>
            <td class="border px-2 py-[2px] text-right">${fmtRupee(it.total)}</td>
        </tr>`);
    });
    document.getElementById('profitLossTotals').innerHTML=`
        <div class="inline-grid grid-cols-3 gap-6 text-right text-[12px]">
            <div><span class="text-gray-500">Total Purchase:</span> <span class="font-semibold">${fmtRupee(p.total_purchase_value)}</span></div>
            <div><span class="text-gray-500">Total Sale:</span> <span class="font-semibold">${fmtRupee(p.total_sale_value)}</span></div>
            <div><span class="text-gray-500">Result:</span>
                 <span class="${p.is_profit?'text-green-600':'text-red-600'} font-bold">${p.is_profit?'Profit':'Loss'}: ${fmtRupee(p.profit_loss_amount)}</span></div>
        </div>`;
}

// --- Charts ---
function ensureBarChart(height=200){
    const p=currentPLData.profit_loss;
    const labels=p.composition_json.map(x=>x.product_name);
    const sale=p.composition_json.map(x=>x.sale_price*x.qty);
    const purchase=p.composition_json.map(x=>x.purchase_price*x.qty);
    const ctx=document.getElementById('plBarChart');
    ctx.height=height;
    barChartInstance=new Chart(ctx,{
        type:'bar',
        data:{labels,datasets:[
            {label:'Sale',data:sale,backgroundColor:'#6366f1'},
            {label:'Purchase',data:purchase,backgroundColor:'#a5b4fc'}
        ]},
        options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'bottom',labels:{boxWidth:10,font:{size:10}}}}}
    });
}
function ensurePieChart(height=150){
    const p=currentPLData.profit_loss;
    const profit=Math.max(p.profit_loss_amount,0);
    const loss=Math.max(-p.profit_loss_amount,0);
    const ctx=document.getElementById('plPieChart');
    ctx.height=height;
    pieChartInstance=new Chart(ctx,{
        type:'pie',
        data:{labels:['Profit','Loss'],datasets:[{data:[profit,loss],backgroundColor:['#16a34a','#dc2626']}]},
        options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'bottom',labels:{boxWidth:10,font:{size:10}}}}}
    });
}

// --- Download PDF (Compact, Full Modal, Multi-page) ---
document.getElementById('btnDownloadPdf').addEventListener('click', async () => {
    try {
        const modal = document.getElementById('profitLossModal');
        const content = modal.querySelector('.relative'); // full card content

        // ✅ Show loader
        const loader = document.createElement('div');
        loader.className = "absolute inset-0 bg-white/80 flex flex-col items-center justify-center z-[99999]";
        loader.innerHTML = `<i class='fas fa-spinner fa-spin text-indigo-600 text-2xl mb-2'></i><p class='text-xs text-gray-600'>Generating PDF...</p>`;
        content.appendChild(loader);

        // ✅ Clean + small charts
        destroyCharts();
        ensureBarChart(160);
        ensurePieChart(120);
        await new Promise(res=>setTimeout(res,400));

        // ✅ PDF settings (auto-pagebreak + small text)
        const clone = content.cloneNode(true);
        clone.style.fontSize='10px';
        clone.style.lineHeight='1.3';
        const opt = {
            margin:[5,5,5,5],
            filename:`profit-loss-${selectedInvoiceId}.pdf`,
            html2canvas:{scale:2,useCORS:true,scrollY:0},
            jsPDF:{unit:'mm',format:'a4',orientation:'portrait'},
            pagebreak:{mode:['avoid-all','css','legacy']},
        };

        await html2pdf().set(opt).from(clone).save();

        // ✅ Clean up
        loader.remove();
        destroyCharts();
        ensureBarChart();
        ensurePieChart();
    } catch (err) {
        console.error("PDF generation error:", err);
        alert("⚠️ Failed to generate PDF. Please try again.");
    }
});
</script>

<style>
#profitLossContent * {
    font-size: 11px !important;
    line-height: 1.3 !important;
}
#plBarChart, #plPieChart {
    max-height: 180px !important;
    height: 180px !important;
}
#profitLossContent table th,
#profitLossContent table td {
    padding: 2px 4px !important;
}
</style>
