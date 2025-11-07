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
                                    <!-- Inside the actions dropdown (below other <a> items) -->
                                    <button 
                                        class="w-full text-left flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 rounded-lg"
                                        onclick="openStatusPanel({{ $saleInvoice->id }}, '{{ $saleInvoice->status ?? 'Pending' }}')">
                                        <i class="fas fa-toggle-on mr-2"></i> Change Status
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
<!-- Slide-Over Panel -->
<div id="statusSlideOver" class="fixed inset-0 z-[10000] hidden">
  <!-- Backdrop -->
  <div class="absolute inset-0 bg-black/50" onclick="closeStatusPanel()"></div>

  <!-- Panel -->
  <div class="absolute top-0 right-0 h-full w-full sm:w-[420px] bg-white shadow-2xl overflow-y-auto">
    <!-- Header -->
    <div class="px-5 py-4 border-b flex items-center justify-between">
      <div>
        <h3 class="text-lg font-semibold text-indigo-700">Change Invoice Status</h3>
        <p class="text-xs text-gray-500" id="ss_invoiceMeta">—</p>
      </div>
      <button class="w-9 h-9 rounded-lg bg-gray-100 hover:bg-gray-200" onclick="closeStatusPanel()">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Body -->
    <div class="p-5 space-y-5">
      <div>
        <label class="text-sm font-medium text-gray-700">Select New Status</label>
        <select id="ss_newStatus" class="mt-1 w-full border rounded-lg px-3 py-2">
          <option value="Pending">Pending</option>
          <option value="Approved">Approved</option>
          <option value="Rejected">Rejected</option>
          <option value="Cancelled">Cancelled</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <div>
        <label class="text-sm font-medium text-gray-700">Remark (optional)</label>
        <textarea id="ss_remark" rows="3" class="mt-1 w-full border rounded-lg px-3 py-2" placeholder="Write a note..."></textarea>
      </div>

      <div id="ss_alert" class="hidden text-sm rounded-lg px-3 py-2"></div>

      <div class="flex items-center justify-end gap-3 pt-2">
        <button class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300" onclick="closeStatusPanel()">Cancel</button>
        <button id="ss_btnSave" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white"
                onclick="submitStatusChange()">Update Status</button>
      </div>

      <!-- History -->
      <div class="pt-4">
        <h4 class="text-sm font-semibold text-gray-700 mb-2">Status History</h4>
        <div id="ss_history" class="space-y-3 text-sm">
          <!-- timeline rows -->
        </div>
      </div>
    </div>
  </div>
</div>

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
            <td class="border px-2 py-1">${it.product_name}</td>
            <td class="border px-2 py-1 text-center">${it.qty}</td>
            <td class="border px-2 py-1 text-right">${fmtRupee(it.sale_price)}</td>
            <td class="border px-2 py-1 text-right">${fmtRupee(it.purchase_price)}</td>
            <td class="border px-2 py-1 text-right">${fmtRupee(it.total)}</td>
        </tr>`);
    });
    document.getElementById('profitLossTotals').innerHTML=`
        <div class="inline-grid grid-cols-3 gap-6 text-right">
            <div><span class="text-gray-500">Total Purchase:</span> <span class="font-semibold">${fmtRupee(p.total_purchase_value)}</span></div>
            <div><span class="text-gray-500">Total Sale:</span> <span class="font-semibold">${fmtRupee(p.total_sale_value)}</span></div>
            <div><span class="text-gray-500">Result:</span>
                 <span class="${p.is_profit?'text-green-600':'text-red-600'} font-bold">${p.is_profit?'Profit':'Loss'}: ${fmtRupee(p.profit_loss_amount)}</span></div>
        </div>`;
}

// --- Charts ---
function ensureBarChart(){
    const p=currentPLData.profit_loss;
    const labels=p.composition_json.map(x=>x.product_name);
    const sale=p.composition_json.map(x=>x.sale_price*x.qty);
    const purchase=p.composition_json.map(x=>x.purchase_price*x.qty);
    barChartInstance=new Chart(document.getElementById('plBarChart'),{
        type:'bar',
        data:{labels,datasets:[{label:'Sale',data:sale},{label:'Purchase',data:purchase}]},
        options:{responsive:true,maintainAspectRatio:false}
    });
}
function ensurePieChart(){
    const p=currentPLData.profit_loss;
    const profit=Math.max(p.profit_loss_amount,0);
    const loss=Math.max(-p.profit_loss_amount,0);
    pieChartInstance=new Chart(document.getElementById('plPieChart'),{
        type:'pie',
        data:{labels:['Profit','Loss'],datasets:[{data:[profit,loss]}]},
        options:{responsive:true,maintainAspectRatio:false}
    });
}

// --- Download PDF ---
document.getElementById('btnDownloadPdf').addEventListener('click',async()=>{
    ensureBarChart(); ensurePieChart();
    const clone=document.getElementById('profitLossContent').cloneNode(true);
    const opt={margin:10,filename:`profit-loss-${selectedInvoiceId}.pdf`,
        html2canvas:{scale:2},jsPDF:{unit:'mm',format:'a4',orientation:'portrait'}};
    await html2pdf().set(opt).from(clone).save();
});
</script>
<script>
let ss_invoiceId = null;

function openStatusPanel(invoiceId, currentStatus) {
    ss_invoiceId = invoiceId;
    // Set meta
    document.getElementById('ss_invoiceMeta').innerText = `Invoice #${invoiceId}`;
    // Preselect current status
    const sel = document.getElementById('ss_newStatus');
    if ([...sel.options].some(o => o.value === currentStatus)) {
        sel.value = currentStatus;
    } else {
        sel.value = 'Pending';
    }
    document.getElementById('ss_remark').value = '';
    setStatusAlert(); // clear
    // Load history
    loadStatusHistory(invoiceId);
    // Open
    document.getElementById('statusSlideOver').classList.remove('hidden');
}

function closeStatusPanel() {
    document.getElementById('statusSlideOver').classList.add('hidden');
}

function setStatusAlert(type = null, msg = '') {
    const el = document.getElementById('ss_alert');
    el.classList.add('hidden');
    el.classList.remove('bg-red-50','text-red-700','bg-emerald-50','text-emerald-700');
    if (!type) return;
    el.classList.remove('hidden');
    if (type === 'error') el.classList.add('bg-red-50','text-red-700');
    if (type === 'success') el.classList.add('bg-emerald-50','text-emerald-700');
    el.innerText = msg;
}

async function loadStatusHistory(invoiceId) {
    const box = document.getElementById('ss_history');
    box.innerHTML = `<div class="text-gray-400">Loading...</div>`;
    try {
        const res = await fetch(`{{ url('admin/sale-invoices') }}/${invoiceId}/status-history`);
        const json = await res.json();
        if (json.status !== 'success') throw new Error('Failed');
        const rows = json.data.history;
        if (!rows.length) {
            box.innerHTML = `<div class="text-gray-400">No history yet.</div>`;
            return;
        }
        // Timeline (Modern vertical)
        box.innerHTML = rows.map(r => `
            <div class="flex gap-3">
                <div class="pt-1">
                    <span class="inline-block w-2 h-2 rounded-full ${colorDot(r.new_status)}"></span>
                </div>
                <div>
                    <div class="font-medium">${escapeHtml(r.new_status)}</div>
                    <div class="text-gray-600">${escapeHtml(r.changed_by)} • ${escapeHtml(r.changed_at)}</div>
                    ${r.remark ? `<div class="mt-1 text-gray-700">Remark: ${escapeHtml(r.remark)}</div>` : ``}
                    ${r.old_status ? `<div class="text-xs text-gray-500">From: ${escapeHtml(r.old_status)}</div>` : ``}
                </div>
            </div>
        `).join('');
    } catch (e) {
        box.innerHTML = `<div class="text-red-600">Failed to load history.</div>`;
    }
}

function colorDot(status) {
    switch (status) {
        case 'Approved': return 'bg-emerald-500';
        case 'Rejected': return 'bg-red-500';
        case 'Cancelled': return 'bg-orange-500';
        case 'Pending': return 'bg-yellow-500';
        default: return 'bg-gray-400';
    }
}

function escapeHtml(s){ return (s ?? '').toString().replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[m])); }

async function submitStatusChange() {
    if (!ss_invoiceId) return;
    const newStatus = document.getElementById('ss_newStatus').value;
    const remark = document.getElementById('ss_remark').value;

    setStatusAlert();
    const btn = document.getElementById('ss_btnSave');
    btn.disabled = true; btn.innerText = 'Updating...';

    try {
        const res = await fetch(`{{ url('admin/sale-invoices') }}/${ss_invoiceId}/status`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ new_status: newStatus, remark })
        });
        const json = await res.json();

        if (res.status === 403) {
            setStatusAlert('error', json.message || 'Not allowed.');
            btn.disabled = false; btn.innerText = 'Update Status';
            return;
        }
        if (json.status !== 'success') {
            setStatusAlert('error', json.message || 'Failed to update.');
            btn.disabled = false; btn.innerText = 'Update Status';
            return;
        }

        // Update status text in table row without reload
        const cell = document.querySelector(`tr[data-entry-id="${ss_invoiceId}"] td:nth-child(6)`);
        if (cell) cell.innerHTML = `<span class="inline-flex items-center gap-2">${badgeFor(newStatus)}</span>`;

        setStatusAlert('success', 'Status updated.');
        await loadStatusHistory(ss_invoiceId);

        // Optional: close after short delay
        setTimeout(() => closeStatusPanel(), 800);
    } catch (e) {
        setStatusAlert('error', e.message);
    }
    btn.disabled = false; btn.innerText = 'Update Status';
}

function badgeFor(st) {
    const base = 'text-xs font-semibold px-2 py-1 rounded-full';
    switch (st) {
        case 'Approved': return `<span class="${base} bg-emerald-100 text-emerald-700">Approved</span>`;
        case 'Rejected': return `<span class="${base} bg-red-100 text-red-700">Rejected</span>`;
        case 'Cancelled': return `<span class="${base} bg-orange-100 text-orange-700">Cancelled</span>`;
        case 'Pending': return `<span class="${base} bg-yellow-100 text-yellow-700">Pending</span>`;
        default: return `<span class="${base} bg-gray-100 text-gray-700">${st}</span>`;
    }
}
</script>

<style>
#plBarChart, #plPieChart { max-height:260px!important; height:260px!important; }
#profitLossContent canvas { display:block!important; }
</style>

