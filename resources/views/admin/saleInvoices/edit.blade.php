@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6">
        <form id="saleForm" action="{{ route('admin.sale-invoices.update', $saleInvoice->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white p-6 rounded-lg mb-6">
                <h1 class="text-3xl font-bold">EDIT SALE INVOICE</h1>
                <div class="flex mt-4 space-x-6">
                    <label class="flex items-center">
                        <input type="radio" name="payment_type" value="credit" class="h-4 w-4 text-white"
                               {{ old('payment_type', $saleInvoice->payment_type) === 'credit' ? 'checked' : '' }}>
                        <span class="ml-2">Credit</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="payment_type" value="cash" class="h-4 w-4 text-white"
                               {{ old('payment_type', $saleInvoice->payment_type) === 'cash' ? 'checked' : '' }}>
                        <span class="ml-2">Cash</span>
                    </label>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Bill To</h2>
                    <select name="select_customer_id" id="customer_id" class="form-select select2 w-full" required>
                        <option value="">-- Select Customer --</option>
                        @foreach($select_customers as $id => $name)
                            <option value="{{ $id }}"
                                {{ (string) old('select_customer_id', $saleInvoice->select_customer_id) === (string) $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>

                    <div id="customerDetailsCard" class="mt-6 p-4 bg-gradient-to-r from-blue-50 to-white border-4 border-blue-300 rounded-xl shadow-xl hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto text-sm">
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Name</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_name"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">GSTIN</td>
                                        <td class="px-3 py-2 text-green-700 font-medium" id="customer_gstin"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Phone</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_phone"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">PAN</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_pan"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Billing Address</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_billing_address"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Shipping Address</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_shipping_address"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">State</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_state"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">City</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_city"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Pincode</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_pincode"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Email</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_email"></td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Credit Limit</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_credit_limit"></td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Payment Terms</td>
                                        <td class="px-3 py-2 text-gray-900" id="customer_payment_terms"></td>
                                    </tr>
                                    <tr class="bg-gray-50">
                                        <td class="px-3 py-2 font-semibold text-gray-700">Opening Balance</td>
                                        <td class="px-3 py-2 space-y-1">
                                            <div id="opening_balance_type" class="text-sm"></div>
                                            <div id="opening_balance_date" class="text-gray-500 text-xs italic"></div>
                                        </td>
                                        <td class="px-3 py-2 font-semibold text-gray-700">Current Balance</td>
                                        <td class="px-3 py-2 space-y-1">
                                            <div id="current_balance_type" class="text-sm"></div>
                                            <div id="current_balance_date" class="text-gray-500 text-xs italic"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 required">Select Main Cost Center</label>
                        <select name="main_cost_center_id" id="main_cost_center_id"
                                class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm" required>
                            @foreach($cost as $id => $name)
                                <option value="{{ $id }}" {{ (string) old('main_cost_center_id', $saleInvoice->main_cost_center_id) === (string) $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 required">Select Sub Cost Center</label>
                        <select name="sub_cost_center_id" id="sub_cost_center_id"
                                class="select2 w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm" required>
                            <option value="">-- Select Sub Cost Center --</option>
                            @foreach($sub_cost as $id => $name)
                                <option value="{{ $id }}" {{ (string) old('sub_cost_center_id', $saleInvoice->sub_cost_center_id) === (string) $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Invoice Details -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700">Invoice Details</h2>

                    <input type="text" name="po_no" value="{{ old('po_no', $saleInvoice->po_no) }}" placeholder="Invoice/PO No." class="w-full rounded-md border px-3 py-2">
                    <input type="text" name="docket_no" value="{{ old('docket_no', $saleInvoice->docket_no) }}" placeholder="Docket Number" class="w-full rounded-md border px-3 py-2 mt-2">

                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <div class="flex flex-col">
                            <label for="po_date" class="mb-1 font-semibold">Billing Date</label>
                            <input type="date" id="po_date" name="po_date"
                                   class="w-full rounded-md border px-3 py-2"
                                   value="{{ old('po_date', optional($saleInvoice->po_date)->format('Y-m-d') ?? date('Y-m-d')) }}">
                        </div>

                        <div class="flex flex-col">
                            <label for="due_date" class="mb-1 font-semibold">Bill Date</label>
                            <input type="date" id="due_date" name="due_date"
                                   class="w-full rounded-md border px-3 py-2"
                                   value="{{ old('due_date', optional($saleInvoice->due_date)->format('Y-m-d')) }}">
                        </div>
                    </div>

                    <input type="text" name="e_way_bill_no" value="{{ old('e_way_bill_no', $saleInvoice->e_way_bill_no) }}" placeholder="E-Way Bill No." class="w-full rounded-md border px-3 py-2 mt-2">
                    <input type="text" name="customer_phone_invoice" id="invoice_customer_phone" value="{{ old('customer_phone_invoice', $saleInvoice->phone_number) }}" placeholder="Customer Phone" class="w-full rounded-md border px-3 py-2 mt-2">
                    <textarea name="billing_address_invoice" id="invoice_billing_address" rows="2" class="w-full rounded-md border px-3 py-2 mt-2" placeholder="Billing Address">{{ old('billing_address_invoice', $saleInvoice->billing_address) }}</textarea>
                    <textarea name="shipping_address_invoice" id="customer_shipping_address2" rows="2" class="w-full rounded-md border px-3 py-2 mt-2" placeholder="Shipping Address">{{ old('shipping_address_invoice', $saleInvoice->shipping_address) }}</textarea>
                </div>
            </div>

            <!-- Items Table -->
            <div class="mb-6">
                <hr class="border-dashed border-gray-300 mb-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">ITEMS</h2>
                    <div class="text-sm text-gray-500">Invoice No: {{ $saleInvoice->sale_invoice_number ?? '—' }} | Status: <span class="font-semibold">{{ $saleInvoice->status ?? 'Draft' }}</span></div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="itemsTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-2 py-2">Item</th>
                                <th class="px-2 py-2">Description</th>
                                <th class="px-2 py-2">QTY</th>
                                <th class="px-2 py-2">Unit</th>
                                <th class="px-2 py-2">Price/Unit</th>
                                <th class="px-2 py-2">Discount</th>
                                <th class="px-2 py-2">Tax</th>
                                <th class="px-2 py-2">Amount</th>
                                <th class="px-2 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $rowIndex = 0; @endphp
                            @foreach($items as $choice)
                                @php
                                    // for option tags later
                                @endphp
                            @endforeach

                            @forelse($saleInvoice->items as $pivotItem)
                                @php
                                    $i = $rowIndex++;
                                    $choiceOptions = '';
                                @endphp
                                <tr class="item-row">
                                    <td class="px-1 py-1">
                                        <select name="items[{{ $i }}][add_item_id]" class="form-select item-select select2">
                                            <option value="">-- Select Item --</option>
                                            @foreach($items as $it)
                                                <option 
                                                    value="{{ $it->id }}"
                                                    data-sale-price="{{ $it->sale_price ?? $it->purchase_price ?? 0 }}"
                                                    data-purchase-price="{{ $it->purchase_price ?? 0 }}"
                                                    data-unit="{{ $it->select_unit->unit_name ?? '' }}"
                                                    data-hsn="{{ $it->item_hsn ?? '' }}"
                                                    data-code="{{ $it->item_code ?? '' }}"
                                                    data-item-type="{{ $it->item_type ?? 'product' }}"
                                                    @if($it->item_type === 'product')
                                                        data-stock="{{ $it->stock_qty ?? 0 }}"
                                                    @else
                                                        data-stock="0"
                                                    @endif
                                                    {{ (string) $pivotItem->id === (string) $it->id ? 'selected' : '' }}
                                                >
                                                    {{ $it->item_name }} ({{ ucfirst($it->item_type ?? 'Product') }})
                                                    @if($it->item_type === 'product' && $it->stock_qty !== null)
                                                        - Stock: {{ $it->stock_qty }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-1 py-1 description"></td>
                                    <td class="px-1 py-1">
                                        <input type="number" name="items[{{ $i }}][qty]" class="qty w-full border px-2 py-1" min="1" 
                                               value="{{ (float) ($pivotItem->pivot->qty ?? 1) }}">
                                    </td>
                                    <td class="px-1 py-1 unit"></td>
                                    <td class="px-1 py-1">
                                        <input type="number" name="items[{{ $i }}][price]" class="price w-full border px-2 py-1" step="0.01"
                                               value="{{ number_format((float) ($pivotItem->pivot->price ?? $pivotItem->sale_price ?? 0), 2, '.', '') }}">
                                    </td>
                                    <td class="px-1 py-1">
                                        <select name="items[{{ $i }}][discount_type]" class="discount_type w-full select2">
                                            <option value="value" {{ ($pivotItem->pivot->discount_type ?? 'value') === 'value' ? 'selected' : '' }}>Value</option>
                                            <option value="percentage" {{ ($pivotItem->pivot->discount_type ?? '') === 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        </select>
                                        <input type="number" name="items[{{ $i }}][discount]" class="discount w-full mt-1 border px-2 py-1" 
                                               value="{{ (float) ($pivotItem->pivot->discount ?? 0) }}" step="0.01">
                                    </td>
                                    <td class="px-1 py-1">
                                        <select name="items[{{ $i }}][tax_type]" class="tax_type w-full select2">
                                            <option value="without" {{ ($pivotItem->pivot->tax_type ?? 'without') === 'without' ? 'selected' : '' }}>Without Tax</option>
                                            <option value="with" {{ ($pivotItem->pivot->tax_type ?? '') === 'with' ? 'selected' : '' }}>With Tax</option>
                                        </select>
                                        <input type="number" name="items[{{ $i }}][tax]" class="tax_rate w-full mt-1 border px-2 py-1" 
                                               value="{{ number_format((float) ($pivotItem->pivot->tax ?? 0), 2, '.', '') }}" step="0.01" placeholder="Tax %"
                                               style="{{ ($pivotItem->pivot->tax_type ?? 'without') === 'with' ? '' : 'display:none;' }}">
                                    </td>
                                    <td class="px-1 py-1">
                                        <input type="text" name="items[{{ $i }}][amount]" class="amount w-full border px-2 py-1"
                                               value="{{ number_format((float) ($pivotItem->pivot->amount ?? 0), 2, '.', '') }}" readonly>
                                    </td>
                                    <td class="px-1 py-1 text-center">
                                        <button type="button" class="removeRow bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button>
                                    </td>
                                </tr>
                            @empty
                                <!-- Fallback single row if no items (rare) -->
                                <tr class="item-row">
                                    <td class="px-1 py-1">
                                        <select name="items[0][add_item_id]" class="form-select item-select select2">
                                            <option value="">-- Select Item --</option>
                                            @foreach($items as $item)
                                                <option 
                                                    value="{{ $item->id }}"
                                                    data-sale-price="{{ $item->sale_price ?? $item->purchase_price ?? 0 }}"
                                                    data-purchase-price="{{ $item->purchase_price ?? 0 }}"
                                                    data-unit="{{ $item->select_unit->unit_name ?? '' }}"
                                                    data-hsn="{{ $item->item_hsn ?? '' }}"
                                                    data-code="{{ $item->item_code ?? '' }}"
                                                    data-item-type="{{ $item->item_type ?? 'product' }}"
                                                    @if($item->item_type === 'product')
                                                        data-stock="{{ $item->stock_qty ?? 0 }}"
                                                    @else
                                                        data-stock="0"
                                                    @endif
                                                >
                                                    {{ $item->item_name }} ({{ ucfirst($item->item_type ?? 'Product') }})
                                                    @if($item->item_type === 'product' && $item->stock_qty !== null)
                                                        - Stock: {{ $item->stock_qty }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-1 py-1 description"></td>
                                    <td class="px-1 py-1"><input type="number" name="items[0][qty]" class="qty w-full border px-2 py-1" min="1" value="1"></td>
                                    <td class="px-1 py-1 unit"></td>
                                    <td class="px-1 py-1"><input type="number" name="items[0][price]" class="price w-full border px-2 py-1" step="0.01"></td>
                                    <td class="px-1 py-1">
                                        <select name="items[0][discount_type]" class="discount_type w-full select2">
                                            <option value="value">Value</option>
                                            <option value="percentage">Percentage</option>
                                        </select>
                                        <input type="number" name="items[0][discount]" class="discount w-full mt-1 border px-2 py-1" value="0" step="0.01">
                                    </td>
                                    <td class="px-1 py-1">
                                        <select name="items[0][tax_type]" class="tax_type w-full select2">
                                            <option value="without">Without Tax</option>
                                            <option value="with">With Tax</option>
                                        </select>
                                        <input type="number" name="items[0][tax]" class="tax_rate w-full mt-1 border px-2 py-1" value="0" step="0.01" placeholder="Tax %" style="display:none;">
                                    </td>
                                    <td class="px-1 py-1"><input type="text" name="items[0][amount]" class="amount w-full border px-2 py-1" readonly></td>
                                    <td class="px-1 py-1 text-center"><button type="button" class="removeRow bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex space-x-2 mt-4">
                    <button type="button" id="addRow" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Row</button>
                </div>
            </div>

            <!-- Right column: Totals & Composition Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4">
                    <textarea name="notes" rows="3" class="w-full rounded-md border px-3 py-2" placeholder="Notes">{{ old('notes', $saleInvoice->notes) }}</textarea>
                    <textarea name="terms" rows="3" class="w-full rounded-md border px-3 py-2" placeholder="Terms & Conditions">{{ old('terms', $saleInvoice->terms) }}</textarea>
                    
                    <!-- COMPOSITION SUMMARY (collapsed by default) -->
                    <div class="bg-white p-4 rounded-lg border mb-4">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold">Selected Product Composition</h3>
                            <button type="button" id="toggleComp" class="text-sm text-blue-600">Show</button>
                        </div>

                        <div id="compositionContainer" style="display:none;">
                            <div id="compositionPlaceholder" class="text-sm text-gray-600 mt-2">
                                Select a product to see raw materials / services & cost breakdown here.
                            </div>

                            <div id="compositionDetails" style="display:none;">
                                <table class="min-w-full text-sm mb-2">
                                    <thead class="text-left text-xs text-gray-500">
                                        <tr>
                                            <th>Raw Material / Service</th>
                                            <th>Used Qty (for invoice qty)</th>
                                            <th>Sale Price (unit)</th>
                                            <th>Purchase Price (unit)</th>
                                            <th>Item Sale Total</th>
                                            <th>Item Purchase Total</th>
                                            <th>Item Profit/Loss</th>
                                        </tr>
                                    </thead>
                                    <tbody id="compositionRows"></tbody>
                                </table>

                                <div class="flex justify-between">
                                    <div>
                                        <p class="text-xs text-gray-500">Total Purchase Cost:</p>
                                        <p class="font-semibold">₹ <span id="comp_total_purchase">0.00</span></p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Total Sale Value (from composition):</p>
                                        <p class="font-semibold">₹ <span id="comp_total_sale">0.00</span></p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Overall Profit / Loss:</p>
                                        <p id="comp_profit_label" class="font-semibold text-green-600">₹ <span id="comp_profit">0.00</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attachment -->
                    <div class="bg-white p-4 rounded-lg border">
                        <label class="font-semibold block mb-2">Attachment:</label>
                        @php
                            $docUrl = $saleInvoice->getFirstMediaUrl('document');
                            $doc = $saleInvoice->getFirstMedia('document');
                        @endphp
                        @if($docUrl)
                            <div class="mb-2 text-sm">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-gray-600">Existing File:</span>
                                        <a href="{{ $docUrl }}" target="_blank" class="text-blue-600 underline">
                                            {{ $doc?->file_name ?? 'View' }}
                                        </a>
                                    </div>
                                    <span class="text-xs text-gray-400">Uploaded: {{ optional($doc?->created_at)->format('d M Y, h:i A') }}</span>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="attachment" class="w-full border px-3 py-2 rounded-md">
                        <p class="text-xs text-gray-500 mt-1">Uploading a new file will replace the existing one.</p>
                    </div>
                </div>

                <div>
                    <div class="mb-2">
                        <label class="font-semibold">Overall Discount:</label>
                        <input type="number" name="overall_discount" id="overall_discount" class="w-full border px-2 py-1 mt-1"
                               value="{{ number_format((float) old('overall_discount', $saleInvoice->overall_discount ?? 0), 2, '.', '') }}" step="0.01">
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span id="subtotal_display">{{ number_format((float) ($saleInvoice->subtotal ?? 0), 2) }}</span>
                            <input type="hidden" name="subtotal" id="subtotal" value="{{ number_format((float) ($saleInvoice->subtotal ?? 0), 2, '.', '') }}">
                        </div>
                        <div class="flex justify-between">
                            <span>Tax:</span>
                            <span id="tax_display">{{ number_format((float) ($saleInvoice->tax ?? 0), 2) }}</span>
                            <input type="hidden" name="tax" id="tax_input" value="{{ number_format((float) ($saleInvoice->tax ?? 0), 2, '.', '') }}">
                        </div>
                        <div class="flex justify-between">
                            <span>Discount:</span>
                            <span id="discount_display">{{ number_format((float) ($saleInvoice->discount ?? 0), 2) }}</span>
                            <input type="hidden" name="discount" id="discount_input" value="{{ number_format((float) ($saleInvoice->discount ?? 0), 2, '.', '') }}">
                        </div>
                        <div class="flex justify-between border-t pt-2 font-bold">
                            <span>Total:</span>
                            <span id="total_display">{{ number_format((float) ($saleInvoice->total ?? 0), 2) }}</span>
                            <input type="hidden" name="total" id="total_input" value="{{ number_format((float) ($saleInvoice->total ?? 0), 2, '.', '') }}">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" id="saveInvoiceBtn" class="w-full bg-green-600 text-white py-3 rounded-md hover:bg-green-700">
                            UPDATE INVOICE
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal (same markup for future use) -->
<div id="invoiceDetailsModal" class="fixed inset-0 z-50 items-center justify-center hidden">
  <div class="absolute inset-0 bg-black opacity-40"></div>
  <div class="relative bg-white max-w-3xl mx-auto rounded p-6 z-50 overflow-auto" style="max-height:90vh;">
    <button id="closeInvoiceModal" class="mb-4 float-right px-3 py-1 bg-red-500 text-white rounded">Close</button>
    <h3 class="text-xl font-semibold mb-3">Invoice Composition & Profit/Loss</h3>
    <div id="invoiceModalContent">Loading...</div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({ width: '100%' });

    // Composition toggle (Slide default)
    $('#toggleComp').on('click', function(){
        const c = $('#compositionContainer');
        const isHidden = c.is(':hidden');
        c.toggle(isHidden);
        $(this).text(isHidden ? 'Hide' : 'Show');
    });

    // 🔹 Save master options to clone rows dynamically
    const masterItemOptions = $('#itemsTable tbody tr.item-row')
        .first().find('.item-select').html();

    // 🔹 Customer selection → fetch & fill details (same as create)
    $('#customer_id').on('change', function() {
        const customerId = $(this).val();
        if (!customerId) return $('#customerDetailsCard').addClass('hidden');

        $.get("{{ route('admin.saleInvoice.getCustomerDetails', '') }}/" + customerId, function(data) {
            function clean(t) { return $('<div>').html(t).text(); }

            $('#customer_name').text(clean(data.party_name));
            $('#customer_gstin').text(clean(data.gstin));
            $('#customer_phone').text(clean(data.phone_number));
            $('#customer_pan').text(clean(data.pan_number));
            $('#customer_billing_address').text(clean(data.billing_address));
            $('#customer_shipping_address').text(clean(data.shipping_address));
            $('#customer_state').text(clean(data.state));
            $('#customer_city').text(clean(data.city));
            $('#customer_pincode').text(clean(data.pincode));
            $('#customer_email').text(clean(data.email));
            $('#customer_credit_limit').text(clean(data.credit_limit));
            $('#customer_payment_terms').text(clean(data.payment_terms));

            function fmt(balance, type) {
                balance = parseFloat(balance) || 0; type = type || 'Debit';
                const label = type === 'Debit' ? 'Payable' : 'Receivable';
                const arrow = type === 'Debit' ? '↑' : '↓';
                const cls = type === 'Debit' ? 'text-red-600 font-bold' : 'text-green-700 font-bold';
                return { txt: `${balance.toFixed(2)} (${type}) ${label} ${arrow}`, cls };
            }
            const open = fmt(data.opening_balance, data.opening_balance_type);
            $('#opening_balance_type').text(open.txt).removeClass('text-red-600 text-green-700 font-bold').addClass(open.cls);

            const curr = fmt(data.current_balance, data.current_balance_type);
            $('#current_balance_type').text(curr.txt).removeClass('text-red-600 text-green-700 font-bold').addClass(curr.cls);

            $('#current_balance_date').text(data.updated_at || '-');
            $('#invoice_customer_phone').val(clean(data.phone_number));
            $('#invoice_billing_address').val(clean(data.billing_address));
            $('#customerDetailsCard').removeClass('hidden');
        });
    });

    // Trigger once for pre-selected customer (Edit mode)
    if ($('#customer_id').val()) {
        $('#customer_id').trigger('change');
    }

    // 🔹 Cache for product compositions
    let compositionCache = {};

    // 🔹 Render composition (same util)
    function renderComposition(rows, finishedQty, finishedSalePrice) {
        if (!rows || !rows.length) {
            $('#compositionPlaceholder').show();
            $('#compositionDetails').hide();
            return;
        }
        $('#compositionPlaceholder').hide();
        $('#compositionDetails').show();

        const tbody = $('#compositionRows').empty();
        let totalPurchase = 0;
        finishedQty = parseFloat(finishedQty) || 1;
        finishedSalePrice = parseFloat(finishedSalePrice) || 0;

        rows.forEach(r => {
            const usedQty = (parseFloat(r.qty_used ?? r.usedQty) || 0) * (r.usedQty ? 1 : finishedQty);
            const sale = (parseFloat(r.sale_price) || 0) * usedQty;
            const purchase = (parseFloat(r.purchase_price) || 0) * usedQty;
            const diff = sale - purchase;
            totalPurchase += purchase;

            tbody.append(`
                <tr>
                    <td>${r.name}</td>
                    <td>${usedQty}</td>
                    <td>₹ ${parseFloat(r.sale_price).toFixed(2)}</td>
                    <td>₹ ${parseFloat(r.purchase_price).toFixed(2)}</td>
                    <td>₹ ${sale.toFixed(2)}</td>
                    <td>₹ ${purchase.toFixed(2)}</td>
                    <td class="${diff >= 0 ? 'text-green-600' : 'text-red-600'}">₹ ${diff.toFixed(2)}</td>
                </tr>
            `);
        });

        const finishedSaleTotal = finishedQty * finishedSalePrice;
        const profit = finishedSaleTotal - totalPurchase;
        $('#comp_total_purchase').text(totalPurchase.toFixed(2));
        $('#comp_total_sale').text(finishedSaleTotal.toFixed(2));
        $('#comp_profit').text(profit.toFixed(2));
        $('#comp_profit_label')
            .toggleClass('text-green-600', profit >= 0)
            .toggleClass('text-red-600', profit < 0);
    }

    // 🔹 Stock + composition + row calc (same as create)
    $(document).on('change', '.item-select', function() {
        const row = $(this).closest('tr');
        const sel = $(this).find(':selected');

        if (!sel.val()) {
            row.find('.price, .unit, .description').val('').text('');
            return;
        }

        const itemId = sel.val();
        const salePrice = parseFloat(sel.data('sale-price')) || 0;
        const purchasePrice = parseFloat(sel.data('purchase-price')) || 0;
        const unit = sel.data('unit') || '';
        const type = sel.data('item-type') || 'product';
        const hsn = sel.data('hsn') || '';
        const code = sel.data('code') || '';

        // keep existing pivot price if already typed; else fill
        if(!row.find('.price').val()) {
            row.find('.price').val(salePrice.toFixed(2));
        }
        row.find('.unit').text(unit);
        row.find('.description').text(`Type: ${type} | HSN: ${hsn} | Code: ${code}`);
        // don't force tax_type to 'without' because edit must preserve — do nothing

        if (type === 'product') {
            const stockQty = parseFloat(sel.data('stock')) || 0;
            if (stockQty > 0) {
                row.find('.qty')
                    .attr('min', 1)
                    .attr('max', stockQty)
                    .attr('placeholder', `Max: ${stockQty}`)
                    .prop('readonly', false);
            } else {
                row.find('.qty')
                    .attr('min', 0)
                    .removeAttr('max')
                    .attr('placeholder', 'Out of stock')
                    .prop('readonly', true);
                alert(`⚠️ This item is out of stock and cannot be sold.`);
            }
        } else {
            row.find('.qty')
                .removeAttr('max')
                .removeAttr('min')
                .removeAttr('placeholder')
                .prop('readonly', false);
        }

        calculateRow(row);
        calculateTotals();

        if (type === 'product') {
            if (compositionCache[itemId]) {
                renderComposition(compositionCache[itemId], parseFloat(row.find('.qty').val()) || 1, parseFloat(row.find('.price').val()) || salePrice);
            } else {
                $.get("{{ route('admin.saleInvoice.getItemComposition', '') }}/" + itemId, function(resp) {
                    compositionCache[itemId] = resp.composition || [];
                    renderComposition(resp.composition, parseFloat(row.find('.qty').val()) || 1, parseFloat(row.find('.price').val()) || salePrice);
                }).fail(() => renderComposition([], 1, salePrice));
            }
        } else {
            renderComposition([
                { id: itemId, name: sel.text(), qty_used: 1, sale_price: salePrice, purchase_price: purchasePrice }
            ], parseFloat(row.find('.qty').val()) || 1, parseFloat(row.find('.price').val()) || salePrice);
        }
    });

    function calculateRow(row) {
        const qty = parseFloat(row.find('.qty').val()) || 0;
        const price = parseFloat(row.find('.price').val()) || 0;
        const discountVal = parseFloat(row.find('.discount').val()) || 0;
        const discountType = row.find('.discount_type').val();
        const taxRate = parseFloat(row.find('.tax_rate').val()) || 0;
        const taxType = row.find('.tax_type').val();

        let base = qty * price;
        let discAmt = discountType === 'percentage' ? base * (discountVal / 100) : discountVal;
        let afterDisc = base - discAmt;
        let taxAmt = taxType === 'with' ? afterDisc * (taxRate / 100) : 0;
        let final = afterDisc + taxAmt;

        row.find('.amount').val(final.toFixed(2));
        row.data({ base, discAmt, taxAmt });
    }

    function calculateTotals() {
        let subtotal = 0, discountTotal = 0, taxTotal = 0;
        $('#itemsTable tbody tr').each(function() {
            const d = $(this).data();
            subtotal += (d.base || 0) - (d.discAmt || 0);
            discountTotal += d.discAmt || 0;
            taxTotal += d.taxAmt || 0;
        });

        const overallDiscount = parseFloat($('#overall_discount').val()) || 0;
        const total = subtotal + taxTotal - overallDiscount;

        $('#subtotal_display').text(subtotal.toFixed(2));
        $('#tax_display').text(taxTotal.toFixed(2));
        $('#discount_display').text((discountTotal + overallDiscount).toFixed(2));
        $('#total_display').text(total.toFixed(2));

        $('#subtotal').val(subtotal.toFixed(2));
        $('#tax_input').val(taxTotal.toFixed(2));
        $('#discount_input').val((discountTotal + overallDiscount).toFixed(2));
        $('#total_input').val(total.toFixed(2));

        // keep composition collapsed by default; don't auto-open
        // update overall composition numbers in background
        updateOverallComposition();
    }

    $(document).on('input change', '.qty, .price, .discount, .discount_type, .tax_type, .tax_rate, #overall_discount', function() {
        const row = $(this).closest('tr');
        if (row.find('.tax_type').val() === 'with') row.find('.tax_rate').show(); else row.find('.tax_rate').hide().val(0);
        calculateRow(row);
        calculateTotals();
    });

    $('#addRow').click(function() {
        const tbody = $('#itemsTable tbody');
        const count = tbody.find('tr').length;
        const row = $(`
            <tr class="item-row">
                <td><select name="items[${count}][add_item_id]" class="form-select item-select select2">${masterItemOptions}</select></td>
                <td class="description"></td>
                <td><input type="number" name="items[${count}][qty]" class="qty border px-2 py-1 w-full" min="1" value="1"></td>
                <td class="unit"></td>
                <td><input type="number" name="items[${count}][price]" class="price border px-2 py-1 w-full" step="0.01"></td>
                <td>
                    <select name="items[${count}][discount_type]" class="discount_type select2 w-full"><option value="value">Value</option><option value="percentage">Percentage</option></select>
                    <input type="number" name="items[${count}][discount]" class="discount mt-1 border px-2 py-1 w-full" value="0" step="0.01">
                </td>
                <td>
                    <select name="items[${count}][tax_type]" class="tax_type select2 w-full"><option value="without">Without Tax</option><option value="with">With Tax</option></select>
                    <input type="number" name="items[${count}][tax]" class="tax_rate mt-1 border px-2 py-1 w-full" value="0" step="0.01" placeholder="Tax %" style="display:none;">
                </td>
                <td><input type="text" name="items[${count}][amount]" class="amount border px-2 py-1 w-full" readonly></td>
                <td class="text-center"><button type="button" class="removeRow bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Remove</button></td>
            </tr>
        `);
        tbody.append(row);
        row.find('.select2').select2({ width: '100%' });
    });

    $(document).on('click', '.removeRow', function() {
        const tbody = $('#itemsTable tbody');
        if (tbody.find('tr').length > 1) {
            $(this).closest('tr').remove();
            calculateTotals();
        } else {
            alert('At least one row is required.');
        }
    });

    function updateOverallComposition() {
        let rows = [], totalSale = 0, totalPurchase = 0;
        $('#itemsTable tbody tr').each(function() {
            const sel = $(this).find('.item-select :selected');
            if (!sel.val()) return;
            const id = sel.val(), qty = parseFloat($(this).find('.qty').val()) || 1;
            const salePrice = parseFloat($(this).find('.price').val()) || parseFloat(sel.data('sale-price')) || 0;
            const purchasePrice = parseFloat(sel.data('purchase-price')) || 0;
            const type = sel.data('item-type') || 'product';
            totalSale += salePrice * qty;

            if (type === 'product' && compositionCache[id]) {
                compositionCache[id].forEach(c => {
                    const used = (parseFloat(c.qty_used) || 0) * qty;
                    const cost = used * (parseFloat(c.purchase_price) || 0);
                    totalPurchase += cost;
                    rows.push({ ...c, usedQty: used, itemPurchaseTotal: cost, itemSaleTotal: used * c.sale_price });
                });
            } else {
                const cost = purchasePrice * qty;
                totalPurchase += cost;
                rows.push({ id, name: sel.text(), usedQty: qty, sale_price: salePrice, purchase_price: purchasePrice, itemPurchaseTotal: cost, itemSaleTotal: salePrice * qty });
            }
        });
        // keep details hidden unless user opens
        if ($('#compositionContainer').is(':visible')) {
            renderComposition(rows, 1, totalSale - totalPurchase);
        }
    }

    // Sub Cost Center AJAX (same route used in your create)
    $('#main_cost_center_id').on('change', function() {
        const id = $(this).val();
        const subSelect = $('#sub_cost_center_id');
        subSelect.empty().append('<option value="">-- Select Sub Cost Center --</option>');
        if (!id) return;
        $.get("{{ route('admin.purchaseBill.getSubCostCenters', '') }}/" + id, function(data) {
            $.each(data, function(k, v) {
                subSelect.append('<option value="' + k + '">' + v + '</option>');
            });
            // keep previously selected if matches
            const current = "{{ (string) old('sub_cost_center_id', $saleInvoice->sub_cost_center_id) }}";
            if (current) subSelect.val(current).trigger('change');
        });
    });

    // Initialize calculations for all prefilled rows
    $('#itemsTable tbody tr').each(function(){
        // Fire change to set description/unit/stock rules and composition cache fill on first row
        const sel = $(this).find('.item-select');
        sel.trigger('change');

        const row = $(this);
        if (row.find('.tax_type').val() === 'with') row.find('.tax_rate').show();
        calculateRow(row);
    });
    calculateTotals();
});
</script>
@endsection
