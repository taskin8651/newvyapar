@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-exchange-alt"></i>
                {{ trans('global.create') }} {{ trans('cruds.bankToCash.title_singular') }}
            </h2>
            <a href="{{ route('admin.bank-to-cashes.index') }}" 
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.bank-to-cashes.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Grid Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- From -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="from_id" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.bankToCash.fields.from') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="from_id" id="from_id" required
                            class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach($froms as $id => $entry)
                            <option value="{{ $id }}" {{ old('from_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @error('from_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- To -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="to" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.bankToCash.fields.to') }}
                    </label>
                    <input type="text" name="to" id="to" value="{{ old('to', 'Cash') }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('to')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.bankToCash.fields.amount') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="amount" id="amount" step="0.01" value="{{ old('amount', '') }}" required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('amount')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Adjustment Date -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="adjustment_date" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.bankToCash.fields.adjustment_date') }}
                    </label>
                    <input type="date" name="adjustment_date" id="adjustment_date" value="{{ old('adjustment_date') }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('adjustment_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2 bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.bankToCash.fields.description') }}
                    </label>
                    <textarea name="description" id="description" 
                              class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 ckeditor">{!! old('description') !!}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Attachment -->
                <div class="md:col-span-2 bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ trans('cruds.bankToCash.fields.attechment') }}
                    </label>
                    <div class="needsclick dropzone border-2 border-dashed rounded-lg p-6 text-center text-gray-500" id="attechment-dropzone"></div>
                    @error('attechment')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.bank-to-cashes.index') }}" 
                   class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow-sm hover:bg-gray-200 transition">
                    {{ trans('global.cancel') }}
                </a>
                <button type="submit" 
                        class="px-5 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow-md hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-1"></i> {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('input[data-required], select[data-required], textarea[data-required]');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');

    function updateProgress() {
        let filled = 0;
        inputs.forEach(input => {
            if (input.value.trim() !== '') filled++;
        });
        const percent = Math.round((filled / inputs.length) * 100);
        progressBar.style.width = percent + '%';
        progressText.textContent = percent + '%';
    }

    inputs.forEach(input => input.addEventListener('input', updateProgress));
    inputs.forEach(input => input.addEventListener('change', updateProgress));

    updateProgress();
});
</script>

{{-- CKEditor Upload --}}
<script>
$(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function(file) {
              return new Promise(function(resolve, reject) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.bank-to-cashes.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';
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
    ClassicEditor.create(allEditors[i], { extraPlugins: [SimpleUploadAdapter] });
  }
});
</script>

{{-- Dropzone --}}
<script>
Dropzone.options.attechmentDropzone = {
    url: '{{ route('admin.bank-to-cashes.storeMedia') }}',
    maxFilesize: 20,
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
    success: function (file, response) {
      $('form').find('input[name="attechment"]').remove()
      $('form').append('<input type="hidden" name="attechment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      $('form').find('input[name="attechment"]').remove()
      this.options.maxFiles += 1
    },
    init: function () {
      @if(isset($bankToCash) && $bankToCash->attechment)
        var file = {!! json_encode($bankToCash->attechment) !!};
        this.options.addedfile.call(this, file)
        this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="attechment" value="' + file.file_name + '">')
        this.options.maxFiles -= 1
      @endif
    },
    error: function (file, response) {
        var message = $.type(response) === 'string' ? response : response.errors.file
        file.previewElement.classList.add('dz-error')
        var nodes = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        nodes.forEach(node => node.textContent = message)
    }
}
</script>
@endsection
