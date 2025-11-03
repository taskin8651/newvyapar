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
use Illuminate\Support\Facades\DB;

class SaleInvoiceController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

public function index()
{
    abort_if(Gate::denies('sale_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = auth()->user();
    $userRole = $user->roles->pluck('title')->first();

    if ($userRole === 'Super Admin') {
        $saleInvoices = SaleInvoice::withoutGlobalScopes()
            ->with([
                'select_customer' => function ($query) {
                    $query->withoutGlobalScopes();
                },
                'items',
                'created_by',
                'media'
            ])
            ->latest()
            ->paginate(10); // ✅ use paginate instead of get()
    } else {
        $saleInvoices = SaleInvoice::with([
                'select_customer',
                'items',
                'created_by',
                'media'
            ])
            ->where('created_by_id', $user->id)
            ->latest()
            ->paginate(10); // ✅
    }

    return view('admin.saleInvoices.index', compact('saleInvoices'));
}


public function confirmManufacture(SaleInvoice $saleInvoice)
{
    // 🔹 Deduct stock quantities for each item
    foreach ($saleInvoice->items as $item) {
        $qty = $item->pivot->qty ?? 0;

        if ($qty > 0 && $item->stock) {
            // Decrement available quantity safely
            $item->stock->decrement('quantity_available', $qty);
        }
    }

    // 🔹 Calculate profit/loss values safely
    $totalPurchase = round($saleInvoice->total_purchase_value ?? 0, 2);
    $totalSale = round($saleInvoice->total_sale_value ?? 0, 2);
    $profitLossAmount = round($totalSale - $totalPurchase, 2);
    $isProfit = $profitLossAmount >= 0;

    // 🔹 Prepare clean item composition JSON
    $compositionData = $saleInvoice->items->map(function ($item) {
        return [
            'product_id' => $item->id,
            'product_name' => $item->name ?? null,
            'qty' => $item->pivot->qty ?? 0,
            'sale_price' => $item->pivot->price ?? 0,
            'purchase_price' => $item->pivot->purchase_price ?? 0,
            'total' => ($item->pivot->qty ?? 0) * ($item->pivot->price ?? 0),
        ];
    })->toArray();

    // 🔹 Store or update profit/loss record
    DB::table('sale_profit_losses')->updateOrInsert(
        ['sale_invoice_id' => $saleInvoice->id],
        [
            'select_customer_id' => $saleInvoice->select_customer_id,
            'main_cost_center_id' => $saleInvoice->main_cost_center_id,
            'sub_cost_center_id' => $saleInvoice->sub_cost_center_id,
            'total_purchase_value' => $totalPurchase,
            'total_sale_value' => $totalSale,
            'profit_loss_amount' => abs($profitLossAmount),
            'is_profit' => $isProfit,
            'composition_json' => json_encode($compositionData),
            'created_by_id' => auth()->id(),
            'updated_at' => now(),
            'created_at' => now(),
        ]
    );

    return back()->with('success', '✅ Manufacture confirmed, stock updated, and profit/loss recorded.');
}

public function create()
{
    abort_if(Gate::denies('sale_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $userId = Auth::id();
    // Customers dropdown
$userId = auth()->id(); // Logged-in user ID

$select_customers = \App\Models\PartyDetail::select(
        'id', 
        'party_name', 
        'opening_balance', 
        'opening_balance_type', 
        'current_balance', 
        'current_balance_type'
    )
    ->where('created_by_id', $userId) // Filter by creator
    ->get()
    ->mapWithKeys(function($customer) {
        // Use current_balance if exists, else opening_balance
        $balance = $customer->current_balance !== null ? $customer->current_balance : $customer->opening_balance;
        $type = $customer->current_balance_type ?? $customer->opening_balance_type;

        $balanceFormatted = number_format($balance, 2);

        // Add arrow HTML and color class
        if ($type === 'Debit') {
            $display = "₹{$balanceFormatted} Dr - Payable ↑";
        } else {
            $display = "₹{$balanceFormatted} Cr - Receivable ↓";
        }

        return [$customer->id => "{$customer->party_name} ({$display})"];
    });


        $items = AddItem::where('created_by_id', $userId)
        ->whereIn('item_type', ['product', 'service'])
        ->select('id', 'item_name', 'purchase_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
        ->with('select_unit')
        ->get()
        ->map(function ($item) use ($userId) {
            // Only calculate stock for products linked to finished_goods or ready_made
            $item->stock_qty = ($item->item_type === 'product')
                ? CurrentStock::where('created_by_id', $userId)
                    ->where('item_id', $item->id)
                    ->whereIn('product_type', ['finished_goods', 'ready_made'])
                    ->sum('qty')
                : null;
            return $item;
        });


    // Cost centers
$cost = \App\Models\MainCostCenter::where('created_by_id', $userId)
    ->pluck('cost_center_name', 'id')
    ->prepend(trans('global.pleaseSelect'), '');

// Fetch Sub Cost Centers created by this user
$sub_cost = \App\Models\SubCostCenter::where('created_by_id', $userId)
    ->pluck('sub_cost_center_name', 'id')
    ->prepend(trans('global.pleaseSelect'), '');
    return view('admin.saleInvoices.create', compact('items', 'select_customers', 'cost', 'sub_cost'));
}


// use DB; at top

public function getItemComposition($itemId)
{
    // Return composition rows: id, name, qty_used, sale_price, purchase_price
    $rows = DB::table('finished_goods_raw_material')
        ->where('item_id', $itemId)
        ->select(
            'select_raw_material_id as id',
            'qty as qty_used',
            'sale_price_at_time as sale_price',
            'purchase_price_at_time as purchase_price',
            'item_name as name'
        )->get()->map(function($r){
            return [
                'id' => $r->id,
                'name' => $r->name ?? (\App\Models\AddItem::find($r->id)->item_name ?? 'Unnamed'),
                'qty_used' => (float)$r->qty_used,
                'sale_price' => (float)$r->sale_price,
                'purchase_price' => (float)$r->purchase_price,
            ];
        });

    return response()->json(['composition' => $rows]);
}
public function profitDetails($invoiceId)
{
    $record = DB::table('sale_profit_losses')->where('sale_invoice_id', $invoiceId)->first();
    if (!$record) {
        return response()->json(['error' => 'Not found'], 404);
    }
    $invoice = SaleInvoice::find($invoiceId);
    $customer = \App\Models\PartyDetail::find($record->select_customer_id);

    return response()->json([
        'invoice' => $invoice,
        'customer_name' => $customer->party_name ?? '',
        'total_purchase_value' => $record->total_purchase_value,
        'total_sale_value' => $record->total_sale_value,
        'profit_loss_amount' => $record->profit_loss_amount,
        'is_profit' => (bool)$record->is_profit,
        'composition' => json_decode($record->composition_json, true) ?? [],
    ]);
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

    // Generate unique sale invoice number
    $sale_invoice_number = 'ET-' . now()->format('YmdHis') . rand(100, 999);

    // Save invoice
    $invoice = \App\Models\SaleInvoice::create([
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

    // Save attachment
    if ($request->hasFile('attachment')) {
        $invoice->addMediaFromRequest('attachment')->toMediaCollection('document');
    }

    // Get customer
    $customer = \App\Models\PartyDetail::find($request->select_customer_id);

    // ---- Balance Update ----
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

    $customer->current_balance = $closingBalance;
    $customer->current_balance_type = $closingType;
    $customer->save();

    // ---- Transaction ----
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

    // ---- Composition Profit/Loss Setup ----
    $invoice_total_purchase_cost = 0;
    $invoice_total_sale_from_composition = 0;
    $composition_master = [];

    // ---- Loop through each item ----
    foreach ($request->items as $itemData) {
        $item = \App\Models\AddItem::find($itemData['add_item_id']);

        // attach item
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

        // ---- If product: handle composition ----
        if ($item->item_type === 'product') {
            $compositionRows = DB::table('finished_goods_raw_material')
                ->where('item_id', $item->id)
                ->get();

            foreach ($compositionRows as $c) {
                $qtyPerFinished = (float) $c->qty;
                $salePriceAtTime = (float) ($c->sale_price_at_time ?? 0);
                $purchasePriceAtTime = (float) ($c->purchase_price_at_time ?? 0);

                $usedTotalQty = $qtyPerFinished * (float)$itemData['qty'];

                $lineSaleValue = $usedTotalQty * $salePriceAtTime;
                $linePurchaseValue = $usedTotalQty * $purchasePriceAtTime;

                $invoice_total_sale_from_composition += $lineSaleValue;
                $invoice_total_purchase_cost += $linePurchaseValue;

                // ✅ Deduct raw material stock
                $rawStock = \App\Models\CurrentStock::where('item_id', $c->select_raw_material_id)->first();
                if ($rawStock) {
                    $previousQty = $rawStock->qty;
                    $rawStock->qty = max(0, $rawStock->qty - $usedTotalQty);
                    $rawStock->save();

                    // Raw material usage log
                    \App\Models\SaleLog::create([
                        'sale_invoice_id' => $invoice->id,
                        'item_id' => $c->select_raw_material_id,
                        'item_type' => 'raw_material',
                        'stock_id' => $rawStock->id,
                        'previous_qty' => $previousQty,
                        'sold_qty' => $usedTotalQty,
                        'sold_amount' => 0,
                        'price' => 0,
                        'sold_to_user_id' => $request->select_customer_id,
                        'created_by_id' => auth()->id(),
                        'json_data_add_item_sale_invoice' => json_encode($itemData),
                        'json_data_current_stock' => json_encode($rawStock),
                        'json_data_sale_invoice' => json_encode($invoice),
                    ]);
                }

                // store composition info for reporting
                $composition_master[] = [
                    'finished_item_id' => $item->id,
                    'finished_item_name' => $item->item_name,
                    'raw_material_id' => $c->select_raw_material_id,
                    'raw_material_name' => $c->item_name ?? \App\Models\AddItem::find($c->select_raw_material_id)->item_name ?? 'Unnamed',
                    'qty_used_per_finished' => $qtyPerFinished,
                    'used_total_qty' => $usedTotalQty,
                    'sale_price_at_time' => $salePriceAtTime,
                    'purchase_price_at_time' => $purchasePriceAtTime,
                    'total_sale_value' => $lineSaleValue,
                    'total_purchase_value' => $linePurchaseValue,
                ];
            }

            // ---- Update finished product stock ----
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
        } 
        // ---- If service: simple log ----
        else {
            $qty = (float)$itemData['qty'];
            $sale = ((float)$itemData['price']) * $qty;
            $purchase = ((float)$item->purchase_price ?? 0) * $qty;
            $invoice_total_sale_from_composition += $sale;
            $invoice_total_purchase_cost += $purchase;

            $composition_master[] = [
                'finished_item_id' => $item->id,
                'finished_item_name' => $item->item_name,
                'raw_material_id' => null,
                'raw_material_name' => $item->item_name,
                'qty_used_per_finished' => 1,
                'used_total_qty' => $qty,
                'sale_price_at_time' => (float)$itemData['price'],
                'purchase_price_at_time' => (float)($item->purchase_price ?? 0),
                'total_sale_value' => $sale,
                'total_purchase_value' => $purchase,
            ];

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

    // ---- Compute Profit/Loss ----
    $profit_loss_amount = floatval($invoice->total) - floatval($invoice_total_purchase_cost);
    $is_profit = $profit_loss_amount >= 0;

    DB::table('sale_profit_losses')->insert([
        'sale_invoice_id' => $invoice->id,
        'select_customer_id' => $invoice->select_customer_id,
        'main_cost_center_id' => $invoice->main_cost_center_id,
        'sub_cost_center_id' => $invoice->sub_cost_center_id,
        'total_purchase_value' => $invoice_total_purchase_cost,
        'total_sale_value' => $invoice->total,
        'profit_loss_amount' => $profit_loss_amount,
        'is_profit' => $is_profit ? 1 : 0,
        'composition_json' => json_encode($composition_master),
        'created_by_id' => auth()->id(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

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
