@extends('layouts.admin')
@section('content')
<div class="max-w-3xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-xl font-bold text-indigo-700 mb-6">Edit Payment In</h2>

        <form method="POST" action="{{ route('admin.payment-ins.update', $paymentIn->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Party -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Party</label>
                <select name="parties_id" class="w-full border rounded px-3 py-2">
                    @foreach($parties as $party)
                        <option value="{{ $party->id }}" {{ $party->id == $paymentIn->parties_id ? 'selected' : '' }}>
                            {{ $party->party_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Payment Type -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-1">Payment Type</label>
                <select name="payment_type_id" class="w-full border rounded px-3 py-2">
                    @foreach($banks as $bank)
                        <option value="{{ $bank->id }}" {{ $bank->id == $paymentIn->payment_type_id ? 'selected' : '' }}>
                            {{ $bank->account_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Date, Reference, Amount, Discount, Total, Description, Attachment same as Create -->
            @include('admin.paymentIns.form-fields', ['paymentIn' => $paymentIn])

            <div class="flex justify-end gap-2">
                <a href="{{ route('admin.payment-ins.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
