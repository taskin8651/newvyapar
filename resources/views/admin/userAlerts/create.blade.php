@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-2xl border border-gray-100">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center space-x-2">
                <i class="fas fa-bell text-indigo-600"></i>
                <span>{{ trans('global.create') }} {{ trans('cruds.userAlert.title_singular') }}</span>
            </h2>
            <a href="{{ route('admin.user-alerts.index') }}" 
               class="text-sm text-gray-600 hover:text-indigo-600 transition">
                <i class="fas fa-arrow-left"></i> {{ trans('global.back_to_list') }}
            </a>
        </div>

        {{-- Body --}}
        <div class="p-6" x-data="userSelect()">
            <form method="POST" action="{{ route('admin.user-alerts.store') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf

                {{-- Alert Text --}}
                <div>
                    <label for="alert_text" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ trans('cruds.userAlert.fields.alert_text') }} <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="alert_text" 
                        id="alert_text" 
                        value="{{ old('alert_text', '') }}" 
                        required
                        placeholder="Enter alert message"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror"
                    >
                    @error('alert_text')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500">{{ trans('cruds.userAlert.fields.alert_text_helper') }}</p>
                </div>

                {{-- Alert Link --}}
                <div>
                    <label for="alert_link" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ trans('cruds.userAlert.fields.alert_link') }}
                    </label>
                    <input 
                        type="text" 
                        name="alert_link" 
                        id="alert_link" 
                        value="{{ old('alert_link', '') }}" 
                        placeholder="Optional link for this alert"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror"
                    >
                    @error('alert_link')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500">{{ trans('cruds.userAlert.fields.alert_link_helper') }}</p>
                </div>

                {{-- Users --}}
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ trans('cruds.userAlert.fields.user') }}
                        </label>
                        <div class="flex gap-2">
                            <button type="button" @click="selectAll()" 
                                class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-md hover:bg-green-200 transition">
                                {{ trans('global.select_all') }}
                            </button>
                            <button type="button" @click="deselectAll()" 
                                class="px-3 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-md hover:bg-red-200 transition">
                                {{ trans('global.deselect_all') }}
                            </button>
                        </div>
                    </div>

                    {{-- Checkboxes --}}
                    <div class="rounded-lg border border-gray-200 p-3 h-56 overflow-y-auto space-y-2">
                        @foreach($users as $id => $user)
                            <div>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" value="{{ $id }}" 
                                        x-model="selected"
                                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm text-gray-700">{{ $user }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Hidden input for submit --}}
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="users[]" :value="id">
                    </template>

                    {{-- Selected Badges --}}
                    <div class="mt-3 flex flex-wrap gap-2">
                        <template x-for="id in selected" :key="id">
                            <span class="flex items-center bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full text-xs font-medium">
                                <span x-text="userNames[id]"></span>
                                <button type="button" @click="remove(id)" class="ml-1 text-indigo-600 hover:text-red-600">
                                    ✕
                                </button>
                            </span>
                        </template>
                    </div>

                    @error('users')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="pt-4 flex justify-end">
                    <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow 
                               hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-save mr-2"></i> {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Alpine.js Script --}}
<script src="https://unpkg.com/alpinejs" defer></script>
<script>
    function userSelect() {
        return {
            selected: @json(old('users', [])),
            userNames: @json($users),
            remove(id) {
                this.selected = this.selected.filter(x => x != id);
            },
            selectAll() {
                this.selected = Object.keys(this.userNames).map(Number);
            },
            deselectAll() {
                this.selected = [];
            }
        }
    }
</script>
@endsection
