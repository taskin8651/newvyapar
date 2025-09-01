@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-2xl border border-gray-100">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
                <i class="fas fa-cubes text-indigo-600"></i>
                <span>{{ trans('global.create') }} {{ trans('cruds.currentStock.title_singular') }}</span>
            </h2>
            <a href="{{ route('admin.current-stocks.index') }}" 
               class="text-sm text-gray-600 hover:text-indigo-600 transition">
                <i class="fas fa-arrow-left"></i> {{ trans('global.back_to_list') }}
            </a>
        </div>

        {{-- Body --}}
        <div class="p-6" x-data="itemSelect()">
            <form method="POST" action="{{ route('admin.current-stocks.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Items --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ trans('cruds.currentStock.fields.item') }} <span class="text-red-500">*</span>
                    </label>

                    {{-- Select All / Deselect All --}}
                    <div class="flex items-center gap-2 mb-2">
                        <button type="button" @click="selectAll()" 
                            class="bg-indigo-500 text-white px-3 py-1 rounded-md text-xs hover:bg-indigo-600">
                            {{ trans('global.select_all') }}
                        </button>
                        <button type="button" @click="deselectAll()" 
                            class="bg-gray-500 text-white px-3 py-1 rounded-md text-xs hover:bg-gray-600">
                            {{ trans('global.deselect_all') }}
                        </button>
                    </div>

                    {{-- Items checkboxes --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach($items as $id => $item)
                            <div>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" value="{{ $id }}" 
                                        x-model="selected"
                                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm text-gray-700">{{ $item }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Hidden inputs for submit --}}
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="items[]" :value="id">
                    </template>

                    @error('items')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.currentStock.fields.item_helper') }}</p>
                </div>

                {{-- Parties --}}
                <div>
                    <label for="parties_id" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ trans('cruds.currentStock.fields.parties') }}
                    </label>
                    <select class="select2 w-full @error('title') border-red-500 @enderror" 
                            name="parties_id" id="parties_id">
                        @foreach($parties as $id => $entry)
                            <option value="{{ $id }}" {{ old('parties_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                    @error('parties')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.currentStock.fields.parties_helper') }}</p>
                </div>

                {{-- Qty --}}
                <div>
                    <label for="qty" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ trans('cruds.currentStock.fields.qty') }}
                    </label>
                    <input type="number" name="qty" id="qty" value="{{ old('qty', '') }}"
                           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    @error('qty')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.currentStock.fields.qty_helper') }}</p>
                </div>

                {{-- Type --}}
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ trans('cruds.currentStock.fields.type') }}
                    </label>
                    <input type="text" name="type" id="type" value="{{ old('type', '') }}"
                           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    @error('type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">{{ trans('cruds.currentStock.fields.type_helper') }}</p>
                </div>

                {{-- Submit --}}
                <div class="pt-4 flex justify-end">
                    <button type="submit" 
                        class="px-6 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-save mr-2"></i> {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

{{-- Alpine.js --}}
@section('scripts')
<script src="https://unpkg.com/alpinejs" defer></script>
<script>
    function itemSelect() {
        return {
            selected: @json(old('items', [])), 
            items: @json($items),
            selectAll() {
                this.selected = Object.keys(this.items).map(Number);
            },
            deselectAll() {
                this.selected = [];
            },
            remove(id) {
                this.selected = this.selected.filter(x => x != id);
            }
        }
    }
</script>
@endsection
