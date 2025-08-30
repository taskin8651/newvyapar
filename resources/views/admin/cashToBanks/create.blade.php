@extends('layouts.admin')
@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md border border-gray-200">

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
                <i class="fas fa-exchange-alt text-indigo-600"></i>
                <span>{{ trans('global.create') }} {{ trans('cruds.cashToBank.title_singular') }}</span>
            </h2>
            <a href="{{ route('admin.cash-to-banks.index') }}" 
               class="text-sm text-gray-500 hover:text-indigo-600 transition flex items-center gap-1">
                <i class="fas fa-arrow-left"></i> {{ trans('global.back_to_list') }}
            </a>
        </div>

        {{-- Progress Bar --}}
        <div class="px-6 pt-4">
            <div class="flex justify-between items-center text-sm text-gray-500 mb-2">
                <span>Form Completion Progress</span>
                <span id="progress-text">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4">
                <div id="progress-bar" class="bg-indigo-600 h-1.5 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
        </div>

        {{-- Form --}}
        <div class="px-6 py-6">
            <form method="POST" action="{{ route('admin.cash-to-banks.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- From --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashToBank.fields.from') }}</label>
                    <input type="text" name="from" id="from" data-required="1" value="{{ old('from', 'Cash') }}"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('from')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- To --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashToBank.fields.to') }}</label>
                    <select name="to_id" id="to_id" data-required="1"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        @foreach($tos as $id => $entry)
                            <option value="{{ $id }}" {{ old('to_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @error('to_id')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Amount --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashToBank.fields.amount') }} <span class="text-red-500">*</span></label>
                    <input type="number" name="amount" id="amount" data-required="1" step="0.01" value="{{ old('amount', '') }}" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('amount')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Adjustment Date --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashToBank.fields.adjustment_date') }}</label>
                    <input type="date" name="adjustment_date" id="adjustment_date" data-required="1" value="{{ old('adjustment_date') }}"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('adjustment_date')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                </div>

                {{-- Description --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashToBank.fields.description') }}</label>
                    <textarea name="description" id="description" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 ckeditor">{!! old('description') !!}</textarea>
                    @error('description')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Attachment --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashToBank.fields.attechment') }}</label>
                    <div class="needsclick dropzone" id="attechment-dropzone"></div>
                    @error('attechment')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="flex justify-end pt-4">
                    <button type="submit" 
                            class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center gap-2">
                        <i class="fas fa-check-circle"></i> {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

{{-- Progress Bar --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputs = document.querySelectorAll('input[data-required], select[data-required], textarea[data-required]');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');

    function updateProgress() {
        let filled = 0;
        inputs.forEach(input => { if(input.value.trim() !== '') filled++; });
        const percent = Math.round((filled / inputs.length) * 100);
        progressBar.style.width = percent + '%';
        progressText.textContent = percent + '%';
    }

    inputs.forEach(input => input.addEventListener('input', updateProgress));
    inputs.forEach(input => input.addEventListener('change', updateProgress));
    updateProgress();
});
</script>

{{-- CKEditor --}}
<script>
$(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file.then(function(file) {
            return new Promise(function(resolve, reject) {
              var xhr = new XMLHttpRequest();
              xhr.open('POST', '{{ route('admin.cash-to-banks.storeCKEditorImages') }}', true);
              xhr.setRequestHeader('x-csrf-token', window._token);
              xhr.setRequestHeader('Accept', 'application/json');
              xhr.responseType = 'json';
              var genericErrorText = `Couldn't upload file: ${ file.name }.`;
              xhr.addEventListener('error', () => reject(genericErrorText));
              xhr.addEventListener('abort', () => reject());
              xhr.addEventListener('load', function() {
                var response = xhr.response;
                if (!response || xhr.status !== 201) {
                  return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                }
                $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');
                resolve({ default: response.url });
              });
              var data = new FormData();
              data.append('upload', file);
              data.append('crud_id', '{{ $cashToBank->id ?? 0 }}');
              xhr.send(data);
            });
          });
        }
      };
    }
  }
  document.querySelectorAll('.ckeditor').forEach(editor => {
    ClassicEditor.create(editor, { extraPlugins: [SimpleUploadAdapter] });
  });
});
</script>

{{-- Dropzone --}}
<script>
Dropzone.options.attechmentDropzone = {
    url: '{{ route('admin.cash-to-banks.storeMedia') }}',
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
      @if(isset($cashToBank) && $cashToBank->attechment)
        var file = {!! json_encode($cashToBank->attechment) !!};
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
