@extends('layouts.admin')

@section('content')

{{-- ========================================================================
     PRODUCTION — INDEX  |  Ultra-Professional Dark Industrial Dashboard
     ======================================================================== --}}

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
    --ix-bg:       #0a0d14;
    --ix-surface:  #111520;
    --ix-card:     #161b28;
    --ix-border:   #1e2840;
    --ix-amber:    #f59e0b;
    --ix-green:    #10b981;
    --ix-red:      #ef4444;
    --ix-indigo:   #6366f1;
    --ix-blue:     #3b82f6;
    --ix-text:     #e2e8f0;
    --ix-muted:    #4b5e7a;
    --ix-mono:     'DM Mono', monospace;
    --ix-display:  'Syne', sans-serif;
    --ix-body:     'DM Sans', sans-serif;
}

* { box-sizing: border-box; }
.ix-wrap       { background: var(--ix-bg); min-height: 100vh; padding: 2rem; font-family: var(--ix-body); }

/* ── Header ── */
.ix-header     { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem; }
.ix-logo-group { display: flex; align-items: center; gap: 1.25rem; }
.ix-logo       { width: 56px; height: 56px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 16px; display: grid; place-items: center; font-size: 1.5rem; box-shadow: 0 0 30px #f59e0b33; flex-shrink: 0; }
.ix-title      { font-family: var(--ix-display); font-size: 2rem; font-weight: 800; color: #fff; letter-spacing: -.04em; line-height: 1; }
.ix-subtitle   { font-size: .78rem; color: var(--ix-muted); margin-top: 4px; letter-spacing: .06em; text-transform: uppercase; }
.ix-new-btn    { display: inline-flex; align-items: center; gap: .6rem; background: linear-gradient(135deg, #f59e0b, #d97706); color: #000; font-family: var(--ix-display); font-size: .9rem; font-weight: 800; padding: .75rem 1.75rem; border-radius: 12px; text-decoration: none; transition: opacity .2s, transform .15s; box-shadow: 0 4px 20px #f59e0b44; letter-spacing: -.01em; }
.ix-new-btn:hover { opacity: .9; transform: translateY(-1px); }

/* ── Stat Cards ── */
.ix-stats      { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem; }
.ix-stat       { background: var(--ix-card); border: 1px solid var(--ix-border); border-radius: 14px; padding: 1.25rem 1.5rem; position: relative; overflow: hidden; }
.ix-stat::after{ content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 14px 14px 0 0; }
.ix-stat.amber::after { background: var(--ix-amber); }
.ix-stat.green::after { background: var(--ix-green); }
.ix-stat.blue::after  { background: var(--ix-blue); }
.ix-stat.red::after   { background: var(--ix-red); }
.ix-stat-label { font-size: .68rem; color: var(--ix-muted); text-transform: uppercase; letter-spacing: .07em; font-weight: 600; margin-bottom: .5rem; }
.ix-stat-value { font-family: var(--ix-display); font-size: 1.75rem; font-weight: 800; color: #fff; letter-spacing: -.04em; line-height: 1; }
.ix-stat-sub   { font-size: .72rem; color: var(--ix-muted); margin-top: .35rem; font-family: var(--ix-mono); }
.ix-stat-icon  { position: absolute; right: 1.25rem; top: 1.25rem; font-size: 1.5rem; opacity: .15; }

/* ── Table Container ── */
.ix-table-wrap { background: var(--ix-card); border: 1px solid var(--ix-border); border-radius: 18px; overflow: hidden; }
.ix-table-head { display: flex; align-items: center; justify-content: space-between; padding: 1.25rem 1.75rem; border-bottom: 1px solid var(--ix-border); flex-wrap: wrap; gap: .75rem; }
.ix-table-title{ font-family: var(--ix-display); font-size: 1rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: .6rem; }
.ix-search     { background: var(--ix-surface); border: 1px solid var(--ix-border); color: var(--ix-text); border-radius: 8px; padding: .5rem 1rem; font-size: .82rem; font-family: var(--ix-body); outline: none; transition: border-color .2s; min-width: 220px; }
.ix-search:focus { border-color: var(--ix-amber); }
.ix-search::placeholder { color: var(--ix-muted); }

/* ── Table ── */
.ix-table      { width: 100%; border-collapse: collapse; }
.ix-table thead tr { background: var(--ix-surface); }
.ix-table th   { padding: .8rem 1.25rem; text-align: left; font-size: .67rem; font-weight: 700; color: var(--ix-muted); text-transform: uppercase; letter-spacing: .08em; white-space: nowrap; cursor: pointer; user-select: none; transition: color .2s; }
.ix-table th:hover { color: var(--ix-amber); }
.ix-table th.sorted { color: var(--ix-amber); }
.ix-table th .sort-icon { margin-left: .3rem; opacity: .5; }
.ix-table td   { padding: .9rem 1.25rem; border-top: 1px solid var(--ix-border); vertical-align: middle; color: var(--ix-text); }
.ix-table tbody tr { transition: background .15s; }
.ix-table tbody tr:hover { background: #ffffff04; }

/* Cells */
.ref-code      { font-family: var(--ix-mono); font-size: .75rem; color: var(--ix-amber); background: #f59e0b10; padding: .2rem .55rem; border-radius: 5px; }
.product-name  { font-weight: 600; color: #fff; font-size: .88rem; }
.product-meta  { font-size: .72rem; color: var(--ix-muted); margin-top: 2px; }
.qty-badge     { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #6366f115; border: 1px solid #6366f130; border-radius: 8px; font-family: var(--ix-mono); font-size: .78rem; font-weight: 600; color: var(--ix-indigo); }
.rm-list       { display: flex; flex-direction: column; gap: 3px; max-width: 220px; }
.rm-chip       { display: flex; justify-content: space-between; align-items: center; background: var(--ix-surface); border: 1px solid var(--ix-border); border-radius: 5px; padding: .15rem .5rem; gap: .5rem; font-size: .7rem; }
.rm-name       { color: var(--ix-text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 130px; }
.rm-qty        { font-family: var(--ix-mono); color: var(--ix-amber); white-space: nowrap; flex-shrink: 0; }
.cost-val      { font-family: var(--ix-mono); font-size: .85rem; font-weight: 500; }
.profit-val    { font-family: var(--ix-mono); font-size: .88rem; font-weight: 700; }
.profit-pos    { color: var(--ix-green); }
.profit-neg    { color: var(--ix-red); }
.party-chip    { display: inline-flex; align-items: center; gap: .35rem; padding: .2rem .55rem; background: #10b98110; border: 1px solid #10b98130; border-radius: 5px; font-size: .72rem; color: var(--ix-green); }

/* Action buttons */
.ix-actions    { display: flex; gap: .5rem; align-items: center; }
.act-btn       { width: 32px; height: 32px; border-radius: 8px; display: grid; place-items: center; font-size: .9rem; cursor: pointer; transition: all .15s; text-decoration: none; border: 1px solid transparent; }
.act-view      { background: #3b82f615; border-color: #3b82f630; color: var(--ix-blue); }
.act-view:hover{ background: #3b82f625; }
.act-edit      { background: #f59e0b15; border-color: #f59e0b30; color: var(--ix-amber); }
.act-edit:hover{ background: #f59e0b25; }
.act-del       { background: #ef444415; border-color: #ef444430; color: var(--ix-red); }
.act-del:hover { background: #ef444425; }

/* Empty state */
.ix-empty      { padding: 5rem 2rem; text-align: center; }
.ix-empty-icon { font-size: 3.5rem; margin-bottom: 1rem; opacity: .3; }
.ix-empty-text { font-family: var(--ix-display); font-size: 1.25rem; color: var(--ix-muted); }

/* Pagination-style footer */
.ix-footer     { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.75rem; border-top: 1px solid var(--ix-border); font-size: .78rem; color: var(--ix-muted); flex-wrap: wrap; gap: .5rem; }

/* Alert flash */
.flash-msg     { display: flex; align-items: center; gap: .75rem; padding: .85rem 1.25rem; background: #10b98115; border: 1px solid #10b98140; border-radius: 10px; margin-bottom: 1.5rem; font-size: .85rem; color: var(--ix-green); }
.flash-msg.err { background: #ef444415; border-color: #ef444440; color: var(--ix-red); }

@media (max-width: 900px) {
    .ix-stats { grid-template-columns: repeat(2,1fr); }
}
@media (max-width: 600px) {
    .ix-stats { grid-template-columns: 1fr; }
    .ix-table-head { flex-direction: column; }
}
</style>

<div class="ix-wrap">

    {{-- Flash Message --}}
    @if(session('message'))
    <div class="flash-msg">
        ✅ {{ session('message') }}
    </div>
    @endif

    {{-- Header --}}
    <div class="ix-header">
        <div class="ix-logo-group">
            <div class="ix-logo">⚙️</div>
            <div>
                <div class="ix-title">Production</div>
                <div class="ix-subtitle">Batch Manufacturing Management</div>
            </div>
        </div>
        <a href="{{ route('admin.productions.create') }}" class="ix-new-btn">
            ＋ New Production Batch
        </a>
    </div>

    {{-- Stats --}}
    @php
        $totalBatches  = $productions->count();
        $totalUnits    = $productions->sum('finished_qty');
        $totalCost     = $productions->sum('total_production_cost');
        $totalProfit   = $productions->sum('profit');
    @endphp
    <div class="ix-stats">
        <div class="ix-stat amber">
            <div class="ix-stat-icon">⚙️</div>
            <div class="ix-stat-label">Total Batches</div>
            <div class="ix-stat-value">{{ $totalBatches }}</div>
            <div class="ix-stat-sub">production runs</div>
        </div>
        <div class="ix-stat blue">
            <div class="ix-stat-icon">📦</div>
            <div class="ix-stat-label">Units Produced</div>
            <div class="ix-stat-value">{{ number_format($totalUnits) }}</div>
            <div class="ix-stat-sub">finished goods</div>
        </div>
        <div class="ix-stat red">
            <div class="ix-stat-icon">💸</div>
            <div class="ix-stat-label">Total Cost</div>
            <div class="ix-stat-value" style="font-size:1.3rem;">₹{{ number_format($totalCost, 0) }}</div>
            <div class="ix-stat-sub">raw material cost</div>
        </div>
        <div class="ix-stat green">
            <div class="ix-stat-icon">📈</div>
            <div class="ix-stat-label">Total Profit</div>
            <div class="ix-stat-value" style="font-size:1.3rem;color:{{ $totalProfit >= 0 ? '#10b981' : '#ef4444' }};">₹{{ number_format($totalProfit, 0) }}</div>
            <div class="ix-stat-sub">net earnings</div>
        </div>
    </div>

    {{-- Table --}}
    <div class="ix-table-wrap">
        <div class="ix-table-head">
            <div class="ix-table-title">
                🏭 All Productions
                <span style="font-size:.7rem;background:#f59e0b20;color:var(--ix-amber);padding:.2rem .6rem;border-radius:99px;font-family:var(--ix-mono);font-weight:500;">{{ $totalBatches }} total</span>
            </div>
            <input type="text" class="ix-search" id="ixSearch" placeholder="🔍  Search reference, product…" oninput="filterTable()">
        </div>

        <div style="overflow-x:auto;">
            <table class="ix-table" id="ixTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">Ref No <span class="sort-icon">↕</span></th>
                        <th onclick="sortTable(1)">Finished Product</th>
                        <th onclick="sortTable(2)">Qty</th>
                        <th>Party</th>
                        <th>Raw Materials</th>
                        <th onclick="sortTable(5)">Total Cost <span class="sort-icon">↕</span></th>
                        <th onclick="sortTable(6)">Profit <span class="sort-icon">↕</span></th>
                        <th onclick="sortTable(7)">Date <span class="sort-icon">↕</span></th>
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </thead>
                <tbody id="ixBody">
                    @forelse($productions as $production)
                    <tr>
                        <td>
                            <span class="ref-code">{{ $production->reference_no }}</span>
                            <div style="font-size:.68rem;color:var(--ix-muted);margin-top:3px;font-family:var(--ix-mono);">{{ $production->batch_no }}</div>
                        </td>

                        <td>
                            <div class="product-name">{{ $production->product_name ?? $production->template?->item_name ?? '—' }}</div>
                            <div class="product-meta">
                                {{ $production->finished_qty }} units ·
                                HSN: {{ $production->template?->item_hsn ?? 'N/A' }}
                            </div>
                        </td>

                        <td>
                            <div class="qty-badge">{{ $production->finished_qty }}</div>
                        </td>

                        <td>
                            @if($production->party)
                                <div class="party-chip">
                                    👤 {{ $production->party->party_name }}
                                </div>
                                <div style="font-size:.68rem;color:var(--ix-muted);margin-top:3px;">{{ $production->party->phone_number }}</div>
                            @else
                                <span style="color:var(--ix-muted);font-size:.75rem;">—</span>
                            @endif
                        </td>

                        <td>
                            @if($production->rawMaterials->count())
                                <div class="rm-list">
                                    @foreach($production->rawMaterials->take(3) as $rm)
                                    <div class="rm-chip">
                                        <span class="rm-name">{{ $rm->rawMaterial->item_name ?? $rm->rawMaterial->title ?? 'Material' }}</span>
                                        <span class="rm-qty">× {{ $rm->used_qty }}</span>
                                    </div>
                                    @endforeach
                                    @if($production->rawMaterials->count() > 3)
                                        <div style="font-size:.68rem;color:var(--ix-muted);padding-left:.25rem;">+{{ $production->rawMaterials->count() - 3 }} more</div>
                                    @endif
                                </div>
                            @else
                                <span style="color:var(--ix-muted);font-size:.75rem;">—</span>
                            @endif
                        </td>

                        <td>
                            <div class="cost-val" style="color:var(--ix-amber);">₹ {{ number_format($production->total_production_cost, 2) }}</div>
                            @if($production->input_tax > 0)
                                <div style="font-size:.68rem;color:var(--ix-muted);font-family:var(--ix-mono);">ITC: ₹{{ number_format($production->input_tax, 2) }}</div>
                            @endif
                        </td>

                        <td>
                            <div class="profit-val {{ $production->profit >= 0 ? 'profit-pos' : 'profit-neg' }}">
                                {{ $production->profit >= 0 ? '+' : '' }}₹ {{ number_format($production->profit, 2) }}
                            </div>
                            @php
                                $margin = $production->total_production_cost > 0
                                    ? ($production->profit / ($production->total_production_cost + $production->profit) * 100)
                                    : 0;
                            @endphp
                            <div style="margin-top:4px;height:3px;background:var(--ix-border);border-radius:3px;overflow:hidden;width:80px;">
                                <div style="height:100%;width:{{ min(max($margin,0),100) }}%;background:{{ $production->profit >= 0 ? '#10b981' : '#ef4444' }};border-radius:3px;"></div>
                            </div>
                        </td>

                        <td style="font-size:.78rem;color:var(--ix-muted);font-family:var(--ix-mono);">
                            {{ $production->created_at->format('d M Y') }}<br>
                            <span style="font-size:.65rem;">{{ $production->created_at->format('H:i') }}</span>
                        </td>

                        <td>
                            <div class="ix-actions" style="justify-content:center;">
                                <a href="{{ route('admin.productions.show', $production->id) }}" class="act-btn act-view" title="View Invoice">👁</a>
                                <a href="{{ route('admin.productions.edit', $production->id) }}" class="act-btn act-edit" title="Edit">✏️</a>
                                <form action="{{ route('admin.productions.destroy', $production->id) }}" method="POST" style="margin:0;" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="act-btn act-del" title="Delete">🗑</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">
                            <div class="ix-empty">
                                <div class="ix-empty-icon">⚙️</div>
                                <div class="ix-empty-text">No production batches yet</div>
                                <a href="{{ route('admin.productions.create') }}" style="display:inline-block;margin-top:1rem;padding:.6rem 1.5rem;background:var(--ix-amber);color:#000;border-radius:8px;text-decoration:none;font-weight:700;font-family:var(--ix-display);font-size:.85rem;">
                                    Start First Batch
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="ix-footer">
            <span id="rowCount">Showing all {{ $totalBatches }} records</span>
            <span style="font-family:var(--ix-mono);font-size:.7rem;">Last updated: {{ now()->format('d M Y, H:i') }}</span>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
function filterTable() {
    const q     = document.getElementById('ixSearch').value.toLowerCase();
    const rows  = document.querySelectorAll('#ixBody tr');
    let visible = 0;

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const show = text.includes(q);
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });

    document.getElementById('rowCount').textContent = q
        ? `Showing ${visible} of {{ $totalBatches }} records`
        : `Showing all {{ $totalBatches }} records`;
}

let sortDir = {};
function sortTable(col) {
    const tbody = document.getElementById('ixBody');
    const rows  = Array.from(tbody.querySelectorAll('tr'));
    const dir   = sortDir[col] = !(sortDir[col]);

    rows.sort((a, b) => {
        const aText = a.cells[col]?.textContent.trim() ?? '';
        const bText = b.cells[col]?.textContent.trim() ?? '';
        const aNum  = parseFloat(aText.replace(/[^0-9.\-]/g, ''));
        const bNum  = parseFloat(bText.replace(/[^0-9.\-]/g, ''));

        if (!isNaN(aNum) && !isNaN(bNum)) {
            return dir ? aNum - bNum : bNum - aNum;
        }
        return dir
            ? aText.localeCompare(bText)
            : bText.localeCompare(aText);
    });

    rows.forEach(row => tbody.appendChild(row));

    document.querySelectorAll('.ix-table th').forEach((th, i) => {
        th.classList.toggle('sorted', i === col);
    });
}

function confirmDelete() {
    return confirm("⚠️ Delete this production batch?\n\nThis will reverse the finished goods stock and restore raw materials.");
}
</script>
@endsection
