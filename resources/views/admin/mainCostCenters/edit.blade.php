@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.mainCostCenter.title_singular') }}
                </div> --}}
   <div class="p-6 max-w-5xl mx-auto">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.main-cost-centers.index') }}" 
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <!-- Edit Main Cost Center Card -->
    <div class="bg-white shadow-lg rounded-xl p-6 text-sm">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">
            {{ trans('global.edit') }} {{ trans('cruds.mainCostCenter.title_singular') }}
        </h2>

        <form method="POST" action="{{ route('admin.main-cost-centers.update', [$mainCostCenter->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Cost Center Name -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="cost_center_name" class="block font-semibold text-gray-700 mb-1 required">
                        {{ trans('cruds.mainCostCenter.fields.cost_center_name') }}
                    </label>
                    <input type="text" name="cost_center_name" id="cost_center_name" 
                           value="{{ old('cost_center_name', $mainCostCenter->cost_center_name) }}" required
                           class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                    @error('cost_center_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Unique Code -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="unique_code" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.mainCostCenter.fields.unique_code') }}
                    </label>
                    <input type="text" name="unique_code" id="unique_code" 
                           value="{{ old('unique_code', $mainCostCenter->unique_code) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                    @error('unique_code') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Details of Cost Center -->
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <label for="details_of_cost_center" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.mainCostCenter.fields.details_of_cost_center') }}
                    </label>
                    <textarea name="details_of_cost_center" id="details_of_cost_center" 
                              class="ckeditor w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">{{ old('details_of_cost_center', $mainCostCenter->details_of_cost_center) }}</textarea>
                    @error('details_of_cost_center') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Link with Company -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <label for="link_with_company_id" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.mainCostCenter.fields.link_with_company') }}
                    </label>
                    <select name="link_with_company_id" id="link_with_company_id" 
                            class="w-full p-2 border rounded-md focus:ring focus:ring-purple-200">
                        @foreach($link_with_companies as $id => $entry)
                            <option value="{{ $id }}" {{ (old('link_with_company_id', $mainCostCenter->link_with_company->id ?? '') == $id) ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                    @error('link_with_company') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Responsible Manager -->
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <label for="responsible_manager_id" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.mainCostCenter.fields.responsible_manager') }}
                    </label>
                    <select name="responsible_manager_id" id="responsible_manager_id" 
                            class="w-full p-2 border rounded-md focus:ring focus:ring-purple-200">
                        @foreach($responsible_managers as $id => $entry)
                            <option value="{{ $id }}" {{ (old('responsible_manager_id', $mainCostCenter->responsible_manager->id ?? '') == $id) ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                    @error('responsible_manager') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Location -->
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <label for="location" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.mainCostCenter.fields.location') }}
                    </label>
                    <textarea name="location" id="location" 
                              class="ckeditor w-full p-2 border rounded-md focus:ring focus:ring-pink-200">{{ old('location', $mainCostCenter->location) }}</textarea>
                    @error('location') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Budget Amount -->
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <label for="budget_amount" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.mainCostCenter.fields.budget_amount') }}
                    </label>
                    <input type="number" step="0.01" name="budget_amount" id="budget_amount" 
                           value="{{ old('budget_amount', $mainCostCenter->budget_amount) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-indigo-200">
                    @error('budget_amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Actual Amount -->
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner">
                    <label for="actual_amount" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.mainCostCenter.fields.actual_amount') }}
                    </label>
                    <input type="number" step="0.01" name="actual_amount" id="actual_amount" 
                           value="{{ old('actual_amount', $mainCostCenter->actual_amount) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-indigo-200">
                    @error('actual_amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Start Date -->
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="start_date" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.mainCostCenter.fields.start_date') }}
                    </label>
                    <input type="text" name="start_date" id="start_date" 
                           value="{{ old('start_date', $mainCostCenter->start_date) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-green-200 date">
                    @error('start_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Status -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="status" class="block font-semibold text-gray-700 mb-1 required">
                        {{ trans('cruds.mainCostCenter.fields.status') }}
                    </label>
                    <select name="status" id="status" required 
                            class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\MainCostCenter::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $mainCostCenter->status) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Save Button -->
            <div class="mt-6">
                <button type="submit" class="px-6 py-2 bg-red-500 text-white font-semibold rounded-lg shadow hover:bg-red-600 transition">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

            </div>



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
                xhr.open('POST', '{{ route('admin.main-cost-centers.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $mainCostCenter->id ?? 0 }}');
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

@endsection