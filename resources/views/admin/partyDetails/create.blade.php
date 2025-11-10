@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Party Details</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .required:after { content: " *"; color: #e53e3e; }
        .step-indicator { transition: all 0.3s ease; }
        input:focus, select:focus, textarea:focus {
            outline: none;
            ring: 2px;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="max-w-5xl mx-auto py-6">
        <div 
            x-data="partyForm()" 
            class="bg-white rounded-2xl shadow-lg p-6"
        >
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-indigo-800">Create Party Details</h2>
                    <p class="text-sm text-gray-500">Complete all 4 steps — Basic, Address, Finance & Bank.</p>
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

            <!-- Form -->
            <form method="POST" action="{{ route('admin.party-details.store') }}" enctype="multipart/form-data" id="partyForm" class="space-y-6">
                @csrf

                <!-- STEP 1 -->
                <div x-show="step === 1" x-transition>
                    <div class="p-6 border rounded-xl space-y-6 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            <i class="fas fa-info-circle mr-2 text-indigo-600"></i> Basic Information
                        </h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 required">Party Name</label>
                            <input type="text" name="party_name" required
                                class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 mt-1">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">GSTIN</label>
                                <input type="text" name="gstin"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 required">Phone Number</label>
                                <input type="text" name="phone_number" required
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">PAN Number</label>
                                <input type="text" name="pan_number"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Place of Supply</label>
                                <input type="text" name="place_of_supply"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Type of Supply</label>
                                <select name="type_of_supply" x-model="type_of_supply"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                                    <option value="Intra-State">Intra-State</option>
                                    <option value="Inter-State">Inter-State</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">GST Type</label>
                                <select name="gst_type" x-model="gst_type"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                                    <option value="Unregistered_Consumer">Unregistered/Consumer</option>
                                    <option value="Registered_Business_Regular">Registered Business - Regular</option>
                                    <option value="Registered_Business_Composition">Registered Business - Composition</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" x-model="status"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                                    <option value="enable">Enable</option>
                                    <option value="disable">Disable</option>
                                    <option value="hold">Hold</option>
                                    <option value="black_list">Black List</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STEP 2 -->
                <!-- STEP 2: Address -->
                <div x-show="step === 2" x-transition>
                    <div class="p-6 border rounded-xl space-y-6 bg-gray-50" x-data="{
                        state: '',
                        city: '',
                        billing_address: '',
                        shipping_address: '',
                        async fetchPincodeDetails() {
                            let pin = document.getElementById('pincode').value.trim();
                            if (pin.length === 6) {
                                try {
                                    const res = await fetch(`https://api.postalpincode.in/pincode/${pin}`);
                                    const data = await res.json();

                                    if (data[0].Status === 'Success') {
                                        let info = data[0].PostOffice[0];
                                        this.state = info.State;
                                        this.city = info.District;
                                        this.billing_address = `${info.Name}, ${info.District}, ${info.State}`;
                                        this.shipping_address = `${info.Name}, ${info.District}, ${info.State}`;
                                    } else {
                                        alert('Invalid Pincode. Please enter a valid Indian pincode.');
                                    }
                                } catch (err) {
                                    console.error('Error fetching pincode:', err);
                                    alert('Could not fetch address. Please try again.');
                                }
                            }
                        }
                    }">

                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i>
                            Address & Contact
                        </h3>                

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Pincode</label>
                                <input type="text" name="pin_code" id="pincode"  maxlength="6"
                                    @input.debounce.500ms="fetchPincodeDetails()"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                            focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">State</label>
                                <input type="text" name="state" id="state" x-model="state"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                            focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" id="city" x-model="city"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                            focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Billing Address</label>
                            <textarea name="billing_address" id="billing_address" rows="3" x-model="billing_address"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                            focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Shipping Address</label>
                            <textarea name="shipping_address" id="shipping_address" rows="3" x-model="shipping_address"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                            focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"></textarea>
                        </div>
                    </div>
                </div>


                <!-- STEP 3 -->
                <div x-show="step === 3" x-transition>
                    <div class="p-6 border rounded-xl space-y-6 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            <i class="fas fa-money-bill-wave mr-2 text-indigo-600"></i> Financial Details
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">Opening Balance</label>
                                <input type="number" step="0.01" name="opening_balance" 
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Opening Balance Type</label>
                                <select name="opening_balance_type" x-model="opening_balance_type"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                                    <option value="Debit">Debit (Payable)</option>
                                    <option value="Credit">Credit (Receivable)</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">As of Date</label>
                                <input type="date" name="as_of_date"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Payment Terms</label>
                                <input type="text" name="payment_terms"
                                    class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Credit Limit</label>
                            <div class="flex items-center space-x-6">
                                <label class="inline-flex items-center">
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
                            <input type="number" step="0.01" name="credit_limit_amount"
                                class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                        </div>
                    </div>
                </div>

                <!-- STEP 4 -->
                <div x-show="step === 4" x-transition>
                    <div class="p-6 border rounded-xl space-y-6 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            <i class="fas fa-university mr-2 text-indigo-600"></i> Bank Details & Notes
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 ">IFSC Code</label>
                                <input type="text" name="ifsc_code" id="ifsc_code" x-model="ifsc_code"
                                       @blur="fetchBankDetails()"
                                       placeholder="Enter IFSC code (e.g., SBIN0000456)"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                                <p class="text-xs text-gray-500 mt-1">Bank name and branch will auto-fill.</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Bank Name</label>
                                <input type="text" name="bank_name" id="bank_name" x-model="bank_name"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Branch</label>
                                <input type="text" name="branch" id="branch" x-model="branch"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700">Branch Address</label>
                                <textarea name="branch_address" x-model="branch_address" rows="3" readonly
                                        class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm mt-1 bg-gray-100"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Account Number</label>
                                <input type="text" name="account_number"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" rows="4"
                                class="w-full rounded-md border border-gray-300 px-4 py-3 focus:border-indigo-500 mt-1"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex justify-between pt-6">
                    <button type="button" @click="prevStep" x-show="step > 1"
                        class="px-5 py-2.5 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition-colors flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Previous
                    </button>
                    <button type="button" @click="nextStep" x-show="step < 4"
                        class="ml-auto px-5 py-2.5 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition-colors flex items-center">
                        Next <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                    <button type="submit" x-show="step === 4"
                        class="ml-auto px-6 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors flex items-center">
                        <i class="fas fa-save mr-2"></i> Save Party Details
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function partyForm() {
        return {
            step: 1,
            credit_limit: 'off',
            type_of_supply: 'Intra-State',
            gst_type: 'Unregistered_Consumer',
            opening_balance_type: 'Debit',
            status: 'enable',
            ifsc_code: '',
            bank_name: '',
            branch: '',
            branch_address: '',

            nextStep() {
                if (this.step < 4) this.step++;
                window.scrollTo(0, 0);
            },
            prevStep() {
                if (this.step > 1) this.step--;
                window.scrollTo(0, 0);
            },

            async fetchBankDetails() {
                if (!this.ifsc_code) return;
                try {
                    const res = await fetch(`https://ifsc.razorpay.com/${this.ifsc_code}`);
                    if (!res.ok) throw new Error('Invalid IFSC');
                    const data = await res.json();

                    this.bank_name = data.BANK || '';
                    this.branch = data.BRANCH || '';
                    this.branch_address = data.ADDRESS || '';

                } catch (err) {
                    alert('Invalid IFSC code or network error.');
                    this.bank_name = '';
                    this.branch = '';
                    this.branch_address = '';
                }
            }
        }
    }
</script>

</body>
</html>
@endsection
