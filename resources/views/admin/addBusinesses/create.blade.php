@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">
        
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-building"></i>
                {{ trans('global.create') }} {{ trans('cruds.addBusiness.title_singular') }}
            </h2>
            <a href="{{ route('admin.add-businesses.index') }}" 
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.add-businesses.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Grid Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Company Name -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="company_name" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.addBusiness.fields.company_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="company_name" id="company_name" 
                           value="{{ old('company_name', '') }}" required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('company_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Legal Name -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="legal_name" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.addBusiness.fields.legal_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="legal_name" id="legal_name" 
                           value="{{ old('legal_name', '') }}" required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('legal_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Business Type -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="business_type" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.addBusiness.fields.business_type') }}
                    </label>
                    <select name="business_type" id="business_type"
                            class="select2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value disabled {{ old('business_type', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\AddBusiness::BUSINESS_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('business_type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('business_type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Industry Type -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="industry_type" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.addBusiness.fields.industry_type') }}
                    </label>
                    <select name="industry_type" id="industry_type"
                            class="select2 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value disabled {{ old('industry_type', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\AddBusiness::INDUSTRY_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('industry_type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('industry_type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo Upload -->
                <div class="md:col-span-2 bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ trans('cruds.addBusiness.fields.logo_upload') }}
                    </label>
                    <div class="needsclick dropzone border-2 border-dashed rounded-lg p-6 text-center text-gray-500" id="logo_upload-dropzone"></div>
                    @error('logo_upload')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.add-businesses.index') }}" 
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
    var uploadedLogoUploadMap = {}
    Dropzone.options.logoUploadDropzone = {
        url: '{{ route('admin.add-businesses.storeMedia') }}',
        maxFilesize: 20, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        addRemoveLinks: true,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        params: { size: 20, width: 4096, height: 4096 },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="logo_upload[]" value="' + response.name + '">')
            uploadedLogoUploadMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = file.file_name !== undefined ? file.file_name : uploadedLogoUploadMap[file.name]
            $('form').find('input[name="logo_upload[]"][value="' + name + '"]').remove()
        },
        init: function () {
            @if(isset($addBusiness) && $addBusiness->logo_upload)
                var files = {!! json_encode($addBusiness->logo_upload) !!};
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="logo_upload[]" value="' + file.file_name + '">')
                }
            @endif
        },
        error: function (file, response) {
            var message = $.type(response) === 'string' ? response : response.errors.file
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
