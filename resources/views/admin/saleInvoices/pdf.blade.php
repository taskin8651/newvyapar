<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sale Invoice - {{ $saleInvoice->sale_invoice_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .invoice-container { box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .header-gradient { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); }
        .table-header { background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%); }

        @media print {
            body { background: #fff !important; font-size: 10px !important; line-height: 1.2; }
            .invoice-container { box-shadow: none !important; border: none !important; padding: 6px !important; }
            @page { size: A4; margin: 8mm; }
            h1 { font-size: 12px !important; }
            h2, h3 { font-size: 10px !important; }
            h4, p, span, td, th { font-size: 10px !important; }
            table th, table td { padding: 2px 3px !important; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-4 px-2 text-xs">
    <div class="max-w-4xl mx-auto border border-gray-300 bg-white p-4 rounded-lg shadow-md">

        <!-- Header -->
        <div class="text-center mb-2">
            <div class="flex items-center justify-center space-x-3">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="Company Logo" class="h-12 w-auto rounded shadow-sm" style="width: 200px;">
                @else
                    <img src="{{ asset('images/default-logo.png') }}" alt="Default Logo" class="h-12 w-auto rounded shadow-sm">
                @endif

                <div class="text-left">
                    <h1 class="text-xl font-bold text-blue-800">
                        {{ $company->company_name ?? 'MARUTI SUZUKI VENTURES' }}
                    </h1>
                    <p class="text-blue-600 text-xs">Authorized Dealer & Service Center</p>
                </div>
            </div>
        </div>


        <!-- Invoice Container -->
        <div class="invoice-container bg-white rounded-xl overflow-hidden text-xs">

            <!-- Header -->
            <div class="header-gradient text-white p-4 text-xs">
                <div class="flex justify-between items-start">
                    <div class="font-bold">
                        <h1 class="text-lg font-bold">SALE INVOICE</h1>
                        <p class="text-blue-200 mt-1 text-xs">ORIGINAL FOR RECIPIENT</p>
                        <div class="mt-2 text-xs">
                            <p><i class="fas fa-map-marker-alt mr-1"></i> 1st Floor, Kamla Bhattacharya Road, Patna (Bihar) - 800001</p>
                            <p><i class="fas fa-phone mr-1"></i> 9263906099</p>
                            <p><i class="fas fa-envelope mr-1"></i> marutisuzukiventures@gmail.com</p>
                        </div>
                    </div>
                    <div class="text-right bg-white text-blue-700 p-2 rounded-lg text-xs">
                        <p class="font-semibold">GSTIN: 10ABZFM8479K1ZC</p>
                        <p>State: Bihar</p>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
           <table class="w-full border-b border-gray-200 text-xs">
    <tr>
        <!-- Customer Info -->
         <!-- Supplier Info -->
                    <td class="w-1/2 p-2 align-top">
                       <div class="flex  rounded-lg border border-blue-200">
    <!-- Left Column: Supplier Details -->
    <div class="w-1/2 bg-blue-50 p-2  text-xs">
        <h3 class="text-sm font-semibold text-blue-700 mb-1 flex items-center">
            <i class="fas fa-user-circle mr-1"></i> Supplier
        </h3>
        @if($saleInvoice->select_customer)
            <h4 class="font-medium text-blue-800">
                {{ $saleInvoice->select_customer->party_name ?? '-' }}
            </h4>
            <p class="text-blue-700">Phone: {{ $saleInvoice->phone_number ?? '-' }}</p>
            <p class="text-blue-700">State: {{ $saleInvoice->select_customer->state ?? '-' }}</p>
            <p class="text-blue-700">GSTIN: {{ $saleInvoice->select_customer->gstin ?? '-' }}</p>
            <p class="text-blue-700 mt-1">
                {!! nl2br(trim($saleInvoice->select_customer->billing_address) ?: '-') !!}
            </p>
        @else
            <p class="italic text-gray-500">No supplier selected</p>
        @endif
    </div>

    <!-- Right Column: Billing Address -->
    <div class="w-1/2 bg-blue-50 border-l border-blue-200 p-2 text-xs">
        <h3 class="text-sm font-semibold text-blue-700 mb-1">
            Billing Address
        </h3>
        <p class="text-blue-700">
           {!! nl2br(trim($saleInvoice->billing_address) ?: '-') !!}

        </p>
        <h3 class="text-sm font-semibold text-blue-700 mt-2 mb-1">
            Shipping Address
        </h3>
        <p class="text-blue-700">
            {!! nl2br(trim($saleInvoice->shipping_address ?? '-')) !!}
        </p>
    </div>
</div>

                    </td>

        <!-- Bill Details -->
        <td class="w-1/2 p-2 align-top">
            <table class="w-full border rounded-lg border-blue-200 bg-blue-50 text-xs">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center text-blue-700 font-semibold py-1 text-sm">
                            <i class="fas fa-file-invoice mr-1"></i> Bill Details
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-medium py-1 px-2">Invoice No.:</td>
                        <td class="text-right px-2">{{ $saleInvoice->sale_invoice_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium py-1 px-2">Date:</td>
                        <td class="text-right px-2">{{ $saleInvoice->po_date ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="font-medium py-1 px-2">PO No.:</td>
                        <td class="text-right px-2">{{ $saleInvoice->po_no ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>


            <!-- Items Table -->
            <div class="p-4 border-b border-gray-200 overflow-x-auto text-xs">
                <table class="w-full text-xs border border-gray-200">
                    <thead>
                        <tr class="table-header text-white text-xs">
                            <th class="p-1 text-left">#</th>
                            <th class="p-1 text-left">Item Name</th>
                            <th class="p-1 text-left">HSN/SAC</th>
                            <th class="p-1 text-left">Qty</th>
                            <th class="p-1 text-left">Unit</th>
                            <th class="p-1 text-left">Price/Unit</th>
                            <th class="p-1 text-left">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @forelse($saleInvoice->items as $key => $item)
                            @php
                                $qty = $item->pivot->qty ?? 1;
                                $price = $item->pivot->price ?? 0;
                                $amount = $qty * $price;
                                $total += $amount;
                            @endphp
                            <tr class="border-b">
                                <td class="p-1">{{ $key+1 }}</td>
                                <td class="p-1">{{ $item->item_name }}</td>
                                <td class="p-1">{{ $item->item_hsn ?? '-' }}</td>
                                <td class="p-1">{{ $qty }}</td>
                                <td class="p-1">{{ $item->select_unit->name ?? 'pcs' }}</td>
                                <td class="p-1">Rs {{ number_format($price,2) }}</td>
                                <td class="p-1 font-semibold">Rs {{ number_format($amount,2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-1 italic text-gray-500">No items found</td>
                            </tr>
                        @endforelse
                        <tr class="bg-blue-50 font-semibold">
                            <td class="p-1" colspan="3">Total</td>
                            <td class="p-1">{{ $saleInvoice->items->sum(fn($i) => $i->pivot->qty ?? 1) }}</td>
                            <td class="p-1" colspan="2"></td>
                            <td class="p-1 text-green-600">Rs {{ number_format($total,2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Invoice Details & Amount in Words -->
            <div class="p-4 border-b border-gray-200 overflow-x-auto text-xs">
                <table class="w-full text-xs">
                    <tr>
                       <td class="align-top w-1/2 pl-2">
                            <table class="w-full border rounded-lg border-blue-200 bg-blue-50 text-xs">
                               
                               <tbody>
    <!-- 🔹 Amount in Words -->
    <tr>
        <th colspan="2" class="text-center text-blue-700 font-semibold py-1 text-sm">
            <i class="fas fa-rupee-sign mr-1"></i> Amount in Words
        </th>
    </tr>
    <tr>
        <td colspan="2" class="bg-blue-100 font-medium py-2 px-2 text-center rounded">
            {{ \App\Helpers\NumberHelper::toWords($total) }}
        </td>
    </tr>

    <!-- 🔹 Payment Mode & Notes in One Row -->
    <tr>
        <th class="text-center text-blue-700 font-semibold py-1 text-sm w-1/2 border-r border-blue-200">
            <i class="fas fa-receipt mr-1"></i> Payment Mode
        </th>
        <th class="text-center text-blue-700 font-semibold py-1 text-sm w-1/2">
            <i class="fas fa-sticky-note mr-1"></i> Notes
        </th>
    </tr>

    <tr>
        <td class="bg-blue-100 font-medium py-2 px-2 text-center border-r border-blue-200">
            {{ $saleInvoice->payment_mode ?? 'N/A' }}
        </td>
        <td class="bg-blue-100 font-medium py-2 px-2 text-center">
            {{ $saleInvoice->notes ?? 'N/A' }}
        </td>
    </tr>
</tbody>

                            </table>
                        </td>

              <!-- Subtotal / Total -->
<td class="align-top w-1/2 pl-2">
    <table class="w-full border rounded-lg border-blue-200 bg-blue-50 text-xs">
        <thead>
            <tr>
                <th class="text-center text-blue-700 font-semibold py-1 text-sm">
                    <i class="fas fa-calculator mr-1"></i> Amounts
                </th>
            </tr>
        </thead>
        @php
            // Previous balance (no longer displayed, but used in calculation if needed)
            $previous_balance = $saleInvoice->select_customer->current_balance 
                ?? $saleInvoice->select_customer->opening_balance 
                ?? 0;

            // Grand total
            $grand_total = $saleInvoice->total ?? $total ?? 0;

            // Current balance = previous + grand total
            $current_balance = $previous_balance + $grand_total;
        @endphp

        <tbody>
            <tr class="bg-blue-100">
                <td class="font-medium py-1 px-2">Subtotal</td>
                <td class="text-right font-medium py-1 px-2">
                    Rs {{ number_format($total, 2) }}
                </td>
            </tr>
            <tr>
                <td class="font-medium py-1 px-2">
                    Discount ({{ $item->pivot->discount_type ?? 0 }} {{ $item->pivot->discount ?? 0 }})
                </td>
                <td class="text-right py-1 px-2">
                    Rs {{ number_format($saleInvoice->discount ?? 0, 2) }}
                </td>
            </tr>
            <tr>
                <td class="font-medium py-1 px-2">GST ({{ $item->pivot->tax ?? 0 }}%)</td>
                <td class="text-right py-1 px-2">
                    Rs {{ number_format($saleInvoice->tax ?? 0, 2) }}
                </td>
            </tr>
            <tr class="border-t border-gray-200 bg-blue-50 font-semibold">
                <td class="py-1 px-2">Grand Total</td>
                <td class="text-right py-1 px-2">
                    Rs {{ number_format($grand_total, 2) }}
                </td>
            </tr>

            <!-- Previous Balance row removed -->

            <tr class="border-t border-gray-200 bg-blue-50 font-semibold">
                <td class="py-1 px-2">Current Balance</td>
                <td class="text-right py-1 px-2">
                    Rs {{ number_format($previous_balance, 2) }}
                </td>
            </tr>
        </tbody>
    </table>
</td>

                    </tr>
                </table>
            </div>

            <!-- Bank, Terms & Signatory -->
            <div class="p-4 border-b border-gray-200 overflow-x-auto text-xs">
                <table class="w-full text-xs border border-gray-200 rounded-lg">
                    <tbody>
                        <tr class="align-top">
                            <!-- Bank Details -->
                            <td class="p-2 w-1/3 border-r border-gray-200">
                                <h3 class="font-semibold text-blue-700 mb-1 flex items-center text-xs">
                                    <i class="fas fa-university mr-1"></i> Bank Details
                                </h3>
                                <table class="w-full text-xs">
    @foreach($bankDetails as $bank)
        @if($bank->print_bank_details)
            <tbody>
                <tr>
                    <td class="font-medium px-2 py-1">Bank Name:</td>
                    <td class="px-2 py-1">{{ $bank->bank_name ?? '-' }}</td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="font-medium px-2 py-1">Account No.:</td>
                    <td class="px-2 py-1">{{ $bank->account_number ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="font-medium px-2 py-1">IFSC Code:</td>
                    <td class="px-2 py-1">{{ $bank->ifsc_code ?? '-' }}</td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="font-medium px-2 py-1">Account Holder:</td>
                    <td class="px-2 py-1">{{ $bank->account_holder_name ?? '-' }}</td>
                </tr>

                {{-- ✅ Show UPI QR if uploaded --}}
                @if($bank->print_upi_qr && $bank->upi_qr)
                    <tr>
                        <td class="font-medium px-2 py-1">UPI QR:</td>
                        <td class="px-2 py-1">
                            <img src="{{ $bank->upi_qr }}" width="100" height="100" alt="UPI QR">
                            @if($bank->upi)
                                <p class="mt-1 font-semibold">{{ $bank->upi }}</p>
                            @endif
                        </td>
                    </tr>
                @endif

            </tbody>
        @endif
    @endforeach
</table>



                            </td>

                            <!-- Terms & Conditions -->
                            <td class="p-2 w-1/3 border-r border-gray-200">
                                <h3 class="font-semibold text-blue-700 mb-1 flex items-center text-xs">
                                    <i class="fas fa-file-contract mr-1"></i> Terms & Conditions
                                </h3>

                                
                                    
                                    <div class="bg-yellow-50 p-2 rounded border text-xs mb-2">
                                        <h4 class="font-semibold text-orange-700 mb-1 text-xs">DETAILS:</h4>
                                        <p class="text-orange-800 text-xs">{!! $saleInvoice->terms !!}</p>
                                    </div>
                              

                                @foreach($terms as $term)
                                    
                                    <div class="bg-yellow-50 p-2 rounded border text-xs">
                                        
                                        <p class="text-orange-800 text-xs">{!! $term->description !!}</p>
                                    </div>
                                @endforeach
                            </td>

                            <!-- Authorized Signatory -->
                            <td class="p-2 w-1/3 text-center align-top">
                                <div class="flex flex-col justify-end h-full" style="height: 120px;">
                                    <div class="border-t border-blue-400 w-40 pt-1 mx-auto">
                                        <p class="font-medium text-blue-700 text-xs">Authorized Signatory</p>
                                    </div>
                                    <p class="text-gray-500 mt-1 text-xs">For: MARUTI SUZUKI VENTURES</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Footer -->
        <!-- Footer -->
       <div class="mt-4 p-3 border-t border-gray-300 text-xs text-gray-600 space-y-1 text-center">
    <p class="italic text-gray-500">
        This is a computer-generated sales bill and does not require a physical signature.
    </p>

    <div class="flex flex-col sm:flex-row justify-center sm:justify-between mt-2 space-y-1 sm:space-y-0 sm:space-x-4">
        <p>
            <span class="font-semibold text-gray-700">Generated On:</span>
            {{ $saleInvoice->created_at->format('d-m-Y \a\t h:i A') }}
            by <span class="font-medium">{{ $saleInvoice->created_by->name ?? 'System' }}</span>
        </p>

        <p>
            <span class="font-semibold text-gray-700">Updated On:</span>
           {{ optional($saleInvoice->updated_at)->format('d-m-Y \a\t h:i A') ?? 'N/A' }}
            by <span class="font-medium">{{ $saleInvoice->updated_by->name ?? 'System' }}</span>
        </p>
    </div>
</div>

    </div>

    <!-- Print Button -->
    <div class="fixed bottom-4 right-4 no-print">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-full shadow-lg flex items-center text-xs">
            <i class="fas fa-print mr-1"></i> Print Sale Invoice
        </button>
    </div>
</body>
</html>
