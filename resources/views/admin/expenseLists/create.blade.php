@extends('layouts.admin')
@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6 flex items-center gap-2 text-indigo-700">
                <i class="fas fa-plus-circle"></i>
                {{ trans('global.create') }} {{ trans('cruds.expenseList.title_singular') }}
            </h2>

            <form method="POST" action="{{ route('admin.expense-lists.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Entry Date -->
<div>
    <label for="entry_date" class="block font-medium text-gray-700">
        {{ trans('cruds.expenseList.fields.entry_date') }}
    </label>
    <input type="date" name="entry_date" id="entry_date" 
        value="{{ date('Y-m-d') }}" required
        class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
    @error('entry_date')
        <span class="text-red-600 text-sm">{{ $message }}</span>
    @enderror
</div>


                    <!-- Ledger -->
                    <div>
                        <label for="category_id" class="block font-medium text-gray-700">
                            Select Ledger
                        </label>
                        <select id="ledger_id" name="category_id" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">
                            <option value="">-- Select Ledger --</option>

                            @foreach($ledgers as $ledger)
                                <option value="{{ $ledger->id }}"
                                    data-ledger='@json([
                                        "name" => $ledger->ledger_name,
                                        "opening_balance" => $ledger->opening_balance,
                                        "expense_category" => $ledger->expense_category?->expense_category
                                    ])'>
                                    {{ $ledger->ledger_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Ledger Info Card -->
                    <div id="ledgerCard" class="hidden md:col-span-2">
                        <div class="border rounded-lg bg-indigo-50 p-4 shadow-sm">
                            <h4 class="font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-book"></i> Ledger Details
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-500">Ledger Name</p>
                                    <p class="font-semibold" id="ledger_name">—</p>
                                </div>

                                <div>
                                    <p class="text-gray-500">Expense Category</p>
                                    <p class="font-semibold" id="ledger_category">—</p>
                                </div>

                                <div>
                                    <p class="text-gray-500">Opening Balance</p>
                                    <p class="font-semibold text-green-700">
                                        ₹ <span id="ledger_balance">0.00</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const ledgerSelect = document.getElementById('ledger_id');
                        const ledgerCard = document.getElementById('ledgerCard');

                        ledgerSelect.addEventListener('change', function () {
                            const option = this.options[this.selectedIndex];
                            const data = option.dataset.ledger;

                            if (!data) {
                                ledgerCard.classList.add('hidden');
                                return;
                            }

                            const ledger = JSON.parse(data);

                            document.getElementById('ledger_name').textContent = ledger.name ?? '—';
                            document.getElementById('ledger_category').textContent = ledger.expense_category ?? '—';
                            document.getElementById('ledger_balance').textContent = ledger.opening_balance ?? '0.00';

                            ledgerCard.classList.remove('hidden');
                        });
                    });
                    </script>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block font-medium text-gray-700">
                            {{ trans('cruds.expenseList.fields.amount') }}
                        </label>
                        <input type="number" name="amount" id="amount" value="{{ old('amount') }}" step="0.01" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('amount')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block font-medium text-gray-700">
                            {{ trans('cruds.expenseList.fields.description') }}
                        </label>
                        <input type="text" name="description" id="description" value="{{ old('description') }}"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('description')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Combined Payment / Cash In Hand -->
                    <div>
                        <label for="payment_id" class="block font-medium text-gray-700">
                            Payment Account (Bank)
                        </label>

                        <select id="payment_id" name="payment_id" required
                            class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">

                            <option value="">-- Select Bank Account --</option>

                            @foreach($accounts as $account)
                                <option value="{{ $account['id'] }}"
                                    {{ old('payment_id') == $account['id'] ? 'selected' : '' }}>
                                    {{ $account['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('payment_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>



                    <!-- 🆕 Main Cost Center -->
                    <div>
                        <label for="main_cost_center_id" class="block font-medium text-gray-700">
                            Main Cost Center
                        </label>
                        <select id="main_cost_center_id" name="main_cost_center_id"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select Main Cost Center --</option>
                            @foreach($mainCostCenters as $id => $entry)
                                <option value="{{ $id }}" {{ old('main_cost_center_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}
                                </option>
                            @endforeach
                        </select>
                        @error('main_cost_center_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- 🆕 Sub Cost Center -->
                    <div>
                        <label for="sub_cost_center_id" class="block font-medium text-gray-700">
                            Sub Cost Center
                        </label>
                        <select id="sub_cost_center_id" name="sub_cost_center_id"
                            class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select Sub Cost Center --</option>
                            @foreach($subCostCenters as $id => $entry)
                                <option value="{{ $id }}" {{ old('sub_cost_center_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}
                                </option>
                            @endforeach
                        </select>
                        @error('sub_cost_center_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tax Include -->
                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700">
                            {{ trans('cruds.expenseList.fields.tax_include') }}
                        </label>
                        <div class="space-y-2 mt-1">
                            @foreach(App\Models\ExpenseList::TAX_INCLUDE_RADIO as $key => $label)
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="tax_include_{{ $key }}" name="tax_include" value="{{ $key }}"
                                        {{ old('tax_include', 'No') === (string) $key ? 'checked' : '' }}
                                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <label for="tax_include_{{ $key }}" class="font-normal text-gray-700">{{ $label }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('tax_include')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="md:col-span-2">
                        <label for="notes" class="block font-medium text-gray-700">
                            {{ trans('cruds.expenseList.fields.notes') }}
                        </label>
                        <textarea id="notes" name="notes" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-50 ckeditor focus:ring-indigo-500 focus:border-indigo-500">{!! old('notes') !!}</textarea>
                        @error('notes')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                        <i class="fas fa-save mr-1"></i> {{ trans('global.save') }}
                    </button>
                    <a href="{{ route('admin.expense-lists.index') }}"
                        class="px-6 py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600 transition ml-2">
                        <i class="fas fa-arrow-left mr-1"></i> {{ trans('global.back') }}
                    </a>
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
                                    return reject(response && response.message
                                        ? `Couldn't upload file: ${file.name}.\n${xhr.status} ${response.message}`
                                        : `Couldn't upload file: ${file.name}.\n${xhr.status} ${xhr.statusText}`);
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
        ClassicEditor.create(el, { extraPlugins: [SimpleUploadAdapter] })
            .catch(error => console.error(error));
    });
});
</script>
@endsection
