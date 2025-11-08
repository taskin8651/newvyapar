@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-balance-scale"></i>
                {{ trans('global.create') }} {{ trans('cruds.adjustBankBalance.title_singular') }}
            </h2>
            <a href="{{ route('admin.adjust-bank-balances.index') }}" 
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.adjust-bank-balances.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Grid Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- From -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="from_id" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.from') }} <span class="text-red-500">*</span>
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

                <!-- Type -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.type') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="type" id="type" required
                            class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\AdjustBankBalance::TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('type') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.amount') }} <span class="text-red-500">*</span>
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
                        {{ trans('cruds.adjustBankBalance.fields.adjustment_date') }}
                    </label>
                    <input type="date" name="adjustment_date" id="adjustment_date" 
                           value="{{ old('adjustment_date', date('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('adjustment_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2 bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.adjustBankBalance.fields.description') }}
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
                        {{ trans('cruds.adjustBankBalance.fields.attechment') }}
                    </label>
                    <div class="needsclick dropzone border-2 border-dashed rounded-lg p-6 text-center text-gray-500" id="attechment-dropzone"></div>
                    @error('attechment')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.adjust-bank-balances.index') }}" 
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

@endsection

@section('scripts')
<script>
    function formProgress() {
        return {
            progress: 0,
            calculateProgress() {
                let requiredFields = document.querySelectorAll('[data-required="1"]');
                let filled = 0;
                requiredFields.forEach(field => {
                    if (field.value && field.value.trim() !== '') {
                        filled++;
                    }
                });
                this.progress = Math.round((filled / requiredFields.length) * 100);
            }
        }
    }

    // CKEditor upload
    $(document).ready(function () {
        function SimpleUploadAdapter(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                return {
                    upload: () => {
                        return loader.file.then(file => {
                            return new Promise((resolve, reject) => {
                                let xhr = new XMLHttpRequest();
                                xhr.open('POST', '{{ route('admin.adjust-bank-balances.storeCKEditorImages') }}', true);
                                xhr.setRequestHeader('x-csrf-token', window._token);
                                xhr.setRequestHeader('Accept', 'application/json');
                                xhr.responseType = 'json';

                                xhr.addEventListener('error', () => reject(`Upload failed: ${ file.name }`));
                                xhr.addEventListener('abort', () => reject());
                                xhr.addEventListener('load', () => {
                                    let response = xhr.response;
                                    if (!response || xhr.status !== 201) {
                                        return reject(response && response.message ? response.message : xhr.statusText);
                                    }
                                    $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');
                                    resolve({ default: response.url });
                                });

                                let data = new FormData();
                                data.append('upload', file);
                                data.append('crud_id', '{{ $adjustBankBalance->id ?? 0 }}');
                                xhr.send(data);
                            })
                        })
                    }
                };
            }
        }
        document.querySelectorAll('.ckeditor').forEach(editor => {
            ClassicEditor.create(editor, { extraPlugins: [SimpleUploadAdapter] });
        });
    });

    // Dropzone
    Dropzone.options.attechmentDropzone = {
        url: '{{ route('admin.adjust-bank-balances.storeMedia') }}',
        maxFilesize: 20,
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        maxFiles: 1,
        addRemoveLinks: true,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        params: { size: 20, width: 4096, height: 4096 },
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
    }
</script>
@endsection
