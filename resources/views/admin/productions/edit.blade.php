@extends('layouts.admin')

@section('content')

{{-- ========================================================================
     PRODUCTION — EDIT  |  Same ultra-professional design as create
     ======================================================================== --}}

@php
    $goodsData = $production->finishedGoods->map(fn($fg) => [
        'id'          => $fg->id,
        'buyer_code'  => $fg->buyer_code   ?? '',
        'serial_no'   => $fg->item_code    ?? '',
        'warehouse'   => $fg->warehouse_location ?? '',
        'sale_price'  => floatval($fg->sale_price),
        'tax_percent' => floatval($fg->tax_percent),
        'sale_mode'   => $fg->sale_mode ?? 'exclusive',
        'attachment'  => $fg->attachment ?? '',
        'unique_code' => $fg->unique_code ?? '',
    ])->values()->toArray();
@endphp

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
    --prod-orange:    #f97316;
    --prod-text:      #e2e8f0;
    --prod-muted:     #64748b;
    --prod-mono:      'DM Mono', monospace;
    --prod-display:   'Syne', sans-serif;
    --prod-body:      'DM Sans', sans-serif;
}

.prod-wrap       { background: var(--prod-bg); min-height: 100vh; padding: 2rem; font-family: var(--prod-body); }
.prod-header     { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2.5rem; }
.prod-icon       { width: 52px; height: 52px; background: linear-gradient(135deg,#f97316,#ea580c); border-radius: 14px; display: grid; place-items: center; font-size: 1.4rem; flex-shrink: 0; box-shadow: 0 0 24px #f9731644; }
.prod-title      { font-family: var(--prod-display); font-size: 1.85rem; font-weight: 800; color: #fff; letter-spacing: -0.03em; line-height: 1; }
.prod-subtitle   { font-size: .82rem; color: var(--prod-muted); margin-top: 3px; letter-spacing: .04em; text-transform: uppercase; }
.edit-badge      { display: inline-flex; align-items: center; gap: .4rem; padding: .3rem .85rem; background: #f9731620; border: 1px solid #f9731640; border-radius: 99px; font-size: .72rem; font-family: var(--prod-mono); color: var(--prod-orange); }

.pcard           { background: var(--prod-card); border: 1px solid var(--prod-border); border-radius: 16px; padding: 1.75rem; margin-bottom: 1.5rem; }
.pcard-title     { font-family: var(--prod-display); font-size: 1rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: .6rem; margin-bottom: 1.25rem; letter-spacing: -.01em; }
.pcard-title span{ font-size: .7rem; background: var(--prod-amber-dim); color: var(--prod-amber); padding: .2rem .55rem; border-radius: 99px; font-family: var(--prod-mono); font-weight: 500; }
.pcard-title span.orange { background: #f9731620; color: var(--prod-orange); }

.pinput          { width: 100%; background: var(--prod-surface); border: 1px solid var(--prod-border); color: var(--prod-text); border-radius: 9px; padding: .6rem .85rem; font-size: .85rem; font-family: var(--prod-body); transition: border-color .2s; outline: none; }
.pinput:focus    { border-color: var(--prod-orange); box-shadow: 0 0 0 3px #f9731622; }
.pinput::placeholder { color: var(--prod-muted); }
.plabel          { font-size: .72rem; font-weight: 600; color: var(--prod-muted); text-transform: uppercase; letter-spacing: .06em; margin-bottom: .4rem; display: block; }
.pselect         { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right .75rem center; padding-right: 2rem; }

.prod-info-bar   { display: flex; gap: 1.5rem; flex-wrap: wrap; padding: 1.25rem 1.5rem; background: var(--prod-surface); border: 1px solid var(--prod-border); border-radius: 12px; margin-bottom: 1.5rem; }
.info-chip       { display: flex; flex-direction: column; gap: 2px; }
.info-chip-label { font-size: .65rem; color: var(--prod-muted); text-transform: uppercase; letter-spacing: .06em; font-weight: 600; }
.info-chip-value { font-size: .85rem; color: var(--prod-text); font-family: var(--prod-mono); font-weight: 500; }
.info-chip-value.amber  { color: var(--prod-amber); }
.info-chip-value.orange { color: var(--prod-orange); }
.info-chip-value.green  { color: var(--prod-green); }

.ptable          { width: 100%; border-collapse: collapse; font-size: .83rem; }
.ptable thead tr { background: var(--prod-surface); }
.ptable th       { padding: .7rem .9rem; text-align: left; font-size: .68rem; font-weight: 600; color: var(--prod-muted); text-transform: uppercase; letter-spacing: .07em; }
.ptable td       { padding: .65rem .9rem; border-top: 1px solid var(--prod-border); color: var(--prod-text); vertical-align: middle; }
.badge           { display: inline-flex; align-items: center; padding: .15rem .5rem; border-radius: 5px; font-size: .68rem; font-family: var(--prod-mono); font-weight: 500; }
.badge-green     { background: #10b98120; color: var(--prod-green); }
.badge-amber     { background: #f59e0b20; color: var(--prod-amber); }
.badge-red       { background: #ef444420; color: var(--prod-red); }
.badge-indigo    { background: #6366f120; color: var(--prod-indigo); }
.badge-orange    { background: #f9731620; color: var(--prod-orange); }
.bc-tag          { display: inline-flex; padding: .15rem .45rem; background: #10b98115; border: 1px solid #10b98130; border-radius: 4px; font-family: var(--prod-mono); font-size: .63rem; color: var(--prod-green); }

.goods-table-wrap{ overflow-x: auto; border-radius: 12px; border: 1px solid var(--prod-border); }
.goods-table     { width: 100%; border-collapse: collapse; font-size: .82rem; min-width: 940px; }
.goods-table thead tr { background: var(--prod-surface); }
.goods-table th  { padding: .75rem 1rem; text-align: left; font-size: .67rem; font-weight: 600; color: var(--prod-muted); text-transform: uppercase; letter-spacing: .07em; white-space: nowrap; }
.goods-table td  { padding: .5rem .75rem; border-top: 1px solid var(--prod-border); vertical-align: middle; }
.goods-table tbody tr:hover { background: #ffffff04; }
.row-num         { width: 28px; height: 28px; background: var(--prod-border); color: var(--prod-muted); border-radius: 6px; display: grid; place-items: center; font-family: var(--prod-mono); font-size: .7rem; font-weight: 600; }
.btn-auto        { padding: .3rem .65rem; background: #6366f120; color: var(--prod-indigo); border: 1px solid #6366f140; border-radius: 6px; font-size: .7rem; font-family: var(--prod-mono); cursor: pointer; }

.bulk-bar        { display: flex; gap: 1rem; align-items: flex-end; padding: 1rem 1.25rem; background: var(--prod-surface); border: 1px dashed var(--prod-border); border-radius: 10px; margin-bottom: 1rem; flex-wrap: wrap; }
.bulk-bar-label  { font-size: .72rem; color: var(--prod-orange); font-weight: 700; letter-spacing: .05em; text-transform: uppercase; white-space: nowrap; align-self: center; }

.summary-grid    { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.5rem; }
.summary-row     { display: flex; justify-content: space-between; align-items: center; padding: .55rem 0; border-bottom: 1px solid var(--prod-border); }
.summary-row:last-child { border: none; }
.summary-label   { font-size: .82rem; color: var(--prod-muted); }
.summary-value   { font-family: var(--prod-mono); font-size: .88rem; font-weight: 500; color: var(--prod-text); }
.summary-value.amber  { color: var(--prod-amber); }
.summary-value.orange { color: var(--prod-orange); }
.summary-value.green  { color: var(--prod-green); }
.summary-value.red    { color: var(--prod-red); }
.summary-value.big    { font-size: 1.15rem; font-family: var(--prod-display); font-weight: 700; color: #fff; }

.profit-bar-wrap { height: 6px; background: var(--prod-border); border-radius: 99px; overflow: hidden; margin: .75rem 0; }
.profit-bar      { height: 100%; background: linear-gradient(90deg, var(--prod-orange), var(--prod-green)); border-radius: 99px; transition: width .5s ease; }

.attach-preview  { font-size: .7rem; color: var(--prod-indigo); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 110px; }

.btn-update      { background: linear-gradient(135deg, #f97316, #ea580c); color: #fff; font-family: var(--prod-display); font-size: 1rem; font-weight: 800; padding: .9rem 2.5rem; border-radius: 12px; border: none; cursor: pointer; transition: opacity .2s, transform .15s; box-shadow: 0 4px 20px #f9731644; }
.btn-update:hover { opacity: .92; transform: translateY(-1px); }

.warning-note    { background: #f9731615; border: 1px solid #f9731630; border-radius: 10px; padding: .85rem 1.25rem; font-size: .8rem; color: var(--prod-orange); margin-bottom: 1.5rem; }

.party-select-wrap { position: relative; }
.party-select-wrap select { width: 100%; background: var(--prod-surface); border: 1px solid var(--prod-border); color: var(--prod-text); border-radius: 9px; padding: .6rem 2.5rem .6rem .85rem; font-size: .85rem; font-family: var(--prod-body); outline: none; appearance: none; }
.party-select-wrap::after { content: '▾'; position: absolute; right: .75rem; top: 50%; transform: translateY(-50%); color: var(--prod-muted); pointer-events: none; font-size: .75rem; }

[x-cloak] { display: none !important; }
</style>

<div class="prod-wrap">
    <div class="prod-header">
        <div class="prod-icon">✏️</div>
        <div>
            <div class="prod-title">Edit Production</div>
            <div class="prod-subtitle">Batch <span style="font-family:var(--prod-mono);color:var(--prod-orange);">{{ $production->reference_no }}</span></div>
        </div>
        <div style="margin-left:auto;">
            <span class="edit-badge">✏️ Edit Mode</span>
        </div>
    </div>

    <div class="warning-note">
        ⚠️ <strong>Quantity is locked at {{ $production->finished_qty }} units.</strong>
        Raw material costs cannot be changed here.
    </div>

    <div class="prod-info-bar">
        <div class="info-chip"><div class="info-chip-label">Reference No</div><div class="info-chip-value orange">{{ $production->reference_no }}</div></div>
        <div class="info-chip"><div class="info-chip-label">Batch No</div><div class="info-chip-value">{{ $production->batch_no }}</div></div>
        <div class="info-chip"><div class="info-chip-label">Template</div><div class="info-chip-value amber">{{ $production->template?->item_name ?? $production->product_name }}</div></div>
        <div class="info-chip"><div class="info-chip-label">Qty Produced</div><div class="info-chip-value green">{{ $production->finished_qty }} units</div></div>
        <div class="info-chip"><div class="info-chip-label">Total Raw Cost</div><div class="info-chip-value amber">₹ {{ number_format($production->total_raw_cost, 2) }}</div></div>
        <div class="info-chip"><div class="info-chip-label">Cost Per Unit</div><div class="info-chip-value">₹ {{ $production->finished_qty > 0 ? number_format($production->total_raw_cost / $production->finished_qty, 2) : '0.00' }}</div></div>
        <div class="info-chip"><div class="info-chip-label">Created</div><div class="info-chip-value">{{ $production->created_at->format('d M Y') }}</div></div>
        @if($production->party)
        <div class="info-chip"><div class="info-chip-label">Party</div><div class="info-chip-value green">{{ $production->party->party_name }}</div></div>
        @endif
    </div>

    <div x-data="editForm()" x-cloak>
        <form method="POST" action="{{ route('admin.productions.update', $production->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Party Selector --}}
            <div class="pcard">
                <div class="pcard-title">👤 Party / Buyer <span class="orange">Optional</span></div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                    <div>
                        <div class="plabel">Select Party</div>
                        <div class="party-select-wrap">
                            <select name="party_id" x-model="selectedPartyId" @change="selectParty()">
                                <option value="">— No specific party —</option>
                                @foreach($parties as $party)
                                    <option value="{{ $party->id }}"
                                        data-name="{{ $party->party_name }}"
                                        data-phone="{{ $party->phone_number }}"
                                        {{ $production->party_id == $party->id ? 'selected' : '' }}>
                                        {{ $party->party_name }} — {{ $party->phone_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div x-show="selectedParty" style="display:flex;gap:1.5rem;align-items:center;">
                        <div class="info-chip">
                            <div class="info-chip-label">Party Name</div>
                            <div class="info-chip-value green" x-text="selectedParty?.name ?? '—'"></div>
                        </div>
                        <div class="info-chip">
                            <div class="info-chip-label">Phone</div>
                            <div class="info-chip-value" x-text="selectedParty?.phone ?? '—'"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Raw Materials Composition (read-only) --}}
            @if($production->template && $production->template->rawMaterials->count())
            <div class="pcard">
                <div class="pcard-title">🧪 Raw Materials Composition <span>Read-Only · Per Unit</span></div>
                <div style="overflow-x:auto;">
                    <table class="ptable">
                        <thead>
                            <tr>
                                <th>Material</th><th>Unit</th><th>Qty/Unit</th>
                                <th>Total Used ({{ $production->finished_qty }} units)</th>
                                <th>Price at Time</th><th>Line Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($production->template->rawMaterials as $rm)
                            @php
                                $pivotQty  = floatval($rm->pivot->qty ?? 0);
                                $unitPrice = floatval($rm->pivot->purchase_price_at_time ?? $rm->purchase_price ?? 0);
                                $totalUsed = $pivotQty * $production->finished_qty;
                                $lineCost  = $totalUsed * $unitPrice;
                            @endphp
                            <tr>
                                <td style="font-weight:500;color:#fff;">{{ $rm->item_name }}</td>
                                <td><span class="badge badge-indigo">{{ optional($rm->select_unit)->base_unit ?? 'pcs' }}</span></td>
                                <td><span class="badge badge-amber">{{ $pivotQty }}</span></td>
                                <td><span class="badge badge-orange">{{ $totalUsed }}</span></td>
                                <td style="font-family:var(--prod-mono);">₹ {{ number_format($unitPrice, 2) }}</td>
                                <td style="font-family:var(--prod-mono);color:var(--prod-amber);">₹ {{ number_format($lineCost, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- Goods Details --}}
            <div class="pcard">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;flex-wrap:wrap;gap:.75rem;">
                    <div class="pcard-title" style="margin:0;">📦 Individual Goods Details <span class="orange">Editable</span></div>
                    <button type="button" @click="generateAllSerials()"
                        style="padding:.45rem 1rem;background:#6366f120;color:var(--prod-indigo);border:1px solid #6366f140;border-radius:8px;font-size:.78rem;font-family:var(--prod-mono);cursor:pointer;">
                        ⚡ Regen All Serial Nos
                    </button>
                </div>

                <div class="bulk-bar">
                    <div class="bulk-bar-label">⚡ Apply to All →</div>
                    <div style="min-width:160px;"><div class="plabel">Warehouse</div><input type="text" class="pinput" x-model="bulkWarehouse" placeholder="Warehouse"></div>
                    <div style="min-width:110px;"><div class="plabel">Sale Price ₹</div><input type="number" step="0.01" class="pinput" x-model="bulkSalePrice" placeholder="0.00"></div>
                    <div style="min-width:90px;"><div class="plabel">GST %</div><input type="number" step="0.01" class="pinput" x-model="bulkTaxPercent" placeholder="0"></div>
                    <div style="min-width:130px;">
                        <div class="plabel">Sale Mode</div>
                        <select class="pinput pselect" x-model="bulkSaleMode">
                            <option value="exclusive">Tax Exclusive</option>
                            <option value="inclusive">Tax Inclusive</option>
                            <option value="export">Export (Zero)</option>
                        </select>
                    </div>
                    <button type="button" @click="applyToAll()"
                        style="padding:.6rem 1.25rem;background:var(--prod-orange);color:#fff;border:none;border-radius:9px;font-size:.8rem;font-weight:700;cursor:pointer;font-family:var(--prod-display);flex-shrink:0;margin-top:1.1rem;">
                        Apply
                    </button>
                </div>

                <div class="goods-table-wrap">
                    <table class="goods-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Unique Code</th>
                                <th>Buyer Code <span style="color:var(--prod-green);font-size:.6rem;">(Auto)</span></th>
                                <th>Serial No.</th>
                                <th>Warehouse <span style="color:var(--prod-red);">*</span></th>
                                <th>Sale Price ₹ <span style="color:var(--prod-red);">*</span></th>
                                <th>GST %</th>
                                <th>Sale Mode</th>
                                <th>Attachment</th>
                                <th>Profit/Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(card, index) in goodsCards" :key="card.id">
                                <tr>
                                    <input type="hidden" :name="'goods['+index+'][id]'" :value="card.id">
                                    <td><div class="row-num" x-text="index + 1"></div></td>

                                    <td><span class="badge badge-orange" x-text="card.unique_code" style="font-size:.62rem;max-width:90px;overflow:hidden;display:inline-block;text-overflow:ellipsis;"></span></td>

                                    {{-- Buyer Code --}}
                                    <td>
                                        <div style="display:flex;flex-direction:column;gap:.2rem;">
                                            <input type="text" class="pinput" style="min-width:130px;"
                                                x-model="card.buyer_code"
                                                :name="'goods['+index+'][buyer_code]'"
                                                placeholder="Auto-generated">
                                            <span class="bc-tag" x-show="card.buyer_code" x-text="card.buyer_code"></span>
                                        </div>
                                    </td>

                                    {{-- Serial No --}}
                                    <td>
                                        <div style="display:flex;gap:.35rem;align-items:center;">
                                            <input type="text" class="pinput" style="min-width:110px;"
                                                x-model="card.serial_no"
                                                :name="'goods['+index+'][serial_no]'"
                                                placeholder="Serial No.">
                                            <button type="button" @click="generateSerial(index)" class="btn-auto">⚡</button>
                                        </div>
                                    </td>

                                    <td>
                                        <input type="text" class="pinput" style="min-width:130px;"
                                            x-model="card.warehouse"
                                            :name="'goods['+index+'][warehouse_location]'"
                                            placeholder="Location" required>
                                    </td>

                                    <td>
                                        <input type="number" step="0.01" class="pinput" style="min-width:100px;"
                                            x-model.number="card.sale_price"
                                            @input="calculateAll()"
                                            :name="'goods['+index+'][sale_price]'" required>
                                    </td>

                                    <td>
                                        <input type="number" step="0.01" class="pinput" style="min-width:70px;"
                                            x-model.number="card.tax_percent"
                                            @input="calculateAll()"
                                            :name="'goods['+index+'][tax_percent]'">
                                    </td>

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

                                    <td>
                                        <div x-show="card.attachment" style="margin-bottom:.25rem;">
                                            <a :href="'/storage/' + card.attachment" target="_blank" class="attach-preview">📎 View</a>
                                        </div>
                                        <input type="file" :name="'goods_attachments['+index+']'"
                                            accept=".pdf,.jpg,.jpeg,.png,.webp"
                                            style="font-size:.72rem;color:var(--prod-muted);max-width:130px;">
                                    </td>

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

            {{-- Summary --}}
            <div class="summary-grid">
                <div class="pcard" style="margin:0;">
                    <div class="pcard-title">💸 Cost Breakdown <span class="orange">Updated Live</span></div>
                    <div class="summary-row"><span class="summary-label">Total Raw Cost (locked)</span><span class="summary-value amber">₹ {{ number_format($production->total_raw_cost, 2) }}</span></div>
                    <div class="summary-row"><span class="summary-label">Input GST (ITC)</span><span class="summary-value red">₹ {{ number_format($production->input_tax, 2) }}</span></div>
                    <div class="summary-row"><span class="summary-label">Cost Per Unit (locked)</span><span class="summary-value">₹ {{ $production->finished_qty > 0 ? number_format($production->total_raw_cost / $production->finished_qty, 2) : '0.00' }}</span></div>
                    <div class="summary-row"><span class="summary-label">Revenue (updated)</span><span class="summary-value green">₹ <span x-text="totalRevenue.toFixed(2)"></span></span></div>
                    <div style="margin-top:1rem;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:.4rem;">
                            <span style="font-size:.72rem;color:var(--prod-muted);">Profit Margin</span>
                            <span style="font-family:var(--prod-mono);font-size:.78rem;" :style="{ color: profitMargin >= 0 ? 'var(--prod-green)' : 'var(--prod-red)' }" x-text="profitMargin.toFixed(1) + '%'"></span>
                        </div>
                        <div class="profit-bar-wrap"><div class="profit-bar" :style="{ width: Math.min(Math.max(profitMargin, 0), 100) + '%' }"></div></div>
                    </div>
                    <div style="margin-top:1rem;padding:1rem;background:var(--prod-surface);border-radius:10px;display:flex;justify-content:space-between;align-items:center;">
                        <span class="summary-label" style="margin:0;">Net Profit</span>
                        <span class="summary-value big" :style="{ color: totalProfit >= 0 ? 'var(--prod-green)' : 'var(--prod-red)' }">₹ <span x-text="totalProfit.toFixed(2)"></span></span>
                    </div>
                </div>

                <div class="pcard" style="margin:0;">
                    <div class="pcard-title">🧾 GST Summary <span class="orange">Updated Live</span></div>
                    <div class="summary-row"><span class="summary-label">Output GST</span><span class="summary-value amber">₹ <span x-text="outputTax.toFixed(2)"></span></span></div>
                    <div class="summary-row"><span class="summary-label">CGST (50%)</span><span class="summary-value">₹ <span x-text="cgst.toFixed(2)"></span></span></div>
                    <div class="summary-row"><span class="summary-label">SGST (50%)</span><span class="summary-value">₹ <span x-text="sgst.toFixed(2)"></span></span></div>
                    <div class="summary-row"><span class="summary-label">ITC Credit</span><span class="summary-value green">— ₹ {{ number_format($production->input_tax, 2) }}</span></div>
                    <div style="margin-top:1rem;padding:1rem;background:var(--prod-surface);border-radius:10px;display:flex;justify-content:space-between;align-items:center;">
                        <span class="summary-label" style="margin:0;">GST Payable</span>
                        <span class="summary-value big orange">₹ <span x-text="(outputTax - {{ $production->input_tax }}).toFixed(2)"></span></span>
                    </div>
                </div>
            </div>

            <div style="display:flex;gap:1rem;align-items:center;">
                <button type="submit" class="btn-update">✅ Update Production</button>
                <a href="{{ route('admin.productions.index') }}" style="color:var(--prod-muted);font-size:.85rem;text-decoration:none;">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
function editForm() {
    const goodsData    = @json($goodsData);
    const rawCostTotal = {{ $production->total_raw_cost }};
    const qty          = {{ $production->finished_qty }};
    const costPerUnit  = qty > 0 ? rawCostTotal / qty : 0;

    return {
        goodsCards:  goodsData,
        costPerUnit,
        selectedPartyId: '{{ $production->party_id ?? "" }}',
        selectedParty:   null,

        bulkWarehouse:  '',
        bulkSalePrice:  '',
        bulkTaxPercent: '',
        bulkSaleMode:   'exclusive',

        totalRevenue: 0,
        outputTax:    0,
        cgst:         0,
        sgst:         0,
        totalProfit:  0,
        profitMargin: 0,

        init() {
            this.calculateAll();
            // Init party display if pre-selected
            if (this.selectedPartyId) {
                const opt = document.querySelector(`select[name="party_id"] option[value="${this.selectedPartyId}"]`);
                if (opt) this.selectedParty = { name: opt.dataset.name, phone: opt.dataset.phone };
            }
        },

        selectParty() {
            if (!this.selectedPartyId) { this.selectedParty = null; return; }
            const opt = document.querySelector(`select[name="party_id"] option[value="${this.selectedPartyId}"]`);
            this.selectedParty = opt ? { name: opt.dataset.name, phone: opt.dataset.phone } : null;
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
                warehouse:   this.bulkWarehouse  !== '' ? this.bulkWarehouse  : card.warehouse,
                sale_price:  this.bulkSalePrice  !== '' ? parseFloat(this.bulkSalePrice)  : card.sale_price,
                tax_percent: this.bulkTaxPercent !== '' ? parseFloat(this.bulkTaxPercent) : card.tax_percent,
                sale_mode:   this.bulkSaleMode   || card.sale_mode,
            }));
            this.calculateAll();
        },

        getProfitPerUnit(card) {
            const sp  = parseFloat(card.sale_price  || 0);
            const tp  = parseFloat(card.tax_percent || 0);
            const sm  = card.sale_mode;
            const net = sm === 'inclusive' ? sp / (1 + tp / 100) : sp;
            return net - this.costPerUnit;
        },

        calculateAll() {
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
            this.totalProfit  = this.totalRevenue - rawCostTotal;
            this.profitMargin = this.totalRevenue > 0 ? (this.totalProfit / this.totalRevenue * 100) : 0;
        },
    };
}
</script>
@endsection
