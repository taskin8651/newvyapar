@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    <!-- FILTER CARD -->
    <div class="bg-white rounded-xl shadow p-6">
        <form method="GET" class="grid md:grid-cols-4 gap-4 items-end">

            <div>
                <label class="text-sm font-medium">Month</label>
                <input type="month" name="month" value="{{ $month }}"
                    class="w-full rounded-lg border-gray-300">
            </div>

            <div>
                <label class="text-sm font-medium">Party</label>
                <select name="select_customer_id"
                    class="w-full rounded-lg border-gray-300">
                    <option value="">-- All Parties --</option>
                    @foreach($parties as $party)
                        <option value="{{ $party->id }}"
                            {{ $partyId == $party->id ? 'selected' : '' }}>
                            {{ $party->party_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2 mt-6">
                <input type="checkbox" name="show_no_gst" value="1"
                    {{ $showNoGst ? 'checked' : '' }}>
                <span>Show without GST</span>
            </div>

            <button class="bg-primary-600 text-white px-4 py-2 rounded-lg">
                Apply
            </button>
        </form>
    </div>

    {{-- ================= PARTY STATEMENT MODE ================= --}}
    @if($selectedParty)

    <!-- PARTY CARD -->
    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl shadow p-6">
        <h2 class="text-xl font-bold">{{ $selectedParty->party_name }}</h2>

        <div class="grid md:grid-cols-3 gap-4 mt-4 text-sm">
            <div><b>GSTIN:</b> {{ $selectedParty->gstin ?? '-' }}</div>
            <div><b>Phone:</b> {{ $selectedParty->phone_number }}</div>
            <div><b>State:</b> {{ $selectedParty->state }}</div>
            <div><b>City:</b> {{ $selectedParty->city }}</div>
            <div><b>Balance:</b>
                {{ $selectedParty->current_balance }}
                ({{ $selectedParty->current_balance_type }})
            </div>
        </div>
    </div>

    <!-- SALES TABLE -->
    <div class="bg-white rounded-xl shadow p-6">
        <table id="salesTable" class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th>Invoice</th>
                    <th>Date</th>
                    <th>Subtotal</th>
                    <th>Tax</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr class="border-t">
                    <td>{{ $invoice->sale_invoice_number }}</td>
                    <td>{{ $invoice->po_date }}</td>
                    <td>{{ number_format($invoice->subtotal,2) }}</td>
                    <td>{{ number_format($invoice->tax,2) }}</td>
                    <td>{{ number_format($invoice->total,2) }}</td>
                </tr>

                {{-- ITEMS --}}
                <tr class="bg-gray-50">
                    <td colspan="5">
                        <table class="w-full text-xs">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>HSN</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Tax</th>
                                    <th>Amount</th>
                                    <th>Raw Materials</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->items as $item)
                                <tr>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->item_hsn }}</td>
                                    <td>{{ $item->pivot->qty }}</td>
                                    <td>{{ $item->pivot->price }}</td>
                                    <td>{{ $item->pivot->tax }}</td>
                                    <td>{{ $item->pivot->amount }}</td>
                                    <td>
                                        @foreach($item->rawMaterials as $rm)
                                            {{ $rm->item_name }}
                                            ({{ $rm->pivot->qty }})<br>
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @else
    {{-- ================= NORMAL GST SUMMARY MODE ================= --}}
    @include('admin.gst-1.partials.summary')
    @endif

</div>
@endsection
