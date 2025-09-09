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

            <!-- Items Table -->
            <div class="px-6 pb-6">
                <hr class="border-dashed border-gray-300 mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">ITEMS</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">Item</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">QTY</th>
                                <th class="px-4 py-2">Unit</th>
                                <th class="px-4 py-2">Price/Unit</th>
                                <th class="px-4 py-2">Amount</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-2">
                                    <select name="items[0][id]" class="selectItem select2 w-full">
                                        <option value="">Select Item</option>
                                        @foreach($items as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-2">
                                    <input type="text" name="items[0][description]"
                                        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                                </td>
                                <td class="px-4 py-2">
                                    <input type="number" name="items[0][qty]" value="1"
                                        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm qty">
                                </td>
                                <td class="px-4 py-2">
                                    <select name="items[0][unit]" class="select2 w-full">
                                        <option>Piece</option>
                                        <option>Kg</option>
                                        <option>Box</option>
                                    </select>
                                </td>
                                <td class="px-4 py-2">
                                    <input type="number" name="items[0][price]" value="0"
                                        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm price">
                                </td>
                                <td class="px-4 py-2">
                                    <input type="text" name="items[0][amount]" readonly
                                        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm amount">
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <button type="button" class="removeRow bg-red-600 text-white px-3 py-1 rounded-md">X</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

<button type="button" id="addRow" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
    + ADD ROW
</button>

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
@endsection
<!-- Dynamic Row -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.querySelector('#itemsTable tbody');
    const addRowBtn = document.getElementById('addRow');
    const itemsList = @json($items ?? []);

    // Re-index input/select names: items[0][qty], items[1][price], etc.
    function reindexRows() {
        Array.from(tableBody.querySelectorAll('tr')).forEach((row, idx) => {
            row.querySelectorAll('input, select, textarea').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/items\[\d+\]/, `items[${idx}]`));
                }
            });
        });
    }

    // Update item options to avoid duplicate selection
    function updateItemOptions() {
        const selected = Array.from(document.querySelectorAll('.selectItem'))
            .map(s => s.value)
            .filter(v => v !== '');

        document.querySelectorAll('.selectItem').forEach(select => {
            const currentVal = select.value;

            // Destroy Select2 if initialized
            if (window.jQuery && $(select).data('select2')) {
                $(select).select2('destroy');
            }

            // Clear options
            select.innerHTML = '';

            // Default option
            const defaultOpt = document.createElement('option');
            defaultOpt.value = '';
            defaultOpt.textContent = 'Select Item';
            select.appendChild(defaultOpt);

            // Rebuild dropdown excluding duplicates
            Object.entries(itemsList).forEach(([id, name]) => {
                if (selected.includes(String(id)) && String(id) !== String(currentVal)) return;
                const opt = document.createElement('option');
                opt.value = id;
                opt.textContent = name;
                select.appendChild(opt);
            });

            // Restore selected value if still valid
            if (Array.from(select.options).some(o => o.value === currentVal)) {
                select.value = currentVal;
            } else {
                select.value = '';
            }

            // Re-initialize Select2
            if (window.jQuery && $.fn.select2 && select.classList.contains('select2')) {
                $(select).select2({ width: '100%' });
            }
        });
    }

    // Add new row (clean row, not duplicate clone)
    addRowBtn.addEventListener('click', function () {
        const rowCount = tableBody.rows.length;

        // Create new row
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td class="px-4 py-2">
                <select name="items[${rowCount}][id]" class="selectItem select2 w-full">
                    <option value="">Select Item</option>
                    ${Object.entries(itemsList).map(([id, name]) => `<option value="${id}">${name}</option>`).join('')}
                </select>
            </td>
            <td class="px-4 py-2">
                <input type="text" name="items[${rowCount}][description]"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
            </td>
            <td class="px-4 py-2">
                <input type="number" name="items[${rowCount}][qty]" value="1"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm qty">
            </td>
            <td class="px-4 py-2">
                <select name="items[${rowCount}][unit]" class="select2 w-full">
                    <option>Piece</option>
                    <option>Kg</option>
                    <option>Box</option>
                </select>
            </td>
            <td class="px-4 py-2">
                <input type="number" name="items[${rowCount}][price]" value="0"
                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm price">
            </td>
            <td class="px-4 py-2">
                <input type="text" name="items[${rowCount}][amount]" readonly
                    class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm amount">
            </td>
            <td class="px-4 py-2 text-center">
                <button type="button" class="removeRow bg-red-600 text-white px-3 py-1 rounded-md">X</button>
            </td>
        `;

        tableBody.appendChild(newRow);
        reindexRows();
        updateItemOptions();

        // Re-init select2 for new dropdowns
        if (window.jQuery && $.fn.select2) {
            $(newRow).find('.select2').select2({ width: '100%' });
        }
    });

    // Remove row
    tableBody.addEventListener('click', function (e) {
        if (e.target.classList.contains('removeRow')) {
            if (tableBody.rows.length > 1) {
                e.target.closest('tr').remove();
                reindexRows();
                updateItemOptions();
            } else {
                alert("At least one item is required!");
            }
        }
    });

    // Auto-calculate amount
    tableBody.addEventListener('input', function (e) {
        if (e.target.classList.contains('qty') || e.target.classList.contains('price')) {
            const row = e.target.closest('tr');
            const qty = parseFloat(row.querySelector('.qty').value) || 0;
            const price = parseFloat(row.querySelector('.price').value) || 0;
            row.querySelector('.amount').value = (qty * price).toFixed(2);
        }
    });

    // Update options when item selected
    tableBody.addEventListener('change', function (e) {
        if (e.target.classList.contains('selectItem')) {
            updateItemOptions();
        }
    });

    // Initialize Select2 for first time
    if (window.jQuery && $.fn.select2) {
        $('.select2').each(function () {
            if (!$(this).data('select2')) {
                $(this).select2({ width: '100%' });
            }
        });
    }

    // Initial update
    updateItemOptions();
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

