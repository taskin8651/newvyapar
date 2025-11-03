@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <form id="saleForm" action="{{ route('admin.sale-invoices.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-lg mb-6">
                <h1 class="text-3xl font-bold">SALE INVOICE</h1>
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

            <!-- Customer Info (unchanged) -->
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
                                    <!-- ... rest unchanged ... -->
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

                <!-- Invoice Details (unchanged) -->
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
                                            <option value="{{ $item->id }}"
                                                data-sale-price="{{ $item->sale_price ?? $item->purchase_price ?? 0 }}"
                                                data-purchase-price="{{ $item->purchase_price ?? 0 }}"
                                                data-unit="{{ $item->select_unit->unit_name ?? '' }}"
                                                data-hsn="{{ $item->item_hsn }}"
                                                data-code="{{ $item->item_code }}"
                                                data-item-type="{{ $item->item_type }}"
                                                data-stock="{{ $item->stock_qty ?? 0 }}">
                                                {{ $item->item_name }} ({{ ucfirst($item->item_type) }})
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
                                    <input type="number" name="items[0][tax]" class="tax_rate w-full mt-1 border px-2 py-1" value="0" step="0.01" placeholder="Tax %" style="display:none;">
                                </td>
                                <td class="px-1 py-1"><input type="text" name="items[0][amount]" class="amount w-full border px-2 py-1" readonly></td>
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
                                    <p class="text-xs text-gray-500">Profit / Loss:</p>
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
<!-- You will place this modal on your index page; included here as example -->
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

    // Save original options markup for item selects so we can reconstruct selects for cloned rows
    const masterItemOptions = $('#itemsTable tbody tr.item-row').first().find('.item-select').html();

    // Customer details (unchanged)
    $('#customer_id').on('change', function() {
        let customerId = $(this).val();
        if (!customerId) {
            $('#customerDetailsCard').addClass('hidden');
            return;
        }
        $.get("{{ route('admin.saleInvoice.getCustomerDetails', '') }}/" + customerId, function(data) {
            function stripTags(input) { return $('<div>').html(input).text(); }
            $('#customer_name').text(stripTags(data.party_name));
            $('#customer_gstin').text(stripTags(data.gstin));
            $('#customer_phone').text(stripTags(data.phone_number));
            $('#customer_pan').text(stripTags(data.pan_number));
            $('#customer_billing_address').text(stripTags(data.billing_address));
            $('#customer_shipping_address').text(stripTags(data.shipping_address));
            $('#customer_state').text(stripTags(data.state));
            $('#customer_city').text(stripTags(data.city));
            $('#customer_pincode').text(stripTags(data.pincode));
            $('#customer_email').text(stripTags(data.email));
            $('#customer_credit_limit').text(stripTags(data.credit_limit));
            $('#customer_payment_terms').text(stripTags(data.payment_terms));
            // Opening / Current balances
            function formatBalance(balance, type) {
                balance = parseFloat(balance) || 0; type = type || 'Debit';
                let label = type === 'Debit' ? 'Payable' : 'Receivable';
                let arrow = type === 'Debit' ? '↑' : '↓';
                let colorClass = type === 'Debit' ? 'text-red-600 font-bold' : 'text-green-700 font-bold';
                return { text: `${balance.toFixed(2)} (${type}) ${label} ${arrow}`, class: colorClass }
            }
            let opening = formatBalance(data.opening_balance, data.opening_balance_type);
            $('#opening_balance_type').text(opening.text).removeClass('text-red-600 text-green-700 font-bold').addClass(opening.class);
            let current = formatBalance(data.current_balance, data.current_balance_type);
            $('#current_balance_type').text(current.text).removeClass('text-red-600 text-green-700 font-bold').addClass(current.class);
            $('#current_balance_date').text(data.updated_at || '-');
            $('#invoice_customer_phone').val(stripTags(data.phone_number));
            $('#invoice_billing_address').val(stripTags(data.billing_address));
            $('#customerDetailsCard').removeClass('hidden');
        });
    });

    // Composition cache for selected items (by add_item_id)
    let compositionCache = {};

    // function to render composition to right panel
    function renderComposition(rows, finishedQty, finishedSaleUnitPrice) {
        if (!rows || rows.length === 0) {
            $('#compositionPlaceholder').show();
            $('#compositionDetails').hide();
            return;
        }
        $('#compositionPlaceholder').hide();
        $('#compositionDetails').show();
        const tbody = $('#compositionRows').empty();
        let totalPurchase = 0, totalSale = 0;

        // finishedQty: quantity of finished good in invoice (integer)
        finishedQty = parseFloat(finishedQty) || 1;
        finishedSaleUnitPrice = parseFloat(finishedSaleUnitPrice) || 0;

        rows.forEach(r => {
            // r.qty_used is quantity of raw material used PER finished good unit
            const perUnitQtyUsed = parseFloat(r.qty_used) || 0;
            const usedQty = perUnitQtyUsed * finishedQty; // total used for invoice qty
            const salePriceUnit = parseFloat(r.sale_price || 0);
            const purchasePriceUnit = parseFloat(r.purchase_price || 0);

            const itemSaleTotal = usedQty * salePriceUnit;
            const itemPurchaseTotal = usedQty * purchasePriceUnit;

            totalSale += itemSaleTotal;
            totalPurchase += itemPurchaseTotal;

            tbody.append(`
                <tr>
                    <td class="py-1">${r.name}</td>
                    <td class="py-1">${usedQty}</td>
                    <td class="py-1">₹ ${salePriceUnit.toFixed(2)}</td>
                    <td class="py-1">₹ ${purchasePriceUnit.toFixed(2)}</td>
                    <td class="py-1">₹ ${itemSaleTotal.toFixed(2)}</td>
                    <td class="py-1">₹ ${itemPurchaseTotal.toFixed(2)}</td>
                </tr>
            `);
        });

        // Total sale of finished goods according to finishedQty and finishedSaleUnitPrice
        const finishedGoodsSaleTotal = finishedQty * finishedSaleUnitPrice;

        $('#comp_total_purchase').text(totalPurchase.toFixed(2));
        $('#comp_total_sale').text(finishedGoodsSaleTotal.toFixed(2));
        const profit = finishedGoodsSaleTotal - totalPurchase;
        $('#comp_profit').text(profit.toFixed(2));
        $('#comp_profit_label').toggleClass('text-green-600', profit>=0).toggleClass('text-red-600', profit<0);
    }

    // When an item is selected in any row: auto-fill price, unit and fetch composition if product
    $(document).on('change', '.item-select', function(){
        let row = $(this).closest('tr');
        let selected = $(this).find(':selected');
        if(selected.val() === '') {
            // clear row fields
            row.find('.price').val('');
            row.find('.unit').text('');
            row.find('.description').text('');
            return;
        }

        const itemId = selected.val();
        const salePrice = parseFloat(selected.data('sale-price') || 0);
        const purchasePrice = parseFloat(selected.data('purchase-price') || 0);
        const unitText = selected.data('unit') || '';
        const itemType = selected.data('item-type') || 'product';
        const itemHSN = selected.data('hsn') || '';
        const itemCode = selected.data('code') || '';

        // Auto-fill sale price in price input
        row.find('.price').val(salePrice.toFixed(2));
        row.find('.unit').text(unitText);
        row.find('.qty').attr('max', selected.data('stock') || 0).val(1);

        // Fill description with item_type, item_hsn, item_code
        const descriptionText = `Type: ${itemType} | HSN: ${itemHSN} | Code: ${itemCode}`;
        row.find('.description').text(descriptionText);

        // Recalculate row totals and overall
        // Show/hide tax input correctly
        if(row.find('.tax_type').val()==='with'){ row.find('.tax_rate').show(); } else { row.find('.tax_rate').hide().val(0); }
        calculateRow(row); calculateTotals();

        // Reconstruct other selects to avoid removing options permanently:
        // We DO NOT remove option from other selects here to allow multiple same items on purpose.
        // If you still want unique selections, handle on server-side or maintain a more complex state.

        // If product – fetch its composition (raw materials used to make it)
        if(itemType === 'product') {
            // use cache if exists
            if(compositionCache[itemId]) {
                // use cache
                const finishedQty = row.find('.qty').val() || 1;
                renderComposition(compositionCache[itemId], finishedQty, salePrice);
            } else {
                // AJAX fetch composition
                $.get("{{ route('admin.saleInvoice.getItemComposition', '') }}/"+itemId, function(resp){
                    // resp expected: { composition: [ {id,name,qty_used,sale_price,purchase_price}, ... ] }
                    compositionCache[itemId] = resp.composition || [];
                    const finishedQty = row.find('.qty').val() || 1;
                    renderComposition(compositionCache[itemId], finishedQty, salePrice);
                }).fail(function(){
                    compositionCache[itemId] = [];
                    renderComposition([], 1, salePrice);
                });
            }
        } else {
            // service or raw item: simple composition - itself as service/raw
            const finishedQty = row.find('.qty').val() || 1;
            const svc = [{ id: itemId, name: selected.text(), qty_used: 1, sale_price: salePrice, purchase_price: purchasePrice }];
            renderComposition(svc, finishedQty, salePrice);
        }
    });

    // Calculation functions - corrected to avoid double counting tax and to compute amounts cleanly
    function calculateRow(row){
        let qty = parseFloat(row.find('.qty').val()) || 0;
        let price = parseFloat(row.find('.price').val()) || 0;
        let discountVal = parseFloat(row.find('.discount').val()) || 0;
        let discountType = row.find('.discount_type').val();
        let taxRate = parseFloat(row.find('.tax_rate').val()) || 0;
        let taxType = row.find('.tax_type').val();

        // base amount before tax
        let baseAmount = price * qty;

        // compute discount amount
        let discountAmount = 0;
        if(discountType === 'percentage'){
            discountAmount = baseAmount * (discountVal/100);
        } else {
            discountAmount = discountVal;
        }
        let amountAfterDiscount = baseAmount - discountAmount;

        // tax amount (if tax applies)
        let taxAmount = 0;
        if(taxType === 'with'){ // 'with' means tax to be applied on top
            taxAmount = amountAfterDiscount * (taxRate/100);
        }

        // final row amount (without storing tax separately in the field)
        let finalAmount = amountAfterDiscount + taxAmount;

        row.find('.amount').val(finalAmount.toFixed(2));
        // store data attributes for debugging / usage
        row.data('row-base', baseAmount);
        row.data('row-discount', discountAmount);
        row.data('row-tax', taxAmount);
    }

    function calculateTotals(){
        let subtotal=0, discountTotal=0, taxTotal=0;
        $('#itemsTable tbody tr').each(function(){
            let row = $(this);
            let amount = parseFloat(row.find('.amount').val()) || 0;
            subtotal += (parseFloat(row.data('row-base')) || 0) - (parseFloat(row.data('row-discount')) || 0); // sum of base-after-discount
            discountTotal += parseFloat(row.data('row-discount')) || 0;
            taxTotal += parseFloat(row.data('row-tax')) || 0;
        });

        let overallDiscount = parseFloat($('#overall_discount').val()) || 0;
        // overallDiscount is subtracted after row-level discounts/taxes
        let total = subtotal + taxTotal - overallDiscount;

        $('#subtotal_display').text(subtotal.toFixed(2));
        $('#tax_display').text(taxTotal.toFixed(2));
        $('#discount_display').text((discountTotal + overallDiscount).toFixed(2));
        $('#total_display').text(total.toFixed(2));

        $('#subtotal').val(subtotal.toFixed(2));
        $('#tax_input').val(taxTotal.toFixed(2));
        $('#discount_input').val((discountTotal + overallDiscount).toFixed(2));
        $('#total_input').val(total.toFixed(2));

        // update composition panel profit calculation using latest selected product & its qty
        const activeSelects = $('.item-select');
        // find selected product (first one with an item_type 'product'); preferentially pick focused row
        let focusedRow = $(':focus').closest('tr');
        if(focusedRow.length === 0) {
            // fallback to first row
            focusedRow = $('#itemsTable tbody tr').first();
        }
        const activeItemId = focusedRow.find('.item-select').find(':selected').val();
        const finishedQty = focusedRow.find('.qty').val() || 1;
        const finishedSaleUnitPrice = parseFloat(focusedRow.find('.price').val()) || 0;
        if(activeItemId && compositionCache[activeItemId]) {
            renderComposition(compositionCache[activeItemId], finishedQty, finishedSaleUnitPrice);
        } else if(activeItemId) {
            // try fetch if not cached
            const itemType = focusedRow.find('.item-select').find(':selected').data('item-type') || 'product';
            if(itemType === 'product') {
                $.get("{{ route('admin.saleInvoice.getItemComposition', '') }}/"+activeItemId, function(resp){
                    compositionCache[activeItemId] = resp.composition || [];
                    renderComposition(compositionCache[activeItemId], finishedQty, finishedSaleUnitPrice);
                }).fail(function(){
                    renderComposition([], finishedQty, finishedSaleUnitPrice);
                });
            } else {
                // service/raw fallback
                const name = focusedRow.find('.item-select').find(':selected').text();
                const purchasePrice = parseFloat(focusedRow.find('.item-select').find(':selected').data('purchase-price') || 0);
                const svc = [{ id: activeItemId, name: name, qty_used: 1, sale_price: finishedSaleUnitPrice, purchase_price: purchasePrice }];
                renderComposition(svc, finishedQty, finishedSaleUnitPrice);
            }
        } else {
            // nothing selected
            renderComposition([], 1, 0);
        }
    }

    $(document).on('input change', '.qty, .price, .discount, .discount_type, .tax_type, .tax_rate, #overall_discount', function(){
        let row = $(this).closest('tr');
        let maxQty = parseFloat(row.find('.qty').attr('max')) || 999999;
        if(parseFloat(row.find('.qty').val())>maxQty){ row.find('.qty').val(maxQty); }
        if(row.find('.tax_type').val()==='with'){ row.find('.tax_rate').show(); } else { row.find('.tax_rate').hide().val(0); }
        calculateRow(row); calculateTotals();
    });

    // Add/remove rows
    $('#addRow').click(function(){
        let tbody = $('#itemsTable tbody');
        let newRow = $('<tr class="item-row"></tr>');
        const rowCount = tbody.find('tr').length;
        // build markup similar to first row but with input names updated
        const markup = `
            <td class="px-1 py-1">
                <select name="items[${rowCount}][add_item_id]" class="form-select item-select select2">
                    <option value="">-- Select Item --</option>
                    ${masterItemOptions}
                </select>
            </td>
            <td class="px-1 py-1 description"></td>
            <td class="px-1 py-1"><input type="number" name="items[${rowCount}][qty]" class="qty w-full border px-2 py-1" min="1" value="1"></td>
            <td class="px-1 py-1 unit"></td>
            <td class="px-1 py-1"><input type="number" name="items[${rowCount}][price]" class="price w-full border px-2 py-1" step="0.01"></td>
            <td class="px-1 py-1">
                <select name="items[${rowCount}][discount_type]" class="discount_type w-full select2">
                    <option value="value">Value</option>
                    <option value="percentage">Percentage</option>
                </select>
                <input type="number" name="items[${rowCount}][discount]" class="discount w-full mt-1 border px-2 py-1" value="0" step="0.01">
            </td>
            <td class="px-1 py-1">
                <select name="items[${rowCount}][tax_type]" class="tax_type w-full select2">
                    <option value="without">Without Tax</option>
                    <option value="with">With Tax</option>
                </select>
                <input type="number" name="items[${rowCount}][tax]" class="tax_rate w-full mt-1 border px-2 py-1" value="0" step="0.01" placeholder="Tax %" style="display:none;">
            </td>
            <td class="px-1 py-1"><input type="text" name="items[${rowCount}][amount]" class="amount w-full border px-2 py-1" readonly></td>
            <td class="px-1 py-1 text-center"><button type="button" class="removeRow bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button></td>
        `;
        newRow.html(markup);
        tbody.append(newRow);
        // init select2 on new selects
        newRow.find('.select2').select2({ width: '100%' });
        // set default values & run calculating
        newRow.find('.qty').val(1);
        calculateRow(newRow);
        calculateTotals();
    });

    $(document).on('click', '.removeRow', function(){
        let tbody = $('#itemsTable tbody');
        if(tbody.find('tr').length>1){
            $(this).closest('tr').remove();
            calculateTotals();
        } else { alert('At least one row is required'); }
    });

    // Initial calc
    // initialize first row select2 properly
    $('#itemsTable tbody tr.item-row').find('.select2').select2({ width: '100%' });
    calculateTotals();

    // ---------- Modal sample handlers (for index page) ----------
    window.openInvoiceModal = function(invoiceId) {
        $('#invoiceModalContent').html('Loading...');
        $('#invoiceDetailsModal').removeClass('hidden').addClass('flex');
        $.get("{{ route('admin.saleInvoice.profitDetails', '') }}/" + invoiceId, function(resp) {
            let html = '<div class="prose">';
            html += `<p><strong>Invoice:</strong> ${resp.invoice.sale_invoice_number} | <strong>Customer:</strong> ${resp.customer_name}</p>`;
            html += `<p><strong>Total Purchase Cost:</strong> ₹ ${parseFloat(resp.total_purchase_value||0).toFixed(2)}</p>`;
            html += `<p><strong>Total Sale Value:</strong> ₹ ${parseFloat(resp.total_sale_value||0).toFixed(2)}</p>`;
            html += `<p><strong>Profit/Loss:</strong> ₹ ${parseFloat(resp.profit_loss_amount||0).toFixed(2)} (${resp.is_profit ? 'Profit' : 'Loss'})</p>`;
            html += '<hr/>';
            if(resp.composition && resp.composition.length) {
                html += '<table class="min-w-full text-sm"><thead><tr><th>Name</th><th>Qty</th><th>Sale Price</th><th>Purchase Price</th><th>Item Sale Total</th><th>Item Purchase Total</th></tr></thead><tbody>';
                resp.composition.forEach(c=>{
                    html += `<tr><td>${c.name}</td><td>${c.qty_used}</td><td>₹ ${parseFloat(c.sale_price||0).toFixed(2)}</td><td>₹ ${parseFloat(c.purchase_price||0).toFixed(2)}</td><td>₹ ${(c.qty_used*c.sale_price).toFixed(2)}</td><td>₹ ${(c.qty_used*c.purchase_price).toFixed(2)}</td></tr>`;
                });
                html += '</tbody></table>';
            } else {
                html += '<p>No composition stored for this invoice.</p>';
            }
            html += '</div>';
            $('#invoiceModalContent').html(html);
        }).fail(function(){
            $('#invoiceModalContent').html('<p class="text-red-500">Could not load details.</p>');
        });
    };

    $('#closeInvoiceModal').on('click', function(){ $('#invoiceDetailsModal').addClass('hidden').removeClass('flex'); });

});
</script>

@endsection
