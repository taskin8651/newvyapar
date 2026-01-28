@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-xl font-bold text-indigo-700 mb-6">Edit Payment In</h2>

        <form method="POST"
              action="{{ route('admin.payment-ins.update', $paymentIn->id) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Party --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">
                    Party
                </label>
                <select name="parties_id" class="w-full border rounded px-3 py-2">
                    <option value="">Please Select</option>
                    @foreach($parties as $party)
                        <option value="{{ $party->id }}"
                            {{ $party->id == $paymentIn->parties_id ? 'selected' : '' }}>
                            {{ $party->party_name }}
                        </option>
                    @endforeach

                </select>
                @error('parties_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Payment Type / Bank --}}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">
                    Payment Type
                </label>
                <select name="payment_type_id" class="w-full border rounded px-3 py-2">
                    <option value="">Please Select</option>
                    @foreach($payment_types as $bank)
                        <option value="{{ $bank->id }}"
                            {{ $bank->id == old('payment_type_id', $paymentIn->payment_type_id) ? 'selected' : '' }}>
                            {{ $bank->account_name }}
                        </option>
                    @endforeach
                </select>
                @error('payment_type_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Common Fields (Date, Ref, Amount, Discount, Total, Description, Attachment) --}}
            @include('admin.paymentIns.form-fields', ['paymentIn' => $paymentIn])

            {{-- Buttons --}}
            <div class="flex justify-end gap-2 mt-6">
                <a href="{{ route('admin.payment-ins.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </a>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
