@extends('layouts.admin')
@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">Bank Transactions</h2>
        @can('bank_transaction_create')
            <a href="{{ route('admin.bank-transactions.create') }}"
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm transition">
                <i class="fas fa-plus mr-2"></i> Add Transaction
            </a>
        @endcan
    </div>


    {{-- Transactions Table --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <div class="p-6 overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600 datatable datatable-BankTransaction p-2">
                <thead class="bg-gradient-to-r from-blue-100 to-blue-200 text-gray-700 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-center w-10 p-3">
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Party</th>
                        <th class="px-4 py-3">Payment Type</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Current Balance</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Created By</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($transactions as $transaction)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $transaction->id }}</td>
                        <td class="px-4 py-3">{{ $transaction->party->party_name ?? $transaction->party_name }}</td>
                        <td class="px-4 py-3">{{ $transaction->paymentType->bank_name ?? '—' }}</td>
                        <td class="px-4 py-3 font-semibold text-green-700">₹{{ number_format($transaction->amount, 2) }}</td>
                        <td class="px-4 py-3">
                            {{ $transaction->current_balance_type == 'credit' ? '+' : '-' }}
                            ₹{{ number_format($transaction->current_balance, 2) }}
                        </td>
                        <td class="px-4 py-3 truncate max-w-xs">
                            {{ Str::limit($transaction->description, 40) }}
                        </td>
                        <td class="px-4 py-3">{{ $transaction->createdBy->name ?? '—' }}</td>
                        <td class="px-4 py-3 text-center" x-data="{ open: false }" x-init="$watch('open', value => value ? $nextTick(() => initModal({{ $transaction->id }})) : '')">
                            <button @click="open = true"
                                    class="text-blue-600 hover:underline text-sm font-medium">
                                View JSON
                            </button>

                            {{-- JSON Modal --}}
                            <div x-show="open" x-cloak x-transition
                                 class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                <div @click.away="open = false"
                                     class="bg-white rounded-lg shadow-lg max-w-3xl w-full p-6 relative overflow-y-auto max-h-[80vh]">

                                    <h3 class="text-lg font-semibold mb-4">Transaction #{{ $transaction->id }} JSON Data</h3>

                                    <table id="jsonTable-{{ $transaction->id }}" class="min-w-full text-left text-gray-700 border border-gray-200 table-auto">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-4 py-2 border-b">Key</th>
                                                <th class="px-4 py-2 border-b">Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $json = json_decode($transaction->json, true); @endphp
                                            @if(is_array($json))
                                                @foreach($json as $key => $value)
                                                    <tr>
                                                        <td class="px-4 py-2 border-b font-medium">{{ $key }}</td>
                                                        <td class="px-4 py-2 border-b">{{ is_array($value) ? json_encode($value) : $value }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2" class="text-center text-gray-500 py-3">No JSON Data Found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <button @click="open = false"
                                            class="mt-4 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

@section('scripts')
@parent
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwind.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwind.min.js"></script>

<script>
$(function () {
    $('.datatable-BankTransaction').DataTable({
        order: [[0, 'desc']],
        pageLength: 25,
        responsive: true,
    });
});

// Modal JSON table init
function initModal(id) {
    let tableId = '#jsonTable-' + id;
    if (!$.fn.DataTable.isDataTable(tableId)) {
        $(tableId).DataTable({
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            scrollY: "400px",
            scrollCollapse: true,
            responsive: true,
            autoWidth: false,
        });
    }
}
</script>
@endsection
