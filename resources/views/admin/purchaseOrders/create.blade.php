@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        
        <!-- Header -->
        <div class="bg-blue-600 text-white p-6">
            <h1 class="text-3xl font-bold">PURCHASE ORDER</h1>
        </div>

        <form action="{{ route('admin.purchase-orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Customer & Invoice Info -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left: Customer -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Customer Details</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Customer</label>
                        <select name="select_customer_id" class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
    focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                            <option value="">-- Select Customer --</option>
                            @foreach($select_customers as $id => $name)
                                <option value="{{ $id }}" {{ old('select_customer_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('select_customer_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Customer Name</label>
                        <input type="text" name="billing_name" value="{{ old('billing_name') }}" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                        @error('billing_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                        @error('phone_number') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Billing Address</label>
                        <textarea name="billing_address" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">{{ old('billing_address') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Shipping Address</label>
                        <textarea name="shipping_address" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">{{ old('shipping_address') }}</textarea>
                    </div>
                </div>

                <!-- Right: Invoice -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Order Details</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">PO Number</label>
                        <input type="text" name="po_no" value="{{ old('po_no') }}" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">PO Date</label>
                        <input type="date" name="po_date" value="{{ old('po_date') }}" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-Way Bill No.</label>
                        <input type="text" name="e_way_bill_no" value="{{ old('e_way_bill_no') }}" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Type</label>
                        <select name="payment_type_id" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                            <option value="">-- Select Payment Type --</option>
                            @foreach($payment_types as $id => $name)
                                <option value="{{ $id }}" {{ old('payment_type_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Reference No.</label>
                        <input type="text" name="reference_no" value="{{ old('reference_no') }}" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="px-6 pb-6">
                <hr class="border-dashed border-gray-300 mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Items</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2">Item</th>
                                <th class="px-4 py-2">Description</th>
                                <th class="px-4 py-2">Qty</th>
                                <th class="px-4 py-2">Unit</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="items[0][id]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm">
                                        <option value="">Select Item</option>
                                        @foreach($items as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="text" name="items[0][description]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm"></td>
                                <td><input type="number" name="items[0][qty]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" value="1"></td>
                                <td><input type="text" name="items[0][unit]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm"></td>
                                <td><input type="number" name="items[0][price]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm" value="0"></td>
                                <td><input type="text" name="items[0][amount]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
           focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm font-semibold" readonly></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" id="addRow" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    <i class="fas fa-plus mr-2"></i> ADD ROW
                </button>
            </div>

            <!-- File Uploads -->
              <!-- Attachment Upload -->
            <div class="px-6 pb-6">
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
            </div>

            <!-- Submit -->
            <div class="px-6 pb-6">
                <button type="submit" class="w-full mt-6 bg-green-600 hover:bg-green-700 text-white py-3 rounded-md flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i> SAVE PURCHASE ORDER
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JS for Dynamic Row -->
<script>
document.getElementById('addRow').addEventListener('click', function () {
    let table = document.querySelector('#itemsTable tbody');
    let rowCount = table.rows.length;
    let newRow = table.rows[0].cloneNode(true);

    newRow.querySelectorAll('input, select').forEach(el => {
        let name = el.getAttribute('name');
        if (name) {
            el.setAttribute('name', name.replace(/\d+/, rowCount));
            if (el.tagName === 'INPUT') el.value = (el.type === 'number') ? 0 : '';
        }
    });

    table.appendChild(newRow);
});
</script>


<script>
    Dropzone.options.imageDropzone = {
        url: '{{ route('admin.purchase-orders.storeMedia') }}',
        maxFilesize: 20, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 20,
            width: 4096,
            height: 4096
        },
        success: function (file, response) {
            $('form').find('input[name="image"]').remove()
            $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="image"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
            @if(isset($proformaInvoice) && $proformaInvoice->image)
                var file = {!! json_encode($proformaInvoice->image) !!};

                // Dropzone methods
                this.options.addedfile.call(this, file);
                this.options.thumbnail.call(this, file, file.url ?? file.preview_url);

                file.previewElement.classList.add('dz-complete');
                $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">');
                this.options.maxFiles = this.options.maxFiles - 1;
            @endif
        },
        error: function (file, response) {
            var message = $.type(response) === 'string' ? response : response.errors.file
            file.previewElement.classList.add('dz-error')
            var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            var _results = []
            for (var _i = 0, _len = _ref.length; _i < _len; _i++) {
                var node = _ref[_i]
                _results.push(node.textContent = message)
            }
            return _results
        }
    }
</script>

<script>
    Dropzone.options.documentDropzone = {
        url: '{{ route('admin.purchase-orders.storeMedia') }}',
        maxFilesize: 20, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 20
        },
        success: function (file, response) {
            $('form').find('input[name="document"]').remove()
            $('form').append('<input type="hidden" name="document" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="document"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
            @if(isset($proformaInvoice) && $proformaInvoice->document)
                var file = {!! json_encode($proformaInvoice->document) !!};

                this.options.addedfile.call(this, file);
                file.previewElement.classList.add('dz-complete');

                $('form').append('<input type="hidden" name="document" value="' + file.file_name + '">');
                this.options.maxFiles = this.options.maxFiles - 1;
            @endif
        },
        error: function (file, response) {
            var message = $.type(response) === 'string' ? response : response.errors.file
            file.previewElement.classList.add('dz-error')
            var _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
            var _results = []
            for (var _i = 0, _len = _ref.length; _i < _len; _i++) {
                var node = _ref[_i]
                _results.push(node.textContent = message)
            }
            return _results
        }
    }
</script>

@endsection
