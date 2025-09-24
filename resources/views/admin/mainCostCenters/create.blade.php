@extends('layouts.admin')
@section('content')
<div class="content py-8">

    <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg p-8">

        <h1 class="text-3xl font-extrabold mb-8 text-indigo-600">
            {{ trans('global.create') }} {{ trans('cruds.mainCostCenter.title_singular') }}
        </h1>

        <form method="POST" action="{{ route('admin.main-cost-centers.store') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Row 1: Cost Center Name | Unique Code | Status -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="relative">
                    <input type="text" name="cost_center_name" id="cost_center_name" value="{{ old('cost_center_name', '') }}" required
                        class="peer block w-full rounded-xl border border-gray-300 bg-transparent px-3 pt-5 pb-2 text-gray-900 placeholder-transparent focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm"
                        placeholder="Cost Center Name">
                    <label for="cost_center_name" class="absolute left-3 top-2 text-gray-500 text-sm transition-all
                        peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base
                        peer-focus:top-2 peer-focus:text-gray-700 peer-focus:text-sm">
                        Cost Center Name *
                    </label>
                    @error('cost_center_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="relative">
                    <input type="text" name="unique_code" id="unique_code" value="{{ old('unique_code', '') }}"
                        class="peer block w-full rounded-xl border border-gray-300 bg-transparent px-3 pt-5 pb-2 text-gray-900 placeholder-transparent focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm"
                        placeholder="Unique Code">
                    <label for="unique_code" class="absolute left-3 top-2 text-gray-500 text-sm transition-all
                        peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base
                        peer-focus:top-2 peer-focus:text-gray-700 peer-focus:text-sm">
                        Unique Code
                    </label>
                    @error('unique_code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="relative">
                    <select name="status" id="status" required
                        class="block w-full rounded-xl border border-gray-300 bg-transparent px-3 pt-5 pb-2 text-gray-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm">
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>Select Status</option>
                        @foreach(App\Models\MainCostCenter::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', 'Active') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Row 2: Company | Manager | Budget Amount -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="relative">
                    <select name="link_with_company_id" id="link_with_company_id"
                        class="block w-full rounded-xl border border-gray-300 bg-transparent px-3 pt-5 pb-2 text-gray-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm">
                        <option value="">Select Company</option>
                        @foreach($link_with_companies as $id => $entry)
                            <option value="{{ $id }}" {{ old('link_with_company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @error('link_with_company') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="relative">
                    <select name="responsible_manager_id" id="responsible_manager_id"
                        class="block w-full rounded-xl border border-gray-300 bg-transparent px-3 pt-5 pb-2 text-gray-900 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm">
                        <option value="">Select Manager</option>
                        @foreach($responsible_managers as $id => $entry)
                            <option value="{{ $id }}" {{ old('responsible_manager_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @error('responsible_manager') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="relative">
                    <input type="number" step="0.01" name="budget_amount" id="budget_amount" value="{{ old('budget_amount', '') }}"
                        class="peer block w-full rounded-xl border border-gray-300 bg-transparent px-3 pt-5 pb-2 text-gray-900 placeholder-transparent focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm"
                        placeholder="Budget Amount">
                    <label for="budget_amount" class="absolute left-3 top-2 text-gray-500 text-sm transition-all
                        peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base
                        peer-focus:top-2 peer-focus:text-gray-700 peer-focus:text-sm">
                        Budget Amount
                    </label>
                    @error('budget_amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Row 3: Actual Amount | Start Date | Empty placeholder -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="relative">
                    <input type="number" step="0.01" name="actual_amount" id="actual_amount" value="{{ old('actual_amount', '') }}"
                        class="peer block w-full rounded-xl border border-gray-300 bg-transparent px-3 pt-5 pb-2 text-gray-900 placeholder-transparent focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm"
                        placeholder="Actual Amount">
                    <label for="actual_amount" class="absolute left-3 top-2 text-gray-500 text-sm transition-all
                        peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base
                        peer-focus:top-2 peer-focus:text-gray-700 peer-focus:text-sm">
                        Actual Amount
                    </label>
                    @error('actual_amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="relative">
                    <input type="text" name="start_date" id="start_date" value="{{ old('start_date') }}"
                        class="peer block w-full rounded-xl border border-gray-300 bg-transparent px-3 pt-5 pb-2 text-gray-900 placeholder-transparent focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 focus:outline-none shadow-sm date"
                        placeholder="Start Date">
                    <label for="start_date" class="absolute left-3 top-2 text-gray-500 text-sm transition-all
                        peer-placeholder-shown:top-5 peer-placeholder-shown:text-gray-400 peer-placeholder-shown:text-base
                        peer-focus:top-2 peer-focus:text-gray-700 peer-focus:text-sm">
                        Start Date
                    </label>
                    @error('start_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div></div>
            </div>

            <!-- Full-width CKEditor Textareas -->
           <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Details of Cost Center -->
    <div class="bg-gray-50 p-4 rounded-lg shadow-sm hover:shadow-md transition">
        <label for="details_of_cost_center" class="block font-semibold text-gray-700 mb-2">
            {{ __('Details of Cost Center') }}
        </label>
        <textarea id="details_of_cost_center" name="details_of_cost_center"
            class="ckeditor w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-y min-h-[120px]"
        >{!! old('details_of_cost_center') !!}</textarea>
        @error('details_of_cost_center')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Location -->
    <div class="bg-gray-50 p-4 rounded-lg shadow-sm hover:shadow-md transition">
        <label for="location" class="block font-semibold text-gray-700 mb-2">
            {{ __('Location') }}
        </label>
        <textarea id="location" name="location"
            class="ckeditor w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-y min-h-[120px]"
        >{!! old('location') !!}</textarea>
        @error('location')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>

            <div class="flex justify-end">
                <button type="submit" class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold py-3 px-6 rounded-2xl shadow-lg transition duration-300">
                    Save
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function SimpleUploadAdapter(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                return {
                    upload: function() {
                        return loader.file.then(file => new Promise((resolve, reject) => {
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '{{ route('admin.main-cost-centers.storeCKEditorImages') }}', true);
                            xhr.setRequestHeader('x-csrf-token', window._token);
                            xhr.setRequestHeader('Accept', 'application/json');
                            xhr.responseType = 'json';

                            xhr.addEventListener('error', () => reject(`Couldn't upload file: ${file.name}.`));
                            xhr.addEventListener('abort', () => reject());
                            xhr.addEventListener('load', () => {
                                var response = xhr.response;
                                if (!response || xhr.status !== 201) {
                                    return reject(response && response.message ? `${xhr.status} ${response.message}` : `Upload failed`);
                                }
                                document.querySelector('form').insertAdjacentHTML('beforeend', `<input type="hidden" name="ck-media[]" value="${response.id}">`);
                                resolve({ default: response.url });
                            });

                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', e => {
                                    if (e.lengthComputable) {
                                        loader.uploadTotal = e.total;
                                        loader.uploaded = e.loaded;
                                    }
                                });
                            }

                            var data = new FormData();
                            data.append('upload', file);
                            data.append('crud_id', '{{ $mainCostCenter->id ?? 0 }}');
                            xhr.send(data);
                        }));
                    }
                };
            }
        }

        document.querySelectorAll('.ckeditor').forEach(editor => {
            ClassicEditor.create(editor, { extraPlugins: [SimpleUploadAdapter] })
            .catch(error => console.error(error));
        });
    });
</script>
@endsection
