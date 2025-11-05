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
use Illuminate\Support\Facades\Log;

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



public function getProfitLoss(SaleInvoice $saleInvoice)
{
    $profitLoss = DB::table('sale_profit_losses')->where('sale_invoice_id', $saleInvoice->id)->first();

    if (!$profitLoss) {
        return response()->json(['status' => 'error', 'message' => 'Profit/Loss data not found.'], 404);
    }

    return response()->json(['status' => 'success', 'data' => $profitLoss]);
}

public function updateProfitLoss(Request $request, SaleInvoice $saleInvoice)
{
    $validated = $request->validate([
        'total_purchase_value' => 'required|numeric|min:0',
        'total_sale_value' => 'required|numeric|min:0',
    ]);

    $totalPurchase = round($validated['total_purchase_value'], 2);
    $totalSale = round($validated['total_sale_value'], 2);
    $profitLossAmount = round($totalSale - $totalPurchase, 2);
    $isProfit = $profitLossAmount >= 0;

    DB::table('sale_profit_losses')
        ->where('sale_invoice_id', $saleInvoice->id)
        ->update([
            'total_purchase_value' => $totalPurchase,
            'total_sale_value' => $totalSale,
            'profit_loss_amount' => abs($profitLossAmount),
            'is_profit' => $isProfit,
            'updated_at' => now(),
        ]);

    return response()->json(['status' => 'success', 'message' => '✅ Profit/Loss updated successfully.']);
}


public function confirmManufacture($id)
{
    try {
        // 🔹 Fetch Sale Invoice with relationships
        $saleInvoice = SaleInvoice::with([
            'select_customer:id,party_name,state,gstin,phone_number',
            'main_cost_center:id,cost_center_name',
            'sub_cost_center:id,sub_cost_center_name'
        ])->findOrFail($id);

        // 🔹 Fetch all sold items for this invoice
        $saleItems = DB::table('add_item_sale_invoice')
            ->join('add_items', 'add_item_sale_invoice.add_item_id', '=', 'add_items.id')
            ->where('add_item_sale_invoice.sale_invoice_id', $id)
            ->select(
                'add_items.id as item_id',
                'add_items.item_name',
                'add_item_sale_invoice.qty',
                'add_item_sale_invoice.price',
                'add_item_sale_invoice.amount',
                'add_items.purchase_price'
            )
            ->get();

        if ($saleItems->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => '❌ No sale items found for this invoice.'
            ], 404);
        }

        // 🔹 Initialize totals
        $totalSale = 0;
        $totalPurchase = 0;
        $itemDetails = [];

        // 🔹 Loop through each sold product
        foreach ($saleItems as $item) {
            $productTotalSale = $item->amount;
            $productTotalPurchase = $item->purchase_price * $item->qty;

            // 🔹 Add to totals
            $totalSale += $productTotalSale;
            $totalPurchase += $productTotalPurchase;

            // 🔹 Fetch raw materials used in manufacturing this product
            $rawMaterials = DB::table('finished_goods_raw_material')
                ->join('add_items', 'finished_goods_raw_material.select_raw_material_id', '=', 'add_items.id')
                ->where('finished_goods_raw_material.item_id', $item->item_id)
                ->select(
                    'add_items.item_name as raw_material_name',
                    'finished_goods_raw_material.qty',
                    'finished_goods_raw_material.sale_price_at_time',
                    'finished_goods_raw_material.purchase_price_at_time',
                    'finished_goods_raw_material.total_sale_value',
                    'finished_goods_raw_material.total_purchase_value'
                )
                ->get();

            // 🔹 Add raw material totals to overall purchase/sale
            $totalSale += $rawMaterials->sum('total_sale_value');
            $totalPurchase += $rawMaterials->sum('total_purchase_value');

            // 🔹 Structure for frontend
            $itemDetails[] = [
                'product_name' => $item->item_name,
                'qty' => $item->qty,
                'sale_price' => number_format($item->price, 2),
                'purchase_price' => number_format($item->purchase_price, 2),
                'total' => number_format($item->amount, 2),
                'raw_materials' => $rawMaterials->map(function ($r) {
                    return [
                        'raw_material_name' => $r->raw_material_name,
                        'qty' => $r->qty,
                        'sale_price' => number_format($r->sale_price_at_time, 2),
                        'purchase_price' => number_format($r->purchase_price_at_time, 2),
                        'total_sale_value' => number_format($r->total_sale_value, 2),
                        'total_purchase_value' => number_format($r->total_purchase_value, 2),
                    ];
                }),
            ];
        }

        // 🔹 Calculate Profit or Loss
        $profitLossAmount = $totalSale - $totalPurchase;
        $isProfit = $profitLossAmount >= 0;

        // 🔹 Insert or Update sale_profit_losses manually
        $existing = DB::table('sale_profit_losses')->where('sale_invoice_id', $id)->first();

        $data = [
            'sale_invoice_id'      => $id,
            'select_customer_id'   => $saleInvoice->select_customer_id,
            'main_cost_center_id'  => $saleInvoice->main_cost_center_id,
            'sub_cost_center_id'   => $saleInvoice->sub_cost_center_id,
            'total_purchase_value' => $totalPurchase,
            'total_sale_value'     => $totalSale,
            'profit_loss_amount'   => $profitLossAmount,
            'is_profit'            => $isProfit ? 1 : 0,
            'composition_json'     => json_encode($itemDetails),
            'created_by_id'        => auth()->id(),
            'updated_at'           => now(),
        ];

        if ($existing) {
            DB::table('sale_profit_losses')->where('sale_invoice_id', $id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('sale_profit_losses')->insert($data);
        }

        // 🔹 Update Sale Invoice Status
        DB::table('sale_invoices')->where('id', $id)
            ->update(['status' => 'Manufacture Confirmed', 'updated_at' => now()]);

        // 🔹 Prepare Response for frontend
        $responseData = [
            'invoice' => [
                'id' => $saleInvoice->id,
                'docket_no' => $saleInvoice->docket_no ?? '—',
                'billing_date' => $saleInvoice->created_at ? $saleInvoice->created_at->format('d M Y') : '—',
                'select_customer' => [
                    'party_name' => $saleInvoice->select_customer->party_name ?? '—',
                    'state' => $saleInvoice->select_customer->state ?? '—',
                    'gstin' => $saleInvoice->select_customer->gstin ?? '—',
                    'phone_number' => $saleInvoice->select_customer->phone_number ?? '—',
                ],
                'main_cost_center' => [
                    'name' => $saleInvoice->main_cost_center->cost_center_name ?? '—',
                ],
                'sub_cost_center' => [
                    'name' => $saleInvoice->sub_cost_center->sub_cost_center_name ?? '—',
                ],
            ],
            'profit_loss' => [
                'total_purchase_value' => number_format($totalPurchase, 2),
                'total_sale_value' => number_format($totalSale, 2),
                'profit_loss_amount' => number_format(abs($profitLossAmount), 2),
                'is_profit' => $isProfit,
                'composition_json' => $itemDetails,
            ],
        ];

        return response()->json([
            'status' => 'success',
            'message' => '✅ Manufacture confirmed and profit/loss calculated successfully (with raw materials).',
            'data' => $responseData,
        ]);

    } catch (\Exception $e) {
        \Log::error('Error confirming manufacture: ' . $e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => '⚠️ ' . $e->getMessage(),
        ], 500);
    }
}







public function create()
{
    abort_if(Gate::denies('sale_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $user = Auth::user();
    $userId = $user->id;
    $userRole = $user->roles->pluck('title')->first();

    // ✅ Fetch company_id from pivot table (add_business_user)
    $companyId = $user->select_companies()->pluck('add_businesses.id')->first(); 
    // or: $companyId = optional($user->select_companies->first())->id;

    /* ======================================================
       1️⃣ CUSTOMERS DROPDOWN — SAME COMPANY USERS
    ====================================================== */
    if ($userRole === 'Super Admin') {
        $select_customers = \App\Models\PartyDetail::withoutGlobalScopes()->get();
    } elseif ($companyId) {
        $companyUserIds = \DB::table('add_business_user')
            ->where('add_business_id', $companyId)
            ->pluck('user_id')
            ->toArray();

        $select_customers = \App\Models\PartyDetail::whereIn('created_by_id', $companyUserIds)->get();
    } else {
        $select_customers = \App\Models\PartyDetail::where('created_by_id', $userId)->get();
    }

    // Format customer dropdown with balance info
    $select_customers = $select_customers->mapWithKeys(function ($customer) {
        $balance = $customer->current_balance ?? $customer->opening_balance ?? 0;
        $type = $customer->current_balance_type ?? $customer->opening_balance_type ?? 'Debit';
        $balanceFormatted = number_format($balance, 2);
        $display = $type === 'Debit'
            ? "₹{$balanceFormatted} Dr - Payable ↑"
            : "₹{$balanceFormatted} Cr - Receivable ↓";

        return [$customer->id => "{$customer->party_name} ({$display})"];
    });

    /* ======================================================
       2️⃣ ITEMS DROPDOWN — SAME COMPANY USERS
    ====================================================== */
    if ($userRole === 'Super Admin') {
        $items = \App\Models\AddItem::withoutGlobalScopes()
            ->whereIn('item_type', ['product', 'service'])
            ->select('id', 'item_name', 'purchase_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
            ->with('select_unit')
            ->get();
    } elseif ($companyId) {
        $companyUserIds = \DB::table('add_business_user')
            ->where('add_business_id', $companyId)
            ->pluck('user_id')
            ->toArray();

        $items = \App\Models\AddItem::whereIn('created_by_id', $companyUserIds)
            ->whereIn('item_type', ['product', 'service'])
            ->select('id', 'item_name', 'purchase_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
            ->with('select_unit')
            ->get();
    } else {
        $items = \App\Models\AddItem::where('created_by_id', $userId)
            ->whereIn('item_type', ['product', 'service'])
            ->select('id', 'item_name', 'purchase_price', 'select_unit_id', 'item_hsn', 'item_code', 'item_type')
            ->with('select_unit')
            ->get();
    }

    // Attach stock qty (only for products)
    $items->map(function ($item) use ($userRole, $companyId, $userId) {
        if ($item->item_type === 'product') {
            if ($userRole === 'Super Admin') {
                $item->stock_qty = \App\Models\CurrentStock::where('item_id', $item->id)
                    ->whereIn('product_type', ['finished_goods', 'ready_made'])
                    ->sum('qty');
            } elseif ($companyId) {
                $companyUserIds = \DB::table('add_business_user')
                    ->where('add_business_id', $companyId)
                    ->pluck('user_id')
                    ->toArray();

                $item->stock_qty = \App\Models\CurrentStock::whereIn('created_by_id', $companyUserIds)
                    ->where('item_id', $item->id)
                    ->whereIn('product_type', ['finished_goods', 'ready_made'])
                    ->sum('qty');
            } else {
                $item->stock_qty = \App\Models\CurrentStock::where('created_by_id', $userId)
                    ->where('item_id', $item->id)
                    ->whereIn('product_type', ['finished_goods', 'ready_made'])
                    ->sum('qty');
            }
        } else {
            $item->stock_qty = null;
        }
        return $item;
    });

    /* ======================================================
       3️⃣ COST & SUB COST CENTERS — SAME COMPANY USERS
    ====================================================== */
    $fetchDropdown = function ($model, $column) use ($userRole, $userId, $companyId) {
        if ($userRole === 'Super Admin') {
            return $model::withoutGlobalScopes()->pluck($column, 'id')->prepend(trans('global.pleaseSelect'), '');
        } elseif ($companyId) {
            $companyUserIds = \DB::table('add_business_user')
                ->where('add_business_id', $companyId)
                ->pluck('user_id')
                ->toArray();

            return $model::whereIn('created_by_id', $companyUserIds)
                ->pluck($column, 'id')
                ->prepend(trans('global.pleaseSelect'), '');
        } else {
            return $model::where('created_by_id', $userId)
                ->pluck($column, 'id')
                ->prepend(trans('global.pleaseSelect'), '');
        }
    };

    $cost = $fetchDropdown(\App\Models\MainCostCenter::class, 'cost_center_name');
    $sub_cost = $fetchDropdown(\App\Models\SubCostCenter::class, 'sub_cost_center_name');

    /* ======================================================
       4️⃣ RETURN VIEW
    ====================================================== */
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
        'price'              => $request->price ?? 0,
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
    // ✅ Fetch banks where bank details should be printed
    $bankDetails = BankAccount::where('print_bank_details', 1)->get();

    // ✅ Active terms
    $terms = TermAndCondition::where('status', 'active')->get();

    // ✅ Load relations
    $saleInvoice->load([
        'select_customer',
        'items' => function ($query) {
            $query->withPivot([
                'description',
                'qty',
                'unit',
                'price',
                'discount_type',
                'discount',
                'tax_type',
                'tax',
                'amount',
                'created_by_id',
                'json_data',
            ]);
        },
        'created_by',
        'main_cost_center',
        'sub_cost_center',
    ]);

    // ✅ Get company via pivot
    $user = auth()->user();
    $company = $user->select_companies()->first();

    // ✅ Company logo
    $logoUrl = $company?->getFirstMediaUrl('logo_upload') ?? null;

    // ✅ Attach UPI QR for each bank (if `print_upi_qr = 1`)
    foreach ($bankDetails as $bank) {
        if ($bank->print_upi_qr == 1) {

            // ✅ Correct: Get only URL (string), not full media object
            $upiQrMedia = $bank->getFirstMedia('upi_qr'); 

            $bank->upi_qr = $upiQrMedia ? $upiQrMedia->getUrl() : null;

        } else {
            $bank->upi_qr = null;
        }
    }


    // 🔍 Test Output
    // dd($bankDetails->pluck('upi_qr', 'bank_name'));

    return view('admin.saleInvoices.pdf', compact('saleInvoice', 'bankDetails', 'terms', 'company', 'logoUrl'));
}




}
