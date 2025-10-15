@extends('layouts.admin')
@section('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-money-bill-wave text-indigo-600"></i>
                Payment In List
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.payment-ins.create') }}"
                   class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow text-sm">
                   <i class="fas fa-plus mr-1"></i> Add Payment In
                </a>
                <input type="text" id="paymentInSearch" placeholder="Search..." 
                    class="px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 w-64 text-sm">
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-PaymentIn">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Party</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment Type</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Attachment</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($paymentIns as $paymentIn)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $paymentIn->id }}</td>
                        <td class="px-4 py-3">{{ $paymentIn->parties->party_name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $paymentIn->payment_type->account_name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $paymentIn->date }}</td>
                        <td class="px-4 py-3">{{ $paymentIn->amount }}</td>
                        <td class="px-4 py-3">{{ $paymentIn->total }}</td>
                        <td class="px-4 py-3">
                            @if($paymentIn->attechment)
                                <a href="{{ $paymentIn->attechment->getUrl() }}" target="_blank">
                                    <img src="{{ $paymentIn->attechment->getUrl('thumb') }}" class="h-10 w-10 rounded border">
                                </a>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center space-x-1">
                            <a href="{{ route('admin.payment-ins.show', $paymentIn->id) }}" class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.payment-ins.edit', $paymentIn->id) }}" class="px-2 py-1 bg-indigo-600 text-white rounded text-xs hover:bg-indigo-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.payment-ins.destroy', $paymentIn->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
<script>
    $(function () {
        let table = $('.datatable-PaymentIn').DataTable({
            order: [[0, 'desc']],
            pageLength: 25,
        });

        $('#paymentInSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });
    });
</script>
@endsection
