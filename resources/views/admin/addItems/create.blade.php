
@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <!-- Form -->
    <form id="addItemForm" method="POST" action="{{ route('admin.add-items.store') }}" enctype="multipart/form-data" class="p-6">
        @csrf
        <div class="bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h2 class="text-xl font-semibold text-gray-800">Add Item</h2>
                <div class="mb-4">
                    <span class="text-sm font-medium text-gray-600">Product</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <!-- Switch -->
                        <input type="checkbox" id="switchType" value="service" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-indigo-600 transition-colors"></div>
                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                    </label>
                    <span class="text-sm font-medium text-gray-600">Service</span>

                    <!-- Hidden field -->
                    <input type="hidden" id="itemTypeHidden" name="item_type" value="{{ old('item_type', 'product') }}">
                </div>
            </div>

            <!-- Top Fields -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 p-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Name *</label>
                    <input type="text" name="item_name" value="{{ old('item_name') }}"
                           class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Item HSN</label>
                    <input type="text" name="item_hsn" value="{{ old('item_hsn') }}"
                           class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm">
                </div>
                <div>
                    <label for="unit_id" class="text-sm font-medium text-gray-700">Select Unit *</label>
                    <select name="select_unit_id" id="unit_id"
                            class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm">
                        @foreach($select_units as $id => $unit)
                            <option value="{{ $id }}" {{ old('unit_id') == $id ? 'selected' : '' }}>
                                {{ $unit }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Category, Quantity, Item Code -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 px-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="select_category[]" id="select_category" multiple class="select2 w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm">
                        @foreach($select_categories as $id => $entry)
                            <option value="{{ $id }}" {{ (collect(old('select_category'))->contains($id)) ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold <strong>CTRL</strong> or <strong>CMD</strong> to select multiple categories.</p>
                    @error('select_category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}"
                           placeholder="Enter Quantity"
                           class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Code</label>
                    <div class="flex space-x-2">
                        <input type="text" id="item_code" name="item_code" value="{{ old('item_code') }}"
                               class="flex-1 rounded-md border border-gray-300 px-4 py-2 shadow-sm">
                        <button type="button" id="generateCodeBtn"
                                class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-md font-medium">
                            Assign Code
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="border-b mb-6 px-6" x-data="{ tab: 'pricing' }">
                <nav class="flex space-x-6" aria-label="Tabs">
                    <button type="button" @click="tab = 'pricing'" :class="tab === 'pricing' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="py-3 px-1 border-b-2 font-medium text-sm">Pricing</button>
                    <button type="button" @click="tab = 'wholesale'" :class="tab === 'wholesale' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="py-3 px-1 border-b-2 font-medium text-sm">Wholesale</button>
                    <button type="button" @click="tab = 'purchase'" :class="tab === 'purchase' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="py-3 px-1 border-b-2 font-medium text-sm">Purchase</button>
                    <button type="button" @click="tab = 'stock'" :class="tab === 'stock' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="py-3 px-1 border-b-2 font-medium text-sm">Stock</button>
                    <button type="button" @click="tab = 'online'" :class="tab === 'online' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="py-3 px-1 border-b-2 font-medium text-sm">Online Store</button>
                </nav>

                <!-- Pricing Section -->
                <div x-show="tab === 'pricing'" class="bg-gray-50 rounded-lg p-4 mb-6 space-y-6">
                    <!-- Sale Price -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-700 mb-3">Sale Price</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price') }}" placeholder="Sale Price" class="w-full rounded-md border border-gray-300 px-4 py-2">
                            <select name="select_type" class="w-full rounded-md border border-gray-300 px-4 py-2">
                                @foreach(\App\Models\AddItem::SELECT_TYPE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('select_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <input type="number" step="0.01" name="disc_on_sale_price" value="{{ old('disc_on_sale_price') }}" placeholder="Discount on Sale Price" class="w-full rounded-md border border-gray-300 px-4 py-2">
                            <select name="disc_type" class="w-full rounded-md border border-gray-300 px-4 py-2">
                                <option value="percentage" {{ old('disc_type') == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                <option value="flat" {{ old('disc_type') == 'flat' ? 'selected' : '' }}>Flat</option>
                            </select>
                        </div>
                    </div>
                    <!-- Tax -->
                    <div>
                        <h3 class="text-md font-semibold text-gray-700 mb-3">Tax Rate</h3>
                        <select name="select_tax_id" class="w-full rounded-md border border-gray-300 px-4 py-2">
                            @foreach($select_taxes as $id => $label)
                                <option value="{{ $id }}" {{ old('select_tax_id') == $id ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Wholesale Section -->
                <div x-show="tab === 'wholesale'" class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="text-md font-semibold text-gray-700 mb-3">Wholesale Price</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="number" step="0.01" name="wholesale_price" value="{{ old('wholesale_price') }}" placeholder="Wholesale Price" class="w-full rounded-md border border-gray-300 px-4 py-2">
                        <select name="select_type_wholesale" class="w-full rounded-md border border-gray-300 px-4 py-2">
                            @foreach(\App\Models\AddItem::SELECT_TYPE_WHOLESALE_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('select_type_wholesale') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="minimum_wholesale_qty" value="{{ old('minimum_wholesale_qty') }}" placeholder="Minimum Qty" class="w-full rounded-md border border-gray-300 px-4 py-2">
                    </div>
                </div>

                <!-- Purchase Section -->
                <div x-show="tab === 'purchase'" class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="text-md font-semibold text-gray-700 mb-3">Purchase Price</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="number" step="0.01" name="purchase_price" value="{{ old('purchase_price') }}" placeholder="Purchase Price" class="w-full rounded-md border border-gray-300 px-4 py-2">
                        <select name="select_purchase_type" class="w-full rounded-md border border-gray-300 px-4 py-2">
                            @foreach(\App\Models\AddItem::SELECT_PURCHASE_TYPE_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('select_purchase_type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Stock Section -->
                <div x-show="tab === 'stock'" class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="text-md font-semibold text-gray-700 mb-3">Stock Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="number" name="opening_stock" value="{{ old('opening_stock') }}" placeholder="Opening Stock" class="w-full rounded-md border border-gray-300 px-4 py-2">
                        <input type="number" name="low_stock_warning" value="{{ old('low_stock_warning') }}" placeholder="Low Stock Warning" class="w-full rounded-md border border-gray-300 px-4 py-2">
                        <input type="text" name="warehouse_location" value="{{ old('warehouse_location') }}" placeholder="Warehouse Location" class="w-full rounded-md border border-gray-300 px-4 py-2">
                    </div>
                </div>

                <!-- Online Store Section -->
                <div x-show="tab === 'online'" class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="text-md font-semibold text-gray-700 mb-3">Online Store Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="online_store_title" value="{{ old('online_store_title') }}" placeholder="Store Title" class="w-full rounded-md border border-gray-300 px-4 py-2">
                        <textarea name="online_store_description" placeholder="Store Description" class="w-full rounded-md border border-gray-300 px-4 py-2">{{ old('online_store_description') }}</textarea>
                        <input type="file" name="online_store_image" class="w-full rounded-md border border-gray-300 px-4 py-2">
                    </div>
                </div>
            </div>

            <!-- json_data -->
            <input type="hidden" id="json_data" name="json_data" value="">

            <!-- Footer -->
            <div class="flex justify-end space-x-3 px-6 pb-6">
                <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                    Save
                </button>
                <a href="{{ route('admin.add-items.create') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Save & New
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Scripts -->
<script>
    document.getElementById("generateCodeBtn").addEventListener("click", function () {
        let randomCode = "ITM-" + Math.floor(1000 + Math.random() * 9000) + "-" + Date.now().toString().slice(-4);
        document.getElementById("item_code").value = randomCode;
    });

    document.addEventListener('DOMContentLoaded', function () {
        const switchEl = document.getElementById('switchType');
        const hiddenEl = document.getElementById('itemTypeHidden');
        // Initialize switch from hidden value
        switchEl.checked = (hiddenEl.value === 'service');
        switchEl.addEventListener('change', function () {
            hiddenEl.value = this.checked ? 'service' : 'product';
        });

        // Pack a lightweight JSON snapshot before submit
        const form = document.getElementById('addItemForm');
        form.addEventListener('submit', function () {
            const payload = {
                item_type: hiddenEl.value,
                unit_id: document.getElementById('unit_id')?.value || null,
                select_category: document.getElementById('select_category')?.value || null,
                quantity: document.querySelector('[name="quantity"]')?.value || null,
                item_code: document.getElementById('item_code')?.value || null,
                pricing: {
                    sale_price: document.querySelector('[name="sale_price"]').value || null,
                    select_type: document.querySelector('[name="select_type"]').value || null,
                    disc_on_sale_price: document.querySelector('[name="disc_on_sale_price"]').value || null,
                    disc_type: document.querySelector('[name="disc_type"]').value || null,
                    select_tax_id: document.querySelector('[name="select_tax_id"]').value || null,
                },
                wholesale: {
                    wholesale_price: document.querySelector('[name="wholesale_price"]').value || null,
                    select_type_wholesale: document.querySelector('[name="select_type_wholesale"]').value || null,
                    minimum_wholesale_qty: document.querySelector('[name="minimum_wholesale_qty"]').value || null,
                },
                purchase: {
                    purchase_price: document.querySelector('[name="purchase_price"]').value || null,
                    select_purchase_type: document.querySelector('[name="select_purchase_type"]').value || null,
                },
                stock: {
                    opening_stock: document.querySelector('[name="opening_stock"]').value || null,
                    low_stock_warning: document.querySelector('[name="low_stock_warning"]').value || null,
                    warehouse_location: document.querySelector('[name="warehouse_location"]').value || null,
                },
                online: {
                    title: document.querySelector('[name="online_store_title"]').value || null,
                    description: document.querySelector('[name="online_store_description"]').value || null,
                }
            };
            document.getElementById('json_data').value = JSON.stringify(payload);
        });
    });
</script>
@endsection

