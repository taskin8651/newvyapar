@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-bell"></i>
                {{ trans('global.create') }} {{ trans('cruds.userAlert.title_singular') }}
            </h2>

            <a href="{{ route('admin.user-alerts.index') }}"
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.user-alerts.store') }}" x-data="userSelect()">
            @csrf

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Alert Text --}}
                <div class="md:col-span-2 bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="alert_text" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.userAlert.fields.alert_text') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           name="alert_text"
                           id="alert_text"
                           value="{{ old('alert_text') }}"
                           required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">
                    @error('alert_text')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">
                        {{ trans('cruds.userAlert.fields.alert_text_helper') }}
                    </p>
                </div>

                {{-- Alert Link --}}
                <div class="md:col-span-2 bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="alert_link" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.userAlert.fields.alert_link') }}
                    </label>
                    <input type="text"
                           name="alert_link"
                           id="alert_link"
                           value="{{ old('alert_link') }}"
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm
                                  focus:border-indigo-500 focus:ring-indigo-500">
                    @error('alert_link')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">
                        {{ trans('cruds.userAlert.fields.alert_link_helper') }}
                    </p>
                </div>

                {{-- Users --}}
                <div class="md:col-span-2 bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <div class="flex justify-between items-center mb-3">
                        <label class="block text-sm font-semibold text-gray-700">
                            {{ trans('cruds.userAlert.fields.user') }}
                        </label>
                        <div class="flex gap-2">
                            <button type="button" @click="selectAll()"
                                class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-md hover:bg-green-200">
                                {{ trans('global.select_all') }}
                            </button>
                            <button type="button" @click="deselectAll()"
                                class="px-3 py-1 bg-red-100 text-red-700 text-xs rounded-md hover:bg-red-200">
                                {{ trans('global.deselect_all') }}
                            </button>
                        </div>
                    </div>

                    {{-- User List --}}
                    <div class="border border-gray-200 rounded-lg p-3 h-56 overflow-y-auto space-y-2 bg-white">
                        @foreach($users as $id => $user)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox"
                                       value="{{ $id }}"
                                       x-model="selected"
                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="text-sm text-gray-700">{{ $user }}</span>
                            </label>
                        @endforeach
                    </div>

                    {{-- Hidden Inputs --}}
                    <template x-for="id in selected" :key="id">
                        <input type="hidden" name="users[]" :value="id">
                    </template>

                    {{-- Selected Users --}}
                    <div class="mt-3 flex flex-wrap gap-2">
                        <template x-for="id in selected" :key="id">
                            <span class="flex items-center bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full text-xs font-medium">
                                <span x-text="userNames[id]"></span>
                                <button type="button" @click="remove(id)" class="ml-1 hover:text-red-600">
                                    ✕
                                </button>
                            </span>
                        </template>
                    </div>

                    @error('users')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.user-alerts.index') }}"
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

{{-- Alpine --}}
<script src="https://unpkg.com/alpinejs" defer></script>
<script>
    function userSelect() {
        return {
            selected: @json(old('users', [])),
            userNames: @json($users),
            remove(id) {
                this.selected = this.selected.filter(x => x != id)
            },
            selectAll() {
                this.selected = Object.keys(this.userNames).map(Number)
            },
            deselectAll() {
                this.selected = []
            }
        }
    }
</script>
@endsection
