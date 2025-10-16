@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <form action="{{ route('admin.sale-invoices.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <td class="px-3 py-2 text-gray-800" id="customer_billing_address"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Shipping Address</td>
                                        <td class="px-3 py-2 text-gray-800" id="customer_shipping_address"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">State</td>
                                        <td class="px-3 py-2 text-indigo-700 font-medium" id="customer_state"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">City</td>
                                        <td class="px-3 py-2 text-indigo-700 font-medium" id="customer_city"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Pincode</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_pincode"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Email</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_email"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Credit Limit</td>
                                        <td class="px-3 py-2">
                                            <span id="customer_credit_limit" class="bg-yellow-100 text-yellow-800 px-2 rounded-full font-semibold text-xs"></span>
                                        </td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Payment Terms</td>
                                        <td class="px-3 py-2">
                                            <span id="customer_payment_terms" class="bg-green-100 text-green-800 px-2 rounded-full font-semibold text-xs"></span>
                                        </td>
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
                            <tr>
                                <td class="px-1 py-1">
                                    <select name="items[0][add_item_id]" class="form-select item-select select2">
                                        <option value="">-- Select Item --</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}"
                                                data-sale-price="{{ $item->sale_price }}"
                                                data-unit="{{ $item->select_unit->unit_name ?? '' }}"
                                                data-hsn="{{ $item->item_hsn }}"
                                                data-code="{{ $item->item_code }}"
                                                data-stock="{{ $item->item_type === 'product' ? $item->stock_qty : '' }}">
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

            <!-- Totals & Overall Discount -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4">
                    <textarea name="notes" rows="3" class="w-full rounded-md border px-3 py-2" placeholder="Notes"></textarea>
                    <textarea name="terms" rows="3" class="w-full rounded-md border px-3 py-2" placeholder="Terms & Conditions"></textarea>
                </div>
                <div>
                    <div class="mb-2">
                        <label class="font-semibold">Overall Discount:</label>
                        <input type="number" name="overall_discount" id="overall_discount" class="w-full border px-2 py-1 mt-1" value="0" step="0.01">
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg space-y-2">
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
                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-md hover:bg-green-700">SAVE INVOICE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.select2').select2({ width: '100%' });

    $('#customer_id').on('change', function() {
    let customerId = $(this).val();

    if (!customerId) {
        $('#customerDetailsCard').addClass('hidden');
        return;
    }

    $.get("{{ route('admin.saleInvoice.getCustomerDetails', '') }}/" + customerId, function(data) {
        function stripTags(input) {
            return $('<div>').html(input).text();
        }

        // Basic Info
        $('#customer_name').text(stripTags(data.party_name));
        $('#customer_gstin').text(stripTags(data.gstin));
        $('#customer_phone').text(stripTags(data.phone_number));
        $('#customer_pan').text(stripTags(data.pan_number));
        $('#customer_billing_address').text(stripTags(data.billing_address));
        $('#customer_shipping_address').text(stripTags(data.shipping_address));
        $('#customer_shipping_address2').text(stripTags(data.shipping_address));
        $('#customer_state').text(stripTags(data.state));
        $('#customer_city').text(stripTags(data.city));
        $('#customer_pincode').text(stripTags(data.pincode));
        $('#customer_email').text(stripTags(data.email));
        $('#customer_credit_limit').text(stripTags(data.credit_limit));
        $('#customer_payment_terms').text(stripTags(data.payment_terms));

        // Helper function to format balance display
        function formatBalance(balance, type) {
            balance = parseFloat(balance) || 0;
            type = type || 'Debit'; // default to Debit if null
            let label = type === 'Debit' ? 'Payable' : 'Receivable';
            let arrow = type === 'Debit' ? '↑' : '↓';
            let colorClass = type === 'Debit' ? 'text-red-600 font-bold' : 'text-green-700 font-bold';
            return {
                text: `${balance.toFixed(2)} (${type}) (${label}) ${arrow}`,
                class: colorClass
            };
        }

        // Opening Balance
        let opening = formatBalance(data.opening_balance, data.opening_balance_type);
        $('#customer_opening_balance').text(data.opening_balance ?? '0.00' + ' (' + (data.opening_balance_date || '-') + ')');
        $('#opening_balance_type')
            .text(opening.text)
            .removeClass('text-red-600 text-green-700 font-bold')
            .addClass(opening.class);

        // Current Balance
        let current = formatBalance(data.current_balance, data.current_balance_type);
        $('#customer_current_balance').text(current.text);
        $('#current_balance_type')
            .text(current.text)
            .removeClass('text-red-600 text-green-700 font-bold')
            .addClass(current.class);

        $('#current_balance_date').text(data.updated_at || '-');

        // Autofill invoice form
        $('#invoice_customer_phone').val(stripTags(data.phone_number));
        $('#invoice_billing_address').val(stripTags(data.billing_address));

        $('#customerDetailsCard').removeClass('hidden');
    });
    });


    function calculateRow(row){
        let qty = parseFloat(row.find('.qty').val()) || 0;
        let price = parseFloat(row.find('.price').val()) || 0;
        let discount = parseFloat(row.find('.discount').val()) || 0;
        let discountType = row.find('.discount_type').val();
        let taxRate = parseFloat(row.find('.tax_rate').val()) || 0;
        let taxType = row.find('.tax_type').val();

        if(discountType==='percentage'){ discount = price * qty * (discount/100); }
        let amount = (price * qty) - discount;
        if(taxType==='with'){ amount += amount * (taxRate/100); }

        row.find('.amount').val(amount.toFixed(2));
    }

    function calculateTotals(){
        let subtotal=0, discountTotal=0, taxTotal=0;
        $('#itemsTable tbody tr').each(function(){
            let row = $(this);
            let amount = parseFloat(row.find('.amount').val()) || 0;
            subtotal += amount;

            let discount = parseFloat(row.find('.discount').val()) || 0;
            if(row.find('.discount_type').val()==='percentage'){
                discount = parseFloat(row.find('.price').val())*parseFloat(row.find('.qty').val())*(discount/100);
            }
            discountTotal += discount;

            if(row.find('.tax_type').val()==='with'){ taxTotal += amount*(parseFloat(row.find('.tax_rate').val())||0)/100; }
        });

        let overallDiscount = parseFloat($('#overall_discount').val()) || 0;
        let total = subtotal + taxTotal - overallDiscount;

        $('#subtotal_display').text(subtotal.toFixed(2));
        $('#tax_display').text(taxTotal.toFixed(2));
        $('#discount_display').text((discountTotal + overallDiscount).toFixed(2));
        $('#total_display').text(total.toFixed(2));

        // Update hidden inputs to send to server
        $('#subtotal').val(subtotal.toFixed(2));
        $('#tax_input').val(taxTotal.toFixed(2));
        $('#discount_input').val((discountTotal + overallDiscount).toFixed(2));
        $('#total_input').val(total.toFixed(2));
    }

    $(document).on('input change', '.qty, .price, .discount, .discount_type, .tax_type, .tax_rate, #overall_discount', function(){
        let row = $(this).closest('tr');
        let maxQty = parseFloat(row.find('.qty').attr('max'));
        if(parseFloat(row.find('.qty').val())>maxQty){ row.find('.qty').val(maxQty); }
        if(row.find('.tax_type').val()==='with'){ row.find('.tax_rate').show(); } else { row.find('.tax_rate').hide().val(0); }
        calculateRow(row); calculateTotals();
    });

    $(document).on('change', '.item-select', function(){
        let row = $(this).closest('tr');
        let selected = $(this).find(':selected');
        if(selected.val()==='') return;

        row.find('.description').html(
            `<div class="text-sm text-gray-700 bg-gray-100 p-1 rounded">${selected.data('hsn')} | ${selected.data('code')}</div>`
        );
        row.find('.price').val(selected.data('sale-price'));
        row.find('.unit').text(selected.data('unit'));
        row.find('.qty').attr('max', selected.data('stock')).val(1);

        calculateRow(row); calculateTotals();

        $('.item-select').not(this).each(function(){
            if($(this).find('option[value="'+selected.val()+'"]').length){
                $(this).find('option[value="'+selected.val()+'"]').remove();
                $(this).trigger('change.select2');
            }
        });
    });

    $('#addRow').click(function(){
        let tbody = $('#itemsTable tbody');
        let newRow = tbody.find('tr:first').clone();
        let rowCount = tbody.find('tr').length;

        newRow.find('input, select').each(function(){
            let name = $(this).attr('name');
            if(name){ $(this).attr('name', name.replace(/\d+/, rowCount)); }
            if($(this).is('input')){ 
                $(this).val($(this).hasClass('qty') ? 1 : ($(this).hasClass('amount') ? 0 : 0)); 
            }
        });
        newRow.find('.description, .unit, .amount').text('');

        let selectedItems = [];
        $('.item-select').each(function(){
            let val = $(this).val();
            if(val) selectedItems.push(val);
        });
        newRow.find('option').each(function(){
            if(selectedItems.includes($(this).val())) $(this).remove();
        });

        tbody.append(newRow);
        newRow.find('select.select2').select2({ width: '100%' });
    });

    $(document).on('click', '.removeRow', function(){
        let tbody = $('#itemsTable tbody');
        if(tbody.find('tr').length>1){
            $(this).closest('tr').remove();
            calculateTotals();
        } else { alert('At least one row is required'); }
    });
});
</script>


<script>
    $(document).ready(function () {
        $('#main_cost_center_id').on('change', function () {
            var mainCostCenterId = $(this).val();
            if (mainCostCenterId) {
                $.ajax({
                    url: "{{ route('admin.purchaseBill.getSubCostCenters', '') }}/" + mainCostCenterId,
                    type: "GET",
                    success: function (data) {
                        $('#sub_cost_center_id').empty();
                        $('#sub_cost_center_id').append('<option value="">-- Select Sub Cost Center --</option>');
                        $.each(data, function (key, value) {
                            $('#sub_cost_center_id').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#sub_cost_center_id').empty();
                $('#sub_cost_center_id').append('<option value="">-- Select Sub Cost Center --</option>');
            }
        });
    });
</script>
@endsection
