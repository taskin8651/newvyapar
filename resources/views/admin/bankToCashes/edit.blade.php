@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.bank-to-cashes.index') }}" 
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Edit Bank to Cash Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.edit') }} {{ trans('cruds.bankToCash.title_singular') }}
            </h2>

            <form method="POST" action="{{ route('admin.bank-to-cashes.update', [$bankToCash->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- From --}}
                    <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                        <label for="from_id" class="block font-semibold text-gray-700 mb-1 required">
                            {{ trans('cruds.bankToCash.fields.from') }}
                        </label>
                        <select name="from_id" id="from_id" required
                                class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                            @foreach($froms as $id => $entry)
                                <option value="{{ $id }}" {{ (old('from_id', $bankToCash->from->id ?? '') == $id) ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @error('from')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span class="text-gray-500 text-xs">{{ trans('cruds.bankToCash.fields.from_helper') }}</span>
                    </div>

                    {{-- To --}}
                    <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                        <label for="to" class="block font-semibold text-gray-700 mb-1">
                            {{ trans('cruds.bankToCash.fields.to') }}
                        </label>
                        <input type="text" name="to" id="to"
                               value="{{ old('to', $bankToCash->to) }}"
                               class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                        @error('to')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span class="text-gray-500 text-xs">{{ trans('cruds.bankToCash.fields.to_helper') }}</span>
                    </div>

                    {{-- Amount --}}
                    <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                        <label for="amount" class="block font-semibold text-gray-700 mb-1 required">
                            {{ trans('cruds.bankToCash.fields.amount') }}
                        </label>
                        <input type="number" name="amount" id="amount" step="0.01"
                               value="{{ old('amount', $bankToCash->amount) }}" required
                               class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                        @error('amount')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span class="text-gray-500 text-xs">{{ trans('cruds.bankToCash.fields.amount_helper') }}</span>
                    </div>

                    {{-- Adjustment Date --}}
                    <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                        <label for="adjustment_date" class="block font-semibold text-gray-700 mb-1">
                            {{ trans('cruds.bankToCash.fields.adjustment_date') }}
                        </label>
                        <input type="text" name="adjustment_date" id="adjustment_date"
                               value="{{ old('adjustment_date', $bankToCash->adjustment_date) }}"
                               class="w-full p-2 border rounded-md focus:ring focus:ring-green-200 date">
                        @error('adjustment_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span class="text-gray-500 text-xs">{{ trans('cruds.bankToCash.fields.adjustment_date_helper') }}</span>
                    </div>

                    {{-- Description --}}
                    <div class="bg-pink-50 p-4 rounded-lg shadow-inner md:col-span-2">
                        <label for="description" class="block font-semibold text-gray-700 mb-1">
                            {{ trans('cruds.bankToCash.fields.description') }}
                        </label>
                        <textarea name="description" id="description"
                                  class="ckeditor w-full p-2 border rounded-md focus:ring focus:ring-pink-200">{!! old('description', $bankToCash->description) !!}</textarea>
                        @error('description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span class="text-gray-500 text-xs">{{ trans('cruds.bankToCash.fields.description_helper') }}</span>
                    </div>

                    {{-- Attachment --}}
                    <div class="bg-yellow-50 p-4 rounded-lg shadow-inner md:col-span-2">
                        <label for="attechment" class="block font-semibold text-gray-700 mb-1">
                            {{ trans('cruds.bankToCash.fields.attechment') }}
                        </label>
                        <div class="needsclick dropzone border-2 border-dashed border-yellow-300 p-4 rounded-lg" id="attechment-dropzone"></div>
                        @error('attechment')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <span class="text-gray-500 text-xs">{{ trans('cruds.bankToCash.fields.attechment_helper') }}</span>
                    </div>

                </div>

                <!-- Save Button -->
                <div class="mt-6">
                    <button type="submit"
                            class="px-6 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                        {{ trans('global.save') }}
                    </button>
                </div>

            </form>
        </div>

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
                xhr.open('POST', '{{ route('admin.bank-to-cashes.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $bankToCash->id ?? 0 }}');
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
    Dropzone.options.attechmentDropzone = {
    url: '{{ route('admin.bank-to-cashes.storeMedia') }}',
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
      $('form').find('input[name="attechment"]').remove()
      $('form').append('<input type="hidden" name="attechment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="attechment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($bankToCash) && $bankToCash->attechment)
      var file = {!! json_encode($bankToCash->attechment) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="attechment" value="' + file.file_name + '">')
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