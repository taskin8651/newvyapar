@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        
        <!-- Header -->
        <div class="bg-purple-600 text-white p-6">
            <h1 class="text-3xl font-bold">ESTIMATE / QUOTATION</h1>
        </div>

        <form action="{{ route('admin.estimate-quotations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Customer & Estimate Info -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Bill To</h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Customer</label>
                        <select name="select_customer_id" class="select2 w-full @error('title') border-red-500 @enderror">
                            @foreach($select_customers as $id => $entry)
                                <option value="{{ $id }}" {{ old('select_customer_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Billing Name</label>
                        <input type="text" name="billing_name" value="{{ old('billing_name') }}" 
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" 
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Billing Address</label>
                        <textarea name="billing_address" rows="3" 
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">{{ old('billing_address') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Shipping Address</label>
                        <textarea name="shipping_address" rows="3" 
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">{{ old('shipping_address') }}</textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Estimate Details</h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estimate No. (PO No.)</label>
                        <input type="text" name="po_no" value="{{ old('po_no') }}" 
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estimate Date</label>
                        <input type="date" name="po_date" value="{{ old('po_date') }}" 
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-Way Bill No.</label>
                        <input type="text" name="e_way_bill_no" value="{{ old('e_way_bill_no') }}" 
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
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
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Item</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Qty</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Unit</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Price/Unit</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Tax %</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Discount</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>


                                <!-- Table Cell -->
                                <td class="px-4 py-2">
                                    <select name="items[0][id]"
                                        class="select2 w-full @error('title') border-red-500 @enderror">
                                        <option value="">Select Item</option>
                                        @foreach($items as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </td>

        


                                <td class="px-4 py-2">
                                    <input type="text" name="items[0][description]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                                </td>
                                <td class="px-4 py-2">
                                    <input type="number" name="items[0][qty]" value="1" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                                </td>
                                <td class="px-4 py-2">
                                    <select name="items[0][unit]" class="select2 w-full @error('title') border-red-500 @enderror">
                                        <option>Unit</option>
                                        <option>Piece</option>
                                        <option>Kg</option>
                                        <option>Box</option>
                                    </select>
                                </td>
                                <td class="px-4 py-2">
                                    <input type="number" name="items[0][price]" value="0" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                                </td>
                                <td class="px-4 py-2">
                                    <select name="items[0][tax]" class="select2 w-full @error('title') border-red-500 @enderror">
                                        <option value="0">0%</option>
                                        <option value="5">5%</option>
                                        <option value="12">12%</option>
                                        <option value="18">18%</option>
                                    </select>
                                </td>
                                <td class="px-4 py-2">
                                    <input type="number" name="items[0][discount]" value="0" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                                </td>
                                <td class="px-4 py-2">
                                    <input type="text" name="items[0][amount]" readonly class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" id="addRow" class="mt-4 bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md">
                    + ADD ROW
                </button>
            </div>

          <!-- Notes & Totals -->
<div class="px-6 pb-6 grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Left Side -->
    <div class="space-y-6">

        <!-- Notes -->
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Notes</h2>
            <textarea name="notes" rows="3"
                class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
                focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm 
                @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
        </div>

        <!-- Terms -->
        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Terms & Conditions</h2>
            <textarea name="terms" rows="3"
                class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm 
                focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm 
                @error('terms') border-red-500 @enderror">{{ old('terms') }}</textarea>
        </div>

        <!-- Upload Image -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image</label>
            <div id="image-dropzone"
                class="dropzone flex items-center justify-center border-2 border-dashed rounded-lg 
                p-6 bg-gray-50 text-gray-500 cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition">
                <div class="text-center">
                    <i class="fas fa-image text-3xl mb-2"></i>
                    <p class="text-sm">Drag & Drop Image or Click to Upload</p>
                </div>
            </div>
        </div>

        <!-- Upload Document -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Document</label>
            <div id="document-dropzone"
                class="dropzone flex items-center justify-center border-2 border-dashed rounded-lg 
                p-6 bg-gray-50 text-gray-500 cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition">
                <div class="text-center">
                    <i class="fas fa-file-alt text-3xl mb-2"></i>
                    <p class="text-sm">Drag & Drop Document or Click to Upload</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side -->
    <div>
        <div class="bg-gray-50 p-6 rounded-lg shadow space-y-2">
            <div class="flex justify-between">
                <span>Subtotal:</span>
                <span id="subtotal">0.00</span>
            </div>
            <div class="flex justify-between">
                <span>Tax:</span>
                <span id="tax">0.00</span>
            </div>
            <div class="flex justify-between">
                <span>Discount:</span>
                <span id="discount">0.00</span>
            </div>
            <div class="flex justify-between border-t pt-2 font-bold">
                <span>Total:</span>
                <span id="total">0.00</span>
            </div>
        </div>

        <!-- Save Button -->
        <div class="mt-6">
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-md 
                flex items-center justify-center shadow-md transition">
                <i class="fas fa-save mr-2"></i> SAVE ESTIMATE
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    Dropzone.autoDiscover = false;

    // Image Upload
    var imageDropzone = new Dropzone("#image-dropzone", {
        url: "{{ route('admin.estimate-quotations.storeMedia') }}",
        maxFilesize: 5, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        addRemoveLinks: true,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            $('form').find('input[name="image"]').remove()
        }
    });

    // Document Upload
    var documentDropzone = new Dropzone("#document-dropzone", {
        url: "{{ route('admin.estimate-quotations.storeMedia') }}",
        maxFilesize: 10, // MB
        acceptedFiles: '.pdf,.doc,.docx,.xls,.xlsx',
        addRemoveLinks: true,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="document" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            $('form').find('input[name="document"]').remove()
        }
    });
</script>
@endpush

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
            let newName = name.replace(/\d+/, rowCount);
            el.setAttribute('name', newName);
            if (el.tagName === 'INPUT') el.value = '';
        }
    });

    table.appendChild(newRow);
});
</script>
@endsection
