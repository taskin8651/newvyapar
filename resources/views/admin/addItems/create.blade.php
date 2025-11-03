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

            <!-- Product Type -->
            <div class="px-6 pt-4" id="productTypeSection" style="display: none;">
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Type</label>
                <select id="productType" name="product_type" class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm">
                    <option value="">-- Select Product Type --</option>
                    <option value="ready_made" {{ old('product_type') == 'ready_made' ? 'selected' : '' }}>Ready Made</option>
                    <option value="finished_goods" {{ old('product_type') == 'finished_goods' ? 'selected' : '' }}>Finished Goods</option>
                    <option value="raw_material" {{ old('product_type') == 'raw_material' ? 'selected' : '' }}>Raw Material</option>
                </select>
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
                    <button type="button" id="rawMaterialTab" style="display:none;" @click="tab = 'select_raw_material'" :class="tab === 'select_raw_material' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="py-3 px-1 border-b-2 font-medium text-sm">Select Raw Material</button>
                </nav>

                <!-- Pricing Section -->
                <div x-show="tab === 'pricing'" class="bg-gray-50 rounded-lg p-4 mb-6 space-y-6">
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

                <!-- Select Raw Material -->
                <div x-show="tab === 'select_raw_material'" id="rawMaterialSection" style="display:none;" class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h3 class="text-md font-semibold text-gray-700 mb-3">Select Raw Materials</h3>

                    <div class="grid grid-cols-2 gap-4">
                        @forelse($raw_materials as $material)
                            @php
                                $mid = $material['id'];
                            @endphp
                            <label class="raw-material-card flex items-start space-x-3 bg-white p-3 rounded-md border shadow-sm hover:bg-blue-50 cursor-pointer">
                                <div class="flex-shrink-0">
                                    <input 
                                        type="checkbox" 
                                        name="select_raw_materials[]" 
                                        value="{{ $mid }}" 
                                        class="raw-checkbox form-checkbox h-5 w-5 text-blue-600"
                                    >
                                </div>

                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-gray-800 font-medium">{{ $material['name'] }}</p>
                                            <p class="text-xs text-gray-500">Available Qty: {{ $material['qty'] }}</p>
                                        </div>
                                        <div class="text-right text-xs text-gray-600">
                                            <p>Sale: <span class="raw-sale-price">{{ number_format($material['sale_price'], 2) }}</span></p>
                                            <p>Purchase: <span class="raw-purchase-price">{{ number_format($material['purchase_price'], 2) }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Qty controls -->
                                    <div class="mt-3 flex items-center space-x-3">
                                        <div class="flex items-center border rounded-md overflow-hidden">
                                            <button type="button" class="decreaseBtn px-3 py-1">−</button>
                                            <input type="number" min="0" step="0.01" name="raw_qty[{{ $mid }}]" value="0" class="raw-qty-input w-20 text-center border-l border-r px-2 py-1">
                                            <button type="button" class="increaseBtn px-3 py-1">+</button>
                                        </div>

                                        <div class="text-sm text-gray-600">
                                            <div>Item Sale Total: ₹ <span class="raw-item-sale-total">0.00</span></div>
                                            <div>Item Purchase Total: ₹ <span class="raw-item-purchase-total">0.00</span></div>
                                        </div>
                                    </div>

                                    <!-- Hidden inputs for the price snapshot -->
                                    <input type="hidden" name="raw_sale_price[{{ $mid }}]" value="{{ $material['sale_price'] }}" class="raw-sale-price-input">
                                    <input type="hidden" name="raw_purchase_price[{{ $mid }}]" value="{{ $material['purchase_price'] }}" class="raw-purchase-price-input">
                                </div>
                            </label>
                        @empty
                            <p class="text-gray-500 text-sm">No raw materials available in current stock.</p>
                        @endforelse
                    </div>

                    <!-- Totals -->
                    <div class="mt-4 p-4 bg-white rounded border">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Total Sale Value (composition)</p>
                                <p class="text-xl font-semibold">₹ <span id="totalSaleValue">0.00</span></p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Purchase Value (composition)</p>
                                <p class="text-xl font-semibold">₹ <span id="totalPurchaseValue">0.00</span></p>
                            </div>
                        </div>
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
document.addEventListener('DOMContentLoaded', function () {
    const itemTypeSwitch = document.getElementById('switchType');
    const hiddenType = document.getElementById('itemTypeHidden');
    const productTypeSection = document.getElementById('productTypeSection');
    const productTypeDropdown = document.getElementById('productType');
    const rawMaterialTab = document.getElementById('rawMaterialTab');
    const rawMaterialSection = document.getElementById('rawMaterialSection');

    const quantityField = document.querySelector('[name="quantity"]');
    const openingStockField = document.querySelector('[name="opening_stock"]');

    function updateVisibility() {
        if (hiddenType.value === 'product') {
            productTypeSection.style.display = 'block';
        } else {
            productTypeSection.style.display = 'none';
            rawMaterialTab.style.display = 'none';
            rawMaterialSection.style.display = 'none';
        }
    }

    function updateRawMaterialTab() {
        if (productTypeDropdown.value === 'finished_goods') {
            rawMaterialTab.style.display = 'inline-block';
            rawMaterialSection.style.display = 'block';
        } else {
            rawMaterialTab.style.display = 'none';
            rawMaterialSection.style.display = 'none';
        }
    }

    // Initialize state
    itemTypeSwitch.checked = hiddenType.value === 'service';
    updateVisibility();
    updateRawMaterialTab();

    // Event listeners
    itemTypeSwitch.addEventListener('change', () => {
        hiddenType.value = itemTypeSwitch.checked ? 'service' : 'product';
        updateVisibility();
    });

    productTypeDropdown.addEventListener('change', updateRawMaterialTab);

    // Generate code
    document.getElementById("generateCodeBtn").addEventListener("click", function () {
        let randomCode = "ITM-" + Math.floor(1000 + Math.random() * 9000) + "-" + Date.now().toString().slice(-4);
        document.getElementById("item_code").value = randomCode;
    });

    // Pack JSON before submit
    document.getElementById('addItemForm').addEventListener('submit', function () {
        const payload = {
            item_type: hiddenType.value,
            product_type: productTypeDropdown.value,
            quantity: quantityField.value || null,
            opening_stock: openingStockField.value || null,
            composition_totals: {
                total_sale_value: parseFloat(document.getElementById('totalSaleValue').innerText.replace(/,/g,'')) || 0,
                total_purchase_value: parseFloat(document.getElementById('totalPurchaseValue').innerText.replace(/,/g,'')) || 0,
            }
        };
        document.getElementById('json_data').value = JSON.stringify(payload);
    });

    // Two-way binding between Quantity and Opening Stock
    if (quantityField && openingStockField) {
        quantityField.addEventListener('input', function () {
            if (openingStockField.value !== this.value) {
                openingStockField.value = this.value;
            }
        });

        openingStockField.addEventListener('input', function () {
            if (quantityField.value !== this.value) {
                quantityField.value = this.value;
            }
        });
    }

    // RAW MATERIALS: increase/decrease, totals and checkbox handling
    function recalcTotals() {
        const cards = document.querySelectorAll('.raw-material-card');
        let totalSale = 0;
        let totalPurchase = 0;

        cards.forEach(card => {
            const checkbox = card.querySelector('.raw-checkbox');
            const qtyInput = card.querySelector('.raw-qty-input');
            const salePrice = parseFloat(card.querySelector('.raw-sale-price-input').value || 0);
            const purchasePrice = parseFloat(card.querySelector('.raw-purchase-price-input').value || 0);
            const itemSaleTotalEl = card.querySelector('.raw-item-sale-total');
            const itemPurchaseTotalEl = card.querySelector('.raw-item-purchase-total');

            const qty = parseFloat(qtyInput.value || 0);

            // only show totals if checkbox selected
            const saleTotal = qty * salePrice;
            const purchaseTotal = qty * purchasePrice;

            itemSaleTotalEl.innerText = saleTotal.toFixed(2);
            itemPurchaseTotalEl.innerText = purchaseTotal.toFixed(2);

            if (checkbox.checked && qty > 0) {
                totalSale += saleTotal;
                totalPurchase += purchaseTotal;
            }
        });

        document.getElementById('totalSaleValue').innerText = totalSale.toFixed(2);
        document.getElementById('totalPurchaseValue').innerText = totalPurchase.toFixed(2);
    }

    // add click handlers
    document.querySelectorAll('.raw-material-card').forEach(card => {
        const decrease = card.querySelector('.decreaseBtn');
        const increase = card.querySelector('.increaseBtn');
        const qtyInput = card.querySelector('.raw-qty-input');
        const checkbox = card.querySelector('.raw-checkbox');

        decrease.addEventListener('click', function (e) {
            let v = parseFloat(qtyInput.value || 0);
            v = Math.max(0, (v - 1));
            qtyInput.value = v;
            recalcTotals();
        });

        increase.addEventListener('click', function (e) {
            let v = parseFloat(qtyInput.value || 0);
            v = v + 1;
            qtyInput.value = v;
            recalcTotals();
        });

        // also recalc on manual input
        qtyInput.addEventListener('input', recalcTotals);
        checkbox.addEventListener('change', recalcTotals);
    });

    // initial calc
    recalcTotals();
});
</script>

@endsection
