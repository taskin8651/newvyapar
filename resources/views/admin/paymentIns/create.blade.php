@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        
        <!-- Header -->
        <div class="bg-indigo-600 text-white p-6">
            <h1 class="text-3xl font-bold">CREATE PAYMENT IN</h1>
        </div>

        <form action="{{ route('admin.payment-ins.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Party & Payment Info -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Party Details</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Party</label>
                        <select name="parties_id" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                            @foreach($parties as $id => $name)
                                <option value="{{ $id }}" {{ old('parties_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parties_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Select Bank</label>
                        <select name="payment_type_id" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                            @foreach($payment_types as $id => $name)
                                <option value="{{ $id }}" {{ old('payment_type_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('payment_type_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Payment Info</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" value="{{ date('Y-m-d') }}" 
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                        @error('date')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Reference No</label>
                        <input type="text" name="reference_no" value="{{ old('reference_no') }}" 
                               class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                        @error('reference_no')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Amount Section -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" 
                           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Discount</label>
                    <input type="number" step="0.01" name="discount" id="discount" value="{{ old('discount') }}" 
                           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                    @error('discount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Total</label>
                    <input type="number" step="0.01" name="total" id="total" value="{{ old('total') }}" 
                           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-100" readonly>
                    @error('total')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="px-6 pb-6">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Attachment Upload -->
            <div class="px-6 pb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Attachment</label>
                <input type="file" name="attechment" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
                @error('attechment')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Save Button -->
            <div class="px-6 pb-6">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-md flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i> SAVE PAYMENT IN
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 💡 JavaScript for Total Calculation -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const amount = document.getElementById('amount');
    const discount = document.getElementById('discount');
    const total = document.getElementById('total');

    function calculateTotal() {
        const amt = parseFloat(amount.value) || 0;
        const disc = parseFloat(discount.value) || 0;
        const result = amt - disc;
        total.value = result.toFixed(2);
    }

    amount.addEventListener('input', calculateTotal);
    discount.addEventListener('input', calculateTotal);
});
</script>

@endsection
