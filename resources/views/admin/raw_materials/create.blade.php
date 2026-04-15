@extends('layouts.admin')
@section('content')

<h2 class="text-2xl font-bold mb-6">Add Raw Materials</h2>

<form method="POST" action="{{ route('admin.raw-materials.store') }}">
@csrf

<!-- 🔹 Header Section -->
<div class="bg-white p-6 rounded-2xl shadow mb-6 border">
    <div class="grid grid-cols-3 gap-6">

        <!-- Unique Code -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Unique Code</label>
            <input type="text"
                   value="Auto Generated"
                   readonly
                   class="mt-1 w-full border rounded-lg p-2 bg-gray-100 font-semibold text-indigo-600">
        </div>

        <!-- Warehouse -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Warehouse Location</label>
            <input type="text"
                   name="warehouse_location"
                   required
                   class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-indigo-400">
        </div>

        <!-- Low Stock Warning -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Low Stock Warning</label>
            <input type="number"
                   step="0.01"
                   name="low_stock_warning"
                   class="mt-1 w-full border rounded-lg p-2 focus:ring-2 focus:ring-red-400">
        </div>

    </div>
</div>


<!-- 🔹 Table Section -->
<div x-data="rawMaterialTable()" class="bg-white p-6 rounded-2xl shadow border">

    <div class="overflow-x-auto">
        <table class="w-full text-sm border rounded-lg overflow-hidden">
            <thead class="bg-gradient-to-r from-indigo-50 to-purple-50 text-gray-700">
                <tr>
                    <th class="p-3">Title</th>
                    <th class="p-3">Buyer Code</th>
                    <th class="p-3">Item Code</th>
                    <th class="p-3">HSN</th>
                    <th class="p-3">Unit</th>
                    <th class="p-3">Unit Type</th>
                    <th class="p-3">Qty</th>
                    <th class="p-3">Purchase</th>
                    <th class="p-3">Sale</th>
                    <th class="p-3">Tax %</th>
                    <th class="p-3">With Tax</th>
                    <th class="p-3">Line Total</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                <template x-for="(row, index) in rows" :key="index">
                    <tr class="border-t hover:bg-gray-50 transition">

                        <td>
                            <input type="text"
                                   :name="'materials['+index+'][title]'"
                                   class="border p-1 w-full rounded" required>
                        </td>

                        <td>
                            <input type="text"
                                   :name="'materials['+index+'][buyer_code]'"
                                   class="border p-1 w-full rounded">
                        </td>

                        <td>
                            <input type="text"
                                   :name="'materials['+index+'][item_code]'"
                                   class="border p-1 w-full rounded">
                        </td>

                        <td>
                            <input type="text"
                                   :name="'materials['+index+'][item_hsn]'"
                                   class="border p-1 w-full rounded">
                        </td>

                        <td>
                            <input type="text"
                                   :name="'materials['+index+'][unit]'"
                                   class="border p-1 w-full rounded">
                        </td>

                        <td>
                            <input type="text"
                                   :name="'materials['+index+'][unit_type]'"
                                   class="border p-1 w-full rounded">
                        </td>

                        <td>
                            <input type="number"
                                   step="0.01"
                                   :name="'materials['+index+'][quantity]'"
                                   x-model.number="row.qty"
                                   @input="calculate(index)"
                                   class="border p-1 w-full rounded" required>
                        </td>

                        <td>
                            <input type="number"
                                   step="0.01"
                                   :name="'materials['+index+'][purchase_price]'"
                                   x-model.number="row.price"
                                   @input="calculate(index)"
                                   class="border p-1 w-full rounded" required>
                        </td>

                        <td>
                            <input type="number"
                                   step="0.01"
                                   :name="'materials['+index+'][sale_price]'"
                                   class="border p-1 w-full rounded">
                        </td>

                        <td>
                            <input type="number"
                                   step="0.01"
                                   :name="'materials['+index+'][tax_percent]'"
                                   x-model.number="row.tax"
                                   :disabled="!row.withTax"
                                   @input="calculate(index)"
                                   class="border p-1 w-full rounded">
                        </td>

                        <td class="text-center">
                            <!-- Hidden input ensures 0 when unchecked -->
                            <input type="hidden"
                                   :name="'materials['+index+'][with_tax]'"
                                   value="0">

                            <input type="checkbox"
                                   value="1"
                                   :name="'materials['+index+'][with_tax]'"
                                   x-model="row.withTax"
                                   @change="calculate(index)">
                        </td>

                        <td class="text-right font-semibold text-indigo-600">
                            ₹ <span x-text="row.total.toFixed(2)"></span>
                        </td>

                        <td class="text-center space-x-2">
                            <button type="button"
                                    @click="addRow()"
                                    class="bg-green-100 text-green-700 px-2 py-1 rounded hover:bg-green-200">
                                +
                            </button>

                            <button type="button"
                                    @click="removeRow(index)"
                                    x-show="rows.length > 1"
                                    class="bg-red-100 text-red-700 px-2 py-1 rounded hover:bg-red-200">
                                🗑
                            </button>
                        </td>

                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- 🔹 Summary Section -->
    <div class="flex justify-end mt-8">
        <div class="w-1/3 bg-gray-50 p-5 rounded-xl border text-sm shadow-inner">

            <div class="flex justify-between mb-2">
                <span>Subtotal:</span>
                <span>₹ <span x-text="subtotal.toFixed(2)"></span></span>
            </div>

            <div class="flex justify-between mb-2">
                <span>Total Tax:</span>
                <span>₹ <span x-text="totalTax.toFixed(2)"></span></span>
            </div>

            <div class="flex justify-between font-bold text-lg border-t pt-3 text-indigo-600">
                <span>Grand Total:</span>
                <span>₹ <span x-text="grandTotal.toFixed(2)"></span></span>
            </div>

        </div>
    </div>

    <button type="submit"
        class="mt-8 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl shadow-lg hover:scale-105 transition">
        Save Raw Materials
    </button>

</div>

</form>


<script>
function rawMaterialTable() {
    return {
        rows: [
            { qty:0, price:0, tax:0, withTax:false, total:0 }
        ],
        subtotal:0,
        totalTax:0,
        grandTotal:0,

        addRow() {
            this.rows.push({ qty:0, price:0, tax:0, withTax:false, total:0 });
        },

        removeRow(index) {
            this.rows.splice(index,1);
            this.calculateAll();
        },

        calculate(index) {
            let row = this.rows[index];
            let base = row.qty * row.price;
            let taxAmount = row.withTax ? (base * row.tax / 100) : 0;
            row.total = base + taxAmount;
            this.calculateAll();
        },

        calculateAll() {
            this.subtotal = 0;
            this.totalTax = 0;

            this.rows.forEach(row => {
                let base = row.qty * row.price;
                let taxAmount = row.withTax ? (base * row.tax / 100) : 0;

                this.subtotal += base;
                this.totalTax += taxAmount;
            });

            this.grandTotal = this.subtotal + this.totalTax;
        }
    }
}
</script>

@endsection
