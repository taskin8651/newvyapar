@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        
        <!-- Header -->
        <div class="bg-indigo-600 text-white p-6">
            <h1 class="text-3xl font-bold">Edit Purchase Bill</h1>
        </div>

        <form action="{{ route('admin.purchase-bills.update', $purchaseBill->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                                <option value="{{ $id }}" {{ old('select_customer_id', $purchaseBill->select_customer_id) == $id ? 'selected' : '' }}>
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
                                <option value="{{ $id }}" {{ old('main_cost_center_id', $purchaseBill->main_cost_center_id) == $id ? 'selected' : '' }}>
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
                            @foreach($subCostCenters as $id => $name)
                                <option value="{{ $id }}" {{ old('sub_cost_center_id', $purchaseBill->sub_cost_center_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Billing & Shipping Inputs -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Billing Name</label>
                        <input type="text" name="billing_name" id="billing_name"
                               value="{{ old('billing_name', $purchaseBill->billing_name) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number"
                               value="{{ old('phone_number', $purchaseBill->phone_number) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Billing Address</label>
                        <input type="text" name="billing_address" id="billing_address"
                               value="{{ old('billing_address', $purchaseBill->billing_address) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Shipping Address</label>
                        <textarea name="shipping_address" id="shipping_address" rows="4"
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">{{ old('shipping_address', $purchaseBill->shipping_address) }}</textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Invoice Details</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">PO No.</label>
                        <input type="text" name="po_no" value="{{ old('po_no', $purchaseBill->po_no) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">PO Date</label>
                        <input type="date" name="po_date" value="{{ old('po_date', $purchaseBill->po_date) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-Way Bill No.</label>
                        <input type="text" name="e_way_bill_no" value="{{ old('e_way_bill_no', $purchaseBill->e_way_bill_no) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>
                </div>
            </div>

          <!-- Items Table -->
<div class="overflow-x-auto px-6 pb-6">
    <table class="min-w-full border border-gray-300 text-sm rounded-lg overflow-hidden">
        <thead class="bg-gray-200 sticky top-0">
            <tr>
                <th class="border px-4 py-2 text-left text-gray-700">Item</th>
                <th class="border px-4 py-2 text-right text-gray-700">Qty</th>
                <th class="border px-4 py-2 text-left text-gray-700">Unit</th>
                <th class="border px-4 py-2 text-right text-gray-700">Rate</th>
                <th class="border px-4 py-2 text-right text-gray-700">Total</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($itemsWithPivot as $i => $item)
<tr class="hover:bg-gray-50">
    <td class="border px-4 py-2">
        <input type="text" name="items[{{ $i }}][name]" 
            value="{{ $item->item_name ?? '' }}" 
            readonly
            class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-100 text-gray-700">
        <input type="" name="items[{{ $i }}][id]" value="{{ (int) ($item->item_id ?? 0) }}">
    </td>
    <td class="border px-4 py-2">
        <input type="number" name="items[{{ $i }}][qty]" 
            value="{{ (int) ($item->qty ?? 0) }}" 
            class="w-full border border-gray-300 rounded px-2 py-1 text-right" 
            required>
    </td>
    <td class="border px-4 py-2">
        <input type="text" name="items[{{ $i }}][unit]" 
            value="{{ $item->unit ?? '' }}" 
            class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-50 text-gray-700">
    </td>
    <td class="border px-4 py-2">
        <input type="number" name="items[{{ $i }}][rate]" 
            value="{{ (float) ($item->purchase_price ?? 0) }}" 
            class="w-full border border-gray-300 rounded px-2 py-1 text-right">
    </td>
    <td class="border px-4 py-2">
        <input type="number" name="items[{{ $i }}][total]" 
            value="{{ ((int) ($item->qty ?? 0)) * ((float) ($item->purchase_price ?? 0)) }}" 
            readonly
            class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-100 text-right font-semibold">
    </td>
</tr>
@endforeach


        </tbody>
    </table>
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
                                <option value="{{ $id }}" {{ old('payment_type_id', $purchaseBill->payment_type_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Reference No</label>
                        <input type="text" name="reference_no" value="{{ old('reference_no', $purchaseBill->reference_no) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    </div>
                </div>
            </div>

            <!-- Upload Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-6 pb-6">
                <!-- Image Upload -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">Upload Image</h2>
                    @if($purchaseBill->getFirstMedia('image'))
                        <div class="mt-2">
                            <img src="{{ $purchaseBill->getFirstMediaUrl('image') }}" class="h-20 w-20 object-cover rounded-md" />
                            <p class="text-sm text-gray-600 mt-1">{{ basename($purchaseBill->getFirstMedia('image')->file_name) }}</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="mt-2">
                </div>

                <!-- Document Upload -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">Upload Document</h2>
                    @if($purchaseBill->getFirstMedia('document'))
                        <div class="mt-2">
                            <i class="fas fa-file text-gray-500 text-3xl"></i>
                            <p class="text-sm text-gray-600">{{ basename($purchaseBill->getFirstMedia('document')->file_name) }}</p>
                        </div>
                    @endif
                    <input type="file" name="document" accept=".pdf,.doc,.docx,.xls,.xlsx" class="mt-2">
                </div>
            </div>

            <!-- Notes -->
            <div class="px-6 pb-6">
                <h2 class="text-xl font-semibold text-gray-700">Notes</h2>
                <textarea name="notes" rows="3"
                          class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">{{ old('notes', $purchaseBill->notes) }}</textarea>
            </div>

            <!-- Save Button -->
            <div class="px-6 pb-6">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-md flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i> UPDATE PURCHASE BILL
                </button>
            </div>
        </form>
    </div>
</div>
@endsection



@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.purchase-bills.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $purchaseBill->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.purchase-bills.storeMedia') }}',
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
@if(isset($purchaseBill) && $purchaseBill->image)
      var file = {!! json_encode($purchaseBill->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    Dropzone.options.documentDropzone = {
    url: '{{ route('admin.purchase-bills.storeMedia') }}',
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
@if(isset($purchaseBill) && $purchaseBill->document)
      var file = {!! json_encode($purchaseBill->document) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="document" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection