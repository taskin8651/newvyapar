@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">

        <form id="saleForm" 
              action="{{ route('admin.estimate-quotations.update', $estimateQuotation->id) }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-lg mb-6">
                <h1 class="text-3xl font-bold">EDIT ESTIMATE / QUOTATION</h1>

                <div class="flex mt-4 space-x-6">
                    <label class="flex items-center">
                        <input type="radio" name="payment_type" value="credit"
                            class="h-4 w-4 text-white"
                            {{ $estimateQuotation->payment_type == 'credit' ? 'checked' : '' }}>
                        <span class="ml-2">Credit</span>
                    </label>

                    <label class="flex items-center">
                        <input type="radio" name="payment_type" value="cash"
                            class="h-4 w-4 text-white"
                            {{ $estimateQuotation->payment_type == 'cash' ? 'checked' : '' }}>
                        <span class="ml-2">Cash</span>
                    </label>
                </div>
            </div>

            <!-- BILL TO + INVOICE DETAILS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <!-- LEFT → CUSTOMER -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Bill To</h2>

                    <select name="select_customer_id" id="customer_id"
                        class="form-select select2 w-full" required>
                        <option value="">-- Select Customer --</option>

                        @foreach($select_customers as $id => $name)
                            <option value="{{ $id }}"
                                {{ $estimateQuotation->select_customer_id == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Auto-filled customer card -->
                    <div id="customerDetailsCard"
                        class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-white border-4 border-blue-300 rounded-xl shadow-xl {{ $estimateQuotation->select_customer_id ? '' : 'hidden' }}">

                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto text-sm">
                                <tbody class="divide-y divide-gray-200">

                                    <tr>
                                        <td class="px-3 py-2 font-semibold">Name</td>
                                        <td class="px-3 py-2" id="customer_name">
                                            {{ $estimateQuotation->select_customer->party_name ?? '' }}
                                        </td>

                                        <td class="px-3 py-2 font-semibold">GSTIN</td>
                                        <td class="px-3 py-2 text-green-700 font-medium" id="customer_gstin">
                                            {{ $estimateQuotation->select_customer->gstin ?? '' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-3 py-2 font-semibold">Phone</td>
                                        <td class="px-3 py-2" id="customer_phone">
                                            {{ $estimateQuotation->select_customer->phone_number ?? '' }}
                                        </td>

                                        <td class="px-3 py-2 font-semibold">PAN</td>
                                        <td class="px-3 py-2" id="customer_pan">
                                            {{ $estimateQuotation->select_customer->pan_number ?? '' }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-3 py-2 font-semibold">Billing Address</td>
                                        <td class="px-3 py-2" id="customer_billing_address">
                                            {{ $estimateQuotation->billing_address }}
                                        </td>

                                        <td class="px-3 py-2 font-semibold">Shipping Address</td>
                                        <td class="px-3 py-2" id="customer_shipping_address">
                                            {{ $estimateQuotation->shipping_address }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Main Cost Center -->
                    <div>
                        <label class="block text-sm font-medium">Select Main Cost Center</label>
                        <select name="main_cost_centers_id" class="select2 w-full rounded-md border px-3 py-2" required>
                            @foreach($cost as $id => $name)
                                <option value="{{ $id }}"
                                    {{ $estimateQuotation->main_cost_centers_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sub Cost Center -->
                    <div>
                        <label class="block text-sm font-medium">Select Sub Cost Center</label>
                        <select name="sub_cost_centers_id" class="select2 w-full rounded-md border px-3 py-2" required>
                            @foreach($sub_cost as $id => $name)
                                <option value="{{ $id }}"
                                    {{ $estimateQuotation->sub_cost_centers_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- RIGHT → INVOICE DETAILS -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Invoice Details</h2>

                    <input type="text" name="po_no"
                        value="{{ $estimateQuotation->po_no }}"
                        class="w-full rounded-md border px-3 py-2" placeholder="Invoice / PO No.">

                    <input type="text" name="docket_no"
                        value="{{ $estimateQuotation->docket_no }}"
                        class="w-full rounded-md border px-3 py-2 mt-2"
                        placeholder="Docket Number">

                    <div class="grid grid-cols-2 gap-4 mt-2">

                        <div class="flex flex-col">
                            <label class="mb-1 font-semibold">Billing Date</label>
                            <input type="date" name="po_date"
                                value="{{ $estimateQuotation->po_date ? \Carbon\Carbon::parse($estimateQuotation->po_date)->format('Y-m-d') : date('Y-m-d') }}"
                                class="w-full rounded-md border px-3 py-2">
                        </div>

                        <div class="flex flex-col">
                            <label class="mb-1 font-semibold">Valid Date</label>
                            <input type="date" name="due_date"
                                value="{{ $estimateQuotation->due_date }}"
                                class="w-full rounded-md border px-3 py-2">
                        </div>

                    </div>

                    <input type="text" name="e_way_bill_no"
                        value="{{ $estimateQuotation->e_way_bill_no }}"
                        placeholder="E-Way Bill No."
                        class="w-full rounded-md border px-3 py-2 mt-2">

                    <input type="text" name="customer_phone_invoice"
                        value="{{ $estimateQuotation->customer_phone_invoice }}"
                        placeholder="Customer Phone"
                        class="w-full rounded-md border px-3 py-2 mt-2">

                    <textarea name="billing_address_invoice" rows="2"
                        class="w-full rounded-md border px-3 py-2 mt-2"
                        placeholder="Billing Address">{{ $estimateQuotation->billing_address }}</textarea>

                    <textarea name="shipping_address_invoice" rows="2"
                        class="w-full rounded-md border px-3 py-2 mt-2"
                        placeholder="Shipping Address">{{ $estimateQuotation->shipping_address }}</textarea>
                </div>
            </div>
<!-- ITEMS TABLE -->
<div class="mb-6">
    <hr class="border-dashed border-gray-300 mb-4">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">ITEMS</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-2 py-2">Item</th>
                    <th class="px-2 py-2">Description</th>
                    <th class="px-2 py-2">QTY</th>
                    <th class="px-2 py-2">Unit</th>
                    <th class="px-2 py-2">Price/Unit</th>
                    <th class="px-2 py-2">Discount</th>
                    <th class="px-2 py-2">Tax</th>
                    <th class="px-2 py-2">Amount</th>
                    <th class="px-2 py-2">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($estimateQuotation->items as $index => $item)
                @php
                    $pivot = $item->pivot;
                @endphp

                <tr class="item-row">

                    <!-- ITEM SELECT -->
                    <td class="px-1 py-1">
                        <select name="items[{{ $index }}][add_item_id]"
                                class="form-select item-select select2 w-full">

                            <option value="">-- Select Item --</option>

                            @foreach($items as $it)
                                <option 
                                    value="{{ $it->id }}"
                                    data-sale-price="{{ $it->sale_price ?? $it->purchase_price ?? 0 }}"
                                    data-purchase-price="{{ $it->purchase_price ?? 0 }}"
                                    data-unit="{{ $it->select_unit->unit_name ?? '' }}"
                                    data-hsn="{{ $it->item_hsn ?? '' }}"
                                    data-code="{{ $it->item_code ?? '' }}"
                                    data-item-type="{{ $it->item_type ?? 'product' }}"
                                    data-stock="{{ $it->item_type === 'product' ? ($it->stock_qty ?? 0) : 0 }}"
                                    {{ $it->id == $item->id ? 'selected' : '' }}
                                >
                                    {{ $it->item_name }} ({{ ucfirst($it->item_type) }})
                                    @if($it->item_type === 'product')
                                        - Stock: {{ $it->stock_qty }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </td>

                    <!-- DESCRIPTION -->
                    <td class="px-1 py-1 description">
                        Type: {{ $item->item_type }} |
                        HSN: {{ $item->item_hsn }} |
                        Code: {{ $item->item_code }}
                    </td>

                    <!-- QTY -->
                    <td class="px-1 py-1">
                        <input type="number"
                               name="items[{{ $index }}][qty]"
                               class="qty w-full border px-2 py-1"
                               value="{{ $pivot->qty }}" min="1">
                    </td>

                    <!-- UNIT -->
                    <td class="px-1 py-1 unit">
                        {{ $pivot->unit ?? ($item->select_unit->unit_name ?? '') }}
                    </td>

                    <!-- PRICE -->
                    <td class="px-1 py-1">
                        <input type="number"
                               name="items[{{ $index }}][price]"
                               class="price w-full border px-2 py-1"
                               value="{{ $pivot->price }}" step="0.01">
                    </td>

                    <!-- DISCOUNT -->
                    <td class="px-1 py-1">
                        <select name="items[{{ $index }}][discount_type]"
                                class="discount_type w-full select2">
                            <option value="value" {{ $pivot->discount_type == 'value' ? 'selected' : '' }}>Value</option>
                            <option value="percentage" {{ $pivot->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                        </select>

                        <input type="number"
                               name="items[{{ $index }}][discount]"
                               class="discount w-full mt-1 border px-2 py-1"
                               value="{{ $pivot->discount }}" step="0.01">
                    </td>

                    <!-- TAX -->
                    <td class="px-1 py-1">
                        <select name="items[{{ $index }}][tax_type]"
                                class="tax_type w-full select2">
                            <option value="without" {{ $pivot->tax_type == 'without' ? 'selected' : '' }}>Without Tax</option>
                            <option value="with" {{ $pivot->tax_type == 'with' ? 'selected' : '' }}>With Tax</option>
                        </select>

                        <div class="flex items-center gap-2">
                            <input type="number"
                                   name="items[{{ $index }}][tax]"
                                   class="tax_rate w-full mt-1 border px-2 py-1"
                                   value="{{ $pivot->tax }}" step="0.01"
                                   style="{{ $pivot->tax_type == 'with' ? '' : 'display:none;' }}">
                            <span class="gst-applied text-green-600 text-xs font-medium hidden">
                                GST Applied ✅
                            </span>
                        </div>
                    </td>

                    <!-- AMOUNT + base/gst info -->
                    <td class="px-1 py-1">
                        <input type="text"
                               name="items[{{ $index }}][amount]"
                               class="amount w-full border px-2 py-1"
                               value="{{ $pivot->amount }}" readonly>

                        <div class="text-xs text-gray-500 leading-tight mt-1 base-gst-lines">
                            <div class="base-line">
                                Base Price: ₹ <span class="base-val">0.00</span>
                            </div>
                            <div class="gst-line">
                                GST: ₹ <span class="gst-val">0.00</span>
                            </div>
                        </div>
                    </td>

                    <!-- REMOVE ROW -->
                    <td class="px-1 py-1 text-center">
                        <button type="button"
                                class="removeRow bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">
                            Remove
                        </button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
<!-- RIGHT COLUMN: TOTALS, NOTES, TERMS, ATTACHMENT -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

    <!-- LEFT SIDE -->
    <div class="space-y-4">

        <!-- NOTES -->
        <textarea name="notes" rows="3"
            class="w-full rounded-md border px-3 py-2"
            placeholder="Notes">{{ old('notes', $estimateQuotation->notes) }}</textarea>

        <!-- TERMS & CONDITIONS -->
        <textarea name="terms" rows="3"
            class="w-full rounded-md border px-3 py-2"
            placeholder="Terms & Conditions">{{ old('terms', $estimateQuotation->terms) }}</textarea>

        <!-- COMPOSITION SUMMARY -->
        <div class="bg-white p-4 rounded-lg border mb-4">
            <h3 class="font-semibold mb-2">Selected Product Composition</h3>

            <div id="compositionPlaceholder" class="text-sm text-gray-600">
                Select a product to see raw materials / services & cost breakdown here.
            </div>

            <div id="compositionDetails" style="display:none;">
                <table class="min-w-full text-sm mb-2">
                    <thead class="text-left text-xs text-gray-500">
                        <tr>
                            <th>Raw Material / Service</th>
                            <th>Used Qty</th>
                            <th>Sale Price (unit)</th>
                            <th>Purchase Price (unit)</th>
                            <th>Item Sale Total</th>
                            <th>Item Purchase Total</th>
                            <th>Profit/Loss</th>
                        </tr>
                    </thead>
                    <tbody id="compositionRows"></tbody>
                </table>

                <div class="flex justify-between mt-2">
                    <div>
                        <p class="text-xs text-gray-500">Total Purchase Cost:</p>
                        <p class="font-semibold">₹ <span id="comp_total_purchase">0.00</span></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Total Sale Value:</p>
                        <p class="font-semibold">₹ <span id="comp_total_sale">0.00</span></p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Overall Profit / Loss:</p>
                        <p id="comp_profit_label" class="font-semibold text-green-600">
                            ₹ <span id="comp_profit">0.00</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- RIGHT SIDE TOTALS -->
    <div>

        <!-- Overall Discount -->
        <div class="mb-2">
            <label class="font-semibold">Overall Discount:</label>
            <input type="number" name="overall_discount" id="overall_discount"
                class="w-full border px-2 py-1 mt-1"
                value="{{ old('overall_discount', $estimateQuotation->overall_discount) }}"
                step="0.01">
        </div>

        <!-- TOTALS BOX -->
        <div class="bg-gray-50 p-4 rounded-lg space-y-2 mb-4">

            <div class="flex justify-between">
                <span>Subtotal:</span>
                <span id="subtotal_display">{{ number_format($estimateQuotation->subtotal, 2) }}</span>
                <input type="hidden" name="subtotal" id="subtotal"
                       value="{{ $estimateQuotation->subtotal }}">
            </div>

            <div class="flex justify-between">
                <span>Tax:</span>
                <span id="tax_display">{{ number_format($estimateQuotation->tax, 2) }}</span>
                <input type="hidden" name="tax" id="tax_input"
                       value="{{ $estimateQuotation->tax }}">
            </div>

            <div class="flex justify-between">
                <span>Discount:</span>
                <span id="discount_display">{{ number_format($estimateQuotation->discount, 2) }}</span>
                <input type="hidden" name="discount" id="discount_input"
                       value="{{ $estimateQuotation->discount }}">
            </div>

            <div class="flex justify-between border-t pt-2 font-bold">
                <span>Total:</span>
                <span id="total_display">{{ number_format($estimateQuotation->total, 2) }}</span>
                <input type="hidden" name="total" id="total_input"
                       value="{{ $estimateQuotation->total }}">
            </div>
        </div>

        <!-- Attachment -->
        <div class="mb-6">
            <label class="font-semibold">Attachment:</label>

            @if($estimateQuotation->document)
                <div class="mt-2 flex items-center space-x-3">
                    <a href="{{ $estimateQuotation->document->getUrl() }}"
                       target="_blank"
                       class="text-blue-600 underline">
                        View Existing File
                    </a>
                </div>
            @endif

            <input type="file" name="attachment"
                   class="w-full border px-3 py-2 rounded-md mt-2">
        </div>

        <!-- Save Button -->
        <div class="mt-6">
            <button type="submit" id="saveInvoiceBtn"
                class="w-full bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700">
                UPDATE ESTIMATE
            </button>
        </div>

    </div>
</div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
$(document).ready(function() {
    $('.select2').select2({ width: '100%' });

    // -----------------------------------------------------
    // 1. Master options store for row-cloning
    // -----------------------------------------------------
    const masterItemOptions =
        $('#itemsTable tbody tr.item-row').first().find('.item-select').html();

    // -----------------------------------------------------
    // 2. GST Reverse calculation
    // -----------------------------------------------------
    function reverseGST(priceIncl, taxRate) {
        priceIncl = parseFloat(priceIncl) || 0;
        taxRate = parseFloat(taxRate) || 0;
        if (taxRate <= 0) return { basePerUnit: priceIncl, gstPerUnit: 0 };

        const divisor = 1 + (taxRate / 100);
        const base = priceIncl / divisor;
        const gst = priceIncl - base;

        return { basePerUnit: base, gstPerUnit: gst };
    }

    // -----------------------------------------------------
    // 3. CUSTOMER DETAILS (Edit page on load)
    // -----------------------------------------------------
    if ($('#customer_id').val()) {
        $('#customer_id').trigger('change');
    }

    $('#customer_id').on('change', function() {
        const id = $(this).val();
        if (!id) return $('#customerDetailsCard').addClass('hidden');

        $.get("{{ route('admin.saleInvoice.getCustomerDetails', '') }}/" + id, function(data) {

            function clean(v) { return $('<div>').html(v).text(); }

            $('#customer_name').text(clean(data.party_name));
            $('#customer_gstin').text(clean(data.gstin));
            $('#customer_phone').text(clean(data.phone_number));
            $('#customer_pan').text(clean(data.pan_number));
            $('#customer_billing_address').text(clean(data.billing_address));
            $('#customer_shipping_address').text(clean(data.shipping_address));
            $('#customer_state').text(clean(data.state));
            $('#customer_city').text(clean(data.city));
            $('#customer_pincode').text(clean(data.pincode));
            $('#customer_email').text(clean(data.email));
            $('#customerDetailsCard').removeClass('hidden');

            $('#invoice_customer_phone').val(clean(data.phone_number));
            $('#invoice_billing_address').val(clean(data.billing_address));
        });
    });

    // -----------------------------------------------------
    // 4. PRODUCT COMPOSITION CACHE
    // -----------------------------------------------------
    let compositionCache = {};

    function renderComposition(rows, qty, salePrice) {
        if (!rows || rows.length === 0) {
            $('#compositionPlaceholder').show();
            $('#compositionDetails').hide();
            return;
        }

        qty = parseFloat(qty) || 1;
        salePrice = parseFloat(salePrice) || 0;

        $('#compositionRows').empty();
        $('#compositionPlaceholder').hide();
        $('#compositionDetails').show();

        let totalPurchase = 0;

        rows.forEach(r => {
            const used = (parseFloat(r.qty_used) || 0) * qty;
            const sale = (parseFloat(r.sale_price) || 0) * used;
            const purchase = (parseFloat(r.purchase_price) || 0) * used;
            const diff = sale - purchase;

            totalPurchase += purchase;

            $('#compositionRows').append(`
                <tr>
                    <td>${r.name}</td>
                    <td>${used}</td>
                    <td>₹ ${parseFloat(r.sale_price).toFixed(2)}</td>
                    <td>₹ ${parseFloat(r.purchase_price).toFixed(2)}</td>
                    <td>₹ ${sale.toFixed(2)}</td>
                    <td>₹ ${purchase.toFixed(2)}</td>
                    <td class="${diff >= 0 ? 'text-green-600' : 'text-red-600'}">
                        ₹ ${diff.toFixed(2)}
                    </td>
                </tr>
            `);
        });

        const saleTotal = qty * salePrice;
        const profit = saleTotal - totalPurchase;

        $('#comp_total_purchase').text(totalPurchase.toFixed(2));
        $('#comp_total_sale').text(saleTotal.toFixed(2));
        $('#comp_profit').text(profit.toFixed(2));

        $('#comp_profit_label')
            .removeClass('text-green-600 text-red-600')
            .addClass(profit >= 0 ? 'text-green-600' : 'text-red-600');
    }

    // -----------------------------------------------------
    // 5. ROW CALCULATION
    // -----------------------------------------------------
    function calculateRow(row) {

        const qty = parseFloat(row.find('.qty').val()) || 0;
        const priceIncl = parseFloat(row.find('.price').val()) || 0;
        const discountVal = parseFloat(row.find('.discount').val()) || 0;
        const discountType = row.find('.discount_type').val();
        const taxType = row.find('.tax_type').val();
        const taxRate = parseFloat(row.find('.tax_rate').val()) || 0;

        let basePerUnit = priceIncl;
        let gstPerUnit = 0;

        if (taxType === 'with') {
            const rev = reverseGST(priceIncl, taxRate);
            basePerUnit = rev.basePerUnit;
            gstPerUnit = rev.gstPerUnit;
            row.find('.tax_rate').show();
        } else {
            row.find('.tax_rate').hide();
        }

        let baseTotal = basePerUnit * qty;
        let gstTotal = gstPerUnit * qty;

        // discount apply
        let discAmt = discountType === 'percentage'
            ? baseTotal * (discountVal / 100)
            : discountVal;

        discAmt = Math.min(discAmt, baseTotal);

        let baseAfterDisc = baseTotal - discAmt;
        let taxAmt = taxType === 'with' ? baseAfterDisc * (taxRate / 100) : 0;

        const final = baseAfterDisc + taxAmt;

        // WRITE OUTPUTS
        row.find('.amount').val(final.toFixed(2));
        row.find('.base-val').text(baseAfterDisc.toFixed(2));
        row.find('.gst-val').text(taxAmt.toFixed(2));

        row.data({
            base: baseAfterDisc,
            discAmt: discAmt,
            taxAmt: taxAmt,
            gross: final
        });
    }

    // -----------------------------------------------------
    // 6. TOTALS CALCULATION
    // -----------------------------------------------------
    function calculateTotals() {

        let subtotal = 0, discountTotal = 0, taxTotal = 0, grossTotal = 0;

        $('#itemsTable tbody tr').each(function() {
            const d = $(this).data() || {};
            subtotal += d.base || 0;
            discountTotal += d.discAmt || 0;
            taxTotal += d.taxAmt || 0;
            grossTotal += d.gross || 0;
        });

        const overallDisc = parseFloat($('#overall_discount').val()) || 0;
        const total = Math.max(grossTotal - overallDisc, 0);

        $('#subtotal_display').text(subtotal.toFixed(2));
        $('#tax_display').text(taxTotal.toFixed(2));
        $('#discount_display').text((discountTotal + overallDisc).toFixed(2));
        $('#total_display').text(total.toFixed(2));

        $('#subtotal').val(subtotal.toFixed(2));
        $('#tax_input').val(taxTotal.toFixed(2));
        $('#discount_input').val((discountTotal + overallDisc).toFixed(2));
        $('#total_input').val(total.toFixed(2));
    }

    // -----------------------------------------------------
    // 7. ITEM SELECT HANDLER (edit + new rows)
    // -----------------------------------------------------
    $(document).on('change', '.item-select', function() {
        const row = $(this).closest('tr');
        const sel = $(this).find(':selected');

        if (!sel.val()) return;

        const itemId = sel.val();
        const salePrice = parseFloat(sel.data('sale-price')) || 0;
        const purchasePrice = parseFloat(sel.data('purchase-price')) || 0;
        const unit = sel.data('unit') || '';
        const type = sel.data('item-type') || 'product';
        const hsn = sel.data('hsn') || '';
        const code = sel.data('code') || '';

        row.find('.price').val(salePrice);
        row.find('.unit').text(unit);
        row.find('.description').text(`Type: ${type} | HSN: ${hsn} | Code: ${code}`);
        row.find('.qty').val(1);

        // GST auto-apply 18%
        row.find('.tax_type').val('with').trigger('change');
        row.find('.tax_rate').val(18).show();

        // composition load
        if (type === 'product') {

            if (compositionCache[itemId]) {
                renderComposition(compositionCache[itemId], 1, salePrice);
            } else {
                $.get("{{ route('admin.saleInvoice.getItemComposition', '') }}/" + itemId, function(resp) {
                    compositionCache[itemId] = resp.composition || [];
                    renderComposition(resp.composition, 1, salePrice);
                });
            }

        } else {
            renderComposition([
                {
                    id: itemId,
                    name: sel.text(),
                    qty_used: 1,
                    sale_price: salePrice,
                    purchase_price: purchasePrice
                }
            ], 1, salePrice);
        }

        calculateRow(row);
        calculateTotals();
    });

    // -----------------------------------------------------
    // 8. RECALCULATE ON INPUT CHANGES
    // -----------------------------------------------------
    $(document).on('input change',
        '.qty, .price, .discount, .discount_type, .tax_type, .tax_rate, #overall_discount',
        function() {
            const row = $(this).closest('tr');
            calculateRow(row);
            calculateTotals();
        }
    );

    // -----------------------------------------------------
    // 9. ADD ROW
    // -----------------------------------------------------
    $('#addRow').click(function() {
        const tbody = $('#itemsTable tbody');
        const count = tbody.find('tr').length;

        const row = $(`
            <tr class="item-row">
                <td>
                    <select name="items[${count}][add_item_id]"
                        class="form-select item-select select2">${masterItemOptions}</select>
                </td>
                <td class="description"></td>
                <td><input type="number" name="items[${count}][qty]" class="qty border px-2 py-1 w-full" value="1"></td>
                <td class="unit"></td>
                <td><input type="number" name="items[${count}][price]" class="price border px-2 py-1 w-full"></td>
                <td>
                    <select name="items[${count}][discount_type]" class="discount_type select2 w-full">
                        <option value="value">Value</option>
                        <option value="percentage">Percentage</option>
                    </select>
                    <input type="number" name="items[${count}][discount]" class="discount mt-1 border px-2 py-1 w-full">
                </td>
                <td>
                    <select name="items[${count}][tax_type]" class="tax_type select2 w-full">
                        <option value="without">Without Tax</option>
                        <option value="with">With Tax</option>
                    </select>
                    <input type="number" name="items[${count}][tax]"
                           class="tax_rate mt-1 border px-2 py-1 w-full"
                           placeholder="Tax %" style="display:none;">
                </td>
                <td>
                    <input type="text" name="items[${count}][amount]" class="amount border px-2 py-1 w-full" readonly>
                    <div class="text-xs text-gray-500 leading-tight mt-1">
                        <div>Base Price: ₹ <span class="base-val">0.00</span></div>
                        <div>GST: ₹ <span class="gst-val">0.00</span></div>
                    </div>
                </td>
                <td class="text-center">
                    <button type="button" class="removeRow bg-red-600 text-white px-2 py-1 rounded">Remove</button>
                </td>
            </tr>
        `);

        tbody.append(row);
        row.find('.select2').select2({ width: '100%' });
    });

    // -----------------------------------------------------
    // 10. REMOVE ROW
    // -----------------------------------------------------
    $(document).on('click', '.removeRow', function() {
        if ($('#itemsTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            calculateTotals();
        } else {
            alert('At least one row is required.');
        }
    });

    // -----------------------------------------------------
    // 11. INITIAL CALCULATION (FOR EDIT MODE)
    // -----------------------------------------------------
    $('#itemsTable tbody tr').each(function() {
        calculateRow($(this));
    });
    calculateTotals();

});
</script>
@endsection
