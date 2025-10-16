<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySaleInvoiceRequest;
use App\Http\Requests\StoreSaleInvoiceRequest;
use App\Http\Requests\UpdateSaleInvoiceRequest;
use App\Models\AddItem;
use App\Models\CurrentStock;
use App\Models\PartyDetail;
use App\Models\SaleInvoice;
use App\Models\MainCostCenter;
use App\Models\SubCostCenter;
use Gate;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

use App\Models\BankAccount;
use App\Models\TermAndCondition;
use Illuminate\Support\Facades\Auth;

class SaleInvoiceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

public function index()
{
    abort_if(Gate::denies('sale_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = auth()->user();
    $userRole = $user->roles->pluck('title')->first(); // assuming one role per user

    if ($userRole === 'Super Admin') {
        // Super Admin ko saara data dikhe, global scopes ignore karke
        $saleInvoices = SaleInvoice::withoutGlobalScopes()
            ->with([
                'select_customer' => function ($query) {
                    $query->withoutGlobalScopes(); // PartyDetail ko bhi global scope ignore karenge
                },
                'items',
                'created_by',
                'media'
            ])
            ->latest()
            ->get();
    } else {
        // Baaki users ke liye filter lagayein (example: user ke own created entries)
        $saleInvoices = SaleInvoice::with([
                'select_customer',
                'items',
                'created_by',
                'media'
            ])
            ->where('created_by_id', $user->id)
            ->latest()
            ->get();
    }

    return view('admin.saleInvoices.index', compact('saleInvoices'));
}


public function create()
{
    abort_if(Gate::denies('sale_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $userId = Auth::id();

    // 1️⃣ Fetch customers created by the logged-in user
    $select_customers = \App\Models\PartyDetail::where('created_by_id', $userId)->get();

    // 2️⃣ Prepare array for dropdown + JS
    $select_customers_details = $select_customers->map(function ($c) {
        $balance = !is_null($c->current_balance) ? $c->current_balance : ($c->opening_balance ?? 0);
        $balance_type = !is_null($c->current_balance_type) ? $c->current_balance_type : ($c->opening_balance_type ?? 'Debit');
        $balance_date = $c->updated_at ? $c->updated_at->format('d-m-Y') : ($c->created_at->format('d-m-Y') ?? '-');

        if ($balance_type === 'Debit') {
            $icon = '↑';
            $color = 'red';
            $label = 'Payable';
        } else {
            $icon = '↓';
            $color = 'green';
            $label = 'Receivable';
        }

        $balance_text = "<span style='color: $color; font-weight:bold;'>"
            . $balance . " ($balance_date) $balance_type ($label) $icon</span>";

        return [
            'id' => $c->id,
            'name' => $c->party_name . ' - ' . $balance_text,
            'party_name' => $c->party_name,
            'gstin' => $c->gstin,
            'phone' => $c->phone_number,
            'pan' => $c->pan_number,
            'billing_address' => $c->billing_address,
            'shipping_address' => $c->shipping_address,
            'state' => $c->state,
            'city' => $c->city,
            'pincode' => $c->pincode,
            'email' => $c->email,
            'credit_limit' => $c->credit_limit,
            'payment_terms' => $c->payment_terms,
            'opening_balance' => $c->opening_balance,
            'opening_balance_type' => $c->opening_balance_type,
            'current_balance' => $c->current_balance,
            'current_balance_type' => $c->current_balance_type,
            'balance_used' => $balance,
            'balance_type_used' => $balance_type,
        ];
    });

    // 3️⃣ Fetch AddItems created by this user (product + service)
    $items = \App\Models\AddItem::where('created_by_id', $userId)
        ->whereIn('item_type', ['product', 'service'])
        ->select('id', 'item_name', 'sale_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
        ->with('select_unit')
        ->get()
        ->map(function ($item) use ($userId) {
            if ($item->item_type === 'product') {
                $item->stock_qty = \App\Models\CurrentStock::where('created_by_id', $userId)
                    ->where('item_id', $item->id)
                    ->whereIn('product_type', ['finished_goods', 'ready_made'])
                    ->sum('qty');
            } else {
                $item->stock_qty = null;
            }
            return $item;
        });

    // 4️⃣ Supporting dropdowns
    $product_ids = $items->where('item_type', 'product')->pluck('id')->toArray();
    $units = \App\Models\Unit::where('created_by_id', $userId)
        ->pluck('base_unit', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $cost = \App\Models\MainCostCenter::where('created_by_id', $userId)
        ->pluck('cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $sub_cost = \App\Models\SubCostCenter::where('created_by_id', $userId)
        ->pluck('sub_cost_center_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $payment_types = \App\Models\BankAccount::where('created_by_id', $userId)
        ->pluck('account_name', 'id')
        ->prepend(trans('global.pleaseSelect'), '');
    $tax_rates = \App\Models\TaxRate::where('created_by_id', $userId)
        ->select('id', 'name', 'parcentage')
        ->get();

    // 5️⃣ Pass to view
    return view('admin.saleInvoices.create', compact(
        'items',
        'product_ids',
        'payment_types',
        'select_customers',
        'select_customers_details',
        'cost',
        'sub_cost',
        'units',
        'tax_rates'
    ));
}




public function getCustomerDetails($id)
{
    $customer = PartyDetail::find($id);

    if (!$customer) {
        return response()->json(['error' => 'Customer not found'], 404);
    }

    // Get current balance from your current_stocks or relevant table
    $currentBalance = $customer->current_balance ?? null; // replace with actual logic

    return response()->json([
        'party_name' => $customer->party_name,
        'gstin' => $customer->gstin,
        'phone_number' => $customer->phone_number,
        'pan_number' => $customer->pan_number,
        'billing_address' => $customer->billing_address,
        'shipping_address' => $customer->shipping_address,
        'state' => $customer->state,
        'city' => $customer->city,
        'pincode' => $customer->pincode,
        'email' => $customer->email,
        'credit_limit' => $customer->credit_limit_amount ?? 0,
        'payment_terms' => $customer->payment_terms,
        'opening_balance' => $customer->opening_balance,
        'opening_balance_date' => optional($customer->created_at)->format('d-m-Y'),
        'current_balance' => $currentBalance,
        'opening_balance_type' => $customer->opening_balance_type
    ]);
}

    public function getSubCostCenters($mainCostCenterId)
    {
        $subCostCenters = SubCostCenter::where('main_cost_center_id', $mainCostCenterId)
            ->select('id', 'sub_cost_center_name as name')
            ->get();

        return response()->json($subCostCenters);
    }

public function store(Request $request)
{
    $request->validate([
        'select_customer_id' => 'required|exists:party_details,id',
        'po_no' => 'required|string',
        'po_date' => 'required|date',
        'docket_no' => 'nullable|string',
        'billing_address_invoice' => 'nullable|string',
        'items' => 'required|array',
        'items.*.add_item_id' => 'required|exists:add_items,id',
        'items.*.qty' => 'required|numeric|min:1',
        'attachment' => 'nullable|file|max:10240', // max 10MB
    ]);

    // Generate sale invoice number
    $sale_invoice_number = 'ET-' . now()->format('YmdHis') . rand(100, 999);

    // Save invoice
    $invoice = SaleInvoice::create([
        'sale_invoice_number' => $sale_invoice_number,
        'payment_type' => $request->payment_type,
        'select_customer_id' => $request->select_customer_id,
        'po_no' => $request->po_no,
        'docket_no' => $request->docket_no,
        'po_date' => $request->po_date,
        'due_date' => $request->due_date,
        'e_way_bill_no' => $request->e_way_bill_no,
        'phone_number' => $request->customer_phone_invoice,
        'billing_address' => $request->billing_address_invoice,
        'shipping_address' => $request->shipping_address_invoice,
        'notes' => $request->notes,
        'terms' => $request->terms,
        'overall_discount' => $request->overall_discount ?? 0,
        'subtotal' => $request->subtotal ?? 0,
        'tax' => $request->tax ?? 0,
        'discount' => $request->discount ?? 0,
        'total' => $request->total ?? 0,
        'created_by_id' => auth()->id(),
        'json_data' => json_encode($request->all()),
        'status' => 'pending',
        'main_cost_center_id' => $request->main_cost_center_id,
        'sub_cost_center_id' => $request->sub_cost_center_id,
    ]);

    // Attach uploaded file to media table
    if ($request->hasFile('attachment')) {
        $invoice->addMediaFromRequest('attachment')->toMediaCollection('document');
    }

    // Fetch customer
    $customer = \App\Models\PartyDetail::find($request->select_customer_id);

    // --- Calculate balances ---
    $baseBalance = $customer->current_balance ?? $customer->opening_balance ?? 0;
    $baseType = $customer->current_balance_type ?? $customer->opening_balance_type ?? 'Debit';

    $totalSaleAmount = $request->total ?? 0;
    $closingBalance = $baseBalance;
    $closingType = $baseType;

    if ($baseType === 'Debit') {
        $closingBalance -= $totalSaleAmount;
        if ($closingBalance < 0) {
            $closingBalance = abs($closingBalance);
            $closingType = 'Credit';
        } else {
            $closingType = 'Debit';
        }
    } else {
        $closingBalance += $totalSaleAmount;
        $closingType = 'Credit';
    }

    // Update customer's current balance
    $customer->current_balance = $closingBalance;
    $customer->current_balance_type = $closingType;
    $customer->save();

    // --- Save transaction ---
    \App\Models\Transaction::create([
        'sale_invoice_id' => $invoice->id,
        'select_customer_id' => $customer->id,
        'payment_type_id' => $request->payment_type_id ?? null,
        'main_cost_center_id' => $request->main_cost_center_id,
        'sub_cost_center_id' => $request->sub_cost_center_id,
        'sale_amount' => $totalSaleAmount,
        'opening_balance' => $baseBalance,
        'closing_balance' => $closingBalance,
        'transaction_type' => 'sale',
        'transaction_id' => strtoupper('TXN' . rand(1000000000, 9999999999)),
        'created_by_id' => auth()->id(),
        'json_data' => json_encode([
            'request' => $request->all(),
            'invoice' => $invoice->toArray(),
            'customer_before' => [
                'balance' => $baseBalance,
                'type' => $baseType,
            ],
            'customer_after' => [
                'balance' => $closingBalance,
                'type' => $closingType,
            ],
        ]),
    ]);

    // --- Attach items and update stock ---
    foreach ($request->items as $itemData) {
        $item = \App\Models\AddItem::find($itemData['add_item_id']);

        // Attach item to invoice pivot
        $invoice->items()->attach($item->id, [
            'description' => $itemData['description'] ?? null,
            'qty' => $itemData['qty'],
            'unit' => $itemData['unit'] ?? null,
            'price' => $itemData['price'] ?? 0,
            'discount_type' => $itemData['discount_type'] ?? 'value',
            'discount' => $itemData['discount'] ?? 0,
            'tax_type' => $itemData['tax_type'] ?? 'without',
            'tax' => $itemData['tax'] ?? 0,
            'amount' => $itemData['amount'] ?? 0,
            'created_by_id' => auth()->id(),
            'json_data' => json_encode($itemData),
        ]);

        if ($item->item_type === 'product') {
            $stock = \App\Models\CurrentStock::where('item_id', $item->id)->first();
            if ($stock) {
                $previousQty = $stock->qty;
                $previousAmount = $previousQty * $itemData['price'];

                $stock->qty -= $itemData['qty'];
                $stock->save();

                \App\Models\SaleLog::create([
                    'sale_invoice_id' => $invoice->id,
                    'item_id' => $item->id,
                    'item_type' => 'product',
                    'stock_id' => $stock->id,
                    'previous_qty' => $previousQty,
                    'sold_qty' => $itemData['qty'],
                    'previous_amount' => $previousAmount,
                    'sold_amount' => $itemData['amount'] ?? 0,
                    'price' => $itemData['price'],
                    'sold_to_user_id' => $request->select_customer_id,
                    'created_by_id' => auth()->id(),
                    'json_data_add_item_sale_invoice' => json_encode($itemData),
                    'json_data_current_stock' => json_encode($stock),
                    'json_data_sale_invoice' => json_encode($invoice),
                ]);
            }
        } else {
            \App\Models\SaleLog::create([
                'sale_invoice_id' => $invoice->id,
                'item_id' => $item->id,
                'item_type' => 'service',
                'sold_qty' => $itemData['qty'],
                'sold_amount' => $itemData['amount'] ?? 0,
                'price' => $itemData['price'],
                'sold_to_user_id' => $request->select_customer_id,
                'json_data_sale_invoice' => json_encode($invoice),
                'json_data_add_item_sale_invoice' => json_encode($itemData),
            ]);
        }
    }

    return redirect()->route('admin.sale-invoices.index')
                     ->with('success', 'Sale Invoice Created Successfully.');
}





public function edit(SaleInvoice $saleInvoice)
{
    abort_if(Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    // Customers dropdown with balance display
    $select_customers = \App\Models\PartyDetail::select(
            'id', 
            'party_name', 
            'opening_balance', 
            'opening_balance_type', 
            'current_balance', 
            'current_balance_type'
        )
        ->get()
        ->mapWithKeys(function($customer) {
            $balance = $customer->current_balance ?? $customer->opening_balance;
            $type = $customer->current_balance_type ?? $customer->opening_balance_type;
            $balanceFormatted = number_format($balance, 2);

            if ($type === 'Debit') {
                $display = "₹{$balanceFormatted} Dr - Payable ↑";
            } else {
                $display = "₹{$balanceFormatted} Cr - Receivable ↓";
            }

            return [$customer->id => "{$customer->party_name} ({$display})"];
        });

    // Fetch all items with stock qty
    $items = AddItem::whereIn('item_type', ['product', 'service'])
        ->select('id', 'item_name', 'sale_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
        ->with('select_unit')
        ->get()
        ->map(function ($item) {
            $item->stock_qty = $item->item_type === 'product'
                ? CurrentStock::where('item_id', $item->id)->sum('qty')
                : null;
            return $item;
        });

    // Cost centers
    $cost = MainCostCenter::pluck('cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');
    $sub_cost = SubCostCenter::pluck('sub_cost_center_name', 'id')->prepend(trans('global.pleaseSelect'), '');

    // Load invoice relations
    $saleInvoice->load('select_customer', 'items');

    return view('admin.saleInvoices.edit', compact('saleInvoice', 'items', 'select_customers', 'cost', 'sub_cost'));
}

public function update(Request $request, SaleInvoice $saleInvoice)
{
    abort_if(Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $request->validate([
        'select_customer_id' => 'required|exists:party_details,id',
        'po_no' => 'required|string',
        'po_date' => 'required|date',
        'docket_no' => 'nullable|string',
        'billing_address_invoice' => 'nullable|string',
        'items' => 'required|array',
        'items.*.add_item_id' => 'required|exists:add_items,id',
        'items.*.qty' => 'required|numeric|min:1',
        'attachment' => 'nullable|file|max:10240', // max 10MB
    ]);

    // Handle attachment
    if ($request->hasFile('attachment')) {
        $saleInvoice->clearMediaCollection('document'); // remove old attachment
        $saleInvoice->addMediaFromRequest('attachment')->toMediaCollection('document');
    }

    // Update invoice details
    $saleInvoice->update([
        'payment_type' => $request->payment_type,
        'select_customer_id' => $request->select_customer_id,
        'po_no' => $request->po_no,
        'docket_no' => $request->docket_no,
        'po_date' => $request->po_date,
        'due_date' => $request->due_date,
        'e_way_bill_no' => $request->e_way_bill_no,
        'phone_number' => $request->customer_phone_invoice,
        'billing_address' => $request->billing_address_invoice,
        'shipping_address' => $request->shipping_address_invoice,
        'notes' => $request->notes,
        'terms' => $request->terms,
        'overall_discount' => $request->overall_discount ?? 0,
        'subtotal' => $request->subtotal ?? 0,
        'tax' => $request->tax ?? 0,
        'discount' => $request->discount ?? 0,
        'total' => $request->total ?? 0,
        'json_data' => json_encode($request->all()),
    ]);

    // --- Detach old items ---
    $saleInvoice->items()->detach();

    // Fetch customer
    $customer = \App\Models\PartyDetail::find($request->select_customer_id);

    // --- Recalculate customer balances ---
    $baseBalance = $customer->current_balance ?? $customer->opening_balance ?? 0;
    $baseType = $customer->current_balance_type ?? $customer->opening_balance_type ?? 'Debit';

    $totalSaleAmount = $request->total ?? 0;
    $closingBalance = $baseBalance;
    $closingType = $baseType;

    if ($baseType === 'Debit') {
        $closingBalance -= $totalSaleAmount;
        if ($closingBalance < 0) {
            $closingBalance = abs($closingBalance);
            $closingType = 'Credit';
        } else {
            $closingType = 'Debit';
        }
    } else {
        $closingBalance += $totalSaleAmount;
        $closingType = 'Credit';
    }

    // Update customer's current balance
    $customer->current_balance = $closingBalance;
    $customer->current_balance_type = $closingType;
    $customer->save();

    // --- Update Transaction ---
    $transaction = \App\Models\Transaction::where('sale_invoice_id', $saleInvoice->id)->first();

    if ($transaction) {
        $transaction->update([
            'select_customer_id' => $customer->id,
            'payment_type_id' => $request->payment_type_id ?? $transaction->payment_type_id,
            'main_cost_center_id' => $request->main_cost_center_id,
            'sub_cost_center_id' => $request->sub_cost_center_id,
            'sale_amount' => $totalSaleAmount,
            'opening_balance' => $baseBalance,
            'closing_balance' => $closingBalance,
            'json_data' => json_encode([
                'request' => $request->all(),
                'invoice' => $saleInvoice->toArray(),
                'customer_before' => [
                    'balance' => $baseBalance,
                    'type' => $baseType,
                ],
                'customer_after' => [
                    'balance' => $closingBalance,
                    'type' => $closingType,
                ],
            ]),
        ]);
    } else {
        \App\Models\Transaction::create([
            'sale_invoice_id' => $saleInvoice->id,
            'select_customer_id' => $customer->id,
            'payment_type_id' => $request->payment_type_id ?? null,
            'main_cost_center_id' => $request->main_cost_center_id,
            'sub_cost_center_id' => $request->sub_cost_center_id,
            'sale_amount' => $totalSaleAmount,
            'opening_balance' => $baseBalance,
            'closing_balance' => $closingBalance,
            'transaction_type' => 'sale',
            'transaction_id' => strtoupper('TXN' . rand(1000000000, 9999999999)),
            'created_by_id' => auth()->id(),
            'json_data' => json_encode([
                'request' => $request->all(),
                'invoice' => $saleInvoice->toArray(),
                'customer_before' => [
                    'balance' => $baseBalance,
                    'type' => $baseType,
                ],
                'customer_after' => [
                    'balance' => $closingBalance,
                    'type' => $closingType,
                ],
            ]),
        ]);
    }

    // --- Attach new items and update stock ---
    foreach ($request->items as $itemData) {
        $item = \App\Models\AddItem::find($itemData['add_item_id']);

        // Attach item to invoice pivot
        $saleInvoice->items()->attach($item->id, [
            'description' => $itemData['description'] ?? null,
            'qty' => $itemData['qty'],
            'unit' => $itemData['unit'] ?? null,
            'price' => $itemData['price'] ?? 0,
            'discount_type' => $itemData['discount_type'] ?? 'value',
            'discount' => $itemData['discount'] ?? 0,
            'tax_type' => $itemData['tax_type'] ?? 'without',
            'tax' => $itemData['tax'] ?? 0,
            'amount' => $itemData['amount'] ?? 0,
            'created_by_id' => auth()->id(),
            'json_data' => json_encode($itemData),
        ]);

        if ($item->item_type === 'product') {
            $stock = \App\Models\CurrentStock::where('item_id', $item->id)->first();
            if ($stock) {
                $previousQty = $stock->qty;
                $previousAmount = $previousQty * $itemData['price'];

                $stock->qty -= $itemData['qty'];
                $stock->save();

                \App\Models\SaleLog::create([
                    'sale_invoice_id' => $saleInvoice->id,
                    'item_id' => $item->id,
                    'item_type' => 'product',
                    'stock_id' => $stock->id,
                    'previous_qty' => $previousQty,
                    'sold_qty' => $itemData['qty'],
                    'previous_amount' => $previousAmount,
                    'sold_amount' => $itemData['amount'] ?? 0,
                    'price' => $itemData['price'],
                    'sold_to_user_id' => $request->select_customer_id,
                    'created_by_id' => auth()->id(),
                    'json_data_add_item_sale_invoice' => json_encode($itemData),
                    'json_data_current_stock' => json_encode($stock),
                    'json_data_sale_invoice' => json_encode($saleInvoice),
                ]);
            }
        } else {
            \App\Models\SaleLog::create([
                'sale_invoice_id' => $saleInvoice->id,
                'item_id' => $item->id,
                'item_type' => 'service',
                'sold_qty' => $itemData['qty'],
                'sold_amount' => $itemData['amount'] ?? 0,
                'price' => $itemData['price'],
                'sold_to_user_id' => $request->select_customer_id,
                'json_data_sale_invoice' => json_encode($saleInvoice),
                'json_data_add_item_sale_invoice' => json_encode($itemData),
            ]);
        }
    }

    return redirect()->route('admin.sale-invoices.index')
                     ->with('success', 'Sale Invoice Updated Successfully.');
}


    public function show(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleInvoice->load('select_customer', 'items', 'created_by', 'media');

        return view('admin.saleInvoices.show', compact('saleInvoice'));
    }

    public function destroy(SaleInvoice $saleInvoice)
    {
        abort_if(Gate::denies('sale_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $saleInvoice->delete();

        return back()->with('success', 'Sale Invoice deleted successfully!');
    }

    public function massDestroy(MassDestroySaleInvoiceRequest $request)
    {
        SaleInvoice::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('sale_invoice_create') && Gate::denies('sale_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new SaleInvoice();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

     public function pdf(SaleInvoice $saleInvoice)
    {
        // Bank details for PDF
        $bankDetails = BankAccount::all();

        // Only active terms
        $terms = TermAndCondition::where('status', 'active')->get();

        // Load relationships
        $saleInvoice->load(
            'select_customer', 
            'items', 
            'created_by'
        );

        // Return PDF view
        return view('admin.saleInvoices.pdf', compact('saleInvoice', 'bankDetails', 'terms'));
    }
}
