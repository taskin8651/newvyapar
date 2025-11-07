@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-exchange-alt"></i>
                {{ trans('global.create') }} {{ trans('cruds.bankToBank.title_singular') }}
            </h2>
            <a href="{{ route('admin.bank-to-banks.index') }}" 
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.bank-to-banks.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Grid Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- From -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="from_id" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.bankToBank.fields.from') }} <span class="text-red-500">*</span>
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
                    <label for="to_id" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.bankToBank.fields.to') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="to_id" id="to_id" required
                            class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach($tos as $id => $entry)
                            <option value="{{ $id }}" {{ old('to_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @error('to_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.bankToBank.fields.amount') }} <span class="text-red-500">*</span>
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
                        {{ trans('cruds.bankToBank.fields.adjustment_date') }}
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
                        {{ trans('cruds.bankToBank.fields.description') }}
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
                        {{ trans('cruds.bankToBank.fields.attechment') }}
                    </label>
                    <div class="needsclick dropzone border-2 border-dashed rounded-lg p-6 text-center text-gray-500" id="attechment-dropzone"></div>
                    @error('attechment')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.bank-to-banks.index') }}" 
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
