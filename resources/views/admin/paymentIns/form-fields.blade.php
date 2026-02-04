{{-- Date --}}
<div>
    <label class="block text-sm font-medium text-gray-700">Date</label>
    <input type="date"
           name="date"
           value="{{ old('date', isset($paymentIn) ? $paymentIn->date : date('Y-m-d')) }}"
           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
    @error('date')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Reference --}}
<div>
    <label class="block text-sm font-medium text-gray-700">Reference No</label>
    <input type="text"
           name="reference_no"
           value="{{ old('reference_no', $paymentIn->reference_no ?? '') }}"
           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
    @error('reference_no')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Amount --}}
<div>
    <label class="block text-sm font-medium text-gray-700">Amount</label>
    <input type="number" step="0.01"
           name="amount"
           id="amount"
           value="{{ old('amount', $paymentIn->amount ?? '') }}"
           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
    @error('amount')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Discount --}}
<div>
    <label class="block text-sm font-medium text-gray-700">Discount</label>
    <input type="number" step="0.01"
           name="discount"
           id="discount"
           value="{{ old('discount', $paymentIn->discount ?? 0) }}"
           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
    @error('discount')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Total --}}
<div>
    <label class="block text-sm font-medium text-gray-700">Total</label>
    <input type="number" step="0.01"
           name="total"
           id="total"
           value="{{ old('total', $paymentIn->total ?? '') }}"
           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm bg-gray-100"
           readonly>
    @error('total')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Description --}}
<div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-700">Description</label>
    <textarea name="description"
              rows="3"
              class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">{{ old('description', $paymentIn->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Attachment --}}
<div class="md:col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-2">Attachment</label>
    <input type="file"
           name="attechment"
           class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm">
    @error('attechment')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- JS for Total --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const amount = document.getElementById('amount');
    const discount = document.getElementById('discount');
    const total = document.getElementById('total');

    function calculateTotal() {
        const amt = parseFloat(amount.value) || 0;
        const disc = parseFloat(discount.value) || 0;
        total.value = (amt - disc).toFixed(2);
    }

    if (amount && discount) {
        amount.addEventListener('input', calculateTotal);
        discount.addEventListener('input', calculateTotal);
    }
});
</script>
