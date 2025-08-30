@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        
        <!-- Header -->
        <div class="bg-indigo-600 text-white p-6">
            <h1 class="text-3xl font-bold">CREATE PAYMENT OUT</h1>
        </div>

        <form action="{{ route('admin.payment-outs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Party & Payment Info -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Party Details</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Party</label>
                        <select name="parties_id" class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                            @foreach($parties as $id => $name)
                                <option value="{{ $id }}" {{ old('parties_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parties_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Type</label>
                        <select name="payment_type_id" class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
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
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Payment Info</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" value="{{ old('date') }}" 
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                        @error('date')
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

            <!-- Amount Section -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" 
                           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Discount</label>
                    <input type="number" step="0.01" name="discount" value="{{ old('discount') }}" 
                           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    @error('discount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Total</label>
                    <input type="number" step="0.01" name="total" value="{{ old('total') }}" 
                           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    @error('total')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

  

            <!-- Description -->
            <div class="px-6 pb-6">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

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

            <!-- Save Button -->
            <div class="px-6 pb-6">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-md flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i> SAVE PAYMENT OUT
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Dropzone Script -->
<script>
    Dropzone.options.attachmentDropzone = {
        url: '{{ route('admin.payment-outs.storeMedia') }}',
        maxFilesize: 20, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        success: function (file, response) {
            $('form').find('input[name="attachment"]').remove()
            $('form').append('<input type="hidden" name="attachment" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="attachment"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
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
