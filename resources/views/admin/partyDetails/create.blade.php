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
        .required:after {
            content: " *";
            color: #e53e3e;
        }
        .step-indicator {
            transition: all 0.3s ease;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            ring: 2px;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-5xl mx-auto py-6">
        <div 
            x-data="{
                step: 1,
                credit_limit: '{{ old('credit_limit', 'off') }}',
                type_of_supply: '{{ old('type_of_supply', 'Intra-State') }}',
                gst_type: '{{ old('gst_type', 'Unregistered_Consumer') }}',
                opening_balance_type: '{{ old('opening_balance_type', 'Debit') }}',
                status: '{{ old('status', 'enable') }}',
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
                    
                    // Basic validation for required fields
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
                        Create Party Details
                    </h2>
                    <p class="text-sm text-gray-500">Complete the 4 steps to add party details — Basic, Address, Finance & Bank.</p>
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
                            :class="step >= s ? 'bg-gradient-to-r from-indigo-600 to-indigo-500' : 'bg-gray-300'"
                        >
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

            <form method="POST" action="{{ route('admin.party-details.store') }}" enctype="multipart/form-data" id="partyForm" class="space-y-6">
                @csrf
            <!-- STEP 1: Basic -->
                <div x-show="step === 1" x-transition>
                    <div class="p-6 border rounded-xl space-y-6 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            <i class="fas fa-info-circle mr-2 text-indigo-600"></i>
                            Basic Information
                        </h3>

                        <div>
                            <label for="party_name" class="block text-sm font-medium text-gray-700 required">
                                Party Name
                            </label>
                            <input 
                                type="text" 
                                name="party_name" 
                                id="party_name" 
                                required
                                class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                       focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"
                            >
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 required">GSTIN</label>
                                <input type="text" name="gstin" id="gstin" required
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 required">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" required
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">PAN Number</label>
                                <input type="text" name="pan_number" id="pan_number"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Place of Supply</label>
                                <input type="text" name="place_of_supply" id="place_of_supply"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Type of Supply</label>
                                <select name="type_of_supply" x-model="type_of_supply"
                                        class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                               focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                                    <option value="Intra-State">Intra-State</option>
                                    <option value="Inter-State">Inter-State</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">GST Type</label>
                                <select name="gst_type" x-model="gst_type"
                                        class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                               focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                                    <option value="Unregistered_Consumer">Unregistered/Consumer</option>
                                    <option value="Registered_Business_Regular">Registered Business - Regular</option>
                                    <option value="Registered_Business_Composition">Registered Business - Composition</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" x-model="status"
                                        class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                               focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                                    <option value="enable">Enable</option>
                                    <option value="disable">Disable</option>
                                    <option value="hold">Hold</option>
                                    <option value="black_list">Black List</option>
                                </select>
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
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">State</label>
                                <input type="text" name="state" id="state"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" id="city"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Billing Address</label>
                            <textarea name="billing_address" id="billing_address" rows="3"
                                      class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                             focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Shipping Address</label>
                            <textarea name="shipping_address" id="shipping_address" rows="3"
                                      class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                             focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"></textarea>
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
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Opening Balance Type</label>
                                <select name="opening_balance_type" x-model="opening_balance_type"
                                        class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                               focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                                    <option value="Debit">Debit (Receivable)</option>
                                    <option value="Credit">Credit (Payable)</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">As of Date</label>
                                <input type="date" name="as_of_date" id="as_of_date"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Payment Terms</label>
                                <input type="text" name="payment_terms" id="payment_terms"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
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
                                          focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
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
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Account Number</label>
                                <input type="text" name="account_number" id="account_number"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">IFSC Code</label>
                                <input type="text" name="ifsc_code" id="ifsc_code"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Branch</label>
                                <input type="text" name="branch" id="branch"
                                       class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                              focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="4"
                                      class="w-full rounded-md border border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 
                                             focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Documents</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                            <span>Upload files</span>
                                            <input id="file-upload" name="file-upload" type="file" class="sr-only" multiple>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                                </div>
                            </div>
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
                        <i class="fas fa-save mr-2"></i> Save Party Details
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Simple form validation for required fields
        document.addEventListener('alpine:initialized', () => {
            // You can add additional validation logic here if needed
        });
    </script>
</body>
</html>
@section('scripts')
<script>
function wizardForm() {
    return {
        step: 1,
        nextStep() {
            if(this.step < 4) this.step++;
        },
        prevStep() {
            if(this.step > 1) this.step--;
        }
    }
}
</script>
@endsection
