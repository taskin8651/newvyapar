@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto py-8">

    <div class="bg-white rounded-lg shadow">
        <!-- Header -->
        <div class="flex items-center justify-between border-b px-6 py-4">
            <h2 class="text-xl font-semibold text-gray-800">Add Item</h2>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3">
    <!-- Label: Product -->
    <span class="text-sm font-medium text-gray-600">Product</span>

    <!-- Switch -->
    <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox" id="switchType" class="sr-only peer">
        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-indigo-600 transition-colors"></div>
        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
    </label>

    <!-- Label: Service -->
    <span class="text-sm font-medium text-gray-600">Service</span>
</div>


<script>
    const switchInput = document.getElementById("switchType");
    const switchValue = document.getElementById("switchValue");

    switchInput.addEventListener("change", () => {
        switchValue.textContent = switchInput.checked ? "Service" : "Product";
    });
</script>

            </div>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.add-items.store') }}" enctype="multipart/form-data" class="p-6">
            @csrf

            <!-- Top Fields -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Name *</label>
                    <input type="text" name="item_name" value="{{ old('item_name') }}"
                           class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 
                                  focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Item HSN</label>
                    <input type="text" name="item_hsn" value="{{ old('item_hsn') }}"
                           class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 
                                  focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="flex items-end">
                    <button type="button" class="w-full px-4 py-2 bg-indigo-100 text-indigo-700 rounded-md font-medium">
                        Select Unit
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="select_category" id="select_category"
                            class="w-full rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 
                                   focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">-- Select --</option>
                        @foreach($select_categories as $id => $entry)
                            <option value="{{ $id }}" {{ old('select_category') == $id ? 'selected' : '' }}>
                                {{ $entry }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Item Code</label>
                    <div class="flex space-x-2">
                        <input type="text" name="item_code" value="{{ old('item_code') }}"
                               class="flex-1 rounded-md border border-gray-300 px-4 py-2 shadow-sm focus:border-indigo-500 
                                      focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <button type="button" class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-md font-medium">
                            Assign Code
                        </button>
                    </div>
                </div>
                <div class="flex items-end">
                    <button type="button" class="w-full px-4 py-2 border border-indigo-500 text-indigo-600 rounded-md hover:bg-indigo-50">
                        + Add Item Image
                    </button>
                </div>
            </div>

          <!-- Tabs -->
<div class="border-b mb-6" x-data="{ tab: 'pricing' }">
    <nav class="flex space-x-6" aria-label="Tabs">
        <button type="button"
                @click="tab = 'pricing'"
                :class="tab === 'pricing' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                class="py-3 px-1 border-b-2 font-medium text-sm">
            Pricing
        </button>
        <button type="button"
                @click="tab = 'stock'"
                :class="tab === 'stock' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                class="py-3 px-1 border-b-2 font-medium text-sm">
            Stock
        </button>
        <button type="button"
                @click="tab = 'online'"
                :class="tab === 'online' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                class="py-3 px-1 border-b-2 font-medium text-sm">
            Online Store
        </button>
    </nav>

    <!-- Pricing Section -->
    <div x-show="tab === 'pricing'" class="bg-gray-50 rounded-lg p-4 mb-6">
        <h3 class="text-md font-semibold text-gray-700 mb-3">Sale Price</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input type="text" name="sale_price" placeholder="Sale Price"
                   class="w-full rounded-md border border-gray-300 px-4 py-2">
            <select name="select_type"
                    class="w-full rounded-md border border-gray-300 px-4 py-2">
                <option value="without_tax">Without Tax</option>
                <option value="with_tax">With Tax</option>
            </select>
            <input type="text" name="disc_on_sale_price" placeholder="Disc. On Sale Price"
                   class="w-full rounded-md border border-gray-300 px-4 py-2">
            <select name="disc_type"
                    class="w-full rounded-md border border-gray-300 px-4 py-2">
                <option value="percentage">Percentage</option>
                <option value="flat">Flat</option>
            </select>
        </div>
        <div class="mt-3">
            <button type="button" class="text-indigo-600 text-sm font-medium hover:underline">
                + Add Wholesale Price
            </button>
        </div>
    </div>

    <!-- Stock Section -->
    <div x-show="tab === 'stock'" class="bg-gray-50 rounded-lg p-4 mb-6">
        <h3 class="text-md font-semibold text-gray-700 mb-3">Stock Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" placeholder="Opening Stock"
                   class="w-full rounded-md border border-gray-300 px-4 py-2">
            <input type="text" placeholder="Low Stock Warning"
                   class="w-full rounded-md border border-gray-300 px-4 py-2">
            <input type="text" placeholder="Warehouse Location"
                   class="w-full rounded-md border border-gray-300 px-4 py-2">
        </div>
    </div>

    <!-- Online Store Section -->
    <div x-show="tab === 'online'" class="bg-gray-50 rounded-lg p-4 mb-6">
        <h3 class="text-md font-semibold text-gray-700 mb-3">Online Store Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" placeholder="Store Title"
                   class="w-full rounded-md border border-gray-300 px-4 py-2">
            <textarea placeholder="Store Description"
                      class="w-full rounded-md border border-gray-300 px-4 py-2"></textarea>
            <input type="file"
                   class="w-full rounded-md border border-gray-300 px-4 py-2">
        </div>
    </div>
</div>


            <!-- Footer -->
            <div class="flex justify-end space-x-3">
                <button type="button"
                        class="px-6 py-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Save & New
                </button>
                <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
