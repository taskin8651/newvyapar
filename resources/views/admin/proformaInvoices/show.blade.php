@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Top actions -->
        <div class="flex flex-wrap items-center justify-between mb-4 gap-3">
            <div>
                <a href="{{ route('admin.proforma-invoices.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 text-sm">
                    ← Back to List
                </a>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.proforma-invoices.edit', $proformaInvoice->id) }}" 
                   class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                    Edit
                </a>

                @if($proformaInvoice->status !== 'Converted')
                <form action="{{ route('admin.proforma-invoices.convertToSale', $proformaInvoice->id) }}" method="POST" 
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

                    <!-- ITEM FIELDS -->
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
                @endif

            </div>
        </div>

        <!-- Printable invoice wrapper -->
        <div id="invoicePrintable" class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-6 flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold tracking-wide">DELIVERY CHALLAN</h1>
                    <p class="mt-2 text-sm opacity-90">
                        DC No: <span class="font-semibold">{{ $proformaInvoice->delivery_challan_number }}</span>
                    </p>
                    <p class="text-xs mt-1">
                        Created: {{ $proformaInvoice->created_at?->format('d-m-Y H:i') }} |
                        Updated: {{ $proformaInvoice->updated_at?->format('d-m-Y H:i') }}
                    </p>
                </div>

                <div class="text-right text-sm">
                    <p>Status:</p>
                    <p class="mt-1">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($proformaInvoice->status === 'Converted') bg-green-300 text-green-900 
                            @elseif($proformaInvoice->status === 'Draft') bg-yellow-300 text-yellow-900
                            @else bg-blue-300 text-blue-900 @endif">
                            {{ $proformaInvoice->status }}
                        </span>
                    </p>
                    <p class="mt-3">
                        Payment Type: 
                        <span class="font-semibold uppercase">{{ $proformaInvoice->payment_type }}</span>
                    </p>
                    @if($proformaInvoice->converted_sale_invoice_id)
                        <p class="mt-2 text-xs">
                            Linked Sale Invoice ID: 
                            <span class="font-semibold">{{ $proformaInvoice->converted_sale_invoice_id }}</span>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Company & Customer -->
            <div class="px-6 py-4 border-b border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Company Details</h2>
                    @php $company = optional(auth()->user()->select_companies()->first()); @endphp
                    <div class="text-sm text-gray-800 space-y-1">
                        <p class="font-bold text-lg">{{ $company?->business_name ?? '-' }}</p>
                        <p>{{ $company?->address ?? '' }}</p>
                        <p>GSTIN: {{ $company?->gst_number ?? '-' }}</p>
                        <p>Phone: {{ $company?->phone ?? '-' }}</p>
                        <p>Email: {{ $company?->email ?? '-' }}</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Bill / Ship To</h2>
                    @php $c = $proformaInvoice->select_customer; @endphp
                    <div class="bg-gray-50 rounded-lg p-3 text-sm text-gray-800 space-y-1">
                        <p class="font-bold text-lg">{{ $c?->party_name ?? '-' }}</p>
                        <p><span class="font-semibold">Phone:</span> {{ $proformaInvoice->phone_number ?? $c?->phone_number ?? '-' }}</p>
                        <p><span class="font-semibold">Email:</span> {{ $c?->email ?? '-' }}</p>
                        <p><span class="font-semibold">GSTIN:</span> {{ $c?->gstin ?? '-' }}</p>
                        <p><span class="font-semibold">PAN:</span> {{ $c?->pan_number ?? '-' }}</p>

                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <p class="font-semibold text-xs text-gray-600 uppercase">Billing Address</p>
                                <p class="text-xs">{{ $proformaInvoice->billing_address ?? $c?->billing_address ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-xs text-gray-600 uppercase">Shipping Address</p>
                                <p class="text-xs">{{ $proformaInvoice->shipping_address ?? $c?->shipping_address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meta -->
            <div class="px-6 py-4 border-b border-gray-200 grid grid-cols-2 md:grid-cols-4 gap-4 text-xs text-gray-700">
                <div>
                    <p class="font-semibold text-gray-600">PO No</p>
                    <p class="mt-1 text-sm">{{ $proformaInvoice->po_no ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">Docket No</p>
                    <p class="mt-1 text-sm">{{ $proformaInvoice->docket_no ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">Billing Date</p>
                    <p class="mt-1 text-sm">{{ $proformaInvoice->po_date ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">Bill Date</p>
                    <p class="mt-1 text-sm">{{ $proformaInvoice->due_date ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">E-Way Bill</p>
                    <p class="mt-1 text-sm">{{ $proformaInvoice->e_way_bill_no ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">Main Cost Center</p>
                    <p class="mt-1 text-sm">{{ $proformaInvoice->main_cost_centers_id ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">Sub Cost Center</p>
                    <p class="mt-1 text-sm">{{$proformaInvoice->sub_cost_centers_id ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-600">Created By</p>
                    <p class="mt-1 text-sm">{{ optional($proformaInvoice->created_by)->name ?? '-' }}</p>
                </div>
            </div>

            <!-- Items Table -->
            <div class="px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-3">Items</h2>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full text-xs md:text-sm">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-2 py-2 text-left">#</th>
                                <th class="px-2 py-2 text-left">Item</th>
                                <th class="px-2 py-2 text-left">Description</th>
                                <th class="px-2 py-2 text-right">Qty</th>
                                <th class="px-2 py-2 text-left">Unit</th>
                                <th class="px-2 py-2 text-right">Price</th>
                                <th class="px-2 py-2 text-right">Discount</th>
                                <th class="px-2 py-2 text-right">Tax</th>
                                <th class="px-2 py-2 text-right">Amount</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach($proformaInvoice->items as $item)
                                @php $p = $item->pivot; @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-2 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-2 py-2">
                                        <div class="font-semibold">{{ $item->item_name }}</div>
                                        <div class="text-[10px] text-gray-500">
                                            Code: {{ $item->item_code ?? '-' }} |
                                            HSN: {{ $item->item_hsn ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-2 py-2">{{ $p->description ?: '-' }}</td>
                                    <td class="px-2 py-2 text-right">{{ number_format($p->qty,2) }}</td>
                                    <td class="px-2 py-2 text-left">{{ $p->unit ?? '-' }}</td>
                                    <td class="px-2 py-2 text-right">₹ {{ number_format($p->price,2) }}</td>
                                    <td class="px-2 py-2 text-right">
                                        @if($p->discount > 0)
                                            @if($p->discount_type == 'percentage')
                                                {{ $p->discount }}%
                                            @else
                                                ₹ {{ number_format($p->discount,2) }}
                                            @endif
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="px-2 py-2 text-right">
                                        @if($p->tax > 0)
                                            {{ $p->tax }}%
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="px-2 py-2 text-right font-semibold">
                                        ₹ {{ number_format($p->amount,2) }}
                                    </td>
                                </tr>
                            @endforeach

                            @if($proformaInvoice->items->isEmpty())
                                <tr>
                                    <td colspan="9" class="px-2 py-4 text-center text-sm text-gray-500">
                                        No items found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Totals -->
            <div class="px-6 py-6 grid grid-cols-1 md:grid-cols-3 gap-4 border-t border-gray-200">

                <div class="md:col-span-2 space-y-3">
                    @if($proformaInvoice->notes)
                        <div>
                            <h3 class="text-xs font-semibold text-gray-600 uppercase mb-1">Notes</h3>
                            <p class="text-xs text-gray-700 whitespace-pre-line">
                                {{ $proformaInvoice->notes }}
                            </p>
                        </div>
                    @endif

                    @if($proformaInvoice->terms)
                        <div>
                            <h3 class="text-xs font-semibold text-gray-600 uppercase mb-1">Terms & Conditions</h3>
                            <p class="text-xs text-gray-700 whitespace-pre-line">
                                {{ $proformaInvoice->terms }}
                            </p>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="bg-gray-50 rounded-lg p-4 text-sm space-y-2 shadow-inner">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span>₹ {{ number_format($proformaInvoice->subtotal ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax:</span>
                            <span>₹ {{ number_format($proformaInvoice->tax ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Discount:</span>
                            <span>₹ {{ number_format($proformaInvoice->discount ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Overall Discount:</span>
                            <span>₹ {{ number_format($proformaInvoice->overall_discount ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between border-t pt-2 font-bold text-base">
                            <span>Total:</span>
                            <span>₹ {{ number_format($proformaInvoice->total ?? 0, 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-6 text-xs text-gray-500 text-right">
                        <p>Authorised Signatory</p>
                        <div class="mt-8 border-t border-gray-300 w-32 ml-auto"></div>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-4 text-[10px] text-gray-400 text-center">
            Generated from system • {{ now()->format('d-m-Y H:i') }}
        </p>
    </div>
</div>

@endsection
@section('scripts')
<script>
document.getElementById('downloadPdfBtn')?.addEventListener('click', function () {
    const element = document.getElementById('invoicePrintable');
    const opt = {
        margin:       0.4,
        filename:     'delivery-challan-{{ $proformaInvoice->delivery_challan_number ?? $proformaInvoice->id }}.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2, useCORS: true },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
});
</script>
@endsection
