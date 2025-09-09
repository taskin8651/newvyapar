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
    <label class="block text-sm font-medium text-gray-700">Select Customer</label>
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

<!-- JS for Auto-Fill -->
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

            

        <!-- Include jQuery and Select2 first -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Items Table -->
<div class="px-6 pb-6">
    <hr class="border-dashed border-gray-300 mb-4">
    <h2 class="text-xl font-semibold text-gray-700 mb-4">ITEMS</h2>

    <!-- Include jQuery and Select2 -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Item</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Description</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">QTY</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Unit</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Price/Unit</th>
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
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="px-4 py-2">
                    <input type="text" name="items[0][description]" class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm description">
                </td>
                <td class="px-4 py-2">
                    <input type="number" name="items[0][qty]" value="1" class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm qty">
                </td>
                <td class="px-4 py-2">
                    <select name="items[0][unit]" class="unit w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm">
                        <option>Piece</option>
                        <option>Kg</option>
                        <option>Box</option>
                    </select>
                </td>
                <td class="px-4 py-2">
                    <input type="number" name="items[0][price]" value="0" class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm price">
                </td>
                <td class="px-4 py-2">
                    <input type="text" name="items[0][amount]" readonly class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm amount bg-gray-50">
                </td>
                <td class="px-4 py-2 text-center">
                    <button type="button" class="removeRow bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md">X</button>
                </td>
            </tr>
        </tbody>
    </table>

    <button type="button" id="addRow" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
        + ADD ROW
    </button>

  
@php
$itemsData = [];
foreach($items as $id => $text) {
    $parts = explode('|', $text);
    $name = trim($parts[0]);
    $description = trim($parts[1] ?? '');
    $price = isset($parts[2]) ? floatval(str_replace([',', 'Price:'], '', $parts[2])) : 0;
    $qty = isset($parts[3]) ? floatval(str_replace(['Qty:', ','], '', $parts[3])) : 1;
    $itemsData[$id] = [
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'qty' => $qty,
        'unit' => 'Piece',
    ];
}
@endphp

<script>
$(document).ready(function() {
    const tableBody = $('#itemsTable tbody');
    const itemsList = @json($itemsData);

    function reindexRows() {
        tableBody.find('tr').each(function(idx, row) {
            $(row).find('input, select').each(function() {
                let name = $(this).attr('name');
                if(name) $(this).attr('name', name.replace(/items\[\d+\]/, `items[${idx}]`));
            });
        });
    }

    function updateItemOptions() {
        const selected = $('.selectItem').map(function() { return $(this).val(); }).get().filter(v => v !== '');
        $('.selectItem').each(function() {
            const currentVal = $(this).val();
            const $select = $(this);
            $select.empty().append('<option value="">Select Item</option>');
            $.each(itemsList, function(id, item) {
                if(selected.includes(id.toString()) && id != currentVal) return;
                $select.append(`<option value="${id}">${item.name}</option>`);
            });
            $select.val(currentVal).trigger('change.select2');
        });
    }

    function recalcAmount(row) {
        const qty = parseFloat(row.find('.qty').val()) || 0;
        const price = parseFloat(row.find('.price').val()) || 0;
        row.find('.amount').val((qty * price).toFixed(2));
    }

    // Initialize Select2
    $('.select2').select2({ width: '100%' });

    // On item change
    tableBody.on('change', '.selectItem', function() {
        const id = $(this).val();
        const row = $(this).closest('tr');
        if(id && itemsList[id]) {
            const item = itemsList[id];
            row.find('.description').val(item.description);
            row.find('.qty').val(item.qty);
            row.find('.unit').val(item.unit);
            row.find('.price').val(item.price);
        } else {
            row.find('.description').val('');
            row.find('.qty').val(1);
            row.find('.unit').val('Piece');
            row.find('.price').val(0);
        }
        recalcAmount(row);
        updateItemOptions();
    });

    // On qty or price input
    tableBody.on('input', '.qty, .price', function() {
        const row = $(this).closest('tr');
        recalcAmount(row);
    });

    // Add row
    $('#addRow').on('click', function() {
        const rowCount = tableBody.find('tr').length;
        const newRow = $(`
            <tr class="hover:bg-gray-50">
    <td class="px-4 py-2">
        <select name="items[${rowCount}][id]" 
                class="selectItem select2 w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Select Item</option>
        </select>
    </td>
    <td class="px-4 py-2">
        <input type="text" name="items[${rowCount}][description]" 
               class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm description focus:ring-indigo-500 focus:border-indigo-500">
    </td>
    <td class="px-4 py-2">
        <input type="number" name="items[${rowCount}][qty]" value="1" 
               class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm qty focus:ring-indigo-500 focus:border-indigo-500">
    </td>
    <td class="px-4 py-2">
        <select name="items[${rowCount}][unit]" 
                class="unit w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option>Piece</option>
            <option>Kg</option>
            <option>Box</option>
        </select>
    </td>
    <td class="px-4 py-2">
        <input type="number" name="items[${rowCount}][price]" value="0" 
               class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm price focus:ring-indigo-500 focus:border-indigo-500">
    </td>
    <td class="px-4 py-2">
        <input type="text" name="items[${rowCount}][amount]" readonly 
               class="w-full border border-gray-300 rounded-md px-2 py-1 shadow-sm amount bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
    </td>
    <td class="px-4 py-2 text-center">
        <button type="button" 
                class="removeRow bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md shadow-sm">
            X
        </button>
    </td>
</tr>

        `);
        tableBody.append(newRow);
        // Populate select options
        $.each(itemsList, function(id, item) {
            newRow.find('.selectItem').append(`<option value="${id}">${item.name}</option>`);
        });
        newRow.find('.select2').select2({ width: '100%' });
        reindexRows();
        updateItemOptions();
    });

    // Remove row
    tableBody.on('click', '.removeRow', function() {
        if(tableBody.find('tr').length > 1) {
            $(this).closest('tr').remove();
            reindexRows();
            updateItemOptions();
        } else {
            alert('At least one item is required!');
        }
    });
});
</script>



                </div>



    <!-- Left Side -->
    <div class="space-y-4 py-6">
        <h2 class="text-xl font-semibold text-gray-700">Payment Details</h2>
        <div class=" grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block text-sm font-medium text-gray-700">Payment Type</label>
            <select name="payment_type_id" 
                    class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
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

    <!-- Right Side -->
    <div class="space-y-4">
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
            </div>


             <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Image Upload Section -->
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
        <!-- Preview -->
        <div id="imagePreview" class="mt-3 hidden">
            <img class="h-20 w-20 object-cover rounded-md mx-auto mb-2" />
            <p class="text-sm text-gray-600 text-center" id="imageFileName"></p>
        </div>
        @error('image')
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    <!-- Document Upload Section -->
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
        <!-- Preview -->
        <div id="documentPreview" class="mt-3 hidden text-center">
            <i class="fas fa-file text-gray-500 text-3xl mb-1"></i>
            <p class="text-sm text-gray-600" id="documentFileName"></p>
        </div>
        @error('document')
            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>

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


@endsection


