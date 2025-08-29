{{-- resources/views/admin/partyDetails/edit.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto py-6">
    <div 
        x-data="{
            step: 1,
            credit_limit: '{{ old('credit_limit', $partyDetail->credit_limit ?? 'off') }}',
            type_of_supply: '{{ old('type_of_supply', $partyDetail->type_of_supply ?? 'Intra-State') }}',
            gst_type: '{{ old('gst_type', $partyDetail->gst_type ?? 'Unregistered_Consumer') }}',
            opening_balance_type: '{{ old('opening_balance_type', $partyDetail->opening_balance_type ?? 'Debit') }}',
            status: '{{ old('status', $partyDetail->status ?? 'enable') }}',
            nextStep() {
                if(this.validateStep()) {
                    this.step++;
                    window.scrollTo(0, 0);
                }
            },
            prevStep() {
                this.step--;
                window.scrollTo(0, 0);
            },
            validateStep() {
                let valid = true;
                const stepEl = document.querySelector(`[x-show='step === ${this.step}']`);
                const requiredFields = stepEl.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500');
                        valid = false;
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });
                return valid;
            }
        }" 
        class="bg-white rounded-2xl shadow-lg p-6"
    >

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-indigo-800">
                    Edit Party Details
                </h2>
                <p class="text-sm text-gray-500">Update the 4 steps — Basic, Address, Finance & Bank.</p>
            </div>
            <div class="mt-3 md:mt-0 text-sm text-gray-600">
                Step <span x-text="step"></span> of 4
            </div>
        </div>

        <!-- Stepper -->
        <div class="flex items-center justify-between">
            <template x-for="s in 4" :key="s">
                <div class="flex-1 flex items-center">
                    <div 
                        class="w-10 h-10 flex items-center justify-center rounded-full font-bold text-white step-indicator"
                        :class="step >= s ? 'bg-gradient-to-r from-indigo-600 to-indigo-500' : 'bg-gray-300'">
                        <span x-text="s"></span>
                    </div>
                    <div class="flex-1 h-1 mx-2 rounded"
                         :class="step > s ? 'bg-indigo-500' : 'bg-gray-200'"></div>
                </div>
            </template>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-200 rounded-full h-2 mt-4 mb-6">
            <div class="bg-indigo-600 h-2 rounded-full transition-all" 
                 :style="`width: ${(step-1)/3*100}%`"></div>
        </div>

        <form method="POST" action="{{ route('admin.party-details.update', $partyDetail->id) }}" enctype="multipart/form-data" id="partyForm" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- STEP 1: Basic -->
            <div x-show="step === 1" x-transition>
                <div class="p-6 border rounded-xl space-y-6 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                        <i class="fas fa-info-circle mr-2 text-indigo-600"></i>
                        Basic Information
                    </h3>

                    <div>
                        <label for="party_name" class="block text-sm font-medium text-gray-700 required">Party Name</label>
                        <input type="text" name="party_name" id="party_name" required
                               value="{{ old('party_name', $partyDetail->party_name) }}"
                               class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 required">GSTIN</label>
                            <input type="text" name="gstin" id="gstin" required
                                   value="{{ old('gstin', $partyDetail->gstin) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 required">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" required
                                   value="{{ old('phone_number', $partyDetail->phone_number) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">PAN Number</label>
                            <input type="text" name="pan_number" id="pan_number"
                                   value="{{ old('pan_number', $partyDetail->pan_number) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                   value="{{ old('email', $partyDetail->email) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 2: Address -->
            <div x-show="step === 2" x-transition>
                <div class="p-6 border rounded-xl space-y-6 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i>
                        Address & Contact
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 required">Pincode</label>
                            <input type="text" name="pincode" id="pincode" required
                                   value="{{ old('pincode', $partyDetail->pincode) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">State</label>
                            <input type="text" name="state" id="state"
                                   value="{{ old('state', $partyDetail->state) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">City</label>
                            <input type="text" name="city" id="city"
                                   value="{{ old('city', $partyDetail->city) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Billing Address</label>
                        <textarea name="billing_address" id="billing_address" rows="3"
                                  class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">{{ old('billing_address', $partyDetail->billing_address) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Shipping Address</label>
                        <textarea name="shipping_address" id="shipping_address" rows="3"
                                  class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">{{ old('shipping_address', $partyDetail->shipping_address) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- STEP 3: Finance -->
            <div x-show="step === 3" x-transition>
                <div class="p-6 border rounded-xl space-y-6 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                        <i class="fas fa-money-bill-wave mr-2 text-indigo-600"></i>
                        Financial Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 required">Opening Balance</label>
                            <input type="number" step="0.01" name="opening_balance" id="opening_balance" required
                                   value="{{ old('opening_balance', $partyDetail->opening_balance) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Opening Balance Type</label>
                            <select name="opening_balance_type" x-model="opening_balance_type"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                                <option value="Debit">Debit (Receivable)</option>
                                <option value="Credit">Credit (Payable)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">As of Date</label>
                            <input type="date" name="as_of_date" id="as_of_date"
                                   value="{{ old('as_of_date', $partyDetail->as_of_date) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Payment Terms</label>
                            <input type="text" name="payment_terms" id="payment_terms"
                                   value="{{ old('payment_terms', $partyDetail->payment_terms) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>

                          <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Credit Limit</label>
                            <div class="flex items-center space-4">
                                <label class="inline-flex items-center mr-6">
                                    <input type="radio" name="credit_limit" value="off" x-model="credit_limit" class="form-radio h-4 w-4 text-indigo-600">
                                    <span class="ml-2">OFF</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="credit_limit" value="on" x-model="credit_limit" class="form-radio h-4 w-4 text-indigo-600">
                                    <span class="ml-2">ON</span>
                                </label>
                            </div>
                        </div>

                        <div x-show="credit_limit === 'on'">
                            <label class="block text-sm font-medium text-gray-700">Credit Limit Amount</label>
                            <input type="number" step="0.01" name="credit_limit_amount" id="credit_limit_amount"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                          focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1" value="{{ old('credit_limit_amount', $partyDetail->credit_limit_amount) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 4: Bank -->
            <div x-show="step === 4" x-transition>
                <div class="p-6 border rounded-xl space-y-6 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                        <i class="fas fa-university mr-2 text-indigo-600"></i>
                        Bank Details & Notes
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bank Name</label>
                            <input type="text" name="bank_name" id="bank_name"
                                   value="{{ old('bank_name', $partyDetail->bank_name) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Account Number</label>
                            <input type="text" name="account_number" id="account_number"
                                   value="{{ old('account_number', $partyDetail->account_number) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">IFSC Code</label>
                            <input type="text" name="ifsc_code" id="ifsc_code"
                                   value="{{ old('ifsc_code', $partyDetail->ifsc_code) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Branch</label>
                            <input type="text" name="branch" id="branch"
                                   value="{{ old('branch', $partyDetail->branch) }}"
                                   class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes" id="notes" rows="4"
                                  class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">{{ old('notes', $partyDetail->notes) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex justify-between pt-6">
                <button type="button" @click="prevStep" 
                        x-show="step > 1"
                        class="px-5 py-2.5 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition-colors flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Previous
                </button>
                <button type="button" @click="nextStep" 
                        x-show="step < 4"
                        class="ml-auto px-5 py-2.5 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition-colors flex items-center">
                    Next <i class="fas fa-arrow-right ml-2"></i>
                </button>
                <button type="submit" 
                        x-show="step === 4"
                        class="ml-auto px-6 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors flex items-center">
                    <i class="fas fa-save mr-2"></i> Update Party Details
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
