@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-white shadow-lg rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-600 flex items-center gap-2">
                <i class="fas fa-user-plus"></i>
                {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
            </h2>
            <a href="{{ route('admin.users.index') }}" 
               class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 text-sm transition">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.user.fields.name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" 
                           value="{{ old('name', '') }}" required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.user.fields.email') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" 
                           value="{{ old('email') }}" required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Select Companies -->
                <div class="md:col-span-2 bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="select_companies" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.user.fields.select_companies') }}
                    </label>

                    @if(!$readonly_company)
                        <!-- Super Admin view (can select multiple companies) -->
                        <div class="flex gap-2 mb-2">
                            <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded cursor-pointer select-all-companies">
                                {{ trans('global.select_all') }}
                            </span>
                            <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded cursor-pointer deselect-all-companies">
                                {{ trans('global.deselect_all') }}
                            </span>
                        </div>

                        <select name="select_companies[]" id="select_companies" multiple
                            class="w-full select2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach($select_companies as $id => $select_company)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('select_companies', isset($selected_company) ? (array) $selected_company : [])) ? 'selected' : '' }}>
                                    {{ $select_company }}
                                </option>
                            @endforeach
                        </select>

                    @else
                        <!-- Company or Admin view (readonly) -->
                        <select name="select_companies[]" id="select_companies" multiple disabled
                            class="w-full rounded-lg border-gray-300 bg-gray-100 shadow-sm sm:text-sm cursor-not-allowed">
                            @foreach($select_companies as $id => $select_company)
                                <option value="{{ $id }}"
                                    {{ $selected_company == $id ? 'selected' : '' }}>
                                    {{ $select_company }}
                                </option>
                            @endforeach
                        </select>

                        <!-- hidden field to submit selected company -->
                        <input type="hidden" name="select_companies[]" value="{{ $selected_company }}">
                    @endif

                    @error('select_companies')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Roles -->
                <div class="md:col-span-2 bg-green-50 p-4 rounded-lg shadow-inner">
                    <label for="roles" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.user.fields.roles') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-2 mb-2">
                        <span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded cursor-pointer select-all-roles">
                            {{ trans('global.select_all') }}
                        </span>
                        <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded cursor-pointer deselect-all-roles">
                            {{ trans('global.deselect_all') }}
                        </span>
                    </div>
                    <select name="roles[]" id="roles" multiple required
                            class="w-full select2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @foreach($roles as $id => $role)
                            <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="md:col-span-2 bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ trans('cruds.user.fields.password') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" id="password" required
                           class="w-full rounded-lg border-gray-300 shadow-sm px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <a href="{{ route('admin.users.index') }}" 
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
    $(document).ready(function() {
        // Companies
        $('.select-all-companies').click(function() {
            $('#select_companies option').prop('selected', true).trigger('change');
        });
        $('.deselect-all-companies').click(function() {
            $('#select_companies option').prop('selected', false).trigger('change');
        });

        // Roles
        $('.select-all-roles').click(function() {
            $('#roles option').prop('selected', true).trigger('change');
        });
        $('.deselect-all-roles').click(function() {
            $('#roles option').prop('selected', false).trigger('change');
        });
    });
</script>
@endsection
