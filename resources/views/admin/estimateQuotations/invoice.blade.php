<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice Ultra Version</title>

<style>

/* ==========================================================
   A4 PERFECT PRINT LAYOUT
========================================================== */
@page { size: A4; margin: 8mm; }
body { margin:0; padding:0; background:#eef1f7; font-family:Arial, sans-serif; }

/* MAIN PAGE */
.page {
    width:210mm;
    min-height:297mm;
    background:white;
    padding:14mm 12mm;
    margin:auto;
    position:relative;
    box-sizing:border-box;
}

/* DARK MODE */
body.dark { background:#000; }
body.dark .page { background:#121212; color:white; }
body.dark th { background:#333 !important; }
body.dark .panel { background:#1c1f26 !important; }
body.dark .totals-box { background:#1d1f24 !important; }
body.dark .hsn-box { background:#1d1f24 !important; }
body.dark .profit-box { background:#241f1d !important; }

/* WATERMARK */
.watermark {
    position:absolute; top:45%; left:50%;
    transform:translate(-50%,-50%);
    font-size:100px; font-weight:900;
    color:#4253ff15; user-select:none; z-index:-1;
}

/* HEADER */
.header { display:flex; justify-content:space-between; align-items:center; }
.company-title { font-size:26px; font-weight:900; color:#4253ff; }
.invoice-title { font-size:34px; font-weight:900; text-align:right; }

/* CUSTOMER PANEL */
.panel {
    background:#f2f4ff;
    padding:12px;
    border-left:5px solid #4253ff;
    border-radius:6px;
    margin-top:10px;
}

/* TABLES */
table { width:100%; border-collapse:collapse; }
th {
    background:#4253ff;
    color:white;
    padding:8px;
    text-align:left;
    font-size:14px;
}
td {
    padding:6px;
    border-bottom:1px solid #ddd;
    font-size:13px;
}

/* MULTI-PAGE SUPPORT */
tbody { page-break-inside:auto; }
tr { page-break-inside:avoid; }

/* TOTAL BOX */
.totals-box {
    width:40%;
    margin-left:auto;
    margin-top:20px;
    background:#f3f4ff;
    padding:12px;
    border-radius:8px;
}
.totals-box div {
    display:flex; justify-content:space-between;
    padding:6px 0;
}
.grand {
    font-size:18px; font-weight:900;
    border-top:2px solid #333;
    margin-top:8px;
    padding-top:8px;
}

/* HSN SUMMARY */
.hsn-box {
    background:#f3f4ff;
    padding:14px;
    margin-top:20px;
    border-radius:8px;
}

/* PROFIT BOX (HIDDEN BY DEFAULT) */
.profit-box {
    margin-top:20px;
    background:#fff4e6;
    border-left:6px solid orange;
    padding:12px;
    border-radius:8px;
    display:none;
    transition:0.3s;
}

/* SIGNATURE */
.sign-area {
    display:flex;
    justify-content:space-between;
    margin-top:40px;
}
.sign-img { width:130px; }
.stamp-img { width:110px; }

/* BUTTONS */
.actions { text-align:right; margin:10px 15mm; }
.btn {
    padding:7px 14px;
    border-radius:6px;
    background:black;
    color:white;
    cursor:pointer;
}
.toggle-dark { background:#4253ff !important; }

</style>
</head>

<body>

<!-- ACTION BUTTONS -->
<div class="actions">
    <button class="btn toggle-dark" onclick="toggleDark()">Dark Mode</button>
    <button class="btn" onclick="window.print()">Print</button>
    <button class="btn" onclick="window.print()">Download</button>
</div>

<div class="page">

    <div class="watermark">ESTIMATE</div>

    <!-- HEADER -->
    <div class="header">
        <div>
            <div class="company-title">{{ $company->company_name }}</div>
            <div>{{ $company->address }}</div>
            <div>Phone: {{ $company->phone }}</div>
        </div>
        <div class="invoice-title">ESTIMATE</div>
    </div>

    <!-- BARCODE + QR -->
    <div style="margin-top:15px; display:flex; gap:30px; align-items:center;">
        <svg id="barcode"></svg>
        <div id="qrcode"></div>
    </div>

    <!-- CUSTOMER SECTION -->
    <h3 style="margin-top:20px;">Customer Details</h3>
    <div class="panel">
        <table>
            <tr><td><b>Name:</b></td><td>{{ $estimateQuotation->select_customer->party_name }}</td></tr>
            <tr><td><b>Phone:</b></td><td>{{ $estimateQuotation->select_customer->phone_number }}</td></tr>
            <tr><td><b>Email:</b></td><td>{{ $estimateQuotation->select_customer->email }}</td></tr>
            <tr><td><b>GSTIN:</b></td><td>{{ $estimateQuotation->select_customer->gstin }}</td></tr>
            <tr><td><b>Address:</b></td><td>{{ $estimateQuotation->billing_address }}</td></tr>
        </table>
    </div>

    <!-- ITEMS -->
    <h3 style="margin-top:22px;">Items</h3>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>HSN</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Base</th>
                <th>Tax %</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            @php
                $hsnSummary = [];
                $overallProfit = 0;
            @endphp

            @foreach ($estimateQuotation->items as $item)
            @php
                $data = json_decode($item->pivot->json_data);
                $hsn = $item->item_hsn ?? 'N/A';

                $profit = ($item->pivot->price - ($item->purchase_price ?? 0)) * $item->pivot->qty;
                $overallProfit += $profit;

                if (!isset($hsnSummary[$hsn])) {
                    $hsnSummary[$hsn] = ['qty'=>0,'tax'=>0,'amount'=>0];
                }
                $hsnSummary[$hsn]['qty'] += $item->pivot->qty;
                $hsnSummary[$hsn]['tax'] += ($item->pivot->tax/100) * $item->pivot->amount;
                $hsnSummary[$hsn]['amount'] += $item->pivot->amount;
            @endphp

            <tr>
                <td>{{ $item->item_name }}</td>
                <td>{{ $hsn }}</td>
                <td>{{ $data->description ?? '' }}</td>
                <td>{{ $item->pivot->qty }}</td>
                <td>{{ number_format($item->pivot->price,2) }}</td>
                <td>{{ $item->pivot->tax }}%</td>
                <td>{{ number_format($item->pivot->amount,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TOTAL BOX -->
    <div class="totals-box">
        <div><span>Subtotal</span><span>₹ {{ number_format($estimateQuotation->subtotal,2) }}</span></div>
        <div><span>Tax</span><span>₹ {{ number_format($estimateQuotation->tax,2) }}</span></div>
        <div><span>Discount</span><span>₹ {{ number_format($estimateQuotation->discount,2) }}</span></div>
        <div class="grand"><span>Total</span><span>₹ {{ number_format($estimateQuotation->total,2) }}</span></div>
    </div>

    <!-- HSN SUMMARY -->
    <div class="hsn-box">
        <h3>HSN Summary</h3>
        <table>
            <tr><th>HSN</th><th>Qty</th><th>Tax Amt</th><th>Total Amt</th></tr>

            @foreach ($hsnSummary as $h => $row)
            <tr>
                <td>{{ $h }}</td>
                <td>{{ $row['qty'] }}</td>
                <td>₹ {{ number_format($row['tax'],2) }}</td>
                <td>₹ {{ number_format($row['amount'],2) }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- PROFIT TOGGLE -->
    <div style="margin-top:15px;">
        <label style="font-weight:bold; cursor:pointer;">
            <input type="checkbox" id="profitToggle" style="transform:scale(1.2); margin-right:6px;">
            Show Profit / Loss
        </label>
    </div>

    <!-- PROFIT BOX -->
    <div id="profitBox" class="profit-box">
        <h3>Profit / Loss</h3>
        <h2 id="profitValue"></h2>
    </div>

    <!-- SIGNATURE -->
    <div class="sign-area">
        <div>
            <img src="/signature.png" class="sign-img">
            <div>Authorized Signature</div>
        </div>
        <div>
            <img src="/stamp.png" class="stamp-img">
            <div>Company Stamp</div>
        </div>
    </div>

</div>

<!-- JS BARCODE + QR -->
<script src="https://cdn.jsdelivr.net/jsbarcode/3.11.0/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>

/* FIXED BARCODE (Always Works) */
JsBarcode("#barcode", String(@json($estimateQuotation->estimate_quotations_number)), {
    format:"code128",
    width:2,
    height:60,
    displayValue:true,
    lineColor:"#000"
});

new QRCode(document.getElementById("qrcode"), {
    text:String(@json($estimateQuotation->estimate_quotations_number)),
    width:100,
    height:100
});

/* DARK MODE */
function toggleDark() {
    document.body.classList.toggle("dark");
}

/* PROFIT TOGGLE */
document.getElementById("profitToggle").addEventListener("change", function(){
    const box = document.getElementById("profitBox");

    if (this.checked) {
        box.style.display = "block";
    } else {
        box.style.display = "none";
    }
});

document.getElementById("profitValue").innerText =
    "₹ {{ number_format($overallProfit,2) }}";
document.getElementById("profitValue").style.color =
    {{ $overallProfit >= 0 ? '"green"' : '"red"' }};

</script>

</body>
</html>
