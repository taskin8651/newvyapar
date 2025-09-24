@extends('layouts.admin')
@section('content')
<div class="content">

   <div class="p-6 max-w-5xl mx-auto">

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.sub-cost-centers.index') }}" 
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <!-- Edit Sub Cost Center Card -->
    <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

        <h2 class="text-2xl font-bold mb-6 text-blue-600">
            {{ trans('global.edit') }} {{ trans('cruds.subCostCenter.title_singular') }}
        </h2>

        <form method="POST" action="{{ route('admin.sub-cost-centers.update', [$subCostCenter->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Main Cost Center --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="main_cost_center_id" class="block font-semibold text-gray-700 mb-1 required">
                        {{ trans('cruds.subCostCenter.fields.main_cost_center') }}
                    </label>
                    <select name="main_cost_center_id" id="main_cost_center_id" required
                            class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                        @foreach($main_cost_centers as $id => $entry)
                            <option value="{{ $id }}" {{ (old('main_cost_center_id', $subCostCenter->main_cost_center->id ?? '') == $id) ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @error('main_cost_center') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Sub Cost Center Name --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="sub_cost_center_name" class="block font-semibold text-gray-700 mb-1 required">
                        {{ trans('cruds.subCostCenter.fields.sub_cost_center_name') }}
                    </label>
                    <input type="text" name="sub_cost_center_name" id="sub_cost_center_name"
                           value="{{ old('sub_cost_center_name', $subCostCenter->sub_cost_center_name) }}" required
                           class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                    @error('sub_cost_center_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Unique Code --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="unique_code" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.subCostCenter.fields.unique_code') }}
                    </label>
                    <input type="text" name="unique_code" id="unique_code"
                           value="{{ old('unique_code', $subCostCenter->unique_code) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-green-200">
                    @error('unique_code') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Responsible Manager --}}
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <label for="responsible_manager" class="block font-semibold text-gray-700 mb-1 required">
                        {{ trans('cruds.subCostCenter.fields.responsible_manager') }}
                    </label>
                    <input type="text" name="responsible_manager" id="responsible_manager"
                           value="{{ old('responsible_manager', $subCostCenter->responsible_manager) }}" required
                           class="w-full p-2 border rounded-md focus:ring focus:ring-purple-200">
                    @error('responsible_manager') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Budget Allocated --}}
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label for="budget_allocated" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.subCostCenter.fields.budget_allocated') }}
                    </label>
                    <input type="text" name="budget_allocated" id="budget_allocated"
                           value="{{ old('budget_allocated', $subCostCenter->budget_allocated) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                    @error('budget_allocated') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Actual Expense --}}
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label for="actual_expense" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.subCostCenter.fields.actual_expense') }}
                    </label>
                    <input type="text" name="actual_expense" id="actual_expense"
                           value="{{ old('actual_expense', $subCostCenter->actual_expense) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-yellow-200">
                    @error('actual_expense') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Start Date --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="start_date" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.subCostCenter.fields.start_date') }}
                    </label>
                    <input type="text" name="start_date" id="start_date"
                           value="{{ old('start_date', $subCostCenter->start_date) }}"
                           class="w-full p-2 border rounded-md focus:ring focus:ring-green-200 date">
                    @error('start_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Status --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="status" class="block font-semibold text-gray-700 mb-1 required">
                        {{ trans('cruds.subCostCenter.fields.status') }}
                    </label>
                    <select name="status" id="status" required
                            class="w-full p-2 border rounded-md focus:ring focus:ring-blue-200">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}
                        </option>
                        @foreach(App\Models\SubCostCenter::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $subCostCenter->status) === (string) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Details of Sub Cost Center --}}
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <label for="details_of_sub_cost_center" class="block font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.subCostCenter.fields.details_of_sub_cost_center') }}
                    </label>
                    <textarea name="details_of_sub_cost_center" id="details_of_sub_cost_center"
                              class="ckeditor w-full p-2 border rounded-md focus:ring focus:ring-pink-200">{!! old('details_of_sub_cost_center', $subCostCenter->details_of_sub_cost_center) !!}</textarea>
                    @error('details_of_sub_cost_center') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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