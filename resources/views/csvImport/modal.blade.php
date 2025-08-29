{{-- Modal --}}
<template x-if="openCsvModal">
    <div 
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        @keydown.escape.window="openCsvModal = false">

        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-4">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-3 border-b">
                <h3 class="text-lg font-semibold text-gray-800">
                    @lang('global.app_csvImport')
                </h3>
                <button @click="openCsvModal = false" class="text-gray-500 hover:text-gray-700">
                    ✖
                </button>
            </div>

            <!-- Body -->
            <div class="p-6">
                <form method="POST" action="{{ route($route, ['model' => $model]) }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <!-- File Input -->
                    <div>
                        <label for="csv_file" class="block text-sm font-medium text-gray-700">
                            @lang('global.app_csv_file_to_import')
                        </label>
                        <input id="csv_file" type="file" name="csv_file" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @if($errors->has('csv_file'))
                            <p class="text-sm text-red-600 mt-1">
                                {{ $errors->first('csv_file') }}
                            </p>
                        @endif
                    </div>

                    <!-- Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" name="header" id="header" checked
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        <label for="header" class="ml-2 text-sm text-gray-700">
                            @lang('global.app_file_contains_header_row')
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                            @lang('global.app_parse_csv')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
