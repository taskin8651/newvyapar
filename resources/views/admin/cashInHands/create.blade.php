@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md border border-gray-200">

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
                <i class="fas fa-cash-register text-indigo-600"></i>
                <span>{{ trans('global.create') }} {{ trans('cruds.cashInHand.title_singular') }}</span>
            </h2>
            <a href="{{ route('admin.cash-in-hands.index') }}" 
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
            <form method="POST" action="{{ route('admin.cash-in-hands.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Adjustment --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashInHand.fields.adjustment') }} <span class="text-red-500">*</span></label>
                    <select name="adjustment" id="adjustment" data-required="1" required
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                        <option value disabled {{ old('adjustment', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\CashInHand::ADJUSTMENT_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('adjustment') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('adjustment')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Enter Amount --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashInHand.fields.enter_amount') }} <span class="text-red-500">*</span></label>
                    <input type="number" name="enter_amount" id="enter_amount" data-required="1" step="0.01" value="{{ old('enter_amount', '') }}" 
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('enter_amount')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Adjustment Date --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashInHand.fields.adjustment_date') }}</label>
                    <input type="date" name="adjustment_date" id="adjustment_date" data-required="1" value="{{ old('adjustment_date') }}"
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    @error('adjustment_date')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.cashInHand.fields.description') }}</label>
                    <textarea name="description" id="description" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 ckeditor">{!! old('description') !!}</textarea>
                    @error('description')
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
@endsection

{{-- Progress Bar Script --}}
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
                            .then(function (file) {
                                return new Promise(function(resolve, reject) {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', '{{ route('admin.cash-in-hands.storeCKEditorImages') }}', true);
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
                                    data.append('crud_id', '{{ $cashInHand->id ?? 0 }}');
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
