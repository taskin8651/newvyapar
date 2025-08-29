@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
        
        <!-- Header -->
        <div class="bg-blue-600 text-white p-6">
            <h1 class="text-3xl font-bold">SALE INVOICE</h1>
            <div class="flex mt-4 space-x-6">
                <label class="flex items-center">
                    <input type="radio" name="payment_type" value="credit" class="h-4 w-4 text-blue-600" checked>
                    <span class="ml-2">Credit</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="payment_type" value="cash" class="h-4 w-4 text-blue-600">
                    <span class="ml-2">Cash</span>
                </label>
            </div>
        </div>

        <form action="{{ route('admin.sale-invoices.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Customer & Invoice Info -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Bill To</h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Customer Name</label>
                        <input type="text" name="billing_name" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Billing Address</label>
                        <textarea name="billing_address" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror"></textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Invoice Details</h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Invoice Number (PO No.)</label>
                        <input type="text" name="po_no" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Invoice Date</label>
                            <input type="date" name="po_date" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Due Date</label>
                            <input type="date" name="due_date" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">E-Way Bill No.</label>
                        <input type="text" name="e_way_bill_no" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="px-6 pb-6">
                <hr class="border-dashed border-gray-300 mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">ITEMS</h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">QTY</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price/Unit</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tax %</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Discount</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-2">
                                    <input type="text" name="items[0][name]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                                </td>
                                <td class="px-4 py-2">
                                    <input type="text" name="items[0][description]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                                </td>
                                <td class="px-4 py-2">
                                    <input type="number" name="items[0][qty]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror" value="1">
                                </td>
                                <td class="px-4 py-2">
                                    <select name="items[0][unit]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                                        <option>Unit</option>
                                        <option>Piece</option>
                                        <option>Kg</option>
                                        <option>Box</option>
                                    </select>
                                </td>
                                <td class="px-4 py-2">
                                    <input type="number" name="items[0][price]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror" value="0">
                                </td>
                                <td class="px-4 py-2">
                                    <select name="items[0][tax]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror">
                                        <option value="0">0%</option>
                                        <option value="5">5%</option>
                                        <option value="12">12%</option>
                                        <option value="18">18%</option>
                                    </select>
                                </td>
                                <td class="px-4 py-2">
                                    <input type="number" name="items[0][discount]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror" value="0">
                                </td>
                                <td class="px-4 py-2 font-semibold">
                                    <input type="text" name="items[0][amount]" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" id="addRow" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    <i class="fas fa-plus mr-2"></i> ADD ROW
                </button>
            </div>

            <!-- Notes & Totals -->
            <div class="px-6 pb-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Notes</h2>
                    <textarea name="notes" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror"></textarea>

                    <h2 class="text-xl font-semibold text-gray-700">Terms & Conditions</h2>
                    <textarea name="terms" rows="3" class="w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 sm:text-sm @error('title') border-red-500 @enderror"></textarea>
                </div>
                <div>
                    <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span id="subtotal">$0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax:</span>
                            <span id="tax">$0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Discount:</span>
                            <span id="discount">$0.00</span>
                        </div>
                        <div class="flex justify-between border-t pt-2 font-bold">
                            <span>Total:</span>
                            <span id="total">$0.00</span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-md flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> SAVE INVOICE
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JS for Dynamic Row -->
<script>
document.getElementById('addRow').addEventListener('click', function () {
    let table = document.querySelector('#itemsTable tbody');
    let rowCount = table.rows.length;
    let newRow = table.rows[0].cloneNode(true);

    newRow.querySelectorAll('input, select').forEach(el => {
        let name = el.getAttribute('name');
        if (name) {
            let newName = name.replace(/\d+/, rowCount);
            el.setAttribute('name', newName);
            if (el.tagName === 'INPUT') el.value = '';
        }
    });

    table.appendChild(newRow);
});
</script>
@endsection
