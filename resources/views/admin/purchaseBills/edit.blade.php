@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <form action="{{ route('admin.purchase-bills.update', $purchaseBill->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-lg mb-6">
                <h1 class="text-3xl font-bold">PURCHASE INVOICE (EDIT)</h1>
            </div>

            <!-- Customer Info & Invoice Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Customer Info -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Bill To</h2>
                    <select name="select_customer_id" id="customer_id" class="form-select select2 w-full" required>
                        <option value="">-- Select Customer --</option>
                        @foreach($select_customers as $customer)
                            <option value="{{ $customer }}" {{ $purchaseBill->select_customer_id == $customer ? 'selected' : '' }}>
                                {{ $customer }}
                            </option>
                        @endforeach


                    </select>


                    <div id="customerDetailsCard" class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-white border-4 border-blue-300 rounded-xl shadow-xl {{ $purchaseBill->select_customer_id ? '' : 'hidden' }}">
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto text-sm">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Name</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_name">{{ $purchaseBill->customer->name ?? '' }}</td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">GSTIN</td>
                                        <td class="px-3 py-2 text-green-700 font-medium" id="customer_gstin">{{ $purchaseBill->customer->gstin ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Phone</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_phone">{{ $purchaseBill->customer->phone ?? '' }}</td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">PAN</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_pan">{{ $purchaseBill->customer->pan ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Billing Address</td>
                                        <td class="px-3 py-2 text-gray-800" id="customer_billing_address">{{ $purchaseBill->billing_address_invoice }}</td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Shipping Address</td>
                                        <td class="px-3 py-2 text-gray-800" id="customer_shipping_address">{{ $purchaseBill->shipping_address_invoice }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">State</td>
                                        <td class="px-3 py-2 text-indigo-700 font-medium" id="customer_state">{{ $purchaseBill->customer->state ?? '' }}</td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">City</td>
                                        <td class="px-3 py-2 text-indigo-700 font-medium" id="customer_city">{{ $purchaseBill->customer->city ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Pincode</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_pincode">{{ $purchaseBill->customer->pincode ?? '' }}</td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Email</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_email">{{ $purchaseBill->customer->email ?? '' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Main Cost Center</label>
                        <select name="main_cost_center_id" id="main_cost_center_id" class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                            <option value="">-- Select Main Cost Center --</option>
                            @foreach($cost as $id => $name)
                                <option value="{{ $id }}" {{ $purchaseBill->main_cost_center_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sub Cost Center</label>
                        <select name="sub_cost_center_id" id="sub_cost_center_id" class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                            <option value="">-- Select Sub Cost Center --</option>
                            @foreach($sub_cost as $id => $name)
                                <option value="{{ $id }}" {{ $purchaseBill->sub_cost_center_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Invoice Details -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Invoice Details</h2>
                    <input type="text" name="po_no" value="{{ old('po_no', $purchaseBill->po_no) }}" placeholder="Invoice/PO No." class="w-full rounded-md border px-3 py-2">
                    <input type="text" name="docket_no" value="{{ old('docket_no', $purchaseBill->docket_no) }}" placeholder="Docket Number" class="w-full rounded-md border px-3 py-2 mt-2">
                    <input type="text" name="purchase_bill_no" value="{{ old('purchase_bill_no', $purchaseBill->purchase_bill_no) }}" placeholder="Reference Bill Number" class="w-full rounded-md border px-3 py-2 mt-2">

                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <label for="po_date">Billing Date</label>
                        <input type="date" name="po_date" class="w-full rounded-md border px-3 py-2" value="{{ old('po_date', $purchaseBill->po_date) }}">

                        <label for="due_date">Purchase Bill Date</label>
                        <input type="date" name="due_date" class="w-full rounded-md border px-3 py-2" value="{{ old('due_date', $purchaseBill->due_date) }}">
                    </div>


                    <input type="text" name="e_way_bill_no" value="{{ old('e_way_bill_no', $purchaseBill->e_way_bill_no) }}" placeholder="E-Way Bill No." class="w-full rounded-md border px-3 py-2 mt-2">
                    <textarea name="billing_address_invoice" rows="2" class="w-full rounded-md border px-3 py-2 mt-2" placeholder="Billing Address">{{ old('billing_address_invoice', $purchaseBill->billing_address_invoice) }}</textarea>
                    <textarea name="shipping_address_invoice" rows="2" class="w-full rounded-md border px-3 py-2 mt-2" placeholder="Shipping Address">{{ old('shipping_address_invoice', $purchaseBill->shipping_address_invoice) }}</textarea>
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
                            @foreach($purchaseBill->items as $index => $item)
                            <tr>
                                <td class="px-1 py-1">
                                    <select name="items[{{ $index }}][id]" class="form-select item-select select2">
                                        <option value="">-- Select Item --</option>
                                        @foreach($items as $it)
                                            <option value="{{ $it->id }}" {{ $item->id == $it->id ? 'selected' : '' }}>
                                                {{ $it->item_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-1 py-1"><input type="text" name="items[{{ $index }}][description]" class="description w-full border px-2 py-1" value="{{ $item->description }}"></td>
                                <td class="px-1 py-1"><input type="number" name="items[{{ $index }}][qty]" class="qty w-full border px-2 py-1" min="1" value="{{ $item->qty }}"></td>
                                <td class="px-1 py-1"><input type="text" name="items[{{ $index }}][unit]" class="unit w-full border px-2 py-1" value="{{ $item->unit }}"></td>
                                <td class="px-1 py-1"><input type="number" name="items[{{ $index }}][price]" class="price w-full border px-2 py-1" step="0.01" value="{{ $item->price }}"></td>
                                <td class="px-1 py-1">
                                    <select name="items[{{ $index }}][discount_type]" class="discount_type w-full select2">
                                        <option value="value" {{ $item->discount_type=='value' ? 'selected' : '' }}>Value</option>
                                        <option value="percentage" {{ $item->discount_type=='percentage' ? 'selected' : '' }}>Percentage</option>
                                    </select>
                                    <input type="number" name="items[{{ $index }}][discount]" class="discount w-full mt-1 border px-2 py-1" value="{{ $item->discount }}" step="0.01">
                                </td>
                                <td class="px-1 py-1">
                                    <input type="number" name="items[{{ $index }}][tax]" class="tax_rate w-full border px-2 py-1" value="{{ $item->tax }}" step="0.01">
                                </td>
                                <td class="px-1 py-1"><input type="text" name="items[{{ $index }}][amount]" class="amount w-full border px-2 py-1" readonly value="{{ $item->amount }}"></td>
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

            <!-- Totals Section -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Subtotal</label>
                    <input type="text" id="subtotal" class="w-full border px-2 py-1 rounded" readonly value="{{ $purchaseBill->subtotal }}">
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Grand Total</label>
                    <input type="text" id="grand_total" name="grand_total" class="w-full border px-2 py-1 rounded" readonly value="{{ $purchaseBill->grand_total }}">
                </div>
            </div>

            <!-- Notes & Uploads -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-1">Notes</label>
                <textarea name="notes" rows="3" class="w-full border px-3 py-2 rounded">{{ $purchaseBill->notes }}</textarea>
            </div>

            <div class="px-6 pb-6">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-md flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i> UPDATE PURCHASE BILL
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({ width: '100%' });

    function recalcRow(row) {
        let qty = parseFloat(row.find('.qty').val()) || 0;
        let price = parseFloat(row.find('.price').val()) || 0;
        let discount = parseFloat(row.find('.discount').val()) || 0;
        let discountType = row.find('.discount_type').val();
        let tax = parseFloat(row.find('.tax_rate').val()) || 0;

        let amount = qty * price;
        if(discountType=='value') amount -= discount;
        else if(discountType=='percentage') amount -= amount*discount/100;

        amount += amount*tax/100;
        row.find('.amount').val(amount.toFixed(2));

        recalcTotal();
    }

    function recalcTotal() {
        let subtotal = 0;
        $('#itemsTable tbody tr').each(function(){
            subtotal += parseFloat($(this).find('.amount').val()) || 0;
        });
        $('#subtotal').val(subtotal.toFixed(2));
        $('#grand_total').val(subtotal.toFixed(2));
    }

    $('#itemsTable').on('input change', '.qty, .price, .discount, .discount_type, .tax_rate', function(){
        recalcRow($(this).closest('tr'));
    });

    $('#addRow').click(function(){
        let index = $('#itemsTable tbody tr').length;
        let newRow = `<tr>
            <td class="px-1 py-1">
                <select name="items[${index}][id]" class="form-select item-select select2">
                    <option value="">-- Select Item --</option>
                    @foreach($items as $it)
                        <option value="{{ $it->id }}">{{ $it->item_name }}</option>
                    @endforeach
                </select>
            </td>
            <td class="px-1 py-1"><input type="text" name="items[${index}][description]" class="description w-full border px-2 py-1"></td>
            <td class="px-1 py-1"><input type="number" name="items[${index}][qty]" class="qty w-full border px-2 py-1" value="1"></td>
            <td class="px-1 py-1"><input type="text" name="items[${index}][unit]" class="unit w-full border px-2 py-1"></td>
            <td class="px-1 py-1"><input type="number" name="items[${index}][price]" class="price w-full border px-2 py-1" step="0.01" value="0"></td>
            <td class="px-1 py-1">
                <select name="items[${index}][discount_type]" class="discount_type w-full select2">
                    <option value="value">Value</option>
                    <option value="percentage">Percentage</option>
                </select>
                <input type="number" name="items[${index}][discount]" class="discount w-full mt-1 border px-2 py-1" value="0" step="0.01">
            </td>
            <td class="px-1 py-1"><input type="number" name="items[${index}][tax]" class="tax_rate w-full border px-2 py-1" value="0" step="0.01"></td>
            <td class="px-1 py-1"><input type="text" name="items[${index}][amount]" class="amount w-full border px-2 py-1" readonly value="0"></td>
            <td class="px-1 py-1 text-center"><button type="button" class="removeRow bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button></td>
        </tr>`;
        $('#itemsTable tbody').append(newRow);
        $('.select2').select2({ width: '100%' });
    });

    $('#itemsTable').on('click', '.removeRow', function(){
        $(this).closest('tr').remove();
        recalcTotal();
    });

    // Initial calculation
    $('#itemsTable tbody tr').each(function(){
        recalcRow($(this));
    });

    // Customer details card toggle
    $('#customer_id').change(function(){
        let customerId = $(this).val();
        if(customerId) $('#customerDetailsCard').removeClass('hidden');
        else $('#customerDetailsCard').addClass('hidden');
    });
});
</script>
@endsection
