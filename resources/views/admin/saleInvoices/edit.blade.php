@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <form action="{{ route('admin.sale-invoices.update', $saleInvoice->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-lg mb-6">
                <h1 class="text-3xl font-bold">SALE INVOICE</h1>
                <div class="flex mt-4 space-x-6">
                    <label class="flex items-center">
                        <input type="radio" name="payment_type" value="credit" class="h-4 w-4 text-white" {{ $saleInvoice->payment_type=='credit'?'checked':'' }}>
                        <span class="ml-2">Credit</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment_type" value="cash" class="h-4 w-4 text-white" {{ $saleInvoice->payment_type=='cash'?'checked':'' }}>
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
                            <option value="{{ $id }}" {{ $saleInvoice->select_customer_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>

                    <div id="customerDetailsCard" class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-white border-4 border-blue-300 rounded-xl shadow-xl {{ $saleInvoice->select_customer_id ? '' : 'hidden' }}">
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
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Opening Balance</td>
                                        <td class="px-3 py-2">
                                            <span id="customer_opening_balance" class="text-blue-700 font-medium text-xs"></span>
                                            <span id="opening_balance_type" class="text-blue-700 font-medium text-xs"></span>
                                        </td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Current Balance</td>
                                        <td class="px-3 py-2 text-red-600 font-medium text-xs" id="customer_current_balance"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Invoice Details</h2>

                    <input type="text" name="po_no" value="{{ $saleInvoice->po_no }}" placeholder="Invoice/PO No." class="w-full rounded-md border px-3 py-2">
                    <input type="text" name="docket_no" value="{{ $saleInvoice->docket_no }}" placeholder="Docket Number" class="w-full rounded-md border px-3 py-2 mt-2">

                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <input type="date" name="po_date" value="{{ $saleInvoice->po_date }}" class="w-full rounded-md border px-3 py-2">
                        <input type="date" name="due_date" value="{{ $saleInvoice->due_date }}" class="w-full rounded-md border px-3 py-2">
                    </div>
                    <input type="text" name="e_way_bill_no" value="{{ $saleInvoice->e_way_bill_no }}" placeholder="E-Way Bill No." class="w-full rounded-md border px-3 py-2 mt-2">
                    <input type="text" name="customer_phone_invoice" id="invoice_customer_phone" value="{{ $saleInvoice->phone_number }}" placeholder="Customer Phone" class="w-full rounded-md border px-3 py-2 mt-2">
                    <textarea name="billing_address_invoice" id="invoice_billing_address" rows="2" class="w-full rounded-md border px-3 py-2 mt-2" placeholder="Billing Address">{{ $saleInvoice->billing_address }}</textarea>
                    <textarea name="shipping_address_invoice" id="customer_shipping_address2" rows="2" class="w-full rounded-md border px-3 py-2 mt-2" placeholder="Shipping Address">{{ $saleInvoice->shipping_address }}</textarea>
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
                            @foreach($saleInvoice->items as $index => $item)
                            <tr>
                                <td class="px-1 py-1">
                                    <select name="items[{{ $index }}][add_item_id]" class="form-select item-select select2">
                                        <option value="">-- Select Item --</option>
                                        @foreach($items as $itm)
                                            <option value="{{ $itm->id }}"
                                                data-sale-price="{{ $itm->sale_price }}"
                                                data-unit="{{ $itm->select_unit->unit_name ?? '' }}"
                                                data-hsn="{{ $itm->item_hsn }}"
                                                data-code="{{ $itm->item_code }}"
                                                data-stock="{{ $itm->item_type === 'product' ? $itm->stock_qty : '' }}"
                                                {{ $itm->id==$item->id?'selected':'' }}>
                                                {{ $itm->item_name }} ({{ ucfirst($itm->item_type) }})
                                                @if($itm->item_type === 'product' && $itm->stock_qty !== null)
                                                    - Stock: {{ $itm->stock_qty }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-1 py-1 description">{{ $item->pivot->description ?? '' }}</td>
                                <td class="px-1 py-1"><input type="number" name="items[{{ $index }}][qty]" class="qty w-full border px-2 py-1" min="1" value="{{ $item->pivot->qty }}"></td>
                                <td class="px-1 py-1 unit">{{ $item->pivot->unit ?? '' }}</td>
                                <td class="px-1 py-1"><input type="number" name="items[{{ $index }}][price]" class="price w-full border px-2 py-1" step="0.01" value="{{ $item->pivot->price }}"></td>
                                <td class="px-1 py-1">
                                    <select name="items[{{ $index }}][discount_type]" class="discount_type w-full select2">
                                        <option value="value" {{ $item->pivot->discount_type=='value'?'selected':'' }}>Value</option>
                                        <option value="percentage" {{ $item->pivot->discount_type=='percentage'?'selected':'' }}>Percentage</option>
                                    </select>
                                    <input type="number" name="items[{{ $index }}][discount]" class="discount w-full mt-1 border px-2 py-1" value="{{ $item->pivot->discount }}" step="0.01">
                                </td>
                                <td class="px-1 py-1">
                                    <select name="items[{{ $index }}][tax_type]" class="tax_type w-full select2">
                                        <option value="without" {{ $item->pivot->tax_type=='without'?'selected':'' }}>Without Tax</option>
                                        <option value="with" {{ $item->pivot->tax_type=='with'?'selected':'' }}>With Tax</option>
                                    </select>
                                    <input type="number" name="items[{{ $index }}][tax]" class="tax_rate w-full mt-1 border px-2 py-1" value="{{ $item->pivot->tax_rate }}" step="0.01" placeholder="Tax %" style="display:{{ $item->pivot->tax_type=='with'?'block':'none' }};">
                                </td>
                                <td class="px-1 py-1"><input type="text" name="items[{{ $index }}][amount]" class="amount w-full border px-2 py-1" readonly value="{{ $item->pivot->amount }}"></td>
                                <td class="px-1 py-1 text-center"><button type="button" class="removeRow bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button></td>
                            </tr>
                            @endforeach
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
                    <textarea name="notes" rows="3" class="w-full rounded-md border px-3 py-2" placeholder="Notes">{{ $saleInvoice->notes }}</textarea>
                    <textarea name="terms" rows="3" class="w-full rounded-md border px-3 py-2" placeholder="Terms & Conditions">{{ $saleInvoice->terms }}</textarea>
                </div>
                <div>
                    <div class="mb-2">
                        <label class="font-semibold">Overall Discount:</label>
                        <input type="number" name="overall_discount" id="overall_discount" class="w-full border px-2 py-1 mt-1" value="{{ $saleInvoice->overall_discount }}" step="0.01">
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span id="subtotal_display">{{ $saleInvoice->subtotal }}</span>
                            <input type="hidden" name="subtotal" id="subtotal" value="{{ $saleInvoice->subtotal }}">
                        </div>
                        <div class="flex justify-between">
                            <span>Tax:</span>
                            <span id="tax_display">{{ $saleInvoice->tax }}</span>
                            <input type="hidden" name="tax" id="tax_input" value="{{ $saleInvoice->tax }}">
                        </div>
                        <div class="flex justify-between">
                            <span>Discount:</span>
                            <span id="discount_display">{{ $saleInvoice->discount }}</span>
                            <input type="hidden" name="discount" id="discount_input" value="{{ $saleInvoice->discount }}">
                        </div>
                        <div class="flex justify-between border-t pt-2 font-bold">
                            <span>Total:</span>
                            <span id="total_display">{{ $saleInvoice->total }}</span>
                            <input type="hidden" name="total" id="total_input" value="{{ $saleInvoice->total }}">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="font-semibold">Attachment:</label>
                        <input type="file" name="attachment" class="w-full border px-3 py-2 rounded-md">
                        @if($saleInvoice->attachment)
                            <p class="mt-1 text-sm text-gray-600">Current: <a href="{{ asset('storage/'.$saleInvoice->attachment) }}" target="_blank">{{ $saleInvoice->attachment }}</a></p>
                        @endif
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-md hover:bg-green-700">UPDATE INVOICE</button>
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

    function loadCustomerDetails(customerId){
        if(customerId){
            $.get("{{ route('admin.saleInvoice.getCustomerDetails', '') }}/"+customerId, function(data){
                function stripTags(input){ return $('<div>').html(input).text(); }
                $('#customer_name').text(stripTags(data.party_name));
                $('#customer_gstin').text(stripTags(data.gstin));
                $('#customer_phone').text(stripTags(data.phone_number));
                $('#customer_pan').text(stripTags(data.pan_number));
                $('#customer_billing_address').text(stripTags(data.billing_address));
                $('#customer_shipping_address').text(stripTags(data.shipping_address));
                $('#customer_shipping_address2').val(stripTags(data.shipping_address));
                $('#customer_state').text(stripTags(data.state));
                $('#customer_city').text(stripTags(data.city));
                $('#customer_pincode').text(stripTags(data.pincode));
                $('#customer_email').text(stripTags(data.email));
                $('#customer_credit_limit').text(stripTags(data.credit_limit));
                $('#customer_payment_terms').text(stripTags(data.payment_terms));
                $('#customer_opening_balance').text(stripTags(data.opening_balance)+' ('+stripTags(data.opening_balance_date)+')');
                let balanceType = stripTags(data.opening_balance_type);
                if(balanceType==='Debit'){
                    $('#opening_balance_type').text(balanceType + ' (Receivable)').removeClass('text-green-700').addClass('text-red-600 font-bold');
                } else {
                    $('#opening_balance_type').text(balanceType + ' (Payable)').removeClass('text-red-600').addClass('text-green-700 font-bold');
                }
                $('#customer_current_balance').text(data.current_balance ?? '0.00');
                $('#invoice_customer_phone').val(stripTags(data.phone_number));
                $('#invoice_billing_address').val(stripTags(data.billing_address));
                $('#customerDetailsCard').removeClass('hidden');
            });
        } else {
            $('#customerDetailsCard').addClass('hidden');
        }
    }

    loadCustomerDetails($('#customer_id').val());

    $('#customer_id').on('change', function(){ loadCustomerDetails($(this).val()); });

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

        row.find('.description').html(`<div class="text-sm text-gray-700 bg-gray-100 p-1 rounded">${selected.data('hsn')} | ${selected.data('code')}</div>`);
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

    calculateTotals();
});
</script>
@endsection
