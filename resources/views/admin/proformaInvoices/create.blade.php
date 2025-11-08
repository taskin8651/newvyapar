@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <form id="saleForm" action="{{ route('admin.sale-invoices.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-lg mb-6">
                <h1 class="text-3xl font-bold">DELEVERY CHALLAN</h1>
                <div class="flex mt-4 space-x-6">
                    <label class="flex items-center">
                        <input type="radio" name="payment_type" value="credit" class="h-4 w-4 text-white" checked>
                        <span class="ml-2">Credit</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment_type" value="cash" class="h-4 w-4 text-white">
                        <span class="ml-2">Cash</span>
                    </label>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Bill To</h2>
                    <select name="select_customer_id" id="customer_id" class="form-select select2 w-full" required>
                        <option value="">-- Select Customer --</option>
                        @foreach($select_customers as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>

                    <div id="customerDetailsCard" class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-white border-4 border-blue-300 rounded-xl shadow-xl hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto text-sm">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Name</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_name"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">GSTIN</td>
                                        <td class="px-3 py-2 text-green-700 font-medium" id="customer_gstin"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Phone</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_phone"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">PAN</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_pan"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Billing Address</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_billing_address"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Shipping Address</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_shipping_address"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">State</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_state"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">City</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_city"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Pincode</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_pincode"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Email</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_email"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Credit Limit</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_credit_limit"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Payment Terms</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_payment_terms"></td>
                                    </tr>
                                    <tr class="bg-gray-50">
                                        <td class="px-3 py-2 font-semibold text-gray-700">Opening Balance</td>
                                        <td class="px-3 py-2 space-y-1">
                                            <div id="opening_balance_type" class="text-sm"></div>
                                            <div id="opening_balance_date" class="text-gray-500 text-xs italic"></div>
                                        </td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Current Balance</td>
                                        <td class="px-3 py-2 space-y-1">
                                            <div id="current_balance_type" class="text-sm"></div>
                                            <div id="current_balance_date" class="text-gray-500 text-xs italic"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 required">Select Main Cost Center</label>
                        <select name="main_cost_center_id" id="main_cost_center_id"
                                class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm" required>
                            @foreach($cost as $id => $name)
                                <option value="{{ $id }}" {{ old('main_cost_center_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 required" >Select Sub Cost Center</label>
                        <select name="sub_cost_center_id" id="sub_cost_center_id"
                                class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm" required>
                            <option value="">-- Select Sub Cost Center --</option>
                        </select>
                    </div>
                </div>

                <!-- Invoice Details -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Invoice Details</h2>
                    @php
                    $datePart = date('Ymd');
                    $lastPO = \App\Models\SaleInvoice::whereDate('created_at', now()->format('Y-m-d'))
                        ->orderBy('id', 'desc')
                        ->first();
                    $serial = $lastPO ? intval(substr($lastPO->po_no, -4)) + 1 : 1;
                    $serial = str_pad($serial, 4, '0', STR_PAD_LEFT);
                    $poNo = 'PO-'.$datePart.'-'.$serial;
                    @endphp

                    <input type="text" name="po_no" value="{{ $poNo }}" placeholder="Invoice/PO No." class="w-full rounded-md border px-3 py-2">
                    <input type="text" name="docket_no" placeholder="Docket Number" class="w-full rounded-md border px-3 py-2 mt-2">

                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <div class="flex flex-col">
                            <label for="po_date" class="mb-1 font-semibold">Billing Date</label>
                            <input type="date" id="po_date" name="po_date" 
                            class="w-full rounded-md border px-3 py-2"
                            value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="flex flex-col">
                            <label for="due_date" class="mb-1 font-semibold"> Bill Date</label>
                            <input type="date" id="due_date" name="due_date" class="w-full rounded-md border px-3 py-2">
                        </div>
                    </div>

                    <input type="text" name="e_way_bill_no" placeholder="E-Way Bill No." class="w-full rounded-md border px-3 py-2 mt-2">
                    <input type="text" name="customer_phone_invoice" id="invoice_customer_phone" placeholder="Customer Phone" class="w-full rounded-md border px-3 py-2 mt-2">
                    <textarea name="billing_address_invoice" id="invoice_billing_address" rows="2" class="w-full rounded-md border px-3 py-2 mt-2" placeholder="Billing Address"></textarea>
                    <textarea name="shipping_address_invoice" id="customer_shipping_address2" rows="2" class="w-full rounded-md border px-3 py-2 mt-2" placeholder="Shipping Address"></textarea>
                </div>
            </div>

            <!-- Items Table -->
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
                            <tr class="item-row">
                                <td class="px-1 py-1">
                                    <select name="items[0][add_item_id]" class="form-select item-select select2">
                                        <option value="">-- Select Item --</option>
                                        @foreach($items as $item)
                                            <option 
                                                value="{{ $item->id }}"
                                                data-sale-price="{{ $item->sale_price ?? $item->purchase_price ?? 0 }}"
                                                data-purchase-price="{{ $item->purchase_price ?? 0 }}"
                                                data-unit="{{ $item->select_unit->unit_name ?? '' }}"
                                                data-hsn="{{ $item->item_hsn ?? '' }}"
                                                data-code="{{ $item->item_code ?? '' }}"
                                                data-item-type="{{ $item->item_type ?? 'product' }}"
                                                @if($item->item_type === 'product')
                                                    data-stock="{{ $item->stock_qty ?? 0 }}"
                                                @else
                                                    data-stock="0"
                                                @endif
                                            >
                                                {{ $item->item_name }} ({{ ucfirst($item->item_type ?? 'Product') }})
                                                @if($item->item_type === 'product' && $item->stock_qty !== null)
                                                    - Stock: {{ $item->stock_qty }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-1 py-1 description"></td>
                                <td class="px-1 py-1"><input type="number" name="items[0][qty]" class="qty w-full border px-2 py-1" min="1" value="1"></td>
                                <td class="px-1 py-1 unit"></td>
                                <td class="px-1 py-1"><input type="number" name="items[0][price]" class="price w-full border px-2 py-1" step="0.01"></td>
                                <td class="px-1 py-1">
                                    <select name="items[0][discount_type]" class="discount_type w-full select2">
                                        <option value="value">Value</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                    <input type="number" name="items[0][discount]" class="discount w-full mt-1 border px-2 py-1" value="0" step="0.01">
                                </td>
                                <td class="px-1 py-1">
                                    <select name="items[0][tax_type]" class="tax_type w-full select2">
                                        <option value="without">Without Tax</option>
                                        <option value="with">With Tax</option>
                                    </select>
                                    <div class="flex items-center gap-2">
                                        <input type="number" name="items[0][tax]" class="tax_rate w-full mt-1 border px-2 py-1" value="0" step="0.01" placeholder="Tax %" style="display:none;">
                                        <!-- 🟢 GST Applied indicator -->
                                        <span class="gst-applied text-green-600 text-xs font-medium hidden">GST Applied ✅</span> <!-- 🧾 Base Price & GST Display Added -->
                                    </div>
                                </td>
                                <td class="px-1 py-1">
                                    <input type="text" name="items[0][amount]" class="amount w-full border px-2 py-1" readonly>
                                    <!-- 🧾 Base Price & GST Display Added -->
                                    <div class="text-xs text-gray-500 leading-tight mt-1 base-gst-lines">
                                        <div class="base-line">Base Price: ₹ <span class="base-val">0.00</span></div>
                                        <div class="gst-line">GST: ₹ <span class="gst-val">0.00</span></div>
                                    </div>
                                </td>
                                <td class="px-1 py-1 text-center"><button type="button" class="removeRow bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex space-x-2 mt-4">
                    <button type="button" id="addRow" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Row</button>
                </div>
            </div>

            <!-- Right column: Totals & Composition Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4">
                    <textarea name="notes" rows="3" class="w-full rounded-md border px-3 py-2" placeholder="Notes"></textarea>
                    <textarea name="terms" rows="3" class="w-full rounded-md border px-3 py-2" placeholder="Terms & Conditions"></textarea>
                    
                    <!-- COMPOSITION SUMMARY (real-time) -->
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
                                        <th>Used Qty (for invoice qty)</th>
                                        <th>Sale Price (unit)</th>
                                        <th>Purchase Price (unit)</th>
                                        <th>Item Sale Total</th>
                                        <th>Item Purchase Total</th>
                                        <th>Item Profit/Loss</th>
                                    </tr>
                                </thead>
                                <tbody id="compositionRows"></tbody>
                            </table>

                            <div class="flex justify-between">
                                <div>
                                    <p class="text-xs text-gray-500">Total Purchase Cost:</p>
                                    <p class="font-semibold">₹ <span id="comp_total_purchase">0.00</span></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Total Sale Value (from composition):</p>
                                    <p class="font-semibold">₹ <span id="comp_total_sale">0.00</span></p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Overall Profit / Loss:</p>
                                    <p id="comp_profit_label" class="font-semibold text-green-600">₹ <span id="comp_profit">0.00</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="mb-2">
                        <label class="font-semibold">Overall Discount:</label>
                        <input type="number" name="overall_discount" id="overall_discount" class="w-full border px-2 py-1 mt-1" value="0" step="0.01">
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span id="subtotal_display">0.00</span>
                            <input type="hidden" name="subtotal" id="subtotal" value="0.00">
                        </div>
                        <div class="flex justify-between">
                            <span>Tax:</span>
                            <span id="tax_display">0.00</span>
                            <input type="hidden" name="tax" id="tax_input" value="0.00">
                        </div>
                        <div class="flex justify-between">
                            <span>Discount:</span>
                            <span id="discount_display">0.00</span>
                            <input type="hidden" name="discount" id="discount_input" value="0.00">
                        </div>
                        <div class="flex justify-between border-t pt-2 font-bold">
                            <span>Total:</span>
                            <span id="total_display">0.00</span>
                            <input type="hidden" name="total" id="total_input" value="0.00">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="font-semibold">Attachment:</label>
                        <input type="file" name="attachment" class="w-full border px-3 py-2 rounded-md">
                    </div>
                    <div class="mt-6">
                        <button type="submit" id="saveInvoiceBtn" class="w-full bg-green-600 text-white py-3 rounded-md hover:bg-green-700">SAVE INVOICE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Index view (sample) -->
<div id="invoiceDetailsModal" class="fixed inset-0 z-50 items-center justify-center hidden">
  <div class="absolute inset-0 bg-black opacity-40"></div>
  <div class="relative bg-white max-w-3xl mx-auto rounded p-6 z-50 overflow-auto" style="max-height:90vh;">
    <button id="closeInvoiceModal" class="mb-4 float-right px-3 py-1 bg-red-500 text-white rounded">Close</button>
    <h3 class="text-xl font-semibold mb-3">Invoice Composition & Profit/Loss</h3>
    <div id="invoiceModalContent">Loading...</div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({ width: '100%' });

    // 🔹 Save master options to clone rows dynamically
    const masterItemOptions = $('#itemsTable tbody tr.item-row')
        .first().find('.item-select').html();

    // 🔹 Customer selection → fetch & fill details
    $('#customer_id').on('change', function() {
        const customerId = $(this).val();
        if (!customerId) return $('#customerDetailsCard').addClass('hidden');

        $.get("{{ route('admin.saleInvoice.getCustomerDetails', '') }}/" + customerId, function(data) {
            function clean(t) { return $('<div>').html(t).text(); }

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
            $('#customer_credit_limit').text(clean(data.credit_limit));
            $('#customer_payment_terms').text(clean(data.payment_terms));

            // Opening/current balances display
            function fmt(balance, type) {
                balance = parseFloat(balance) || 0; type = type || 'Debit';
                const label = type === 'Debit' ? 'Payable' : 'Receivable';
                const arrow = type === 'Debit' ? '↑' : '↓';
                const cls = type === 'Debit' ? 'text-red-600 font-bold' : 'text-green-700 font-bold';
                return { txt: `${balance.toFixed(2)} (${type}) ${label} ${arrow}`, cls };
            }
            const open = fmt(data.opening_balance, data.opening_balance_type);
            $('#opening_balance_type').text(open.txt)
                .removeClass('text-red-600 text-green-700 font-bold').addClass(open.cls);

            const curr = fmt(data.current_balance, data.current_balance_type);
            $('#current_balance_type').text(curr.txt)
                .removeClass('text-red-600 text-green-700 font-bold').addClass(curr.cls);

            $('#current_balance_date').text(data.updated_at || '-');
            $('#invoice_customer_phone').val(clean(data.phone_number));
            $('#invoice_billing_address').val(clean(data.billing_address));
            $('#customerDetailsCard').removeClass('hidden');
        });
    });

    // 🔹 Cache for product compositions
    let compositionCache = {};

    // 🔹 Render composition for right panel
    function renderComposition(rows, finishedQty, finishedSalePrice) {
        if (!rows || !rows.length) {
            $('#compositionPlaceholder').show();
            $('#compositionDetails').hide();
            return;
        }
        $('#compositionPlaceholder').hide();
        $('#compositionDetails').show();

        const tbody = $('#compositionRows').empty();
        let totalPurchase = 0;
        finishedQty = parseFloat(finishedQty) || 1;
        finishedSalePrice = parseFloat(finishedSalePrice) || 0;

        rows.forEach(r => {
            const usedQty = (parseFloat(r.qty_used) || 0) * finishedQty;
            const sale = (parseFloat(r.sale_price) || 0) * usedQty;
            const purchase = (parseFloat(r.purchase_price) || 0) * usedQty;
            const diff = sale - purchase;
            totalPurchase += purchase;

            tbody.append(`
                <tr>
                    <td>${r.name}</td>
                    <td>${usedQty}</td>
                    <td>₹ ${parseFloat(r.sale_price || 0).toFixed(2)}</td>
                    <td>₹ ${parseFloat(r.purchase_price || 0).toFixed(2)}</td>
                    <td>₹ ${sale.toFixed(2)}</td>
                    <td>₹ ${purchase.toFixed(2)}</td>
                    <td class="${diff >= 0 ? 'text-green-600' : 'text-red-600'}">₹ ${diff.toFixed(2)}</td>
                </tr>
            `);
        });

        const finishedSaleTotal = finishedQty * finishedSalePrice;
        const profit = finishedSaleTotal - totalPurchase;
        $('#comp_total_purchase').text(totalPurchase.toFixed(2));
        $('#comp_total_sale').text(finishedSaleTotal.toFixed(2));
        $('#comp_profit').text(profit.toFixed(2));
        $('#comp_profit_label')
            .toggleClass('text-green-600', profit >= 0)
            .toggleClass('text-red-600', profit < 0);
    }

    // ✅ GST Reverse Calculation helper — returns {basePerUnit, gstPerUnit}
    // ✅ GST Reverse Calculation Added
    function reverseGST(priceIncl, taxRate) {
        priceIncl = parseFloat(priceIncl) || 0;
        taxRate = parseFloat(taxRate) || 0;
        if (taxRate <= 0) return { basePerUnit: priceIncl, gstPerUnit: 0 };
        const divisor = 1 + (taxRate / 100);
        const base = priceIncl / divisor;
        const gst = priceIncl - base;
        return { basePerUnit: base, gstPerUnit: gst };
    }

    // 🔹 When item is selected
    $(document).on('change', '.item-select', function() {
        const row = $(this).closest('tr');
        const sel = $(this).find(':selected');

        if (!sel.val()) {
            row.find('.price, .unit, .description').val('').text('');
            return;
        }

        const itemId = sel.val();
        const salePrice = parseFloat(sel.data('sale-price')) || 0;
        const purchasePrice = parseFloat(sel.data('purchase-price')) || 0;
        const unit = sel.data('unit') || '';
        const type = sel.data('item-type') || 'product';
        const hsn = sel.data('hsn') || '';
        const code = sel.data('code') || '';

        row.find('.price').val(salePrice.toFixed(2));
        row.find('.unit').text(unit);
        row.find('.description').text(`Type: ${type} | HSN: ${hsn} | Code: ${code}`);

        // 🔥 Auto GST 18% Applied
        row.find('.tax_type').val('with').trigger('change');
        row.find('.tax_rate').val(18).show(); // keep editable

        // Small green indicator for 2.5s
        const badge = row.find('.gst-applied');
        badge.removeClass('hidden');
        setTimeout(() => badge.addClass('hidden'), 2500);

        // ✅ Handle stock only for product type
        if (type === 'product') {
            const stockQty = parseFloat(sel.data('stock')) || 0;

            if (stockQty > 0) {
                row.find('.qty')
                    .attr('min', 1)
                    .attr('max', stockQty)
                    .attr('placeholder', `Max: ${stockQty}`)
                    .val(1)
                    .prop('readonly', false);
            } else {
                row.find('.qty')
                    .attr('min', 0)
                    .removeAttr('max')
                    .attr('placeholder', 'Out of stock')
                    .val(0)
                    .prop('readonly', true);

                alert(`⚠️ This item is out of stock and cannot be sold.`);
            }
        } else {
            // Service → no stock restriction
            row.find('.qty')
                .removeAttr('max')
                .removeAttr('min')
                .removeAttr('placeholder')
                .prop('readonly', false)
                .val(1);
        }

        calculateRow(row);   // ✅ GST Reverse Calculation Added (used inside)
        calculateTotals();

        // Composition (optional)
        if (type === 'product') {
            if (compositionCache[itemId]) {
                renderComposition(compositionCache[itemId], 1, salePrice);
            } else {
                $.get("{{ route('admin.saleInvoice.getItemComposition', '') }}/" + itemId, function(resp) {
                    compositionCache[itemId] = resp.composition || [];
                    renderComposition(resp.composition, 1, salePrice);
                }).fail(() => renderComposition([], 1, salePrice));
            }
        } else {
            renderComposition([
                { id: itemId, name: sel.text(), qty_used: 1, sale_price: salePrice, purchase_price: purchasePrice }
            ], 1, salePrice);
        }
    });

    // 🔹 Row calculation (RESPECT GST-INCLUDED PRICE)
    function calculateRow(row) {
        const qty = parseFloat(row.find('.qty').val()) || 0;
        const priceIncl = parseFloat(row.find('.price').val()) || 0; // GST-included per unit
        const discountVal = parseFloat(row.find('.discount').val()) || 0;
        const discountType = row.find('.discount_type').val();
        const taxRate = parseFloat(row.find('.tax_rate').val()) || 0;
        const taxType = row.find('.tax_type').val();

        let basePerUnit = priceIncl;
        let gstPerUnit = 0;

        if (taxType === 'with') {
            // ✅ Reverse GST because price includes tax
            const rev = reverseGST(priceIncl, taxRate);  // ✅ GST Reverse Calculation Added
            basePerUnit = rev.basePerUnit;
            gstPerUnit = rev.gstPerUnit;
        } else {
            // without tax => base is price, gst 0
            basePerUnit = priceIncl;
            gstPerUnit = 0;
        }

        // Amounts before discount
        let baseTotal = basePerUnit * qty;
        let gstTotal = gstPerUnit * qty;

        // Discount apply on base (common practice)
        let discAmt = discountType === 'percentage' ? baseTotal * (discountVal / 100) : discountVal;
        discAmt = Math.min(discAmt, baseTotal); // avoid negative base
        const baseAfterDisc = baseTotal - discAmt;

        // Recompute GST on discounted base
        let taxAmt = (taxType === 'with') ? (baseAfterDisc * (taxRate / 100)) : 0;

        // Final amount should be (baseAfterDisc + taxAmt)
        const final = baseAfterDisc + taxAmt;

        // NOTE: If no discount, final ~= qty * priceIncl (unchanged), as required.

        // Write per-row visible fields
        row.find('.amount').val(final.toFixed(2));
        row.find('.base-val').text(baseAfterDisc.toFixed(2)); // 🧾 Base Price & GST Display Added
        row.find('.gst-val').text(taxAmt.toFixed(2));         // 🧾 Base Price & GST Display Added

        // Store for totals
        row.data({
            base: baseAfterDisc,    // used in subtotal
            discAmt: discAmt,       // informative
            taxAmt: taxAmt,
            gross: final
        });
    }

    // 🔹 Totals calculation
    function calculateTotals() {
        let subtotal = 0, discountTotal = 0, taxTotal = 0, grossTotal = 0;

        $('#itemsTable tbody tr').each(function() {
            const d = $(this).data();
            subtotal += (d.base || 0);      // base after line-discount
            discountTotal += (d.discAmt || 0);
            taxTotal += (d.taxAmt || 0);
            grossTotal += (d.gross || 0);
        });

        const overallDiscount = parseFloat($('#overall_discount').val()) || 0;

        // Apply overall discount on base (pre-tax), then recompute tax? 
        // Simpler: subtract overall discount directly from gross total.
        // If you want to treat it as pre-tax, uncomment the alternative block below.

        let total = Math.max(grossTotal - overallDiscount, 0);

        // UI writes
        $('#subtotal_display').text(subtotal.toFixed(2));
        $('#tax_display').text(taxTotal.toFixed(2));
        $('#discount_display').text((discountTotal + overallDiscount).toFixed(2));
        $('#total_display').text(total.toFixed(2));

        $('#subtotal').val(subtotal.toFixed(2));
        $('#tax_input').val(taxTotal.toFixed(2));
        $('#discount_input').val((discountTotal + overallDiscount).toFixed(2));
        $('#total_input').val(total.toFixed(2));

        updateOverallComposition();
    }

    // 🔹 Recalculate on input change
    $(document).on('input change', '.qty, .price, .discount, .discount_type, .tax_type, .tax_rate, #overall_discount', function() {
        const row = $(this).closest('tr');
        if (row.find('.tax_type').val() === 'with') row.find('.tax_rate').show(); else row.find('.tax_rate').hide().val(0);
        calculateRow(row);
        calculateTotals();
    });

    // 🔹 Add new item row
    $('#addRow').click(function() {
        const tbody = $('#itemsTable tbody');
        const count = tbody.find('tr').length;
        const row = $(`
            <tr class="item-row">
                <td><select name="items[${count}][add_item_id]" class="form-select item-select select2">${masterItemOptions}</select></td>
                <td class="description"></td>
                <td><input type="number" name="items[${count}][qty]" class="qty border px-2 py-1 w-full" min="1" value="1"></td>
                <td class="unit"></td>
                <td><input type="number" name="items[${count}][price]" class="price border px-2 py-1 w-full" step="0.01"></td>
                <td>
                    <select name="items[${count}][discount_type]" class="discount_type select2 w-full"><option value="value">Value</option><option value="percentage">Percentage</option></select>
                    <input type="number" name="items[${count}][discount]" class="discount mt-1 border px-2 py-1 w-full" value="0" step="0.01">
                </td>
                <td>
                    <select name="items[${count}][tax_type]" class="tax_type select2 w-full"><option value="without">Without Tax</option><option value="with">With Tax</option></select>
                    <div class="flex items-center gap-2">
                        <input type="number" name="items[${count}][tax]" class="tax_rate mt-1 border px-2 py-1 w-full" value="0" step="0.01" placeholder="Tax %" style="display:none;">
                        <span class="gst-applied text-green-600 text-xs font-medium hidden">GST Applied ✅</span> <!-- 🧾 Base Price & GST Display Added -->
                    </div>
                </td>
                <td>
                    <input type="text" name="items[${count}][amount]" class="amount border px-2 py-1 w-full" readonly>
                    <div class="text-xs text-gray-500 leading-tight mt-1 base-gst-lines">
                        <div class="base-line">Base Price: ₹ <span class="base-val">0.00</span></div>
                        <div class="gst-line">GST: ₹ <span class="gst-val">0.00</span></div>
                    </div>
                </td>
                <td class="text-center"><button type="button" class="removeRow bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button></td>
            </tr>
        `);
        tbody.append(row);
        row.find('.select2').select2({ width: '100%' });
    });

    // 🔹 Remove row
    $(document).on('click', '.removeRow', function() {
        const tbody = $('#itemsTable tbody');
        if (tbody.find('tr').length > 1) {
            $(this).closest('tr').remove();
            calculateTotals();
        } else {
            alert('At least one row is required.');
        }
    });

    // 🔹 Update overall composition for profit/loss summary
    function updateOverallComposition() {
        let rows = [], totalSale = 0, totalPurchase = 0;
        $('#itemsTable tbody tr').each(function() {
            const sel = $(this).find('.item-select :selected');
            if (!sel.val()) return;
            const id = sel.val(), qty = parseFloat($(this).find('.qty').val()) || 1;
            const salePrice = parseFloat($(this).find('.price').val()) || 0;
            const purchasePrice = parseFloat(sel.data('purchase-price')) || 0;
            const type = sel.data('item-type') || 'product';
            totalSale += salePrice * qty;

            if (type === 'product' && compositionCache[id]) {
                compositionCache[id].forEach(c => {
                    const used = (parseFloat(c.qty_used) || 0) * qty;
                    const cost = used * (parseFloat(c.purchase_price) || 0);
                    totalPurchase += cost;
                    rows.push({ ...c, usedQty: used, itemPurchaseTotal: cost, itemSaleTotal: (used * (parseFloat(c.sale_price)||0)) });
                });
            } else {
                const cost = purchasePrice * qty;
                totalPurchase += cost;
                rows.push({ id, name: sel.text(), usedQty: qty, sale_price: salePrice, purchase_price: purchasePrice, itemPurchaseTotal: cost, itemSaleTotal: salePrice * qty });
            }
        });
        renderComposition(rows, 1, totalSale - totalPurchase);
    }

    // Init first row
    calculateRow($('#itemsTable tbody tr.item-row').first());
    calculateTotals();
});
</script> 

@endsection
