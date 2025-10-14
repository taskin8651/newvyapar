@extends('layouts.admin')
@section('content')
<div class="p-6 bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6">{{ trans('global.create') }} {{ trans('cruds.expenseList.title_singular') }}</h2>

            <form method="POST" action="{{ route('admin.expense-lists.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Entry Date -->
                <div>
                    <label for="entry_date" class="block font-medium text-gray-700">{{ trans('cruds.expenseList.fields.entry_date') }}</label>
                    <input type="text" name="entry_date" id="entry_date" value="{{ old('entry_date') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('entry_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block font-medium text-gray-700">{{ trans('cruds.expenseList.fields.category') }}</label>
                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($categories as $id => $entry)
                            <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Amount -->
                <div>
                    <label for="amount" class="block font-medium text-gray-700">{{ trans('cruds.expenseList.fields.amount') }}</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block font-medium text-gray-700">{{ trans('cruds.expenseList.fields.description') }}</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Payment -->
                <div>
                    <label for="payment_id" class="block font-medium text-gray-700">{{ trans('cruds.expenseList.fields.payment') }}</label>
                    <select id="payment_id" name="payment_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($payments as $id => $entry)
                            <option value="{{ $id }}" {{ old('payment_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @error('payment_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Tax Include -->
                <div>
                    <label class="block font-medium text-gray-700">{{ trans('cruds.expenseList.fields.tax_include') }}</label>
                    <div class="space-y-2 mt-1">
                        @foreach(App\Models\ExpenseList::TAX_INCLUDE_RADIO as $key => $label)
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="tax_include_{{ $key }}" name="tax_include" value="{{ $key }}" {{ old('tax_include', 'no') === (string) $key ? 'checked' : '' }}
                                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                <label for="tax_include_{{ $key }}" class="font-normal text-gray-700">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('tax_include') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block font-medium text-gray-700">{{ trans('cruds.expenseList.fields.notes') }}</label>
                    <textarea id="notes" name="notes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-3 py-2 ckeditor focus:ring-indigo-500 focus:border-indigo-500">{!! old('notes') !!}</textarea>
                    @error('notes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
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
    document.addEventListener('DOMContentLoaded', function () {
        function SimpleUploadAdapter(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                return {
                    upload: function() {
                        return loader.file.then(function(file) {
                            return new Promise(function(resolve, reject) {
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', '{{ route('admin.expense-lists.storeCKEditorImages') }}', true);
                                xhr.setRequestHeader('x-csrf-token', window._token);
                                xhr.setRequestHeader('Accept', 'application/json');
                                xhr.responseType = 'json';

                                xhr.addEventListener('error', function() { reject(`Couldn't upload file: ${file.name}.`) });
                                xhr.addEventListener('abort', function() { reject() });
                                xhr.addEventListener('load', function() {
                                    var response = xhr.response;
                                    if (!response || xhr.status !== 201) {
                                        return reject(response && response.message ? `Couldn't upload file: ${file.name}.\n${xhr.status} ${response.message}` : `Couldn't upload file: ${file.name}.\n${xhr.status} ${xhr.statusText}`);
                                    }
                                    $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');
                                    resolve({ default: response.url });
                                });

                                var data = new FormData();
                                data.append('upload', file);
                                data.append('crud_id', '{{ $expenseList->id ?? 0 }}');
                                xhr.send(data);
                            });
                        });
                    }
                };
            };
        }

        document.querySelectorAll('.ckeditor').forEach(el => {
            ClassicEditor.create(el, { extraPlugins: [SimpleUploadAdapter] }).catch(error => console.error(error));
        });
    });
</script>
@endsection
