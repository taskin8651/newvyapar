<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Invoice Ultra — {{ $estimateQuotation->po_no ?? $estimateQuotation->estimate_quotations_number }}</title>

<style>
/* ===========================
   Theme variables and classes
   =========================== */
:root{
  --primary:#10b981;   /* Emerald default */
  --panel:#ecfff6;
  --muted:#6b7280;
  --card-bg:#fff;
  --text:#0f1724;
}

/* Theme overrides (class applied to <html>) */
.theme-emerald { --primary:#10b981; --panel:#ecfff6; --muted:#6b7280; --card-bg:#fff; --text:#0f1724; }
.theme-royal   { --primary:#4253ff; --panel:#f2f6ff; --muted:#6b7280; --card-bg:#fff; --text:#0f1724; }
.theme-ruby    { --primary:#dc2626; --panel:#fff2f2; --muted:#6b7280; --card-bg:#fff; --text:#0f1724; }
.theme-gold    { --primary:#d4af37; --panel:#fff9ec; --muted:#6b7280; --card-bg:#fff; --text:#0f1724; }
.theme-purple  { --primary:#7c3aed; --panel:#f6f1ff; --muted:#6b7280; --card-bg:#fff; --text:#0f1724; }
.theme-jet     { --primary:#111827; --panel:#f7f7f8; --muted:#9ca3af; --card-bg:#0d0d0d; --text:#f5f5f5; }

/* ===========================
   A4 / layout
   =========================== */
@page { size: A4; margin: 8mm; }
html,body { height:100%; }
body {
  margin:0;
  background:#f5f7fb;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  color:var(--text);
  font-size:14px;
  line-height:1.4;
}

/* Page card */
.page {
  width:210mm;
  min-height:297mm;
  margin:22px auto;
  padding:18mm;
  background:var(--card-bg);
  box-sizing:border-box;
  border-radius:6px;
  border:1px solid rgba(16,24,40,0.06);
  box-shadow:0 14px 40px rgba(2,6,23,0.08);
  position:relative;
  overflow:visible;
}

/* Header (Style B) repeated on each page */
.header {
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:16px;
  z-index:3;
}
.left { display:flex; gap:16px; align-items:center; }
.logo-wrap {
  width:120px; height:72px; border-radius:10px; overflow:hidden;
  background:var(--panel); display:flex; align-items:center; justify-content:center;
  box-shadow:0 6px 18px rgba(15,23,36,0.06);
  padding:6px;
}
.logo-wrap img { width:100%; height:100%; object-fit:contain; display:block; }
.company-meta { line-height:1.05; }
.company-title { font-size:18px; font-weight:800; color:var(--primary); text-transform:lowercase; }
.company-sub { color:var(--muted); font-size:12px; }

/* Title/meta */
.right { text-align:right; }
.invoice-title { font-size:22px; font-weight:900; color:var(--primary); text-transform:uppercase; }
.meta-small { font-size:12px; color:var(--muted); margin-top:6px; }

/* Top codes (barcode + qr) */
.top-codes { display:flex; gap:18px; align-items:center; margin-top:12px; z-index:2; }
#barcode { width:150px; height:56px; display:block; }
#qrcode { width:64px; height:64px; }

/* Customer panel */
.panel {
  margin-top:18px; background:var(--panel); padding:14px; border-radius:8px; border-left:6px solid var(--primary); color:var(--text);
}
.panel table td { vertical-align:top; padding:4px 8px; }

/* Items table */
.items { margin-top:18px; border-radius:8px; overflow:visible; z-index:2; }
.items table { width:100%; border-collapse:collapse; table-layout:fixed; }
.items thead th {
  background:var(--primary); color:#fff; padding:12px 14px; font-weight:700; text-align:left; font-size:13px;
}
.items tbody td {
  padding:12px 14px; border-bottom:1px solid rgba(15,23,36,0.06); color:var(--text); font-size:13px; vertical-align:top; word-wrap:break-word;
}
.items tbody tr:last-child td { border-bottom:none; }

/* Prevent row-break inside */
.items table, .items tbody { page-break-inside: auto; }
.items tr { page-break-inside: avoid; page-break-after: auto; }

/* Continued marker bottom-right */
.continued-marker { display:flex; justify-content:flex-end; margin-top:8px; }
.continued-box {
  background:rgba(16,24,40,0.04); border-radius:6px; padding:6px 10px; border:1px solid rgba(16,24,40,0.06);
  font-weight:700; color:var(--muted);
}

/* Continued header (subsequent pages) */
.continued-header { text-align:center; padding:8px 0; margin-bottom:10px; font-weight:700; color:var(--muted); border-bottom:1px dashed rgba(0,0,0,0.06); }

/* Summary & totals */


.totals .line { display:flex; justify-content:space-between; padding:8px 0; color:var(--text); }
.totals .grand { border-top:2px solid rgba(15,23,36,0.06); padding-top:10px; font-weight:900; font-size:16px; }

/* HSN & Profit */
.hsn { margin-top:8px; width: 360px; border-radius:8px; background:rgba(255,255,255,0.6); padding:10px; border:2px double var(--primary); box-shadow:0 6px 18px rgba(15,23,36,0.06); }
.profit { margin-top:14px; padding:12px; border-radius:8px; background:#f0fdf4; border-left:6px solid #059669; display:none; }

/* Signature area */
.sign-area { display:flex; justify-content:space-between; margin-top:26px; align-items:center; gap:12px; }
.sign-area img { display:block; max-width:150px; border-radius:6px; }

/* Footer */
.footer-note { margin-top:12px; color:var(--muted); font-size:12px; }

/* Controls (preview only) */
.controls { position:fixed; right:18px; top:18px; z-index:120; display:flex; gap:8px; align-items:center; }
.control-select, .control-btn { padding:8px 10px; border-radius:8px; background:#fff; border:1px solid rgba(16,24,40,0.04); cursor:pointer; font-size:13px; box-shadow:0 6px 18px rgba(15,23,36,0.06); }
body.dark .control-select, body.dark .control-btn { background:#0b1220; color:#e6eef6; border-color:#122033; }

/* Toggle knob */
.toggle { --w:44px; --h:26px; --pad:3px; width:var(--w); height:var(--h); border-radius:999px; background:#e6eefc; position:relative; cursor:pointer; box-shadow: inset 0 0 0 1px rgba(0,0,0,0.04); }
.toggle .knob { position:absolute; top:var(--pad); left:var(--pad); width:calc(var(--h) - var(--pad)*2); height:calc(var(--h) - var(--pad)*2); background:#fff; border-radius:999px; transition:all .22s cubic-bezier(.2,.9,.3,1); box-shadow:0 4px 10px rgba(2,6,23,0.12); }
.toggle.on { background:var(--primary); } .toggle.on .knob { left: calc(var(--w) - var(--h) + var(--pad)); }

/* Print helpers */
@media print {
  body { background:#fff; }

  /* Remove all browser default margins */
  body, html {
    margin: 0 !important;
    padding: 0 !important;
  }

  .controls { display:none !important; }

  /* Page wrapper – no extra space */
  .page {
    box-shadow:none !important;
    border-radius:0 !important;
    margin:0 !important;
    border:0 !important;

    /* Top padding minimal so header sticks to page */
    padding: 4mm 8mm 8mm 8mm !important;
  }

  /* Reduce @page margin so Chrome doesn't add big gap */
  @page {
    margin: 4mm !important; /* default is 8mm – now half */
  }

  /* Table font tuning */
  .items table { font-size:12px !important; }
}


/* responsive preview */
@media (max-width:900px){
  .totals { width:100%; margin-left:0; }
  .items table { min-width:0; }
}
/* FIX: prevent HSN + Totals overlap */
.summary-row {
  display: flex;
  gap: 18px;
  margin-top: 18px;
  align-items: flex-start;
  flex-wrap: wrap; /* ⭐ MUST HAVE */
  page-break-inside: avoid;

}

/* Left box full width on small space */
.summary-left {
  flex: 1 1 60%;
  page-break-inside: avoid;
}

#totalsBox {
  flex: 1 1 35%;
  page-break-inside: avoid;
    border: 2px solid;
  border-style: double;
  border-color: var(--primary);
  padding: 5px;
  border-radius: 8px;
}

/* Print mode special fixes */
@media print {
  .summary-row {
    flex-wrap: wrap;        /* Prevent overlap */
    
  }

  .summary-left,
  #totalsBox {
    page-break-inside: avoid !important;
    
  }
}
/* =========================
   PRINT MODE CUSTOM FIXES
========================= */
.print-only { display: none; }

@media print {

  /* Hide HSN summary */
  .hsn { display: none !important; }

  /* Show print-only blocks */
  .print-only { display: block !important; }

  /* Bank + Terms + Notes layout */
  .print-bank {
    border: 2px double var(--primary);
    padding: 10px;
    border-radius: 8px;
    margin-top: 12px;
  }

  .print-terms-notes {
    display: flex;
    gap: 16px;
    margin-top: 12px;
  }

  .print-terms-notes > div {
    width: 50%;
    border: 1px solid rgba(0,0,0,0.08);
    padding: 10px;
    border-radius: 6px;
    font-size: 12px;
  }
}

</style>
</head>
<body>

<!-- Controls (preview only) -->
<div class="controls" aria-hidden="false">
  <select id="themeSelect" class="control-select" title="Select theme">
    <option value="emerald" selected>Emerald</option>
    <option value="royal">Royal Blue</option>
    <option value="ruby">Ruby Red</option>
    <option value="gold">Gold Premium</option>
    <option value="purple">Purple Neon</option>
    <option value="jet">Jet Black Minimal</option>
  </select>

  <button class="control-btn" id="darkBtn" title="Toggle dark mode">Dark</button>

  <div style="display:flex; align-items:center; gap:8px;">
    <div style="font-size:13px; color:var(--muted);">Show P/L</div>
    <div id="profitToggle" class="toggle" role="switch" aria-checked="false" title="Show Profit / Loss"><div class="knob"></div></div>
  </div>

  <button class="control-btn" id="printBtn" title="Print / Download">Print / Download</button>
</div>

<!-- MAIN PAGE -->
<div class="page" id="invoicePage" role="document" aria-label="Invoice Ultra">

  <div class="watermark" aria-hidden="true" style="position:absolute; left:50%; top:50%; transform:translate(-50%,-50%) rotate(-12deg); font-weight:900; font-size:88px; color:rgba(16,24,40,0.05); pointer-events:none; user-select:none; z-index:0;">ESTIMATE</div>

  <!-- HEADER -->
  <div class="header" id="mainHeader">
    <div class="left">
      <div class="logo-wrap" id="logoWrap">
        @php $logoUrl = $company?->getFirstMediaUrl('logo_upload') ?? null; @endphp
        @if($logoUrl)
          <img src="{{ $logoUrl }}" alt="logo">
        @else
          <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-weight:800; color:var(--primary);">
            {{ ucwords($company->company_name ?? 'YC',0,2) }}
          </div>
        @endif
      </div>

      <div class="company-meta">
        <div class="company-title">{{ ucwords($company->company_name ?? 'Your Company' )}}</div>
        <div class="company-sub">{!! nl2br(e($company->address ?? '')) !!}</div>
        <div class="company-sub">Phone: {{ $company->phone ?? '-' }} • Email: {{ $company->email ?? '-' }}</div>
      </div>
    </div>

    <div class="right">
      <div class="invoice-title">ESTIMATE / QUOTATION</div>
      <div class="meta-small">Estimate #: <strong>{{ $estimateQuotation->estimate_quotations_number ?? $estimateQuotation->po_no }}</strong></div>
      <div class="meta-small">Date: <strong>{{ $estimateQuotation->po_date ?? now()->format('Y-m-d') }}</strong></div>
      <div class="meta-small">Valid Until: <strong>{{ $estimateQuotation->due_date ?? '-' }}</strong></div>
    </div>
  </div>

  <!-- Top codes (barcode + QR) -->
  <div class="top-codes" id="mainTopCodes" style="margin-top:12px;">
    <div id="barcodeWrap" style="background:transparent; padding:6px; border-radius:6px;">
      <svg id="barcode" aria-hidden="true"></svg>
      <div style="text-align:center; font-size:12px; color:var(--muted); margin-top:6px;">
        {{ $estimateQuotation->estimate_quotations_number ?? $estimateQuotation->po_no }}
      </div>
    </div>

    <div id="qrcode" style="width:64px; height:64px;"></div>
  </div>

  <!-- CUSTOMER DETAILS PANEL -->
  <div class="panel" role="region" aria-label="Customer details">
    <table style="width:100%;">
      <tr>
        <td style="min-width:120px;"><strong>Bill To</strong></td>
        <td>
          <div><strong>{{ $estimateQuotation->select_customer->party_name ?? '' }}</strong></div>
          <div class="muted" style="margin-top:6px;">{{ $estimateQuotation->select_customer->billing_address ?? '' }}</div>
          <div style="margin-top:6px; font-size:13px;">
            <span class="muted">Phone:</span> {{ $estimateQuotation->select_customer->phone_number ?? '-' }} &nbsp; • &nbsp;
            <span class="muted">GSTIN:</span> {{ $estimateQuotation->select_customer->gstin ?? '-' }}
          </div>
        </td>

        <td style="min-width:160px;"><strong>Ship To</strong></td>
        <td>
          <div>{{ $estimateQuotation->shipping_address ?? $estimateQuotation->billing_address ?? '-' }}</div>
        </td>
      </tr>
    </table>
  </div>

  <!-- ITEMS LIST -->
  <div class="items" role="table" aria-label="Line items">
    <table id="itemsTable">
      <thead id="itemsThead">
        <tr>
          <th style="width:28%;">Item</th>
          <th style="width:10%;">HSN</th>
          <th style="width:30%;">Description</th>
          <th style="width:8%;">Qty</th>
          <th style="width:15%;">Rate</th>
          <th style="width:8%;">Tax</th>
          <th style="width:15%;">Amount</th>
        </tr>
      </thead>
      <tbody id="itemsBody">
        @php $hsnSummary = []; $overallProfit = 0; @endphp
        @foreach($estimateQuotation->items as $item)
          @php
            $pivot = $item->pivot;
            $data = json_decode($pivot->json_data ?? '{}');
            $qty = $pivot->qty ?? 0;
            $rate = $pivot->price ?? 0;
            $taxRate = $pivot->tax ?? 0;
            $amount = $pivot->amount ?? ($qty * $rate);
            $hsn = $item->item_hsn ?? 'N/A';
            $purchase = $item->purchase_price ?? 0;
            $profit = ($rate - $purchase) * $qty;
            $overallProfit += $profit;
            if(!isset($hsnSummary[$hsn])) $hsnSummary[$hsn] = ['qty'=>0,'tax'=>0,'amount'=>0];
            $hsnSummary[$hsn]['qty'] += $qty;
            $hsnSummary[$hsn]['tax'] += ($taxRate/100) * $amount;
            $hsnSummary[$hsn]['amount'] += $amount;
          @endphp

          <tr class="item-row">
            <td>
              <div style="font-weight:700;">{{ $item->item_name }}</div>
              <div class="muted" style="font-size:12px;">SKU: {{ $item->item_code ?? '-' }}</div>
            </td>
            <td>{{ $hsn }}</td>
            <td style="font-size:13px;">{{ $data->description ?? ($item->item_description ?? '') }}</td>
            <td>{{ number_format($qty, 2) }}</td>
            <td>₹ {{ number_format($rate,2) }}</td>
            <td>{{ $taxRate }}%</td>
            <td>₹ {{ number_format($amount,2) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- continued marker placeholder (not used in preview) -->
  <div id="continuedMarkerPlaceholder"></div>

      <div class="summary-row" id="summaryRow">

        <!-- LEFT -->
        <div class="summary-left">

          <!-- SCREEN: HSN -->
          <div class="hsn">
            <strong>HSN Summary</strong>
            <table style="width:100%; margin-top:8px;">
              @foreach($hsnSummary as $h => $row)
                <tr>
                  <td>{{ $h }}</td>
                  <td style="text-align:right">{{ number_format($row['qty'],2) }}</td>
                  <td style="text-align:right">₹ {{ number_format($row['tax'],2) }}</td>
                  <td style="text-align:right">₹ {{ number_format($row['amount'],2) }}</td>
                </tr>
              @endforeach
            </table>
          </div>

          <!-- PRINT: BANK DETAILS -->
          <div class="print-only print-bank">
            <div class="">

            <div>
              <strong>Terms & Conditions</strong>
              <ul style="margin-top:6px;padding-left:16px">
                @foreach($terms as $term)
                  <li>{!! nl2br(e($term->description)) !!}</li>
                @endforeach
              </ul>
            </div>

            <div>
              <strong>Notes</strong>
              <p style="margin-top:6px">
                {!! nl2br(e($estimateQuotation->notes ?? '—')) !!}
              </p>
            </div>

          </div>
          </div>

        </div>

        <!-- RIGHT -->
        <div class="totals" id="totalsBox">
          <div class="line"><div>Subtotal</div><div>₹ {{ number_format($estimateQuotation->subtotal,2) }}</div></div>
          <div class="line"><div>Tax</div><div>₹ {{ number_format($estimateQuotation->tax,2) }}</div></div>
          <div class="line"><div>Discount</div><div>₹ {{ number_format($estimateQuotation->discount,2) }}</div></div>
          <div class="grand"><div>Total</div><div>₹ {{ number_format($estimateQuotation->total,2) }}</div></div>
        </div>

      </div>

          <!-- TOTALS -->
        <div class="section grid grid-cols-2 gap-6">

            <div >
               
                    @if($bankDetails->count())
                    <div class="section" >
                        <div class="label-title" ><b>Bank Details</b></div>

                        @foreach($bankDetails as $bank)
                        <div style="display: flex ;border: 2px solid;border-style:double;border-color:var(--primary); padding:10px;" >
                            <div class="box mb-3">
                                <p><b>Bank:</b> {{ $bank->bank_name }}</p>
                                <p><b>Account No:</b> {{ $bank->account_number }}</p>
                                <p><b>IFSC:</b> {{ $bank->ifsc_code }}</p>
                                <p><b>Branch:</b> {{ $bank->branch_name }}</p>


                            </div>
                            <div>
                                {{-- =====================
                                    UPI QR CODE
                                ====================== --}}
                                @if($bank->print_upi_qr)
                                    @php
                                        $upiQr = $bank->getFirstMediaUrl('upi_qr');
                                    @endphp

                                    @if($upiQr)
                                        <div class="">
                                            <img src="{{ $upiQr }}" style="height:120px">
                                            <p class="text-xs text-gray-600">Scan & Pay (UPI)</p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            </div>
                        @endforeach
                    </div>
                    @endif

            </div>


            

        </div>


<!-- PRINT ONLY: TERMS + NOTES -->


  <div class="sign-area" aria-label="Signature area" id="signatureArea">
    <div>
      @if($company && $company->getFirstMediaUrl('signature'))
        <img src="{{ $company->getFirstMediaUrl('signature') }}" alt="signature" style="max-width:150px;">
      @else
        <div style="height:64px; width:150px; border-radius:8px; background:linear-gradient(90deg, rgba(0,0,0,0.06), rgba(0,0,0,0.02)); display:flex; align-items:center; justify-content:center; color:var(--muted);">Signature</div>
      @endif
      <div class="muted" style="margin-top:8px;">Authorized Signatory</div>
    </div>

    <div style="text-align:right;">
      <div style="font-weight:800;">{{ $company->company_name ?? '' }}</div>
      <div class="muted" style="font-size:12px;">{{ $company->website ?? '' }}</div>
    </div>
  </div>

  <div class="footer-note" id="footerNote">{{ $company->company_name ?? '' }} • {{ now()->format('Y-m-d H:i') }} • Invoice {{ $estimateQuotation->estimate_quotations_number ?? '' }} • Created By {{ $estimateQuotation->created_by->name ?? '' }} • {{ $estimateQuotation->created_at ?? '' }}</div>
</div>

<!-- libs -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
/* ---------------------------
   Utilities and initialisation
----------------------------*/

/* set initial theme class on <html> - Emerald default */
document.documentElement.classList.add('theme-emerald');

/* helper to switch theme */
function applyTheme(name){
  const classes = ['theme-emerald','theme-royal','theme-ruby','theme-gold','theme-purple','theme-jet'];
  document.documentElement.classList.remove(...classes);
  switch(name){
    case 'royal': document.documentElement.classList.add('theme-royal'); break;
    case 'ruby':  document.documentElement.classList.add('theme-ruby'); break;
    case 'gold':  document.documentElement.classList.add('theme-gold'); break;
    case 'purple':document.documentElement.classList.add('theme-purple'); break;
    case 'jet':   document.documentElement.classList.add('theme-jet'); break;
    case 'emerald':
    default: document.documentElement.classList.add('theme-emerald'); break;
  }
}

/* Wire theme select */
document.getElementById('themeSelect').addEventListener('change', function(e){
  applyTheme(e.target.value);
});

/* Dark mode toggle */
document.getElementById('darkBtn').addEventListener('click', function(){
  document.body.classList.toggle('dark');
});

/* Profit toggle (iOS style) */
const profitToggle = document.getElementById('profitToggle');
const profitBox = document.getElementById('profitBox');
profitToggle.addEventListener('click', function(){
  const on = profitToggle.classList.toggle('on');
  profitToggle.setAttribute('aria-checked', String(on));
  profitBox.style.display = on ? 'block' : 'none';
  profitBox.setAttribute('aria-hidden', String(!on));
});
profitToggle.tabIndex = 0;
profitToggle.addEventListener('keydown', function(e){ if(e.key==='Enter' || e.key===' '){ e.preventDefault(); profitToggle.click(); } });

/* ---------------------------
   Barcode & QR preview generation
----------------------------*/
(function generatePreviewCodes(){
  try {
    const qrUrl = "{{ url('/invoice/' . $estimateQuotation->id . '/pdf') }}";

    // ----- BARCODE -----
    const svg = document.getElementById('barcode');
    while(svg.firstChild) svg.removeChild(svg.firstChild);
    if(window.JsBarcode) {
      JsBarcode(svg, String("{{ $estimateQuotation->estimate_quotations_number }}"), {
        format:'code128',
        width:1.6,
        height:40,
        displayValue:false,
        margin:4,
        lineColor:'#000'
      });
    }

    // ----- QR CODE -----
    const qrEl = document.getElementById('qrcode');
    qrEl.innerHTML = '';
    if(window.QRCode) {
      new QRCode(qrEl, {
        text: qrUrl,
        width: 64,
        height: 64,
        colorDark: '#000',
        colorLight: '#fff'
      });
    }

  } catch(err) {
    console.error('preview code error', err);
  }
})();


/* ---------------------------
   Print flow with pagination
   - clones invoice into new window
   - preserves theme by copying <html> class
   - paginates table rows so they don't break mid-row
   - repeats header & top-codes on each page (Header Style B)
   - shows continued markers
----------------------------*/
function collectInlineStyles(){
  // collect <style> tags (our styles are inline in this document)
  let css = '';
  document.querySelectorAll('style').forEach(s => css += s.outerHTML);
  return css;
}

function paginateAndPrint(){
  const invoice = document.getElementById('invoicePage');
  if(!invoice) return window.print();

  // clone for print window
  const clone = invoice.cloneNode(true);

  // open print window
  const win = window.open('', '_blank', 'toolbar=0,location=0,menubar=0,width=1200,height=900');
  if(!win){ alert('Pop-up blocked — allow popups for printing.'); return; }
  const doc = win.document;
  doc.open();

  const head = `
    <head>
      <meta charset="utf-8">
      <title>Print - ${document.title}</title>
      <meta name="viewport" content="width=device-width,initial-scale=1">
      ${collectInlineStyles()}
      <style>
        @page { size:A4; margin:8mm; }
        body{ margin:0; -webkit-print-color-adjust:exact; background:#fff; color:#000; }
        .controls{ display:none !important; }
        .page{ box-shadow:none !important; border-radius:0 !important; margin:0; padding:8mm !important; width:210mm; box-sizing:border-box; }
      </style>
    </head>
  `;
  doc.write('<!doctype html><html>' + head + '<body></body></html>');
  doc.close();

  // append cloned invoice
  const wrapper = doc.createElement('div');
  wrapper.innerHTML = clone.outerHTML;
  const newInvoice = wrapper.firstElementChild;
  newInvoice.id = 'invoicePage';
  doc.body.appendChild(newInvoice);

  // copy theme class from current document's <html>
  const themeClasses = Array.from(document.documentElement.classList).filter(c => c.startsWith('theme-'));
  if(themeClasses.length) {
    doc.documentElement.classList.add(...themeClasses);
  }

  // add libs to print window
  const jsBarcodeScript = doc.createElement('script');
  jsBarcodeScript.src = 'https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js';
  doc.body.appendChild(jsBarcodeScript);

  const qrScript = doc.createElement('script');
  qrScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js';
  doc.body.appendChild(qrScript);

  // inject pagination + regenerate script
  const script = doc.createElement('script');
  script.type = 'text/javascript';
  script.text = '(' + (function(refJSON){
    /* this function runs inside print window */
    return function(refStr){
      try {
        const pxPerMm = 96/25.4;
        const pageHeightMm = 297;
        const pageMarginMm = 8;
        const innerH = (pageHeightMm - (pageMarginMm*2)) * pxPerMm;

        const invoice = document.getElementById('invoicePage');
        if(!invoice) { window.print(); return; }

        const headerEl = invoice.querySelector('.header');
        const topCodesEl = invoice.querySelector('.top-codes');
        const panelEl = invoice.querySelector('.panel');
        const summaryRow = invoice.querySelector('#summaryRow');
        const footerNote = invoice.querySelector('#footerNote');
        const signature = invoice.querySelector('#signatureArea');

        const headerH = headerEl ? headerEl.getBoundingClientRect().height : 0;
        const topCodesH = topCodesEl ? topCodesEl.getBoundingClientRect().height : 0;
        const panelH = panelEl ? panelEl.getBoundingClientRect().height : 0;
        const summaryH = summaryRow ? summaryRow.getBoundingClientRect().height : 0;
        const footerH = footerNote ? footerNote.getBoundingClientRect().height : 0;

        const safetyPad = 18;
        const firstAvail = innerH - (headerH + topCodesH + panelH + safetyPad + summaryH + footerH);
        const subsequentAvail = innerH - (36 + footerH + safetyPad);

        const itemsTable = invoice.querySelector('#itemsTable');
        const thead = itemsTable.querySelector('thead');
        const rows = Array.from(itemsTable.querySelectorAll('tbody tr'));

        // measure thead
        const tmpT = document.createElement('table');
        tmpT.style.visibility='hidden'; tmpT.style.position='absolute';
        tmpT.appendChild(thead.cloneNode(true));
        document.body.appendChild(tmpT);
        const theadH = tmpT.getBoundingClientRect().height || 40;
        tmpT.remove();

        // pack rows into pages
        const pages = [];
        let current = [];
        let used = 0;
        let avail = firstAvail - theadH;

        rows.forEach((r) => {
          const rH = r.getBoundingClientRect().height || 28;
          if(current.length === 0 && rH > avail) {
            // single big row doesn't fit entire page: still put it (graceful fallback)
            current.push(r);
            pages.push(current.slice());
            current = [];
            used = 0;
            avail = subsequentAvail - theadH;
          } else if(used + rH <= avail) {
            current.push(r);
            used += rH;
          } else {
            pages.push(current.slice());
            current = [r];
            used = rH;
            avail = subsequentAvail - theadH;
          }
        });
        if(current.length) pages.push(current.slice());

        // if single page, just regenerate codes and print
        if(pages.length <= 1) {
          // regenerate codes on this document
          setTimeout(function(){
            try {
              if(window.JsBarcode) {
                const svg = document.getElementById('barcode');
                if(svg) window.JsBarcode(svg, refStr, { format:'code128', width:1.6, height:40, displayValue:false, margin:4, lineColor:'#000' });
              }
              if(window.QRCode) {
                const qr = document.getElementById('qrcode');
                if(qr) {
                  qr.innerHTML = '';
                  new window.QRCode(qr, { text: refStr, width:64, height:64 });
                }
              }
            } catch(e){}
            window.print();
          }, 200);
          return;
        }

        // build container with pages
        const container = document.createElement('div');

        pages.forEach((rowGroup, idx) => {
          const pageDiv = document.createElement('div');
          pageDiv.className = 'page';
          pageDiv.style.boxSizing = 'border-box';
          pageDiv.style.margin = '0 auto 10px';
          pageDiv.style.padding = '18mm';

          if(idx > 0) {
            const contHeader = document.createElement('div');
            contHeader.className = 'continued-header';
            contHeader.innerText = '← Continued from previous page';
            pageDiv.appendChild(contHeader);
          }

          const headerClone = headerEl.cloneNode(true);
          headerClone.style.marginBottom = '6px';
          pageDiv.appendChild(headerClone);

          const topCodesClone = topCodesEl.cloneNode(true);
          topCodesClone.style.margin = '6px 0 10px 0';
          pageDiv.appendChild(topCodesClone);

          if(idx === 0) {
            pageDiv.appendChild(panelEl.cloneNode(true));
          } else {
            const smallPanel = document.createElement('div');
            smallPanel.style.margin = '8px 0';
            smallPanel.style.fontSize = '12px';
            const billToEl = panelEl.querySelector('td:nth-child(2)');
            const billTo = billToEl ? billToEl.innerText.trim() : '';
            smallPanel.innerHTML = '<strong>Bill To</strong> • ' + (billTo || '');
            pageDiv.appendChild(smallPanel);
          }

          const tbl = document.createElement('table');
          tbl.style.width = '100%';
          tbl.style.borderCollapse = 'collapse';
          tbl.innerHTML = thead.outerHTML;
          const tb = document.createElement('tbody');
          rowGroup.forEach(r => tb.appendChild(r.cloneNode(true)));
          tbl.appendChild(tb);
          pageDiv.appendChild(tbl);

          if(idx < pages.length - 1) {
            const contWrap = document.createElement('div');
            contWrap.className = 'continued-marker';
            const contBox = document.createElement('div');
            contBox.className = 'continued-box';
            contBox.innerText = 'Continued on next page →';
            contWrap.appendChild(contBox);
            pageDiv.appendChild(contWrap);
          }

          if(idx === pages.length - 1) {
            const summaryClone = summaryRow.cloneNode(true);
            summaryClone.style.marginTop = '10px';
            pageDiv.appendChild(summaryClone);

            const signClone = document.createElement('div');
            signClone.className = 'sign-area';
            signClone.innerHTML = signature ? signature.innerHTML : '';
            pageDiv.appendChild(signClone);

            const fNote = document.createElement('div');
            fNote.className = 'footer-note';
            fNote.innerText = document.getElementById('footerNote') ? document.getElementById('footerNote').innerText : '';
            pageDiv.appendChild(fNote);
          }

          container.appendChild(pageDiv);
        });

        // replace invoice with container
        invoice.parentNode.replaceChild(container, invoice);

        // regenerate barcode & QR per page
        const allBarcodes = document.querySelectorAll('#barcode');
        const allQrs = document.querySelectorAll('#qrcode');
        allBarcodes.forEach(svg => {
          try { if(window.JsBarcode) window.JsBarcode(svg, refStr, { format:'code128', width:1.6, height:40, displayValue:false, margin:4, lineColor:'#000' }); } catch(e){}
        });
        allQrs.forEach(div => {
          try { if(div) { div.innerHTML = ''; if(window.QRCode) new window.QRCode(div, { text: refStr, width:64, height:64 }); } } catch(e){}
        });

      } catch(err) {
        console.error('pagination inner error', err);
      }
    };
  })(/* end self */) +')(' + JSON.stringify(String(refJSON)) + ');';
  doc.body.appendChild(script);

  // wait and print
  setTimeout(function(){
    try { win.focus(); win.print(); } catch(e){ console.error(e); }
  }, 1200);
}

/* hook print button and Ctrl+P */
document.getElementById('printBtn').addEventListener('click', function(){ paginateAndPrint(); });
document.addEventListener('keydown', function(e){
  if((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'p'){ e.preventDefault(); paginateAndPrint(); }
});
</script>

</body>
</html>
