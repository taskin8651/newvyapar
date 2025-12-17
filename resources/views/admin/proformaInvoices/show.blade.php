@extends('layouts.admin')

@section('styles')
<style>
    body {
        background: #f8f9fa;
        font-family: Helvetica, sans-serif;
    }

    .invoice-wrapper {
        background: #fff;
        max-width: 900px;
        margin: auto;
        border: 1px solid #ddd;
        border-radius: 6px;
    }

    .brand-header {
        background: #1A73E8;
        padding: 20px 30px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .brand-title {
        font-size: 26px;
        font-weight: bold;
    }

    .section {
        padding: 16px 24px;
    }

    .label-title {
        font-size: 13px;
        font-weight: 700;
        color: #444;
        margin-bottom: 6px;
        text-transform: uppercase;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .table th {
        background: #f4f4f4;
        border: 1px solid #ddd;
        padding: 6px;
        font-size: 11px;
    }

    .table td {
        border: 1px solid #ddd;
        padding: 6px;
        font-size: 12px;
    }

    .box {
        border: 1px dashed #aaa;
        padding: 10px;
        font-size: 12px;
        background: #fafafa;
    }

    .signature-box {
        text-align: right;
        margin-top: -30px;
    }

    /* ======================
        PRINT FIX – A4 SINGLE PAGE
    ====================== */
    @media print {

        @page {
            size: A4;
            margin: 9mm;
        }

        body {
            background: #fff !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Hide everything */
        body * {
            visibility: hidden;
        }

        /* Show only invoice */
        #printArea,
        #printArea * {
            visibility: visible;
           
        }

        #printArea {
            position: relative;
            left: 0;
            top: 0;
            width: 100%;
            transform: scale(0.95);
            transform-origin: top left;
            
        }

        /* Hide navbar, sidebar, buttons */
        header, nav, aside, .no-print {
            display: none !important;
        }

        .invoice-wrapper {
            border: none !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            max-width: 100% !important;
        }

        .table th {
            background: #f4f4f4 !important;
        }
        .signature-box {
        text-align: right;
        margin-top: -30px;
    }
    }
</style>
@endsection

@section('content')

@if(session('message'))
    <div class="p-2 my-2 rounded text-white 
                {{ session('alert-type') === 'success' ? 'bg-green-600' : 'bg-red-600' }}">
        {{ session('message') }}
    </div>
@endif

@php
$company = optional(auth()->user()->select_companies()->first());
$c = $proformaInvoice->select_customer;
@endphp


<div class="max-w-6xl mx-auto mt-6 mb-10">

    <!-- BUTTONS -->
    <div id="actionButtons" class="flex justify-between items-center mb-3 no-print">

        <a href="{{ route('admin.proforma-invoices.index') }}"
            class="px-4 py-2 bg-gray-600 text-white text-sm rounded-md">
            ← Back
        </a>

        <div class="flex gap-2">

            <button onclick="printInvoice()"
                class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md">
                Print
            </button>

            <button id="downloadPdfBtn"
                class="px-4 py-2 bg-green-600 text-white text-sm rounded-md">
                Download PDF
            </button>
        </div>

        <div class="flex gap-2">

            <a href="{{ route('admin.proforma-invoices.edit', $proformaInvoice->id) }}" 
                class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                Edit
            </a>

            @if($proformaInvoice->status !== 'Converted' && $proformaInvoice->status !== 'DC Returned')
            <form action="{{ route('admin.proforma-invoices.convertToSale', $proformaInvoice->id) }}" 
                method="POST" 
                onsubmit="return confirm('Convert this Delivery Challan to Sale Invoice?')">
                @csrf

                <!-- MASTER FIELDS -->
                <input type="hidden" name="payment_type" value="{{ $proformaInvoice->payment_type }}">
                <input type="hidden" name="select_customer_id" value="{{ $proformaInvoice->select_customer_id }}">
                <input type="hidden" name="po_no" value="{{ $proformaInvoice->po_no }}">
                <input type="hidden" name="docket_no" value="{{ $proformaInvoice->docket_no }}">
                <input type="hidden" name="po_date" value="{{ $proformaInvoice->po_date }}">
                <input type="hidden" name="due_date" value="{{ $proformaInvoice->due_date }}">
                <input type="hidden" name="e_way_bill_no" value="{{ $proformaInvoice->e_way_bill_no }}">
                <input type="hidden" name="phone_number" value="{{ $proformaInvoice->phone_number }}">
                <input type="hidden" name="billing_address" value="{{ $proformaInvoice->billing_address }}">
                <input type="hidden" name="shipping_address" value="{{ $proformaInvoice->shipping_address }}">
                <input type="hidden" name="notes" value="{{ $proformaInvoice->notes }}">
                <input type="hidden" name="terms" value="{{ $proformaInvoice->terms }}">
                <input type="hidden" name="overall_discount" value="{{ $proformaInvoice->overall_discount }}">
                <input type="hidden" name="subtotal" value="{{ $proformaInvoice->subtotal }}">
                <input type="hidden" name="tax" value="{{ $proformaInvoice->tax }}">
                <input type="hidden" name="discount" value="{{ $proformaInvoice->discount }}">
                <input type="hidden" name="total" value="{{ $proformaInvoice->total }}">
                <input type="hidden" name="main_cost_center_id" value="{{ $proformaInvoice->main_cost_centers_id }}">
                <input type="hidden" name="sub_cost_center_id" value="{{ $proformaInvoice->sub_cost_centers_id }}">

                @foreach($proformaInvoice->items as $item)
                    @php $p = $item->pivot; @endphp
                    <input type="hidden" name="items[{{ $loop->index }}][add_item_id]" value="{{ $item->id }}">
                    <input type="hidden" name="items[{{ $loop->index }}][description]" value="{{ $p->description }}">
                    <input type="hidden" name="items[{{ $loop->index }}][qty]" value="{{ $p->qty }}">
                    <input type="hidden" name="items[{{ $loop->index }}][unit]" value="{{ $p->unit }}">
                    <input type="hidden" name="items[{{ $loop->index }}][price]" value="{{ $p->price }}">
                    <input type="hidden" name="items[{{ $loop->index }}][discount_type]" value="{{ $p->discount_type }}">
                    <input type="hidden" name="items[{{ $loop->index }}][discount]" value="{{ $p->discount }}">
                    <input type="hidden" name="items[{{ $loop->index }}][tax_type]" value="{{ $p->tax_type }}">
                    <input type="hidden" name="items[{{ $loop->index }}][tax]" value="{{ $p->tax }}">
                    <input type="hidden" name="items[{{ $loop->index }}][amount]" value="{{ $p->amount }}">
                    <input type="hidden" name="items[{{ $loop->index }}][json_data]" value="{{ $p->json_data }}">
                @endforeach

                <button type="submit" class="px-4 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700">
                    Convert to Sale Invoice
                </button>
            </form>

            <form action="{{ route('admin.proforma-invoices.reverseEffects', $proformaInvoice->id) }}" 
                method="POST" 
                onsubmit="return confirm('Are you sure? This will revert stock changes made by this challan!')">
                @csrf
                <button type="submit" class="px-3 py-2 bg-red-600 text-white text-xs rounded">
                    Reverse Stock
                </button>
            </form>

            @endif
        </div>
    </div>


    <!-- INVOICE -->
    <div id="printArea" class="invoice-wrapper shadow-xl" style="">

        <!-- HEADER -->
        <div class="brand-header">

            <div>
                <div class="brand-title">
                    {{ ucwords($company?->company_name) }}
                </div>

                <div style="font-size:13px">GSTIN: {{ $company?->gst_number }}</div>
                <div style="font-size:13px">Status: {{ $proformaInvoice->status }}</div>
            </div>

            @if($company?->getFirstMediaUrl('logo_upload'))
                <img src="{{ $company->getFirstMediaUrl('logo_upload') }}" style="height:60px">
            @endif
        </div>


        <!-- INVOICE TITLE -->
        <div class="section">
            <h1 class="text-2xl font-bold text-blue-700">DC INVOICE</h1>

            <p class="text-xs text-gray-600 mt-1">
                Invoice No: <b>{{ $proformaInvoice->delivery_challan_number }}</b><br>
                Date: <b>{{ $proformaInvoice->created_at?->format('d/m/Y') }}</b>
            </p>

            {!! DNS1D::getBarcodeHTML($proformaInvoice->delivery_challan_number, 'C39', 2, 60) !!}
        </div>


        <!-- SELLER / BUYER -->
        <div class="section grid grid-cols-2 gap-10">

            <div>
                <div class="label-title">Seller</div>
                <p class="text-sm font-semibold">{{ $company?->legal_name }}</p>
                <p class="text-xs">{{ $company?->address }}</p>
                <p class="text-xs">Phone: {{ $company?->phone_number }}</p>
                <p class="text-xs">Email: {{ $company?->email }}</p>
            </div>

            <div>
                <div class="label-title">Buyer</div>
                <p class="text-sm font-semibold">{{ $c?->party_name }}</p>
                <p class="text-xs">Shipping Address: {{ $proformaInvoice->shipping_address }}</p>
                <p class="text-xs">Postal Address: {{ $proformaInvoice->billing_address }}</p>
                <p class="text-xs">Phone: {{ $c?->phone_number }}</p>
                <p class="text-xs">Email: {{ $c?->email }}</p>
                <p class="text-xs">GSTIN: {{ $c?->gstin }}</p>
            </div>
        </div>

        <!-- DELIVERY -->
            {{-- <div class="section">
                <div class="label-title">Delivery Details</div>

                <table class="table">
                    <tr>
                        <td>Mode of Transport</td>
                        <td>{{ $proformaInvoice->json_data['transport_mode'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Vehicle Number</td>
                        <td>{{ $proformaInvoice->json_data['vehicle_number'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Transporter</td>
                        <td>{{ $proformaInvoice->json_data['transporter_name'] ?? '-' }}</td>
                    </tr>
                </table>
            </div> --}}

        <!-- ITEMS -->
        <div class="section">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>HSN</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Tax%</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($proformaInvoice->items as $item)
                    @php $p = $item->pivot; @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->item_hsn }}</td>
                        <td class="text-right">{{ $p->qty }}</td>
                        <td class="text-right">{{ number_format($p->price,2) }}</td>
                        <td class="text-right">{{ $p->tax }}</td>
                        <td class="text-right">{{ number_format($p->amount,2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <!-- HSN SUMMARY -->
        {{-- <div class="section">
            <div class="label-title">HSN Summary</div>

            <table class="table">
                <thead>
                    <tr>
                        <th>HSN Code</th>
                        <th>Qty</th>
                        <th>Taxable Value</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>Total Tax</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                        $summary = $proformaInvoice->items->groupBy('item_hsn');
                    @endphp

                    @foreach($summary as $hsn => $rows)
                        @php
                            $qty = $rows->sum('pivot.qty');
                            $taxable = $rows->sum('pivot.amount');
                            $cgst = $taxable * 0.09;
                            $sgst = $taxable * 0.09;
                        @endphp

                        <tr>
                            <td>{{ $hsn }}</td>
                            <td class="text-right">{{ $qty }}</td>
                            <td class="text-right">{{ number_format($taxable,2) }}</td>
                            <td class="text-right">{{ number_format($cgst,2) }}</td>
                            <td class="text-right">{{ number_format($sgst,2) }}</td>
                            <td class="text-right">{{ number_format($cgst + $sgst, 2) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div> --}}

        <!-- TOTALS -->
        <div class="section grid grid-cols-2 gap-6">

            <div>
               
                    @if($bankDetails->count())
                    <div class="section">
                        <div class="label-title">Bank Details</div>

                        @foreach($bankDetails as $bank)
                        <div style="display: flex">
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


            <div>
                <table class="table totals-table">
                    <tr>
                        <td>Subtotal</td>
                        <td class="text-right">₹ {{ number_format($proformaInvoice->subtotal,2) }}</td>
                    </tr>

                    <tr>
                        <td>Discount</td>
                        <td class="text-right">₹ {{ number_format($proformaInvoice->discount,2) }}</td>
                    </tr>

                    <tr>
                        <td>CGST</td>
                        <td class="text-right">₹ {{ number_format($proformaInvoice->tax/2,2) }}</td>
                    </tr>

                    <tr>
                        <td>SGST</td>
                        <td class="text-right">₹ {{ number_format($proformaInvoice->tax/2,2) }}</td>
                    </tr>

                    <tr class="font-bold">
                        <td>Grand Total</td>
                        <td class="text-right">₹ {{ number_format($proformaInvoice->total,2) }}</td>
                    </tr>
                </table>

                <div class="mt-4 text-xs font-semibold text-gray-700">
                    Amount in Words:<br>
                    <span class="uppercase">
                       ₹ {{ \App\Helpers\NumberHelper::formatIndian($proformaInvoice->total) }}
                    </span>
                </div>
            </div>

        </div>


        
        <!-- TERMS & NOTES -->
        <div class="section" style="margin-top: -20px;">
            <div class="grid grid-cols-2 gap-6" >

                <!-- TERMS -->
                <div>
                    <div class="label-title">Terms & Conditions</div>

                    @if($terms->count())
                        <div class="box text-xs">
                            <ul class="list-disc ml-4">
                                @foreach($terms as $term)
                                    <li>{!! nl2br(e($term->description)) !!}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="box text-xs">—</div>
                    @endif
                </div>

                <!-- NOTES -->
                <div>
                    <div class="label-title">Notes</div>

                    <div class="box text-xs">
                        {!! nl2br(e($proformaInvoice->notes ?? '—')) !!}
                    </div>
                </div>

            </div>
        </div>



        <!-- SIGNATURE -->
        <div class="section signature-box" style="margin-top: -90px;">

            @if($company?->getFirstMediaUrl('stamp_upload'))
                <img src="{{ $company->getFirstMediaUrl('stamp_upload') }}" style="height:80px; opacity:0.8;">
            @endif

            @if($company?->getFirstMediaUrl('signature_upload'))
                <img src="{{ $company->getFirstMediaUrl('signature_upload') }}" style="height:60px; opacity:0.8;">
            @endif

            <p class="text-xs mt-2">(Authorized Signatory)</p>
        </div>

    </div>
</div>

@endsection



@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
function printInvoice() {

    let btns = document.getElementById("actionButtons");

    btns.style.display = "none";    // hide buttons

    setTimeout(() => {
        window.print();

        btns.style.display = "flex"; // restore buttons
    }, 200);
}
</script>


<script>
document.getElementById('downloadPdfBtn')
?.addEventListener('click', function () {
    const element = document.getElementById('printArea');

    const opt = {
        margin: 0.2,
        filename: "Invoice-{{ $proformaInvoice->delivery_challan_number }}.pdf",
        image: { type: "jpeg", quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: "in", format: "a4", orientation: "portrait" }
    };

    html2pdf().set(opt).from(element).save();
});
</script>
@endsection
