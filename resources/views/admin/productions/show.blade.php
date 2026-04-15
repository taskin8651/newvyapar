@extends('layouts.admin')

@section('content')

{{-- ========================================================================
     PRODUCTION — SHOW  |  Professional Invoice Design with Print
     ======================================================================== --}}

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --inv-bg:      #0a0d14;
    --inv-surface: #111520;
    --inv-card:    #161b28;
    --inv-border:  #1e2840;
    --inv-amber:   #f59e0b;
    --inv-green:   #10b981;
    --inv-red:     #ef4444;
    --inv-indigo:  #6366f1;
    --inv-text:    #e2e8f0;
    --inv-muted:   #4b5e7a;
    --inv-mono:    'DM Mono', monospace;
    --inv-display: 'Syne', sans-serif;
    --inv-body:    'DM Sans', sans-serif;
}

.inv-page      { background: var(--inv-bg); min-height: 100vh; padding: 2rem; font-family: var(--inv-body); }

/* Toolbar */
.inv-toolbar   { display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; flex-wrap: wrap; }
.btn-back      { display: inline-flex; align-items: center; gap: .5rem; padding: .6rem 1.25rem; background: var(--inv-card); border: 1px solid var(--inv-border); color: var(--inv-text); border-radius: 10px; text-decoration: none; font-size: .83rem; transition: border-color .2s; }
.btn-back:hover{ border-color: var(--inv-amber); color: var(--inv-amber); }
.btn-print     { display: inline-flex; align-items: center; gap: .5rem; padding: .6rem 1.5rem; background: linear-gradient(135deg,#f59e0b,#d97706); color: #000; border: none; border-radius: 10px; font-family: var(--inv-display); font-size: .85rem; font-weight: 800; cursor: pointer; transition: opacity .2s; }
.btn-print:hover { opacity: .9; }
.btn-edit      { display: inline-flex; align-items: center; gap: .5rem; padding: .6rem 1.25rem; background: #f9731620; border: 1px solid #f9731640; color: #f97316; border-radius: 10px; text-decoration: none; font-size: .83rem; transition: background .2s; }
.btn-edit:hover { background: #f9731630; }

/* Invoice wrapper */
.invoice       { background: var(--inv-card); border: 1px solid var(--inv-border); border-radius: 20px; max-width: 900px; margin: 0 auto; overflow: hidden; }

/* Invoice top bar */
.inv-topbar    { background: linear-gradient(135deg, #161b28, #1e2740); padding: 2.5rem; position: relative; overflow: hidden; }
.inv-topbar::before { content: ''; position: absolute; top: -60px; right: -60px; width: 250px; height: 250px; background: radial-gradient(circle, #f59e0b18, transparent 70%); pointer-events: none; }
.inv-topbar::after  { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, var(--inv-amber), transparent); }

.inv-title-row { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem; }
.inv-brand     { display: flex; align-items: center; gap: 1rem; }
.inv-brand-icon{ width: 52px; height: 52px; background: linear-gradient(135deg,#f59e0b,#d97706); border-radius: 14px; display: grid; place-items: center; font-size: 1.4rem; box-shadow: 0 0 24px #f59e0b44; flex-shrink: 0; }
.inv-brand-name{ font-family: var(--inv-display); font-size: 1.5rem; font-weight: 800; color: #fff; letter-spacing: -.03em; }
.inv-brand-sub { font-size: .72rem; color: var(--inv-muted); letter-spacing: .05em; text-transform: uppercase; margin-top: 2px; }

.inv-num-box   { text-align: right; }
.inv-num-label { font-size: .68rem; color: var(--inv-muted); text-transform: uppercase; letter-spacing: .07em; font-weight: 600; }
.inv-num-val   { font-family: var(--inv-mono); font-size: 1.1rem; color: var(--inv-amber); font-weight: 500; margin-top: 3px; }
.inv-date-val  { font-family: var(--inv-mono); font-size: .82rem; color: var(--inv-text); margin-top: 5px; }

/* Metadata grid */
.inv-meta-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--inv-border); border-top: 1px solid var(--inv-border); }
.inv-meta-cell { background: var(--inv-surface); padding: 1.25rem 1.5rem; }
.inv-meta-label{ font-size: .65rem; color: var(--inv-muted); text-transform: uppercase; letter-spacing: .07em; font-weight: 600; margin-bottom: .4rem; }
.inv-meta-value{ font-size: .9rem; color: var(--inv-text); font-weight: 500; }
.inv-meta-value.amber { color: var(--inv-amber); font-family: var(--inv-mono); }
.inv-meta-value.green { color: var(--inv-green); }

/* Body */
.inv-body      { padding: 2rem 2.5rem; }

/* Section title */
.inv-section   { font-family: var(--inv-display); font-size: .85rem; font-weight: 700; color: var(--inv-muted); text-transform: uppercase; letter-spacing: .08em; margin-bottom: .85rem; display: flex; align-items: center; gap: .5rem; }
.inv-section::after { content: ''; flex: 1; height: 1px; background: var(--inv-border); }

/* Party card */
.party-card    { display: flex; align-items: center; gap: 1.25rem; padding: 1.25rem; background: var(--inv-surface); border: 1px solid #10b98130; border-radius: 12px; margin-bottom: 1.75rem; }
.party-avatar  { width: 46px; height: 46px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; display: grid; place-items: center; font-size: 1.2rem; flex-shrink: 0; }
.party-name    { font-weight: 700; color: #fff; font-size: 1rem; }
.party-phone   { font-family: var(--inv-mono); font-size: .78rem; color: var(--inv-green); margin-top: 2px; }

/* Raw materials table */
.inv-table     { width: 100%; border-collapse: collapse; font-size: .83rem; margin-bottom: 1.75rem; }
.inv-table thead tr { background: var(--inv-surface); }
.inv-table th  { padding: .75rem 1rem; text-align: left; font-size: .67rem; font-weight: 700; color: var(--inv-muted); text-transform: uppercase; letter-spacing: .07em; }
.inv-table th:last-child { text-align: right; }
.inv-table td  { padding: .7rem 1rem; border-top: 1px solid var(--inv-border); vertical-align: middle; }
.inv-table td:last-child { text-align: right; }
.inv-table tbody tr:hover { background: #ffffff03; }
.inv-table tfoot tr { background: var(--inv-surface); }
.inv-table tfoot td { padding: .75rem 1rem; font-weight: 600; border-top: 2px solid var(--inv-border); }

/* Finished goods list */
.fg-list       { display: grid; grid-template-columns: repeat(auto-fill, minmax(240px,1fr)); gap: .75rem; margin-bottom: 1.75rem; }
.fg-card       { background: var(--inv-surface); border: 1px solid var(--inv-border); border-radius: 10px; padding: 1rem; transition: border-color .2s; }
.fg-card:hover { border-color: var(--inv-amber); }
.fg-unique     { font-family: var(--inv-mono); font-size: .65rem; color: var(--inv-amber); margin-bottom: .5rem; }
.fg-serial     { font-size: .8rem; color: var(--inv-text); font-weight: 600; }
.fg-bc         { font-size: .7rem; color: var(--inv-green); font-family: var(--inv-mono); margin-top: 2px; }
.fg-price      { font-family: var(--inv-mono); font-size: .88rem; color: var(--inv-text); margin-top: .6rem; }
.fg-profit     { font-family: var(--inv-mono); font-size: .75rem; margin-top: 2px; }
.fg-wh         { font-size: .68rem; color: var(--inv-muted); margin-top: .35rem; }

/* Financial summary */
.fin-grid      { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
.fin-box       { background: var(--inv-surface); border: 1px solid var(--inv-border); border-radius: 12px; padding: 1.25rem; }
.fin-row       { display: flex; justify-content: space-between; align-items: center; padding: .45rem 0; border-bottom: 1px solid var(--inv-border); font-size: .83rem; }
.fin-row:last-child { border: none; }
.fin-label     { color: var(--inv-muted); }
.fin-val       { font-family: var(--inv-mono); font-weight: 500; }
.fin-val.amber { color: var(--inv-amber); }
.fin-val.green { color: var(--inv-green); }
.fin-val.red   { color: var(--inv-red); }
.fin-total     { margin-top: .85rem; padding: 1rem; background: var(--inv-card); border-radius: 9px; display: flex; justify-content: space-between; align-items: center; }
.fin-total-label { font-size: .82rem; color: var(--inv-muted); }
.fin-total-val { font-family: var(--inv-display); font-size: 1.4rem; font-weight: 800; }

/* Watermark-style status */
.inv-status    { position: absolute; top: 2rem; right: 2.5rem; font-family: var(--inv-mono); font-size: .7rem; background: #10b98120; border: 1px solid #10b98140; color: var(--inv-green); padding: .25rem .7rem; border-radius: 99px; letter-spacing: .05em; }

/* Footer */
.inv-footer    { border-top: 1px solid var(--inv-border); padding: 1.25rem 2.5rem; display: flex; justify-content: space-between; align-items: center; }
.inv-footer-note { font-size: .72rem; color: var(--inv-muted); }
.inv-footer-sig  { font-family: var(--inv-mono); font-size: .7rem; color: var(--inv-muted); }

/* Print Styles */
@media print {
    body, .inv-page { background: #fff !important; color: #000 !important; padding: 0 !important; }
    .inv-toolbar { display: none !important; }
    .invoice { border: none !important; box-shadow: none !important; max-width: 100% !important; border-radius: 0 !important; background: #fff !important; }
    .inv-topbar { background: #f8f9fa !important; border-bottom: 2px solid #dee2e6 !important; }
    .inv-topbar::before, .inv-topbar::after { display: none !important; }
    .inv-meta-grid { background: #dee2e6 !important; }
    .inv-meta-cell { background: #f8f9fa !important; }
    .inv-brand-name, .inv-num-val, .party-name, .product-name { color: #000 !important; }
    .inv-muted, .inv-meta-label, .fin-label, .inv-section { color: #666 !important; }
    .inv-text, .inv-date-val, .fin-val, .fg-serial { color: #333 !important; }
    .inv-amber, .inv-meta-value.amber, .fg-unique, .inv-num-val { color: #b45309 !important; }
    .inv-green, .party-phone, .fin-val.green, .fg-bc { color: #065f46 !important; }
    .inv-red, .fin-val.red { color: #991b1b !important; }
    .inv-body, .inv-footer { padding: 1.5rem !important; }
    .fg-list { grid-template-columns: repeat(3, 1fr) !important; }
    .fin-grid { grid-template-columns: 1fr 1fr !important; }
    .inv-table { font-size: 11px !important; }
    * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
}
</style>

<div class="inv-page">

    {{-- Toolbar --}}
    <div class="inv-toolbar">
        <a href="{{ route('admin.productions.index') }}" class="btn-back">← Back to List</a>
        <a href="{{ route('admin.productions.edit', $production->id) }}" class="btn-edit">✏️ Edit</a>
        <button onclick="window.print()" class="btn-print">🖨️ Print Invoice</button>
    </div>

    <div class="invoice" id="invoicePrint">

        {{-- Top Bar --}}
        <div class="inv-topbar" style="position:relative;">
            <span class="inv-status">✓ COMPLETED</span>
            <div class="inv-title-row">
                <div class="inv-brand">
                    <div class="inv-brand-icon">⚙️</div>
                    <div>
                        <div class="inv-brand-name">Production Invoice</div>
                        <div class="inv-brand-sub">Manufacturing Record</div>
                    </div>
                </div>
                <div class="inv-num-box">
                    <div class="inv-num-label">Reference Number</div>
                    <div class="inv-num-val">{{ $production->reference_no }}</div>
                    <div class="inv-date-val">{{ $production->created_at->format('d F Y, H:i') }}</div>
                    <div style="margin-top:4px;font-family:var(--inv-mono);font-size:.7rem;color:var(--inv-muted);">{{ $production->batch_no }}</div>
                </div>
            </div>
        </div>

        {{-- Metadata Grid --}}
        <div class="inv-meta-grid">
            <div class="inv-meta-cell">
                <div class="inv-meta-label">Product</div>
                <div class="inv-meta-value" style="font-weight:700;font-size:1rem;">{{ $production->product_name ?? $production->template?->item_name ?? '—' }}</div>
                <div style="font-size:.72rem;color:var(--inv-muted);margin-top:2px;">HSN: {{ $production->template?->item_hsn ?? 'N/A' }}</div>
            </div>
            <div class="inv-meta-cell">
                <div class="inv-meta-label">Quantity Produced</div>
                <div class="inv-meta-value amber" style="font-size:1.5rem;letter-spacing:-.03em;">{{ $production->finished_qty }}</div>
                <div style="font-size:.72rem;color:var(--inv-muted);margin-top:2px;">finished goods units</div>
            </div>
            <div class="inv-meta-cell">
                <div class="inv-meta-label">Warehouse</div>
                <div class="inv-meta-value">{{ $production->warehouse_location ?? 'Not specified' }}</div>
                <div style="font-size:.72rem;color:var(--inv-muted);margin-top:2px;">primary location</div>
            </div>
        </div>

        <div class="inv-body">

            {{-- Party --}}
            @if($production->party)
            <div class="inv-section">👤 Buyer / Party</div>
            <div class="party-card">
                <div class="party-avatar">👤</div>
                <div>
                    <div class="party-name">{{ $production->party->party_name }}</div>
                    <div class="party-phone">📞 {{ $production->party->phone_number }}</div>
                    @if($production->party->email)
                        <div style="font-size:.72rem;color:var(--inv-muted);margin-top:2px;">✉️ {{ $production->party->email }}</div>
                    @endif
                </div>
                @if($production->party->gstin)
                <div style="margin-left:auto;text-align:right;">
                    <div style="font-size:.65rem;color:var(--inv-muted);margin-bottom:2px;">GSTIN</div>
                    <div style="font-family:var(--inv-mono);font-size:.78rem;color:var(--inv-amber);">{{ $production->party->gstin }}</div>
                </div>
                @endif
            </div>
            @endif

            {{-- Raw Materials Used --}}
            <div class="inv-section">🧪 Raw Materials Consumed</div>
            <table class="inv-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Material Name</th>
                        <th>Used Qty</th>
                        <th>Unit Price</th>
                        <th>Tax %</th>
                        <th>Tax Amt</th>
                        <th>Total Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($production->rawMaterials as $i => $rm)
                    <tr>
                        <td style="font-family:var(--inv-mono);font-size:.75rem;color:var(--inv-muted);">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div style="font-weight:600;color:#fff;">{{ $rm->rawMaterial->item_name ?? $rm->rawMaterial->title ?? 'Material' }}</div>
                        </td>
                        <td>
                            <span style="font-family:var(--inv-mono);font-size:.82rem;background:#f59e0b15;color:var(--inv-amber);padding:.15rem .45rem;border-radius:4px;">{{ $rm->used_qty }}</span>
                        </td>
                        <td style="font-family:var(--inv-mono); color:#fff;">₹ {{ number_format($rm->purchase_price, 2) }}</td>
                        <td style="font-family:var(--inv-mono); color:#fff;">{{ $rm->tax_percent }}%</td>
                        <td style="font-family:var(--inv-mono);color:var(--inv-red);">₹ {{ number_format($rm->tax_amount, 2) }}</td>
                        <td style="font-family:var(--inv-mono);color:var(--inv-amber);font-weight:600;">₹ {{ number_format($rm->total_cost, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align:right;color:var(--inv-muted);font-size:.78rem;">Total Raw Material Cost</td>
                        <td colspan="2" style="text-align:right;font-family:var(--inv-mono);font-size:1rem;color:var(--inv-amber);">₹ {{ number_format($production->total_raw_cost, 2) }}</td>
                    </tr>
                </tfoot>
            </table>

            {{-- Finished Goods --}}
            <div class="inv-section">📦 Finished Goods Produced ({{ $production->finishedGoods->count() }} units)</div>
            <div class="fg-list">
                @foreach($production->finishedGoods as $fg)
                <div class="fg-card">
                    <div class="fg-unique">{{ $fg->unique_code }}</div>
                    <div class="fg-serial">{{ $fg->item_code ?: 'No Serial' }}</div>
                    <div class="fg-bc">BC: {{ $fg->buyer_code }}</div>
                    <div class="fg-price">₹ {{ number_format($fg->sale_price, 2) }}
                        @if($fg->tax_percent > 0)
                            <span style="font-size:.68rem;color:var(--inv-muted);"> + {{ $fg->tax_percent }}% GST</span>
                        @endif
                    </div>
                    <div class="fg-profit" style="color: {{ $fg->profit_per_unit >= 0 ? '#10b981' : '#ef4444' }};">
                        Profit: {{ $fg->profit_per_unit >= 0 ? '+' : '' }}₹ {{ number_format($fg->profit_per_unit, 2) }}
                    </div>
                    <div class="fg-wh">📍 {{ $fg->warehouse_location }}</div>
                    <div style="margin-top:.5rem;font-size:.65rem;color:var(--inv-muted);">{{ ucfirst($fg->sale_mode) }} pricing</div>
                </div>
                @endforeach
            </div>

            {{-- Financial Summary --}}
            <div class="inv-section">💰 Financial Summary</div>
            <div class="fin-grid">
                <div class="fin-box">
                    <div style="font-size:.72rem;color:var(--inv-muted);text-transform:uppercase;letter-spacing:.06em;font-weight:700;margin-bottom:.75rem;">Cost Breakdown</div>
                    <div class="fin-row"><span class="fin-label">Raw Material Cost</span><span class="fin-val amber">₹ {{ number_format($production->total_raw_cost, 2) }}</span></div>
                    <div class="fin-row"><span class="fin-label">Input GST (ITC)</span><span class="fin-val red">₹ {{ number_format($production->input_tax, 2) }}</span></div>
                    <div class="fin-row"><span class="fin-label">Cost Per Unit</span><span class="fin-val">₹ {{ $production->finished_qty > 0 ? number_format($production->total_raw_cost / $production->finished_qty, 2) : '0.00' }}</span></div>
                    <div class="fin-total">
                        <span class="fin-total-label">Net Profit</span>
                        <span class="fin-total-val" style="color: {{ $production->profit >= 0 ? '#10b981' : '#ef4444' }};">
                            {{ $production->profit >= 0 ? '+' : '' }}₹ {{ number_format($production->profit, 2) }}
                        </span>
                    </div>
                </div>
                <div class="fin-box">
                    <div style="font-size:.72rem;color:var(--inv-muted);text-transform:uppercase;letter-spacing:.06em;font-weight:700;margin-bottom:.75rem;">GST Breakdown</div>
                    <div class="fin-row"><span class="fin-label">Output GST Collected</span><span class="fin-val amber">₹ {{ number_format($production->output_tax, 2) }}</span></div>
                    <div class="fin-row"><span class="fin-label">CGST (50%)</span><span class="fin-val">₹ {{ number_format($production->output_tax / 2, 2) }}</span></div>
                    <div class="fin-row"><span class="fin-label">SGST (50%)</span><span class="fin-val">₹ {{ number_format($production->output_tax / 2, 2) }}</span></div>
                    <div class="fin-row"><span class="fin-label">ITC Credit</span><span class="fin-val green">— ₹ {{ number_format($production->input_tax, 2) }}</span></div>
                    <div class="fin-total">
                        <span class="fin-total-label">GST Payable</span>
                        <span class="fin-total-val" style="color:var(--inv-amber);">₹ {{ number_format($production->output_tax - $production->input_tax, 2) }}</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Invoice Footer --}}
        <div class="inv-footer">
            <div class="inv-footer-note">
                Generated on {{ $production->created_at->format('d M Y') }}
                @if($production->creator)· By {{ $production->creator->name ?? 'System' }}@endif
            </div>
            <div class="inv-footer-sig" style="text-align:right;">
                Production Management System<br>
                <span style="font-size:.6rem;opacity:.5;">{{ $production->reference_no }}</span>
            </div>
        </div>

    </div>

</div>

@endsection
