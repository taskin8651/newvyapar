@extends('layouts.admin')

@section('content')

<style>
    /* Fade */
    .fade-in { animation: fadeIn .45s ease-out; }
    @keyframes fadeIn { from {opacity:0; transform:translateY(10px);} to{opacity:1; transform:translateY(0);} }

    /* Glass effect */
    .glass {
        backdrop-filter: blur(12px);
        background: rgba(255, 255, 255, 0.65);
    }

    /* Card */
    .card {
        @apply rounded-2xl shadow-xl p-6 glass border border-gray-200;
    }

    /* Lift hover */
    .lift { transition: .25s; }
    .lift:hover { transform: translateY(-2px); box-shadow: 0 8px 18px rgba(0,0,0,0.15); }

    /* Modal Overlay */
    .modal-overlay {
        background: rgba(0,0,0,0.55);
        backdrop-filter: blur(4px);
    }

    /* Modal Centering */
    .modal-box {
        animation: pop .35s ease-out;
    }

    @keyframes pop {
        from { transform: scale(0.85); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    #dateModal {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    }
</style>


<div class="max-w-6xl mx-auto fade-in">

    <!-- HEADER BAR -->
    <div class="p-6 rounded-2xl shadow-xl bg-gradient-to-r from-indigo-700 to-blue-600 text-white mb-8">
        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-extrabold tracking-wide">
                    Estimate / Quotation
                </h1>
                <p class="text-lg mt-1 opacity-90">
                    #{{ $estimateQuotation->estimate_quotations_number }}
                </p>
            </div>

            <div class="flex gap-3">

                {{-- Convert to Sale --}}
                @if($estimateQuotation->status !== 'converted')
                <form action="{{ route('admin.estimate-quotations.convert', $estimateQuotation->id) }}" method="POST">
                    @csrf
                    <button class="lift bg-green-500 hover:bg-green-600 px-4 py-2 rounded-lg font-semibold shadow text-white">
                        <i class="fas fa-sync-alt mr-1"></i> Convert
                    </button>
                </form>
                @else
                <button disabled class="px-4 py-2 rounded-lg shadow bg-gray-300 text-gray-700 cursor-not-allowed">
                    <i class="fas fa-check-circle mr-1"></i> Converted
                </button>
                @endif

                {{-- Cancel --}}
                @if($estimateQuotation->status !== 'converted')
                <form action="{{ route('admin.estimate-quotations.cancel', $estimateQuotation->id) }}" method="POST">
                    @csrf @method('PUT')
                    <button class="lift bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg font-semibold shadow text-white">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                </form>
                @endif

                {{-- Update Date --}}
                <button onclick="openDateModal()"
                    class="lift bg-yellow-400 hover:bg-yellow-500 px-4 py-2 rounded-lg font-semibold shadow text-gray-900">
                    <i class="fas fa-calendar-alt mr-1"></i> Update Date
                </button>

                {{-- Print --}}
                <a href="{{ route('admin.estimate-quotations.invoice', $estimateQuotation->id) }}" target="_blank"
                   class="lift bg-white text-indigo-700 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-100">
                    <i class="fas fa-print mr-1"></i> Print
                </a>

            </div>
        </div>
    </div>



    <!-- CUSTOMER CARD -->
    <div class="card mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-user text-blue-500"></i> Customer Information
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">

            <div>
                <p class="font-semibold">Name</p>
                <p>{{ $estimateQuotation->select_customer->party_name }}</p>
            </div>

            <div>
                <p class="font-semibold">Phone</p>
                <p>{{ $estimateQuotation->select_customer->phone_number }}</p>
            </div>

            <div>
                <p class="font-semibold">GSTIN</p>
                <p>{{ $estimateQuotation->select_customer->gstin }}</p>
            </div>

            <div>
                <p class="font-semibold">Billing Address</p>
                <p>{{ $estimateQuotation->billing_address }}</p>
            </div>

            <div>
                <p class="font-semibold">Delivery Address</p>
                <p>{{ $estimateQuotation->shipping_address }}</p>
            </div>

            <div>
                <p class="font-semibold">Cost Centers</p>
                <p>Main: {{ $estimateQuotation->main_cost_centers_id }} | Sub: {{ $estimateQuotation->sub_cost_centers_id }}</p>
            </div>

        </div>
    </div>



    <!-- ITEMS TABLE -->
    <div class="card mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-box-open text-purple-600"></i> Items
        </h2>

        <div class="overflow-x-auto rounded-xl border">
            <table class="w-full text-left">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="p-3">Item</th>
                        <th class="p-3">Qty</th>
                        <th class="p-3">Unit</th>
                        <th class="p-3">Rate</th>
                        <th class="p-3">Tax</th>
                        <th class="p-3 text-right">Total</th>
                    </tr>
                </thead>

                <tbody class="text-gray-800">
                    @foreach($estimateQuotation->items as $it)
                    <tr class="border-t text-sm hover:bg-gray-50 transition">
                        <td class="p-3">{{ $it->item_name }}</td>
                        <td class="p-3">{{ $it->pivot->qty }}</td>
                        <td class="p-3">{{ $it->pivot->unit }}</td>
                        <td class="p-3">₹{{ number_format($it->pivot->price, 2) }}</td>
                        <td class="p-3">{{ $it->pivot->tax }}%</td>
                        <td class="p-3 text-right font-bold">₹{{ number_format($it->pivot->amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>



    <!-- SUMMARY -->
    <div class="card mb-20">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fas fa-file-invoice text-green-600"></i> Summary
        </h2>

        <div class="text-right text-gray-700 text-lg space-y-1">

            <p>Subtotal: <strong>₹{{ number_format($estimateQuotation->subtotal, 2) }}</strong></p>
            <p>Tax: <strong>₹{{ number_format($estimateQuotation->tax, 2) }}</strong></p>
            <p>Discount: <strong>₹{{ number_format($estimateQuotation->discount, 2) }}</strong></p>

            <p class="text-3xl font-bold text-indigo-700 mt-3">
                Grand Total: ₹{{ number_format($estimateQuotation->total,2) }}
            </p>
        </div>
    </div>


</div>



<!-- ✨ CENTERED MODAL -->
<div id="dateModal"
     class="fixed inset-0 hidden modal-overlay flex items-center justify-center z-50">

    <div class="modal-box bg-white w-96 p-6 rounded-xl shadow-2xl">

        <h2 class="text-2xl font-semibold mb-3 text-gray-800 flex items-center gap-2">
            <i class="fas fa-calendar-alt text-yellow-500"></i>
            Update Valid Date
        </h2>

        <form action="{{ route('admin.estimate-quotations.update-date', $estimateQuotation->id) }}" method="POST">
            @csrf @method('PUT')

            <label class="block mb-2 font-semibold text-gray-700">New Valid Date</label>
            <input type="date" name="due_date"
                value="{{ $estimateQuotation->due_date }}"
                class="w-full border rounded px-3 py-2 shadow-sm focus:ring focus:ring-blue-200"
                required>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeDateModal()"
                    class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 lift">
                    Cancel
                </button>

                <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 lift">
                    Update
                </button>
            </div>
        </form>

    </div>

</div>



<script>
function openDateModal() {
    document.getElementById("dateModal").classList.remove("hidden");
}
function closeDateModal() {
    document.getElementById("dateModal").classList.add("hidden");
}
</script>

@endsection
