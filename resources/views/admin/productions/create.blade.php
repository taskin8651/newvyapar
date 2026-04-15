@extends('layouts.admin')

@section('content')

{{-- ========================================================================
     PRODUCTION — CREATE  |  Ultra-professional blade
     Design: Dark industrial with amber accents — precision manufacturing feel
     ======================================================================== --}}

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --prod-bg:        #0f1117;
    --prod-surface:   #181c27;
    --prod-card:      #1e2333;
    --prod-border:    #2a3148;
    --prod-amber:     #f59e0b;
    --prod-amber-dim: #92400e;
    --prod-indigo:    #6366f1;
    --prod-green:     #10b981;
    --prod-red:       #ef4444;
    --prod-text:      #e2e8f0;
    --prod-muted:     #64748b;
    --prod-mono:      'DM Mono', monospace;
    --prod-display:   'Syne', sans-serif;
    --prod-body:      'DM Sans', sans-serif;
}

.prod-wrap       { background: var(--prod-bg); min-height: 100vh; padding: 2rem; font-family: var(--prod-body); }
.prod-header     { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2.5rem; }
.prod-icon       { width: 52px; height: 52px; background: linear-gradient(135deg,#f59e0b,#d97706); border-radius: 14px; display: grid; place-items: center; font-size: 1.4rem; flex-shrink: 0; box-shadow: 0 0 24px #f59e0b44; }
.prod-title      { font-family: var(--prod-display); font-size: 1.85rem; font-weight: 800; color: #fff; letter-spacing: -0.03em; line-height: 1; }
.prod-subtitle   { font-size: .82rem; color: var(--prod-muted); margin-top: 3px; letter-spacing: .04em; text-transform: uppercase; }

.prod-steps      { display: flex; gap: 0; margin-bottom: 2rem; }
.prod-step       { display: flex; align-items: center; gap: .65rem; padding: .6rem 1.2rem; border: 1px solid var(--prod-border); background: var(--prod-card); cursor: default; }
.prod-step:first-child { border-radius: 10px 0 0 10px; }
.prod-step:last-child  { border-radius: 0 10px 10px 0; }
.prod-step + .prod-step { border-left: none; }
.step-num        { width: 24px; height: 24px; border-radius: 50%; background: var(--prod-border); color: var(--prod-muted); font-family: var(--prod-mono); font-size: .72rem; display: grid; place-items: center; flex-shrink: 0; transition: all .3s; }
.step-label      { font-size: .78rem; color: var(--prod-muted); font-weight: 500; letter-spacing: .03em; transition: color .3s; }
.prod-step.active .step-num   { background: var(--prod-amber); color: #000; box-shadow: 0 0 10px #f59e0b66; }
.prod-step.active .step-label { color: var(--prod-amber); }
.prod-step.done  .step-num    { background: var(--prod-green); color: #000; }
.prod-step.done  .step-label  { color: var(--prod-green); }

.pcard           { background: var(--prod-card); border: 1px solid var(--prod-border); border-radius: 16px; padding: 1.75rem; margin-bottom: 1.5rem; }
.pcard-title     { font-family: var(--prod-display); font-size: 1rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: .6rem; margin-bottom: 1.25rem; letter-spacing: -.01em; }
.pcard-title span{ font-size: .7rem; background: var(--prod-amber-dim); color: var(--prod-amber); padding: .2rem .55rem; border-radius: 99px; font-family: var(--prod-mono); font-weight: 500; letter-spacing: .04em; }

.pinput          { width: 100%; background: var(--prod-surface); border: 1px solid var(--prod-border); color: var(--prod-text); border-radius: 9px; padding: .6rem .85rem; font-size: .85rem; font-family: var(--prod-body); transition: border-color .2s, box-shadow .2s; outline: none; }
.pinput:focus    { border-color: var(--prod-amber); box-shadow: 0 0 0 3px #f59e0b22; }
.pinput::placeholder { color: var(--prod-muted); }
.plabel          { font-size: .72rem; font-weight: 600; color: var(--prod-muted); text-transform: uppercase; letter-spacing: .06em; margin-bottom: .4rem; display: block; }
.pselect         { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right .75rem center; padding-right: 2rem; }

.template-select-wrap { position: relative; }
.template-select-wrap::after { content: '▾'; position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: var(--prod-amber); pointer-events: none; font-size: 1rem; }
.template-select-wrap select { width: 100%; background: var(--prod-surface); border: 2px solid var(--prod-border); color: var(--prod-text); border-radius: 12px; padding: .85rem 2.5rem .85rem 1rem; font-size: .95rem; font-family: var(--prod-body); font-weight: 500; outline: none; appearance: none; transition: border-color .2s; cursor: pointer; }
.template-select-wrap select:focus { border-color: var(--prod-amber); }

.info-strip      { display: flex; gap: 1.25rem; padding: 1rem 1.25rem; background: var(--prod-surface); border: 1px solid var(--prod-border); border-radius: 10px; margin-top: 1rem; flex-wrap: wrap; }
.info-chip       { display: flex; flex-direction: column; gap: 2px; }
.info-chip-label { font-size: .65rem; color: var(--prod-muted); text-transform: uppercase; letter-spacing: .06em; font-weight: 600; }
.info-chip-value { font-size: .85rem; color: var(--prod-text); font-family: var(--prod-mono); font-weight: 500; }
.info-chip-value.amber { color: var(--prod-amber); }

.ptable          { width: 100%; border-collapse: collapse; font-size: .83rem; }
.ptable thead tr { background: var(--prod-surface); }
.ptable th       { padding: .7rem .9rem; text-align: left; font-size: .68rem; font-weight: 600; color: var(--prod-muted); text-transform: uppercase; letter-spacing: .07em; }
.ptable td       { padding: .65rem .9rem; border-top: 1px solid var(--prod-border); color: var(--prod-text); vertical-align: middle; }
.ptable tbody tr:hover { background: #ffffff05; }
.badge           { display: inline-flex; align-items: center; padding: .15rem .5rem; border-radius: 5px; font-size: .68rem; font-family: var(--prod-mono); font-weight: 500; }
.badge-green     { background: #10b98120; color: var(--prod-green); }
.badge-amber     { background: #f59e0b20; color: var(--prod-amber); }
.badge-red       { background: #ef444420; color: var(--prod-red); }
.badge-indigo    { background: #6366f120; color: var(--prod-indigo); }

.qty-card        { background: linear-gradient(135deg, #1e2333, #252d44); border: 2px solid var(--prod-border); border-radius: 16px; padding: 1.75rem; margin-bottom: 1.5rem; position: relative; overflow: hidden; }
.qty-card::before{ content: ''; position: absolute; top: -40px; right: -40px; width: 160px; height: 160px; background: radial-gradient(circle, #f59e0b22, transparent 70%); pointer-events: none; }
.qty-big-input   { background: transparent; border: none; border-bottom: 3px solid var(--prod-amber); color: #fff; font-family: var(--prod-display); font-size: 3.5rem; font-weight: 800; width: 180px; outline: none; padding: .25rem 0; letter-spacing: -.03em; }
.qty-big-input::placeholder { color: #ffffff22; }

/* Global Warehouse Strip */
.warehouse-strip { display: flex; align-items: flex-end; gap: 1.25rem; padding: 1rem 1.25rem; background: linear-gradient(90deg, #10b98112, transparent); border: 1px solid #10b98130; border-radius: 12px; margin-bottom: 1.25rem; flex-wrap: wrap; }
.warehouse-strip-label { font-size: .7rem; font-weight: 700; color: var(--prod-green); text-transform: uppercase; letter-spacing: .07em; white-space: nowrap; align-self: center; display: flex; align-items: center; gap: .4rem; }
.warehouse-strip-label::before { content: '🏭'; font-size: .9rem; }

/* Stock warning bar */
.stock-warning   { background: #ef444415; border: 1px solid #ef444440; border-radius: 10px; padding: .85rem 1.25rem; margin-top: 1rem; display: none; }
.stock-warning.show { display: block; }
.stock-warning-title { font-size: .8rem; font-weight: 700; color: var(--prod-red); margin-bottom: .6rem; letter-spacing: .03em; }
.stock-issue-row { display: flex; justify-content: space-between; align-items: center; padding: .35rem 0; border-bottom: 1px solid #ef444420; font-size: .8rem; }
.stock-issue-row:last-child { border: none; }
.stock-issue-name { color: var(--prod-text); }
.stock-issue-detail { font-family: var(--prod-mono); color: var(--prod-red); font-size: .75rem; }
.stock-max-notice { margin-top: .65rem; padding: .5rem .85rem; background: #f59e0b15; border: 1px solid #f59e0b40; border-radius: 7px; font-size: .78rem; color: var(--prod-amber); font-weight: 600; }

.goods-table-wrap{ overflow-x: auto; border-radius: 12px; border: 1px solid var(--prod-border); }
.goods-table     { width: 100%; border-collapse: collapse; font-size: .82rem; min-width: 980px; }
.goods-table thead tr { background: var(--prod-surface); }
.goods-table th  { padding: .75rem 1rem; text-align: left; font-size: .67rem; font-weight: 600; color: var(--prod-muted); text-transform: uppercase; letter-spacing: .07em; white-space: nowrap; }
.goods-table td  { padding: .5rem .75rem; border-top: 1px solid var(--prod-border); vertical-align: middle; }
.goods-table tbody tr:hover { background: #ffffff04; }
.row-num         { width: 28px; height: 28px; background: var(--prod-border); color: var(--prod-muted); border-radius: 6px; display: grid; place-items: center; font-family: var(--prod-mono); font-size: .7rem; font-weight: 600; flex-shrink: 0; }
.btn-auto        { padding: .3rem .65rem; background: #6366f120; color: var(--prod-indigo); border: 1px solid #6366f140; border-radius: 6px; font-size: .7rem; font-family: var(--prod-mono); cursor: pointer; transition: background .2s; white-space: nowrap; }
.btn-auto:hover  { background: #6366f135; }
.bc-tag          { display: inline-flex; align-items: center; gap: .3rem; padding: .2rem .55rem; background: #10b98115; border: 1px solid #10b98130; border-radius: 5px; font-family: var(--prod-mono); font-size: .68rem; color: var(--prod-green); white-space: nowrap; }

/* Batch number tag */
.batch-tag       { display: inline-flex; align-items: center; gap: .3rem; padding: .18rem .5rem; background: #f59e0b12; border: 1px solid #f59e0b35; border-radius: 5px; font-family: var(--prod-mono); font-size: .65rem; color: var(--prod-amber); white-space: nowrap; margin-top: .2rem; }

/* Notes button */
.btn-notes       { width: 28px; height: 28px; border-radius: 8px; background: #6366f120; border: 1px solid #6366f140; color: var(--prod-indigo); font-size: .85rem; font-weight: 700; cursor: pointer; display: grid; place-items: center; transition: all .2s; flex-shrink: 0; }
.btn-notes:hover { background: #6366f135; transform: scale(1.08); }
.btn-notes.has-note { background: #f59e0b20; border-color: #f59e0b50; color: var(--prod-amber); }
.note-dot        { width: 6px; height: 6px; background: var(--prod-amber); border-radius: 50%; display: inline-block; }

/* Notes Modal */
.notes-overlay   { position: fixed; inset: 0; background: rgba(0,0,0,.72); backdrop-filter: blur(6px); z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 1rem; }
.notes-modal     { background: var(--prod-card); border: 1px solid var(--prod-border); border-radius: 20px; width: 100%; max-width: 520px; padding: 0; overflow: hidden; box-shadow: 0 24px 80px #000a, 0 0 0 1px #f59e0b18; animation: modalIn .22s cubic-bezier(.34,1.56,.64,1); }
@keyframes modalIn { from { opacity: 0; transform: translateY(16px) scale(.96); } to { opacity: 1; transform: none; } }
.notes-modal-header { padding: 1.2rem 1.5rem .9rem; border-bottom: 1px solid var(--prod-border); display: flex; align-items: center; justify-content: space-between; }
.notes-modal-title  { font-family: var(--prod-display); font-size: .95rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: .5rem; }
.notes-modal-close  { width: 30px; height: 30px; background: var(--prod-surface); border: 1px solid var(--prod-border); border-radius: 8px; color: var(--prod-muted); cursor: pointer; display: grid; place-items: center; font-size: 1rem; transition: all .2s; }
.notes-modal-close:hover { background: #ef444420; color: var(--prod-red); border-color: #ef444440; }
.notes-modal-body   { padding: 1.25rem 1.5rem; }
.notes-textarea     { width: 100%; background: var(--prod-surface); border: 1px solid var(--prod-border); color: var(--prod-text); border-radius: 10px; padding: .85rem 1rem; font-size: .88rem; font-family: var(--prod-body); line-height: 1.6; resize: vertical; min-height: 130px; outline: none; transition: border-color .2s; }
.notes-textarea:focus { border-color: var(--prod-amber); box-shadow: 0 0 0 3px #f59e0b18; }
.notes-textarea::placeholder { color: var(--prod-muted); }
.notes-char-count   { font-size: .68rem; color: var(--prod-muted); font-family: var(--prod-mono); text-align: right; margin-top: .35rem; }
.notes-modal-footer { padding: .9rem 1.5rem 1.2rem; border-top: 1px solid var(--prod-border); display: flex; gap: .75rem; justify-content: flex-end; }
.btn-notes-save     { padding: .55rem 1.4rem; background: var(--prod-amber); color: #000; border: none; border-radius: 9px; font-size: .82rem; font-weight: 700; cursor: pointer; font-family: var(--prod-display); transition: opacity .2s; }
.btn-notes-save:hover { opacity: .88; }
.btn-notes-clear    { padding: .55rem 1rem; background: var(--prod-surface); color: var(--prod-muted); border: 1px solid var(--prod-border); border-radius: 9px; font-size: .82rem; cursor: pointer; transition: all .2s; }
.btn-notes-clear:hover { color: var(--prod-red); border-color: #ef444440; }

.bulk-bar        { display: flex; gap: 1rem; align-items: flex-end; padding: 1rem 1.25rem; background: var(--prod-surface); border: 1px dashed var(--prod-border); border-radius: 10px; margin-bottom: 1rem; flex-wrap: wrap; }
.bulk-bar-label  { font-size: .72rem; color: var(--prod-amber); font-weight: 700; letter-spacing: .05em; text-transform: uppercase; white-space: nowrap; align-self: center; }

.summary-grid    { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem; }
.summary-row     { display: flex; justify-content: space-between; align-items: center; padding: .55rem 0; border-bottom: 1px solid var(--prod-border); }
.summary-row:last-child { border: none; }
.summary-label   { font-size: .82rem; color: var(--prod-muted); }
.summary-value   { font-family: var(--prod-mono); font-size: .88rem; font-weight: 500; color: var(--prod-text); }
.summary-value.amber { color: var(--prod-amber); }
.summary-value.green { color: var(--prod-green); }
.summary-value.red   { color: var(--prod-red); }
.summary-value.big   { font-size: 1.15rem; font-family: var(--prod-display); font-weight: 700; color: #fff; }

.profit-bar-wrap { height: 6px; background: var(--prod-border); border-radius: 99px; overflow: hidden; margin: .75rem 0; }
.profit-bar      { height: 100%; background: linear-gradient(90deg, var(--prod-amber), var(--prod-green)); border-radius: 99px; transition: width .5s ease; }

.btn-produce     { background: linear-gradient(135deg, #f59e0b, #d97706); color: #000; font-family: var(--prod-display); font-size: 1rem; font-weight: 800; padding: .9rem 2.5rem; border-radius: 12px; border: none; cursor: pointer; letter-spacing: -.01em; transition: opacity .2s, transform .15s; box-shadow: 0 4px 20px #f59e0b44; }
.btn-produce:hover { opacity: .92; transform: translateY(-1px); }
.btn-produce:active { transform: translateY(0); }
.btn-produce:disabled { opacity: .4; cursor: not-allowed; transform: none; }

/* Party selector */
.party-select-wrap { position: relative; }
.party-select-wrap select { width: 100%; background: var(--prod-surface); border: 1px solid var(--prod-border); color: var(--prod-text); border-radius: 9px; padding: .6rem 2.5rem .6rem .85rem; font-size: .85rem; font-family: var(--prod-body); outline: none; appearance: none; transition: border-color .2s; }
.party-select-wrap select:focus { border-color: var(--prod-amber); box-shadow: 0 0 0 3px #f59e0b22; }
.party-select-wrap::after { content: '▾'; position: absolute; right: .75rem; top: 50%; transform: translateY(-50%); color: var(--prod-muted); pointer-events: none; font-size: .75rem; }
.party-info-strip { display: flex; gap: 1.25rem; padding: .6rem 1rem; background: #10b98110; border: 1px solid #10b98130; border-radius: 8px; margin-top: .5rem; }

@media (max-width: 768px) {
    .summary-grid { grid-template-columns: 1fr; }
    .prod-steps   { overflow-x: auto; }
}

[x-cloak] { display: none !important; }
</style>

<div class="prod-wrap">

    <div class="prod-header">
        <div class="prod-icon">⚙️</div>
        <div>
            <div class="prod-title">New Production Batch</div>
            <div class="prod-subtitle">Convert Finished Goods Templates → Serialised Items</div>
        </div>
    </div>

    <div x-data="productionForm()" x-cloak>

        {{-- Step Indicator --}}
        <div class="prod-steps">
            <div class="prod-step" :class="{ active: step===1, done: step>1 }">
                <div class="step-num">01</div><div class="step-label">Select Product</div>
            </div>
            <div class="prod-step" :class="{ active: step===2, done: step>2 }">
                <div class="step-num">02</div><div class="step-label">Set Quantity</div>
            </div>
            <div class="prod-step" :class="{ active: step===3, done: step>3 }">
                <div class="step-num">03</div><div class="step-label">Goods Details</div>
            </div>
            <div class="prod-step" :class="{ active: step===4 }">
                <div class="step-num">04</div><div class="step-label">Confirm</div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.productions.store') }}" enctype="multipart/form-data" id="prodForm">
            @csrf

            {{-- ── STEP 1: Template + Party ── --}}
            <div class="pcard">
                <div class="pcard-title">🏷️ Finished Product Template <span>Step 01</span></div>

                <div class="template-select-wrap">
                    <select x-model="selectedTemplateId" @change="selectTemplate()" name="_template_display">
                        <option value="">— Choose a finished goods template —</option>
                        @foreach($templates as $t)
                            <option value="{{ $t['id'] }}">
                                {{ $t['title'] }}
                                @if(!empty($t['item_code'])) ({{ $t['item_code'] }}) @endif
                                @if(!empty($t['item_hsn'])) | HSN: {{ $t['item_hsn'] }} @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="info-strip" x-show="selectedTemplate" x-transition>
                    <div class="info-chip">
                        <div class="info-chip-label">Product Name</div>
                        <div class="info-chip-value amber" x-text="selectedTemplate?.title ?? '—'"></div>
                    </div>
                    <div class="info-chip">
                        <div class="info-chip-label">Item Code</div>
                        <div class="info-chip-value" x-text="selectedTemplate?.item_code || 'N/A'"></div>
                    </div>
                    <div class="info-chip">
                        <div class="info-chip-label">HSN Code</div>
                        <div class="info-chip-value" x-text="selectedTemplate?.item_hsn || 'N/A'"></div>
                    </div>
                    <div class="info-chip">
                        <div class="info-chip-label">Base Sale Price</div>
                        <div class="info-chip-value amber">₹ <span x-text="(selectedTemplate?.sale_price ?? 0).toFixed(2)"></span></div>
                    </div>
                    <div class="info-chip">
                        <div class="info-chip-label">GST %</div>
                        <div class="info-chip-value" x-text="(selectedTemplate?.tax_percent ?? 0) + '%'"></div>
                    </div>
                    <div class="info-chip">
                        <div class="info-chip-label">Raw Materials</div>
                        <div class="info-chip-value" x-text="(selectedTemplate?.raw_materials?.length ?? 0) + ' items'"></div>
                    </div>
                </div>

                {{-- Party selector --}}
                <div x-show="selectedTemplate" x-transition style="margin-top:1.25rem;">
                    <div class="plabel">👤 Party / Buyer (Optional)</div>
                    <div class="party-select-wrap">
                        <select name="party_id" x-model="selectedPartyId" @change="selectParty()">
                            <option value="">— No specific party —</option>
                            @foreach($parties as $party)
                                <option value="{{ $party->id }}" data-name="{{ $party->party_name }}" data-phone="{{ $party->phone_number }}">
                                    {{ $party->party_name }} — {{ $party->phone_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="party-info-strip" x-show="selectedParty" x-transition>
                        <div class="info-chip">
                            <div class="info-chip-label">Party Name</div>
                            <div class="info-chip-value" style="color:var(--prod-green);" x-text="selectedParty?.name ?? '—'"></div>
                        </div>
                        <div class="info-chip">
                            <div class="info-chip-label">Phone</div>
                            <div class="info-chip-value" x-text="selectedParty?.phone ?? '—'"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Raw Materials Composition ── --}}
            <div class="pcard" x-show="selectedTemplate && rawComposition.length > 0" x-transition>
                <div class="pcard-title">🧪 Raw Materials Composition <span>Per Unit</span></div>
                <div style="overflow-x:auto;">
                    <table class="ptable">
                        <thead>
                            <tr>
                                <th>Material Name</th>
                                <th>Unit</th>
                                <th>Qty / Unit</th>
                                <th>Purchase Price</th>
                                <th>Available Stock</th>
                                <th>Tax</th>
                                <th>Line Cost / Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="rm in rawComposition" :key="rm.id">
                                <tr>
                                    <td>
                                        <div style="font-weight:500;color:#fff;" x-text="rm.name"></div>
                                    </td>
                                    <td><span class="badge badge-indigo" x-text="rm.unit"></span></td>
                                    <td><span class="badge badge-amber" x-text="rm.pivot_qty"></span></td>
                                    <td style="font-family:var(--prod-mono);">₹ <span x-text="rm.purchase_price.toFixed(2)"></span></td>
                                    <td>
                                        <span class="badge"
                                            :class="(rm.available_stock ?? 0) >= rm.pivot_qty ? 'badge-green' : 'badge-red'"
                                            x-text="(rm.available_stock ?? '…') + ' ' + rm.unit"></span>
                                    </td>
                                    <td>
                                        <span x-show="rm.with_tax == 1" class="badge badge-red" x-text="rm.tax_percent + '%'"></span>
                                        <span x-show="rm.with_tax != 1" class="badge badge-green">0%</span>
                                    </td>
                                    <td style="font-family:var(--prod-mono);color:var(--prod-amber);">
                                        ₹ <span x-text="((rm.pivot_qty * rm.purchase_price) + (rm.with_tax == 1 ? (rm.pivot_qty * rm.purchase_price * rm.tax_percent / 100) : 0)).toFixed(2)"></span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ── STEP 2: Production Qty ── --}}
            <div class="qty-card" x-show="selectedTemplate" x-transition>
                <div style="display:flex;align-items:flex-end;gap:2.5rem;flex-wrap:wrap;">
                    <div>
                        <div class="plabel" style="color:var(--prod-amber);margin-bottom:.5rem;">How many units to produce?</div>
                        <div style="display:flex;align-items:center;gap:1rem;">
                            <input
                                type="number"
                                class="qty-big-input"
                                x-model.number="finishedQty"
                                @input="onQtyChange()"
                                min="1"
                                placeholder="1"
                                required>
                            <div style="color:var(--prod-muted);font-size:.85rem;line-height:1.5;">
                                units<br>
                                <span style="color:var(--prod-green);font-family:var(--prod-mono);font-size:.75rem;"
                                    x-text="finishedQty > 0 ? finishedQty + ' individual records will be created' : ''"></span>
                            </div>
                        </div>
                    </div>

                    <div x-show="finishedQty > 0" style="display:flex;gap:1.5rem;flex-wrap:wrap;">
                        <div>
                            <div class="info-chip-label">Total Raw Cost</div>
                            <div class="info-chip-value amber" style="font-size:1.1rem;">₹ <span x-text="totalRawCost.toFixed(2)"></span></div>
                        </div>
                        <div>
                            <div class="info-chip-label">Cost Per Unit</div>
                            <div class="info-chip-value" style="font-size:1.1rem;">₹ <span x-text="costPerUnit.toFixed(2)"></span></div>
                        </div>
                        <div>
                            <div class="info-chip-label">Total Input GST</div>
                            <div class="info-chip-value" style="font-size:1.1rem;color:var(--prod-red);">₹ <span x-text="totalInputTax.toFixed(2)"></span></div>
                        </div>
                    </div>
                </div>

                {{-- Stock Warning Panel --}}
                <div id="stockWarningPanel" class="stock-warning">
                    <div class="stock-warning-title">⚠️ Insufficient Raw Material Stock</div>
                    <div id="stockIssuesList"></div>
                    <div class="stock-max-notice" id="stockMaxNotice"></div>
                </div>

                <input type="hidden" name="finished_qty" :value="finishedQty">
                <input type="hidden" name="add_item_template_id" :value="selectedTemplateId">
            </div>

            {{-- ── STEP 3: Individual Goods Details ── --}}
            <div class="pcard" x-show="goodsCards.length > 0" x-transition>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;flex-wrap:wrap;gap:.75rem;">
                    <div class="pcard-title" style="margin:0;">📦 Individual Goods Details <span>Step 03</span></div>
                    <div style="display:flex;gap:.65rem;flex-wrap:wrap;">
                        <button type="button" @click="generateAllSerials()"
                            style="padding:.45rem 1rem;background:#6366f120;color:var(--prod-indigo);border:1px solid #6366f140;border-radius:8px;font-size:.78rem;font-family:var(--prod-mono);cursor:pointer;">
                            ⚡ Auto-Gen All Serials
                        </button>
                        <button type="button" @click="generateAllBatchNos()"
                            style="padding:.45rem 1rem;background:#f59e0b18;color:var(--prod-amber);border:1px solid #f59e0b40;border-radius:8px;font-size:.78rem;font-family:var(--prod-mono);cursor:pointer;">
                            🏷️ Auto-Gen All Batch Nos
                        </button>
                    </div>
                </div>

                {{-- ── Global Warehouse (single for all goods) ── --}}
                <div class="warehouse-strip">
                    <div class="warehouse-strip-label">Warehouse Location</div>
                    <div style="flex:1;min-width:200px;max-width:380px;">
                        <input type="text"
                            class="pinput"
                            x-model="globalWarehouse"
                            @input="syncWarehouse()"
                            name="warehouse_location"
                            placeholder="Enter warehouse / storage location for all goods…"
                            required>
                    </div>
                    <div style="font-size:.72rem;color:var(--prod-muted);align-self:center;">
                        📌 Applies to all <span style="color:var(--prod-amber);font-family:var(--prod-mono);" x-text="goodsCards.length"></span> units
                    </div>
                </div>

                {{-- Bulk Apply Bar --}}
                <div class="bulk-bar">
                    <div class="bulk-bar-label">⚡ Apply to All →</div>
                    <div style="min-width:110px;">
                        <div class="plabel">Sale Price ₹</div>
                        <input type="number" step="0.01" class="pinput" x-model="bulkSalePrice" placeholder="0.00">
                    </div>
                    <div style="min-width:90px;">
                        <div class="plabel">GST %</div>
                        <input type="number" step="0.01" class="pinput" x-model="bulkTaxPercent" placeholder="0">
                    </div>
                    <div style="min-width:130px;">
                        <div class="plabel">Sale Mode</div>
                        <select class="pinput pselect" x-model="bulkSaleMode">
                            <option value="exclusive">Tax Exclusive</option>
                            <option value="inclusive">Tax Inclusive</option>
                            <option value="export">Export (Zero)</option>
                        </select>
                    </div>
                    <button type="button" @click="applyToAll()"
                        style="padding:.6rem 1.25rem;background:var(--prod-amber);color:#000;border:none;border-radius:9px;font-size:.8rem;font-weight:700;cursor:pointer;font-family:var(--prod-display);flex-shrink:0;margin-top:1.1rem;">
                        Apply
                    </button>
                </div>

                <div class="goods-table-wrap">
                    <table class="goods-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Buyer Code <span style="color:var(--prod-green);font-size:.6rem;">(Auto)</span></th>
                                <th>Serial No.</th>
                                <th>Batch No. <span style="color:var(--prod-amber);font-size:.6rem;">(Purchase)</span></th>
                                <th>Sale Price ₹ <span style="color:var(--prod-red);">*</span></th>
                                <th>GST %</th>
                                <th>Sale Mode</th>
                                <th>Attachment</th>
                                <th>Notes</th>
                                <th>Profit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(card, index) in goodsCards" :key="index">
                                <tr>
                                    <td>
                                        <div class="row-num" x-text="index + 1"></div>
                                    </td>

                                    {{-- Buyer Code --}}
                                    <td>
                                        <div style="display:flex;gap:.35rem;align-items:center;flex-direction:column;gap:.25rem;">
                                            <input type="text"
                                                class="pinput"
                                                style="min-width:140px;"
                                                x-model="card.buyer_code"
                                                :name="'goods['+index+'][buyer_code]'"
                                                placeholder="Auto-generated">
                                            <span class="bc-tag" x-show="card.buyer_code" x-text="card.buyer_code" style="font-size:.62rem;"></span>
                                        </div>
                                    </td>

                                    {{-- Serial No --}}
                                    <td>
                                        <div style="display:flex;gap:.35rem;align-items:center;">
                                            <input type="text"
                                                class="pinput"
                                                style="min-width:120px;"
                                                x-model="card.serial_no"
                                                :name="'goods['+index+'][serial_no]'"
                                                placeholder="Auto or manual">
                                            <button type="button" @click="generateSerial(index)" class="btn-auto">⚡</button>
                                        </div>
                                    </td>

                                    {{-- Batch No (NEW) --}}
                                    <td>
                                        <div style="display:flex;gap:.35rem;align-items:center;flex-direction:column;gap:.25rem;">
                                            <div style="display:flex;gap:.3rem;align-items:center;">
                                                <input type="text"
                                                    class="pinput"
                                                    style="min-width:130px;font-family:var(--prod-mono);font-size:.78rem;"
                                                    x-model="card.batch_no"
                                                    :name="'goods['+index+'][batch_no]'"
                                                    placeholder="e.g. APR2026-A3X9K">
                                                <button type="button" @click="generateBatchNo(index)" class="btn-auto">🏷️</button>
                                            </div>
                                            <span class="batch-tag" x-show="card.batch_no" x-text="card.batch_no"></span>
                                        </div>
                                    </td>

                                    {{-- Sale Price --}}
                                    <td>
                                        <input type="number"
                                            step="0.01"
                                            class="pinput"
                                            style="min-width:100px;"
                                            x-model.number="card.sale_price"
                                            @input="calculateAll()"
                                            :name="'goods['+index+'][sale_price]'"
                                            required>
                                    </td>

                                    {{-- GST % --}}
                                    <td>
                                        <input type="number"
                                            step="0.01"
                                            class="pinput"
                                            style="min-width:70px;"
                                            x-model.number="card.tax_percent"
                                            @input="calculateAll()"
                                            :name="'goods['+index+'][tax_percent]'">
                                    </td>

                                    {{-- Sale Mode --}}
                                    <td>
                                        <select class="pinput pselect" style="min-width:130px;"
                                            x-model="card.sale_mode"
                                            @change="calculateAll()"
                                            :name="'goods['+index+'][sale_mode]'">
                                            <option value="exclusive">Exclusive</option>
                                            <option value="inclusive">Inclusive</option>
                                            <option value="export">Export</option>
                                        </select>
                                    </td>

                                    {{-- Attachment --}}
                                    <td>
                                        <input type="file"
                                            :name="'goods_attachments['+index+']'"
                                            accept=".pdf,.jpg,.jpeg,.png,.webp"
                                            style="font-size:.72rem;color:var(--prod-muted);max-width:130px;">
                                    </td>

                                    {{-- Notes (NEW) --}}
                                    <td>
                                        <div style="display:flex;align-items:center;gap:.4rem;flex-direction:column;">
                                            <button type="button"
                                                @click="openNotesModal(index)"
                                                class="btn-notes"
                                                :class="{ 'has-note': card.notes && card.notes.trim().length > 0 }"
                                                :title="card.notes ? 'Notes added — click to edit' : 'Add notes'"
                                                style="width:32px;height:32px;font-size:1rem;">
                                                <span x-show="!card.notes || card.notes.trim().length === 0">+</span>
                                                <span x-show="card.notes && card.notes.trim().length > 0">📝</span>
                                            </button>
                                            <span x-show="card.notes && card.notes.trim().length > 0"
                                                style="font-size:.6rem;color:var(--prod-amber);font-family:var(--prod-mono);white-space:nowrap;"
                                                x-text="card.notes.trim().length + ' ch'"></span>
                                        </div>
                                        <input type="hidden" :name="'goods['+index+'][notes]'" :value="card.notes ?? ''">
                                    </td>

                                    {{-- Profit --}}
                                    <td>
                                        <div style="font-family:var(--prod-mono);font-size:.78rem;white-space:nowrap;"
                                            :style="{ color: getProfitPerUnit(card) >= 0 ? 'var(--prod-green)' : 'var(--prod-red)' }">
                                            ₹ <span x-text="getProfitPerUnit(card).toFixed(2)"></span>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ── STEP 4: Summary ── --}}
            <div class="summary-grid" x-show="goodsCards.length > 0" x-transition>
                <div class="pcard" style="margin:0;">
                    <div class="pcard-title">💸 Cost Breakdown</div>
                    <div class="summary-row">
                        <span class="summary-label">Total Raw Material Cost</span>
                        <span class="summary-value">₹ <span x-text="totalRawCost.toFixed(2)"></span></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Total Input GST (ITC)</span>
                        <span class="summary-value red">₹ <span x-text="totalInputTax.toFixed(2)"></span></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Cost Per Unit</span>
                        <span class="summary-value amber">₹ <span x-text="costPerUnit.toFixed(2)"></span></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Total Revenue (ex-tax)</span>
                        <span class="summary-value green">₹ <span x-text="totalRevenue.toFixed(2)"></span></span>
                    </div>
                    <div style="margin-top:1rem;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:.4rem;">
                            <span style="font-size:.72rem;color:var(--prod-muted);">Profit Margin</span>
                            <span style="font-family:var(--prod-mono);font-size:.78rem;"
                                :style="{ color: profitMargin >= 0 ? 'var(--prod-green)' : 'var(--prod-red)' }"
                                x-text="profitMargin.toFixed(1) + '%'"></span>
                        </div>
                        <div class="profit-bar-wrap">
                            <div class="profit-bar" :style="{ width: Math.min(Math.max(profitMargin, 0), 100) + '%' }"></div>
                        </div>
                    </div>
                    <div style="margin-top:1rem;padding:1rem;background:var(--prod-surface);border-radius:10px;display:flex;justify-content:space-between;align-items:center;">
                        <span class="summary-label" style="margin:0;">Net Profit</span>
                        <span class="summary-value big" :style="{ color: totalProfit >= 0 ? 'var(--prod-green)' : 'var(--prod-red)' }">
                            ₹ <span x-text="totalProfit.toFixed(2)"></span>
                        </span>
                    </div>
                </div>

                <div class="pcard" style="margin:0;">
                    <div class="pcard-title">🧾 GST Summary</div>
                    <div class="summary-row">
                        <span class="summary-label">Output GST (collected)</span>
                        <span class="summary-value amber">₹ <span x-text="outputTax.toFixed(2)"></span></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">CGST (50%)</span>
                        <span class="summary-value">₹ <span x-text="cgst.toFixed(2)"></span></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">SGST (50%)</span>
                        <span class="summary-value">₹ <span x-text="sgst.toFixed(2)"></span></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Input ITC Credit</span>
                        <span class="summary-value green">— ₹ <span x-text="totalInputTax.toFixed(2)"></span></span>
                    </div>
                    <div style="margin-top:1rem;padding:1rem;background:var(--prod-surface);border-radius:10px;display:flex;justify-content:space-between;align-items:center;">
                        <span class="summary-label" style="margin:0;">GST Payable</span>
                        <span class="summary-value big amber">₹ <span x-text="(outputTax - totalInputTax).toFixed(2)"></span></span>
                    </div>
                    <div style="margin-top:.75rem;padding:.85rem 1rem;background:var(--prod-surface);border-radius:10px;">
                        <div style="font-size:.72rem;color:var(--prod-muted);margin-bottom:.5rem;text-transform:uppercase;letter-spacing:.05em;font-weight:600;">Batch Summary</div>
                        <div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
                            <div class="info-chip">
                                <div class="info-chip-label">Units</div>
                                <div class="info-chip-value amber" x-text="goodsCards.length"></div>
                            </div>
                            <div class="info-chip">
                                <div class="info-chip-label">Template</div>
                                <div class="info-chip-value" x-text="selectedTemplate?.title ?? '—'" style="max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"></div>
                            </div>
                            <div class="info-chip" x-show="selectedParty">
                                <div class="info-chip-label">Party</div>
                                <div class="info-chip-value" style="color:var(--prod-green);" x-text="selectedParty?.name ?? '—'"></div>
                            </div>
                            <div class="info-chip">
                                <div class="info-chip-label">Warehouse</div>
                                <div class="info-chip-value" style="color:var(--prod-green);" x-text="globalWarehouse || '—'"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="goodsCards.length > 0" x-transition style="display:flex;gap:1rem;align-items:center;">
                <button type="submit" class="btn-produce" id="submitBtn" :disabled="stockBlocked">
                    ⚙️ Produce Finished Goods
                </button>
                <span x-show="stockBlocked" style="color:var(--prod-red);font-size:.82rem;font-weight:600;">
                    ⚠️ Cannot produce — insufficient stock
                </span>
                <a href="{{ route('admin.productions.index') }}" style="color:var(--prod-muted);font-size:.85rem;text-decoration:none;">Cancel</a>
            </div>

        </form>

        {{-- ── Notes Modal ── --}}
        <div class="notes-overlay" x-show="notesModalOpen" x-transition.opacity @click.self="closeNotesModal()" style="display:none;">
            <div class="notes-modal" @click.stop>
                <div class="notes-modal-header">
                    <div class="notes-modal-title">
                        📝 Notes
                        <span style="font-size:.7rem;background:#f59e0b20;color:var(--prod-amber);padding:.15rem .5rem;border-radius:99px;font-family:var(--prod-mono);">
                            Unit #<span x-text="(notesModalIndex + 1)"></span>
                        </span>
                    </div>
                    <button class="notes-modal-close" @click="closeNotesModal()">✕</button>
                </div>
                <div class="notes-modal-body">
                    <textarea
                        class="notes-textarea"
                        x-model="notesModalText"
                        x-ref="notesTextarea"
                        placeholder="Add any notes for this unit — quality remarks, inspection notes, special instructions…"
                        maxlength="1000"
                        rows="5"></textarea>
                    <div class="notes-char-count">
                        <span x-text="(notesModalText ?? '').length"></span> / 1000 characters
                    </div>
                </div>
                <div class="notes-modal-footer">
                    <button type="button" class="btn-notes-clear" @click="clearNotes()" x-show="notesModalText && notesModalText.trim().length > 0">
                        🗑️ Clear
                    </button>
                    <button type="button" class="btn-notes-save" @click="saveNotes()">
                        ✅ Save Notes
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
function productionForm() {
    const templates = @json($templates);
    const parties   = @json($parties);

    // Unique prefix for buyer codes this session
    const batchPrefix = Date.now().toString(36).toUpperCase().slice(-4);

    // Month names for batch number
    const MONTHS = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];

    return {
        templates,
        parties,
        selectedTemplateId: '',
        selectedTemplate:   null,
        rawComposition:     [],
        finishedQty:        1,
        goodsCards:         [],
        step:               1,
        stockBlocked:       false,

        // Party
        selectedPartyId:  '',
        selectedParty:    null,

        // Global warehouse (single for whole batch)
        globalWarehouse:  '',

        // Bulk apply (warehouse removed — it's global now)
        bulkSalePrice:   '',
        bulkTaxPercent:  '',
        bulkSaleMode:    'exclusive',

        // Notes modal state
        notesModalOpen:  false,
        notesModalIndex: 0,
        notesModalText:  '',

        // Totals
        totalRawCost:   0,
        totalInputTax:  0,
        costPerUnit:    0,
        totalRevenue:   0,
        outputTax:      0,
        cgst:           0,
        sgst:           0,
        totalProfit:    0,
        profitMargin:   0,

        // ── Select Template ──────────────────────────────────────────
        selectTemplate() {
            this.selectedTemplate = this.templates.find(t => t.id == this.selectedTemplateId) || null;
            if (this.selectedTemplate) {
                this.rawComposition  = this.selectedTemplate.raw_materials;
                this.bulkSalePrice   = this.selectedTemplate.sale_price;
                this.bulkTaxPercent  = this.selectedTemplate.tax_percent;
                this.step = 2;
                this.loadStockLevels();
                this.finishedQty = 1;
                this.updateGoodsCards();
            } else {
                this.rawComposition = [];
                this.goodsCards     = [];
                this.step = 1;
            }
            this.calculateAll();
        },

        // ── Select Party ─────────────────────────────────────────────
        selectParty() {
            if (!this.selectedPartyId) {
                this.selectedParty = null;
                return;
            }
            const opt = document.querySelector(`select[name="party_id"] option[value="${this.selectedPartyId}"]`);
            this.selectedParty = opt ? {
                name:  opt.dataset.name,
                phone: opt.dataset.phone,
            } : null;
            this.refreshBuyerCodes();
        },

        // ── Load available stock levels from server ──────────────────
        async loadStockLevels() {
            if (!this.selectedTemplateId) return;
            try {
                const res  = await fetch(`{{ route('admin.productions.checkStock') }}?template_id=${this.selectedTemplateId}&qty=1`);
                const data = await res.json();
                if (data.stock) {
                    data.stock.forEach(s => {
                        const rm = this.rawComposition.find(r => r.name === s.material);
                        if (rm) rm.available_stock = s.available;
                    });
                }
            } catch(e) {}
        },

        // ── Qty changed ──────────────────────────────────────────────
        onQtyChange() {
            this.updateGoodsCards();
            this.checkStockForQty();
        },

        // ── Sync global warehouse to all cards ───────────────────────
        syncWarehouse() {
            // warehouse is global — no individual sync needed; read from globalWarehouse at submit
        },

        // ── Stock check ──────────────────────────────────────────────
        async checkStockForQty() {
            const qty = parseInt(this.finishedQty) || 0;
            if (!this.selectedTemplateId || qty < 1) {
                this.hideStockWarning();
                this.stockBlocked = false;
                return;
            }

            try {
                const res  = await fetch(`{{ route('admin.productions.checkStock') }}?template_id=${this.selectedTemplateId}&qty=${qty}`);
                const data = await res.json();

                if (data.ok) {
                    this.hideStockWarning();
                    this.stockBlocked = false;
                    if (data.stock) {
                        data.stock.forEach(s => {
                            const rm = this.rawComposition.find(r => r.name === s.material);
                            if (rm) rm.available_stock = s.available;
                        });
                    }
                } else {
                    this.stockBlocked = true;
                    this.showStockWarning(data.issues, data.max_units);
                    data.issues.forEach(issue => {
                        const rm = this.rawComposition.find(r => r.name === issue.material);
                        if (rm) rm.available_stock = issue.available;
                    });
                }
            } catch(e) {
                this.hideStockWarning();
                this.stockBlocked = false;
            }
        },

        showStockWarning(issues, maxUnits) {
            const panel = document.getElementById('stockWarningPanel');
            const list  = document.getElementById('stockIssuesList');
            const notice= document.getElementById('stockMaxNotice');
            panel.classList.add('show');
            list.innerHTML = issues.map(issue =>
                `<div class="stock-issue-row">
                    <span class="stock-issue-name">📦 ${issue.material}</span>
                    <span class="stock-issue-detail">Available: ${issue.available} ${issue.unit} &nbsp;|&nbsp; Needed: ${issue.needed} ${issue.unit}</span>
                </div>`
            ).join('');
            notice.innerHTML = maxUnits > 0
                ? `✅ Maximum producible with current stock: <strong>${maxUnits} units</strong>`
                : `❌ Cannot produce any units — stock is empty for one or more materials`;
        },

        hideStockWarning() {
            const panel = document.getElementById('stockWarningPanel');
            if (panel) panel.classList.remove('show');
        },

        // ── Batch Number Generator ────────────────────────────────────
        /**
         * Build batch no: {MMM}{YYYY}-{5_RANDOM_ALPHANUM}
         * Uses earliest raw material purchase_date if available from template,
         * otherwise falls back to today.
         */
        buildBatchNoString() {
            let useDate = new Date(); // default: today

            // Try to use earliest purchase_date from raw materials
            if (this.rawComposition && this.rawComposition.length > 0) {
                for (const rm of this.rawComposition) {
                    if (rm.purchase_date) {
                        const d = new Date(rm.purchase_date);
                        if (!isNaN(d.getTime())) {
                            useDate = d;
                            break;
                        }
                    }
                }
            }

            const mon    = MONTHS[useDate.getMonth()];
            const yr     = useDate.getFullYear();
            // Generate 5-character random alphanumeric (uppercase)
            const chars  = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // no confusing chars
            let rand     = '';
            for (let i = 0; i < 5; i++) {
                rand += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return `${mon}${yr}-${rand}`;
        },

        generateBatchNo(index) {
            this.goodsCards[index].batch_no = this.buildBatchNoString();
        },

        generateAllBatchNos() {
            // Each unit gets a unique suffix but same date prefix
            let useDate = new Date();
            if (this.rawComposition && this.rawComposition.length > 0) {
                for (const rm of this.rawComposition) {
                    if (rm.purchase_date) {
                        const d = new Date(rm.purchase_date);
                        if (!isNaN(d.getTime())) { useDate = d; break; }
                    }
                }
            }
            const mon   = MONTHS[useDate.getMonth()];
            const yr    = useDate.getFullYear();
            const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

            this.goodsCards.forEach((card) => {
                let rand = '';
                for (let i = 0; i < 5; i++) rand += chars.charAt(Math.floor(Math.random() * chars.length));
                card.batch_no = `${mon}${yr}-${rand}`;
            });
        },

        // ── Goods Cards ──────────────────────────────────────────────
        updateGoodsCards() {
            const qty = parseInt(this.finishedQty) || 0;
            const tpl = this.selectedTemplate;

            while (this.goodsCards.length < qty) {
                const idx = this.goodsCards.length;
                this.goodsCards.push({
                    buyer_code:  this.generateBuyerCodeStr(idx),
                    serial_no:   '',
                    batch_no:    this.buildBatchNoString(),
                    sale_price:  tpl ? tpl.sale_price  : 0,
                    tax_percent: tpl ? tpl.tax_percent : 0,
                    sale_mode:   'exclusive',
                    notes:       '',
                });
            }
            if (this.goodsCards.length > qty) {
                this.goodsCards = this.goodsCards.slice(0, qty);
            }
            if (qty > 0) this.step = 3;
            this.calculateAll();
        },

        generateBuyerCodeStr(index) {
            const partyPrefix = this.selectedParty
                ? this.selectedParty.name.replace(/\s+/g,'').toUpperCase().slice(0,4)
                : batchPrefix;
            return `BC-${partyPrefix}-${String(index + 1).padStart(3, '0')}`;
        },

        refreshBuyerCodes() {
            this.goodsCards = this.goodsCards.map((card, i) => ({
                ...card,
                buyer_code: this.generateBuyerCodeStr(i),
            }));
        },

        generateSerial(index) {
            const ts  = Date.now().toString(36).toUpperCase();
            const idx = String(index + 1).padStart(3, '0');
            this.goodsCards[index].serial_no = `SN-${ts}-${idx}`;
        },

        generateAllSerials() {
            this.goodsCards.forEach((_, i) => this.generateSerial(i));
        },

        applyToAll() {
            this.goodsCards = this.goodsCards.map(card => ({
                ...card,
                sale_price:  this.bulkSalePrice  !== '' ? parseFloat(this.bulkSalePrice)  : card.sale_price,
                tax_percent: this.bulkTaxPercent !== '' ? parseFloat(this.bulkTaxPercent) : card.tax_percent,
                sale_mode:   this.bulkSaleMode   || card.sale_mode,
            }));
            this.calculateAll();
        },

        // ── Notes Modal ───────────────────────────────────────────────
        openNotesModal(index) {
            this.notesModalIndex = index;
            this.notesModalText  = this.goodsCards[index].notes ?? '';
            this.notesModalOpen  = true;
            this.$nextTick(() => {
                if (this.$refs.notesTextarea) this.$refs.notesTextarea.focus();
            });
        },

        closeNotesModal() {
            this.notesModalOpen = false;
        },

        saveNotes() {
            this.goodsCards[this.notesModalIndex].notes = this.notesModalText ?? '';
            this.notesModalOpen = false;
        },

        clearNotes() {
            this.notesModalText = '';
        },

        // ── Profit ───────────────────────────────────────────────────
        getProfitPerUnit(card) {
            const sp  = parseFloat(card.sale_price  || 0);
            const tp  = parseFloat(card.tax_percent || 0);
            const sm  = card.sale_mode;
            const net = sm === 'inclusive' ? sp / (1 + tp / 100) : sp;
            return net - this.costPerUnit;
        },

        calculateAll() {
            const qty = parseInt(this.finishedQty) || 0;
            this.totalRawCost  = 0;
            this.totalInputTax = 0;

            this.rawComposition.forEach(rm => {
                const usedQty  = parseFloat(rm.pivot_qty   || 0) * qty;
                const price    = parseFloat(rm.purchase_price || 0);
                const taxPct   = parseFloat(rm.tax_percent  || 0);
                const baseCost = usedQty * price;
                const taxAmt   = rm.with_tax == 1 ? (baseCost * taxPct / 100) : 0;
                this.totalRawCost  += baseCost + taxAmt;
                this.totalInputTax += taxAmt;
            });

            this.costPerUnit  = qty > 0 ? this.totalRawCost / qty : 0;
            this.outputTax    = 0;
            this.totalRevenue = 0;

            this.goodsCards.forEach(card => {
                const sp = parseFloat(card.sale_price  || 0);
                const tp = parseFloat(card.tax_percent || 0);
                const sm = card.sale_mode;

                if (sm === 'exclusive') {
                    this.outputTax    += sp * tp / 100;
                    this.totalRevenue += sp;
                } else if (sm === 'inclusive') {
                    const d = 1 + tp / 100;
                    this.outputTax    += sp - sp / d;
                    this.totalRevenue += sp / d;
                } else {
                    this.totalRevenue += sp;
                }
            });

            this.cgst         = this.outputTax / 2;
            this.sgst         = this.outputTax / 2;
            this.totalProfit  = this.totalRevenue - this.totalRawCost;
            this.profitMargin = this.totalRevenue > 0
                                ? (this.totalProfit / this.totalRevenue * 100) : 0;
        },
    };
}
</script>
@endsection
