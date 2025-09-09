@extends('layouts.admin')
@section('content')
<div class="max-w-6xl mx-auto py-8">
    <div class="bg-white shadow rounded-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-4 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
                <i class="fas fa-user-edit text-indigo-600"></i>
                {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
            </h2>
            <a href="{{ route('admin.users.index') }}" 
               class="text-sm text-indigo-600 hover:text-indigo-800">
                ← {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ trans('cruds.user.fields.name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $user->name) }}" 
                           required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ trans('cruds.user.fields.email') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $user->email) }}" 
                           required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Select Companies -->
                <div class="md:col-span-2">
                    <label for="select_companies" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ trans('cruds.user.fields.select_companies') }}
                    </label>
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
                                {{ (in_array($id, old('select_companies', [])) || $user->select_companies->contains($id)) ? 'selected' : '' }}>
                                {{ $select_company }}
                            </option>
                        @endforeach
                    </select>
                    @error('select_companies')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Roles -->
                <div class="md:col-span-2">
                    <label for="roles" class="block text-sm font-medium text-gray-700 mb-1">
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
                            <option value="{{ $id }}" 
                                {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                    @error('roles')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Password -->
            <div class="md:col-span-2 mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    {{ trans('cruds.user.fields.password') }}
                </label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <p class="mt-1 text-sm text-gray-500">{{ trans('cruds.user.fields.password_helper') }}</p>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
