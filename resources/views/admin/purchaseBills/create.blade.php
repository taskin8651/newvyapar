@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <form action="{{ route('admin.purchase-bills.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-lg mb-6">
                <h1 class="text-3xl font-bold">PURCHACE INVOICE</h1>

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
                    <div>
                    <label class="block text-sm font-medium text-gray-700">Select Main Cost Center</label>
                        <select name="main_cost_center_id" id="main_cost_center_id"
                                class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                            <option value="">-- Select Main Cost Center --</option>
                            @foreach($cost as $id => $name)
                                <option value="{{ $id }}" {{ old('main_cost_center_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Sub Cost Center</label>
                        <select name="sub_cost_center_id" id="sub_cost_center_id"
                                class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                            <option value="">-- Select Sub Cost Center --</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Invoice Details</h2>
                    @php
                    $datePart = date('Ymd');
                    $lastPO = \App\Models\PurchaseBill::whereDate('created_at', now()->format('Y-m-d'))
                        ->orderBy('id', 'desc')
                        ->first();
                    $serial = $lastPO ? intval(substr($lastPO->po_no, -4)) + 1 : 1;
                    $serial = str_pad($serial, 4, '0', STR_PAD_LEFT);
                    $poNo = 'ET-'.$datePart.'-'.$serial;
                    @endphp
                    
                    <input type="text" name="po_no" value="{{ $poNo }}" placeholder="Invoice/PO No." class="w-full rounded-md border px-3 py-2">
                    <input type="text" name="docket_no" placeholder="Docket Number" class="w-full rounded-md border px-3 py-2 mt-2">
                    <input type="text" name="ref_no" placeholder="Reference Bill  Number" class="w-full rounded-md border px-3 py-2 mt-2">

                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <input type="date" name="po_date" class="w-full rounded-md border px-3 py-2">
                        <input type="date" name="due_date" class="w-full rounded-md border px-3 py-2">
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
                     <!-- Payment Details -->
                    <div class="space-y-4 py-6 px-6">
                        <h2 class="text-xl font-semibold text-gray-700">Payment Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                            <div>
                                <label class="block text-sm font-medium text-gray-700">Payment Type</label>
                                <select name="payment_type_id" class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                                    <option value="">-- Select Payment Type --</option>
                                    @foreach($payment_types as $id => $name)
                                        <option value="{{ $id }}" {{ old('payment_type_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('payment_type_id')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>


                            <div>
                                <label class="block text-sm font-medium text-gray-700">Reference No</label>
                                <input type="text" name="reference_no" value="{{ old('reference_no') }}"
                                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                                @error('reference_no')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <!-- Upload Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-6 pb-6">
                        <!-- Image Upload -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700 mb-3">Upload Image</h2>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <label for="image" class="cursor-pointer flex flex-col items-center">
                                    <i class="fas fa-cloud-upload-alt text-indigo-500 text-4xl mb-2"></i>
                                    <span class="text-gray-600">Click to upload or drag & drop</span>
                                    <span class="text-sm text-gray-500 mt-1">(JPEG, PNG, GIF up to 20MB)</span>
                                    <input type="file" name="image" id="image" accept="image/*" class="hidden">
                                </label>
                            </div>
                            <div id="imagePreview" class="mt-3 hidden">
                                <img class="h-20 w-20 object-cover rounded-md mx-auto mb-2" />
                                <p class="text-sm text-gray-600 text-center" id="imageFileName"></p>
                            </div>
                        </div>


                        <!-- Document Upload -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700 mb-3">Upload Document</h2>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition">
                                <label for="document" class="cursor-pointer flex flex-col items-center">
                                    <i class="fas fa-file-upload text-green-500 text-4xl mb-2"></i>
                                    <span class="text-gray-600">Click to upload or drag & drop</span>
                                    <span class="text-sm text-gray-500 mt-1">(PDF, DOC, XLS up to 20MB)</span>
                                    <input type="file" name="document" id="document" accept=".pdf,.doc,.docx,.xls,.xlsx" class="hidden">
                                </label>
                            </div>
                            <div id="documentPreview" class="mt-3 hidden text-center">
                                <i class="fas fa-file text-gray-500 text-3xl mb-1"></i>
                                <p class="text-sm text-gray-600" id="documentFileName"></p>
                            </div>
                        </div>
                    </div>


                    <!-- Notes -->
                    <div class="px-6 pb-6">
                        <h2 class="text-xl font-semibold text-gray-700">Notes</h2>
                        <textarea name="notes" rows="3"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">{{ old('notes') }}</textarea>
                    </div>


                    <!-- Save Button -->
                    <div class="px-6 pb-6">
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-md flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> SAVE PURCHASE BILL
                        </button>
                    </div>
                </form>
            </div>
        </div>


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


        <!-- JS for Preview -->
        <script>
            // Image Preview
            document.getElementById('image').addEventListener('change', function(e) {
                const previewDiv = document.getElementById('imagePreview');
                const img = previewDiv.querySelector('img');
                const fileName = document.getElementById('imageFileName');
            
                if (e.target.files && e.target.files[0]) {
                    const file = e.target.files[0];
                    img.src = URL.createObjectURL(file);
                    fileName.textContent = file.name;
                    previewDiv.classList.remove('hidden');
                } else {
                    previewDiv.classList.add('hidden');
                }
            });


            // Document Preview
            document.getElementById('document').addEventListener('change', function(e) {
                const previewDiv = document.getElementById('documentPreview');
                const fileName = document.getElementById('documentFileName');
            
                if (e.target.files && e.target.files[0]) {
                    const file = e.target.files[0];
                    fileName.textContent = file.name;
                    previewDiv.classList.remove('hidden');
                } else {
                    previewDiv.classList.add('hidden');
                }
            });
        </script>


        <!-- Dropzone Config -->
        <script>
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.purchase-bills.storeMedia') }}',
            maxFilesize: 20, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            params: { size: 20, width: 4096, height: 4096 },
            success: function (file, response) {
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                $('form').find('input[name="image"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        }


        Dropzone.options.documentDropzone = {
            url: '{{ route('admin.purchase-bills.storeMedia') }}',
            maxFilesize: 20, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            params: { size: 20 },
            success: function (file, response) {
                $('form').find('input[name="document"]').remove()
                $('form').append('<input type="hidden" name="document" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                $('form').find('input[name="document"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        }
        </script>

     
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
        if(customerId){
            $.get("{{ route('admin.saleInvoice.getCustomerDetails', '') }}/"+customerId, function(data){
                function stripTags(input){ return $('<div>').html(input).text(); }
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
                $('#customer_opening_balance').text(stripTags(data.opening_balance) + ' (' + stripTags(data.opening_balance_date) + ')');
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
        } else { $('#customerDetailsCard').addClass('hidden'); }
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
@endsection












