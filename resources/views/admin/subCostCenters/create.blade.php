@extends('layouts.admin')
@section('content')
<div class="content">

     
  <div class="max-w-5xl mx-auto bg-white shadow rounded-xl overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">
            {{ trans('global.create') }} {{ trans('cruds.subCostCenter.title_singular') }}
        </h3>
    </div>

    <div class="p-6">
        <form method="POST" action="{{ route('admin.sub-cost-centers.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- Main Cost Center --}}
            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <label for="main_cost_center_id" class="block font-semibold text-gray-700 mb-1">
                    {{ trans('cruds.subCostCenter.fields.main_cost_center') }} <span class="text-red-500">*</span>
                </label>
                <select name="main_cost_center_id" id="main_cost_center_id"
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200 select2"
                        required>
                    @foreach($main_cost_centers as $id => $entry)
                        <option value="{{ $id }}" {{ old('main_cost_center_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @error('main_cost_center')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.subCostCenter.fields.main_cost_center_helper') }}</p>
            </div>

            {{-- Sub Cost Center Name --}}
            <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                <label for="sub_cost_center_name" class="block font-semibold text-gray-700 mb-1">
                    {{ trans('cruds.subCostCenter.fields.sub_cost_center_name') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" name="sub_cost_center_name" id="sub_cost_center_name"
                       value="{{ old('sub_cost_center_name', '') }}"
                       class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200"
                       required>
                @error('sub_cost_center_name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.subCostCenter.fields.sub_cost_center_name_helper') }}</p>
            </div>

            {{-- Unique Code --}}
            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <label for="unique_code" class="block font-semibold text-gray-700 mb-1">
                    {{ trans('cruds.subCostCenter.fields.unique_code') }}
                </label>
                <input type="text" name="unique_code" id="unique_code"
                       value="{{ old('unique_code', '') }}"
                       class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                @error('unique_code')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.subCostCenter.fields.unique_code_helper') }}</p>
            </div>

            {{-- Responsible Manager --}}
            <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                <label for="responsible_manager" class="block font-semibold text-gray-700 mb-1">
                    {{ trans('cruds.subCostCenter.fields.responsible_manager') }} <span class="text-red-500">*</span>
                </label>
                <input type="text" name="responsible_manager" id="responsible_manager"
                       value="{{ old('responsible_manager', '') }}"
                       class="w-full p-2 border rounded-md focus:ring focus:ring-green-200"
                       required>
                @error('responsible_manager')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.subCostCenter.fields.responsible_manager_helper') }}</p>
            </div>

            {{-- Budget Allocated --}}
            <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                <label for="budget_allocated" class="block font-semibold text-gray-700 mb-1">
                    {{ trans('cruds.subCostCenter.fields.budget_allocated') }}
                </label>
                <input type="text" name="budget_allocated" id="budget_allocated"
                       value="{{ old('budget_allocated', '') }}"
                       class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                @error('budget_allocated')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.subCostCenter.fields.budget_allocated_helper') }}</p>
            </div>

            {{-- Actual Expense --}}
            <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                <label for="actual_expense" class="block font-semibold text-gray-700 mb-1">
                    {{ trans('cruds.subCostCenter.fields.actual_expense') }}
                </label>
                <input type="text" name="actual_expense" id="actual_expense"
                       value="{{ old('actual_expense', '') }}"
                       class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                @error('actual_expense')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.subCostCenter.fields.actual_expense_helper') }}</p>
            </div>

            {{-- Start Date --}}
            <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                <label for="start_date" class="block font-semibold text-gray-700 mb-1">
                    {{ trans('cruds.subCostCenter.fields.start_date') }}
                </label>
                <input type="text" name="start_date" id="start_date"
                       value="{{ old('start_date') }}"
                       class="date w-full p-2 border rounded-md focus:ring focus:ring-purple-200">
                @error('start_date')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.subCostCenter.fields.start_date_helper') }}</p>
            </div>

            {{-- Status --}}
            <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                <label for="status" class="block font-semibold text-gray-700 mb-1">
                    {{ trans('cruds.subCostCenter.fields.status') }}
                </label>
                <select name="status" id="status"
                        class="w-full p-2 border rounded-md focus:ring focus:ring-purple-200">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}
                    </option>
                    @foreach(App\Models\SubCostCenter::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'Active') === (string) $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.subCostCenter.fields.status_helper') }}</p>
            </div>

            {{-- Details of Sub Cost Center (Full Width) --}}
            <div class="bg-gray-50 p-4 rounded-lg shadow-inner col-span-2">
                <label for="details_of_sub_cost_center" class="block font-semibold text-gray-700 mb-1">
                    {{ trans('cruds.subCostCenter.fields.details_of_sub_cost_center') }}
                </label>
                <textarea name="details_of_sub_cost_center" id="details_of_sub_cost_center"
                          class="ckeditor w-full p-2 border rounded-md focus:ring focus:ring-gray-200">{!! old('details_of_sub_cost_center') !!}</textarea>
                @error('details_of_sub_cost_center')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.subCostCenter.fields.details_of_sub_cost_center_helper') }}</p>
            </div>

            {{-- Submit Button (Full Width) --}}
            <div class="col-span-2 flex justify-start">
                <button type="submit"
                        class="px-6 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
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
                xhr.open('POST', '{{ route('admin.sub-cost-centers.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $subCostCenter->id ?? 0 }}');
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