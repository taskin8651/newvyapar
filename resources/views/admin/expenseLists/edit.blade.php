@extends('layouts.admin')
@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-6 flex items-center gap-2 text-indigo-700">
                <i class="fas fa-edit"></i>
                {{ trans('global.edit') }} {{ trans('cruds.expenseList.title_singular') }}
            </h2>

            <form method="POST"
                  action="{{ route('admin.expense-lists.update', $expenseList->id) }}"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @method('PUT')
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Entry Date -->
                    <div>
                        <label class="block font-medium text-gray-700">
                            {{ trans('cruds.expenseList.fields.entry_date') }}
                        </label>
                        <input type="date" name="entry_date"
                               value="{{ old('entry_date', $expenseList->entry_date) }}"
                               required
                               class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">
                    </div>

                    <!-- Ledger -->
                    <div>
                        <label class="block font-medium text-gray-700">
                            Select Ledger
                        </label>

                        <select id="ledger_id" name="category_id" required
                                class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">
                            <option value="">-- Select Ledger --</option>

                            @foreach($ledgers as $ledger)
                                <option value="{{ $ledger->id }}"
                                    {{ old('category_id', $expenseList->category_id) == $ledger->id ? 'selected' : '' }}
                                    data-ledger='@json([
                                        "name" => $ledger->ledger_name,
                                        "opening_balance" => $ledger->opening_balance,
                                        "expense_category" => $ledger->expense_category?->expense_category
                                    ])'>
                                    {{ $ledger->ledger_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ledger Info Card -->
                    <div id="ledgerCard" class="md:col-span-2">
                        <div class="border rounded-lg bg-indigo-50 p-4 shadow-sm">
                            <h4 class="font-semibold text-indigo-700 mb-2">
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

                    <!-- Amount -->
                    <div>
                        <label class="block font-medium text-gray-700">
                            {{ trans('cruds.expenseList.fields.amount') }}
                        </label>
                        <input type="number" name="amount" step="0.01" required
                               value="{{ old('amount', $expenseList->amount) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block font-medium text-gray-700">
                            {{ trans('cruds.expenseList.fields.description') }}
                        </label>
                        <input type="text" name="description"
                               value="{{ old('description', $expenseList->description) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">
                    </div>

                    <!-- Bank -->
                    <div>
                        <label class="block font-medium text-gray-700">
                            Payment Account (Bank)
                        </label>

                        <select name="payment_id" required
                                class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">
                            <option value="">-- Select Bank Account --</option>

                            @foreach($accounts as $account)
                                <option value="{{ $account['id'] }}"
                                    {{ old('payment_id', $expenseList->payment_id) == $account['id'] ? 'selected' : '' }}>
                                    {{ $account['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Main Cost Center -->
                    <div>
                        <label class="block font-medium text-gray-700">
                            Main Cost Center
                        </label>
                        <select name="main_cost_center_id"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">
                            <option value="">-- Select Main Cost Center --</option>
                            @foreach($mainCostCenters as $id => $name)
                                <option value="{{ $id }}"
                                    {{ old('main_cost_center_id', $expenseList->main_cost_center_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sub Cost Center -->
                    <div>
                        <label class="block font-medium text-gray-700">
                            Sub Cost Center
                        </label>
                        <select name="sub_cost_center_id"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">
                            <option value="">-- Select Sub Cost Center --</option>
                            @foreach($subCostCenters as $id => $name)
                                <option value="{{ $id }}"
                                    {{ old('sub_cost_center_id', $expenseList->sub_cost_center_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tax Include -->
                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700">
                            {{ trans('cruds.expenseList.fields.tax_include') }}
                        </label>

                        @foreach(App\Models\ExpenseList::TAX_INCLUDE_RADIO as $key => $label)
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" name="tax_include" value="{{ $key }}"
                                    {{ old('tax_include', $expenseList->tax_include) == $key ? 'checked' : '' }}>
                                <span class="ml-1">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>

                    <!-- Notes -->
                    <div class="md:col-span-2">
                        <label class="block font-medium text-gray-700">
                            {{ trans('cruds.expenseList.fields.notes') }}
                        </label>
                        <textarea name="notes"
                                  class="ckeditor w-full rounded-md border border-gray-300 px-3 py-2 bg-gray-50">
                            {!! old('notes', $expenseList->notes) !!}
                        </textarea>
                    </div>

                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button class="px-6 py-2 bg-indigo-600 text-white rounded">
                        <i class="fas fa-save mr-1"></i> {{ trans('global.update') }}
                    </button>

                    <a href="{{ route('admin.expense-lists.index') }}"
                       class="ml-2 px-6 py-2 bg-gray-500 text-white rounded">
                        {{ trans('global.back') }}
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
    const ledgerSelect = document.getElementById('ledger_id');
    const ledgerCard = document.getElementById('ledgerCard');

    function updateLedgerCard() {
        const option = ledgerSelect.options[ledgerSelect.selectedIndex];
        if (!option || !option.dataset.ledger) return;

        const ledger = JSON.parse(option.dataset.ledger);
        document.getElementById('ledger_name').textContent = ledger.name ?? '—';
        document.getElementById('ledger_category').textContent = ledger.expense_category ?? '—';
        document.getElementById('ledger_balance').textContent = ledger.opening_balance ?? '0.00';
    }

    updateLedgerCard();
    ledgerSelect.addEventListener('change', updateLedgerCard);
});
</script>
@endsection
