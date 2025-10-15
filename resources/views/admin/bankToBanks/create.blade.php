@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div x-data="formProgress()" class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">
                    {{ trans('global.create') }} {{ trans('cruds.bankToBank.title_singular') }}
                </h2>

                {{-- Progress Bar --}}
                <div class="px-2 pb-6">
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-2">
                        <span>Account Setup Progress</span>
                        <span x-text="progress + '%'"></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4">
                        <div class="bg-indigo-600 h-1.5 rounded-full transition-all duration-300" 
                             :style="'width:' + progress + '%'"></div>
                    </div>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('admin.bank-to-banks.store') }}" enctype="multipart/form-data" class="space-y-6" @input="calculateProgress">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- From --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.bankToBank.fields.from') }}</label>
                            <select name="from_id" id="from_id" data-required="1"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                @foreach($froms as $id => $entry)
                                    <option value="{{ $id }}" {{ old('from_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @error('from_id')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- To --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.bankToBank.fields.to') }}</label>
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
                            <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.bankToBank.fields.amount') }} <span class="text-red-500">*</span></label>
                            <input type="number" name="amount" id="amount" data-required="1" step="0.01" value="{{ old('amount', '') }}" required
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @error('amount')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Adjustment Date --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.bankToBank.fields.adjustment_date') }}</label>
                            <input type="date" name="adjustment_date" id="adjustment_date" data-required="1" value="{{ date('Y-m-d') }}"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            @error('adjustment_date')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.bankToBank.fields.description') }}</label>
                        <textarea name="description" id="description" class="ckeditor w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">{!! old('description') !!}</textarea>
                        @error('description')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Attachment --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">{{ trans('cruds.bankToBank.fields.attechment') }}</label>
                        <div class="needsclick dropzone rounded-lg border-2 border-dashed border-indigo-400 p-4 bg-gray-50" id="attechment-dropzone"></div>
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

    // Dropzone config
    Dropzone.options.attechmentDropzone = {
        url: '{{ route('admin.bank-to-banks.storeMedia') }}',
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
