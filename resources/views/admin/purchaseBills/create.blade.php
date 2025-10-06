@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        
        <!-- Header -->
        <div class="bg-indigo-600 text-white p-6">
            <h1 class="text-3xl font-bold">Create Purchase Bill</h1>
        </div>

        <form action="{{ route('admin.purchase-bills.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Customer & Invoice Info -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Bill To</h2>

                    <!-- Customer Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Parties</label>
                        <select name="select_customer_id" id="select_customer_id"
                                class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                            <option value="">-- Select Customer --</option>
                            @foreach($select_customers as $id => $name)
                                <option value="{{ $id }}" {{ old('select_customer_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
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

                    <!-- Billing & Shipping Inputs -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Billing Name</label>
                        <input type="text" name="billing_name" id="billing_name"
                               value="{{ old('billing_name') ?? '' }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number"
                               value="{{ old('phone_number') ?? '' }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Billing Address</label>
                        <input type="text" name="billing_address" id="billing_address"
                               value="{{ old('billing_address') ?? '' }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Shipping Address</label>
                        <textarea name="shipping_address" id="shipping_address" rows="4"
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">{{ old('shipping_address') ?? '' }}</textarea>
                        @error('shipping_address')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Invoice Details</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">PO No.</label>
                        <input type="text" name="po_no" value="{{ old('po_no') }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">PO Date</label>
                        <input type="date" name="po_date" value="{{ old('po_date') }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-Way Bill No.</label>
                        <input type="text" name="e_way_bill_no" value="{{ old('e_way_bill_no') }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="px-6 pb-6">
                <hr class="border-dashed border-gray-300 mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">ITEMS</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Item</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Description</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">QTY</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Unit</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Price/Unit</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tax %</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Discount</th>
            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Amount</th>
            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Action</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        <tr class="hover:bg-gray-50">
            <td class="px-4 py-2">
                <select name="items[0][id]" class="selectItem select2 w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm">
                    <option value="">Select Item</option>
                    @foreach($items as $id => $text)
                        @php $parts = explode('|', $text); $name = trim($parts[0]); @endphp
                        <option value="{{ (int) $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </td>
            <td class="px-4 py-2">
                <input type="text" name="items[0][description]" class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm description">
            </td>
            <td class="px-4 py-2">
                <input type="number" name="items[0][qty]" value="1" class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm qty min-w-[60px]">
            </td>
            <td class="px-4 py-2">
                <select name="items[0][unit]" class="unit w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm">
                    @foreach($units as $id => $unit)
                        <option value="{{ $unit }}">{{ $unit }}</option>
                    @endforeach
                </select>
            </td>
            <td class="px-4 py-2">
                <input type="number" name="items[0][price]" value="0" class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm price min-w-[80px]">
            </td>
           <td class="px-4 py-2">
    <select name="items[0][tax_rate_id]" class="tax_rate w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm min-w-[120px]">
        <option value="">Without Tax</option>
        <option value="with">With Tax</option>
    </select>
</td>
<td class="px-4 py-2 discountCell">
    <input type="number" name="items[0][discount]" value="0" class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm discount min-w-[60px]">
</td>

            <td class="px-4 py-2">
                <input type="text" name="items[0][amount]" readonly class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm amount bg-gray-50">
            </td>
            <td class="px-4 py-2 text-center">
                <button type="button" class="removeRow bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md">X</button>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr class="bg-gray-100">
            <td colspan="2" class="px-4 py-2 font-medium">Total</td>
            <td class="px-4 py-2 font-medium" id="grandQty">0</td>
            <td colspan="3"></td>
            <td></td>
            <td class="px-4 py-2 font-medium" id="grandTotal">0.00</td>
            <td></td>
        </tr>
    </tfoot>
</table>

                   

                    <button type="button" id="addRow" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                        + ADD ROW
                    </button>
                </div>

                @php
                    $itemsData = [];
                    foreach($items as $id => $text) {
                        $parts = explode('|', $text);
                        $name = trim($parts[0]);
                        $description = trim($parts[1] ?? '');
                        $price = isset($parts[2]) ? floatval(str_replace([',', 'Price:'], '', $parts[2])) : 0;
                        $qty = isset($parts[3]) ? floatval(str_replace(['Qty:', ','], '', $parts[3])) : 1;

                        // Determine type
                        $type = strpos($name, '[Product]') === 0 ? 'product' : 'service';

                        // For products, store CurrentStock ID from text after 'id:'
                        if($type === 'product') {
                            preg_match('/\| id: (\d+)/', $text, $matches);
                            $valueId = $matches[1] ?? $id;
                        } else {
                            $valueId = $id; // Service ID
                        }

                        $itemsData[$valueId] = [
                            'name' => $name,
                            'description' => $description,
                            'price' => $price,
                            'qty' => $qty,
                            'unit' => 'Piece',
                            'type' => $type,
                        ];
                    }
                    
                    @endphp

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

<script>
$(document).ready(function() {

    const tableBody = $('#itemsTable tbody');
    const itemsList = @json($itemsData);
    const unitsList = @json($units);
    const taxRatesList = @json($tax_rates); // [{id:1,name:"GST",parcentage:"18"}, ...]

    // ---------------- FUNCTIONS ----------------

    function reindexRows() {
        tableBody.find('tr').each(function(idx, row) {
            $(row).find('input, select').each(function() {
                const name = $(this).attr('name');
                if (name) {
                    $(this).attr('name', name.replace(/items\[\d+\]/, `items[${idx}]`));
                }
            });
        });
    }

    function updateItemOptions() {
        const selected = $('.selectItem').map(function() {
            return $(this).val();
        }).get().filter(v => v !== '');

        $('.selectItem').each(function() {
            const currentVal = $(this).val();
            const $select = $(this);
            $select.empty().append('<option value="">Select Item</option>');

            $.each(itemsList, function(id, item) {
                // Allow currently selected OR not already used
                if (selected.includes(id.toString()) && id != currentVal) return;
                $select.append(`<option value="${id}">${item.name}</option>`);
            });

            if (currentVal) $select.val(currentVal);
        });
    }

    function toggleDiscountField(row) {
        const taxVal = row.find('.tax_rate').val();
        const discountCell = row.find('.discountCell');
        discountCell.empty();
        const idx = row.index();

        if (!taxVal || taxVal === "") {
            // Without Tax → input for discount
            const input = $('<input type="number">')
                .addClass('discount w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm')
                .val(0)
                .attr('name', `items[${idx}][discount]`);
            discountCell.append(input);
        } else if (taxVal === "with") {
            // With Tax → dropdown for tax rates
            const select = $('<select>')
                .addClass('discount w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm')
                .attr('name', `items[${idx}][discount]`);

            let firstId = null;
            $.each(taxRatesList, function(_, tax) {
                const id = tax.id;
                const percentage = parseFloat(tax.parcentage) || 0;
                if (firstId === null) firstId = id;
                select.append(`<option value="${id}" data-percent="${percentage}">
                    ${tax.name} (${percentage}%)
                </option>`);
            });

            discountCell.append(select);
            if (firstId !== null) select.val(firstId);

            // Recalculate on change
            select.on('change', function() {
                recalcAmount(row);
            });
        }
    }

    function recalcAmount(row) {
        const qty = parseFloat(row.find('.qty').val()) || 0;
        const price = parseFloat(row.find('.price').val()) || 0;
        let discount = 0;
        let taxAmount = 0;

        const discountField = row.find('.discount');
        const taxVal = row.find('.tax_rate').val();

        // Normal discount input
        if (discountField.is('input')) {
            discount = parseFloat(discountField.val()) || 0;
        }

        // Tax dropdown → calculate percentage
        if (taxVal === "with" && discountField.is('select')) {
            const selectedOption = discountField.find('option:selected');
            const percentage = parseFloat(selectedOption.data('percent')) || 0;
            taxAmount = ((qty * price) * percentage) / 100;
        }

        const amount = (qty * price) - discount + taxAmount;
        row.find('.amount').val(amount.toFixed(2));
        updateGrandTotals();
    }

    function updateGrandTotals() {
        let totalQty = 0, totalAmount = 0;
        tableBody.find('tr').each(function() {
            totalQty += parseFloat($(this).find('.qty').val()) || 0;
            totalAmount += parseFloat($(this).find('.amount').val()) || 0;
        });
        $('#grandQty').text(totalQty);
        $('#grandTotal').text(totalAmount.toFixed(2));
    }

    // ---------------- INITIALIZATION ----------------
    $('.select2').select2({ width: '100%' });

    // On item change
    tableBody.on('change', '.selectItem', function() {
        const row = $(this).closest('tr');
        const id = $(this).val();

        if (id && itemsList[id]) {
            const item = itemsList[id];
            row.find('.description').val(item.description || '');
            row.find('.unit').val(item.unit || '');
            row.find('.price').val(item.price || 0);
            row.find('.qty').val(item.qty || 1);
        } else {
            row.find('.description').val('');
            row.find('.unit').val('');
            row.find('.price').val(0);
            row.find('.qty').val(1);
        }

        recalcAmount(row);
        updateItemOptions();
    });

    // On qty, price, discount, tax change
    tableBody.on('input change', '.qty, .price, .discount, .tax_rate', function() {
        const row = $(this).closest('tr');
        if ($(this).hasClass('tax_rate')) toggleDiscountField(row);
        recalcAmount(row);
    });

    // Init existing rows
    tableBody.find('tr').each(function() {
        toggleDiscountField($(this));
        recalcAmount($(this));
    });

    // Add new row
    $('#addRow').on('click', function() {
        const unitSelect = $('<select>').addClass('unit w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm');
        $.each(unitsList, (_, unit) => unitSelect.append(`<option value="${unit}">${unit}</option>`));

        const taxSelect = $('<select>').addClass('tax_rate w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm');
        taxSelect.append('<option value="">Without Tax</option>');
        taxSelect.append('<option value="with">With Tax</option>');

        const newRow = $('<tr class="hover:bg-gray-50">')
            .append($('<td>').append($('<select>').addClass('selectItem select2 w-full').append('<option value="">Select Item</option>')))
            .append($('<td>').append($('<input type="text">').addClass('description w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm')))
            .append($('<td>').append($('<input type="number">').addClass('qty w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm').val(1)))
            .append($('<td>').append(unitSelect))
            .append($('<td>').append($('<input type="number">').addClass('price w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm').val(0)))
            .append($('<td>').append(taxSelect))
            .append($('<td class="discountCell">').append($('<input type="number">').addClass('discount w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm').val(0)))
            .append($('<td>').append($('<input type="text" readonly>').addClass('amount w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm bg-gray-50')))
            .append($('<td>').append('<button type="button" class="removeRow bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md">X</button>'));

        tableBody.append(newRow);
        $.each(itemsList, function(id, item) {
            newRow.find('.selectItem').append(`<option value="${id}">${item.name}</option>`);
        });
        newRow.find('.select2').select2({ width: '100%' });

        toggleDiscountField(newRow);
        reindexRows();
        updateItemOptions();
        updateGrandTotals();
    });

    // Remove row
    tableBody.on('click', '.removeRow', function() {
        if (tableBody.find('tr').length > 1) {
            $(this).closest('tr').remove();
            reindexRows();
            updateItemOptions();
            updateGrandTotals();
        } else {
            alert('At least one item is required!');
        }
    });

});
</script>






<script>
$(document).ready(function () {
    // Initialize Select2
    if ($.fn.select2) {
        $('.select2').select2({ width: '100%' });
    }

    $('#select_customer_id').on('change', function () {
        let customerId = $(this).val();

        if (customerId) {
            let url = "{{ route('admin.getCustomerDetails', ':id') }}";
            url = url.replace(':id', customerId);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log("Customer Data:", data);

                    // Fill form inputs only
                    $('#billing_name').val(data.party_name || '');
                    $('#phone_number').val(data.phone_number || '');
                    $('#billing_address').val(data.billing_address || '');
                    $('#shipping_address').val(data.shipping_address || '');
                })
                .catch(error => {
                    console.error("Error fetching customer details:", error);
                    $('#billing_name, #phone_number, #billing_address, #shipping_address').val('');
                });
        } else {
            $('#billing_name, #phone_number, #billing_address, #shipping_address').val('');
        }
    });
});
</script>
@endsection


