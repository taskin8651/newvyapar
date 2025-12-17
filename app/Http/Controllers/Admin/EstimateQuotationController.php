<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\AddItem;
use App\Models\BankAccount;
use App\Models\EstimateQuotation;
use App\Models\PartyDetail;
use App\Models\MainCostCenter;
use App\Models\SubCostCenter;
use App\Models\TermAndCondition;
use App\Traits\CompanyScopeTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class EstimateQuotationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait, CompanyScopeTrait;

    public function index()
    {
        abort_if(Gate::denies('estimate_quotation_access'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        $estimateQuotations = EstimateQuotation::with([
                'select_customer',
                'items',
                'created_by',
                'media'
            ])
            ->whereIn('created_by_id', $allowedUserIds)
            ->latest()
            ->get();

        return view('admin.estimateQuotations.index', compact('estimateQuotations'));
    }

    public function getCustomerDetails($id)
    {
        $allowedUserIds = $this->getCompanyAllowedUserIds();

        $customer = PartyDetail::whereIn('created_by_id', $allowedUserIds)
            ->findOrFail($id);

        return response()->json($customer);
    }

    public function getItemComposition($itemId)
    {
        $allowedUserIds = $this->getCompanyAllowedUserIds();

        $rows = DB::table('finished_goods_raw_material')
            ->where('item_id', $itemId)
            ->get();

        $composition = $rows->map(function ($r) use ($allowedUserIds) {
            $item = AddItem::whereIn('created_by_id', $allowedUserIds)
                ->find($r->select_raw_material_id);

            return [
                'id' => $r->select_raw_material_id,
                'name' => $item->item_name ?? 'Unknown',
                'qty_used' => $r->qty,
                'sale_price' => $item->sale_price ?? 0,
                'purchase_price' => $item->purchase_price ?? 0,
            ];
        });

        return response()->json(['composition' => $composition]);
    }

    public function create()
    {
        abort_if(Gate::denies('estimate_quotation_create'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        $select_customers = PartyDetail::whereIn('created_by_id', $allowedUserIds)
            ->get()
            ->mapWithKeys(function ($c) {
                $balance = $c->current_balance ?? $c->opening_balance ?? 0;
                $type = $c->current_balance_type ?? $c->opening_balance_type ?? 'Debit';
                $label = $type === 'Debit'
                    ? '₹' . number_format($balance, 2) . ' Dr'
                    : '₹' . number_format($balance, 2) . ' Cr';

                return [$c->id => "{$c->party_name} ({$label})"];
            });

        $items = AddItem::whereIn('created_by_id', $allowedUserIds)
            ->whereIn('item_type', ['product', 'service'])
            ->with('select_unit')
            ->get();

        $cost = MainCostCenter::whereIn('created_by_id', $allowedUserIds)
            ->pluck('cost_center_name', 'id')
            ->prepend('Please select', '');

        $sub_cost = SubCostCenter::whereIn('created_by_id', $allowedUserIds)
            ->pluck('sub_cost_center_name', 'id')
            ->prepend('Please select', '');

        return view('admin.estimateQuotations.create', compact(
            'items',
            'select_customers',
            'cost',
            'sub_cost'
        ));
    }

    public function store(Request $request)
    {
        $allowedUserIds = $this->getCompanyAllowedUserIds();

        $request->validate([
            'select_customer_id' => 'required|exists:party_details,id',
            'po_no' => 'required|string',
            'po_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.add_item_id' => 'required|exists:add_items,id',
            'items.*.qty' => 'required|numeric|min:1',
            'main_cost_centers_id' => 'required',
            'sub_cost_centers_id' => 'required',
        ]);

        return DB::transaction(function () use ($request) {

            $estimate = EstimateQuotation::create([
                'estimate_quotations_number' => 'EST-' . now()->format('YmdHis') . rand(100, 999),
                'payment_type' => $request->payment_type,
                'select_customer_id' => $request->select_customer_id,
                'po_no' => $request->po_no,
                'po_date' => $request->po_date,
                'due_date' => $request->due_date,
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
                'main_cost_centers_id' => $request->main_cost_centers_id,
                'sub_cost_centers_id' => $request->sub_cost_centers_id,
            ]);

            foreach ($request->items as $item) {
                $estimate->items()->attach($item['add_item_id'], [
                    'qty' => $item['qty'],
                    'unit' => $item['unit'] ?? '',
                    'price' => $item['price'] ?? 0,
                    'discount' => $item['discount'] ?? 0,
                    'tax' => $item['tax'] ?? 0,
                    'amount' => $item['amount'] ?? 0,
                    'json_data' => json_encode($item),
                    'created_by_id' => auth()->id(),
                ]);
            }

            $estimate->update([
                'download_token' => Str::random(40),
                'token_expires_at' => now()->addHours(24),
            ]);

            return redirect()
                ->route('admin.estimate-quotations.index')
                ->with('success', 'Estimate created successfully.');
        });
    }

    public function edit(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_edit'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        abort_if(!in_array($estimateQuotation->created_by_id, $allowedUserIds), 403);

        $select_customers = PartyDetail::whereIn('created_by_id', $allowedUserIds)
            ->pluck('party_name', 'id');

        $items = AddItem::whereIn('created_by_id', $allowedUserIds)
            ->with('select_unit')
            ->get();

        $cost = MainCostCenter::whereIn('created_by_id', $allowedUserIds)
            ->pluck('cost_center_name', 'id');

        $sub_cost = SubCostCenter::whereIn('created_by_id', $allowedUserIds)
            ->pluck('sub_cost_center_name', 'id');

        $estimateQuotation->load(['select_customer','items','media']);

        return view('admin.estimateQuotations.edit', compact(
            'estimateQuotation',
            'items',
            'select_customers',
            'cost',
            'sub_cost'
        ));
    }

    public function update(Request $request, EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_edit'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        abort_if(!in_array($estimateQuotation->created_by_id, $allowedUserIds), 403);

        return DB::transaction(function () use ($request, $estimateQuotation) {

            $estimateQuotation->update([
                'payment_type' => $request->payment_type,
                'po_no' => $request->po_no,
                'po_date' => $request->po_date,
                'due_date' => $request->due_date,
                'billing_address' => $request->billing_address_invoice,
                'shipping_address' => $request->shipping_address_invoice,
                'notes' => $request->notes,
                'terms' => $request->terms,
                'subtotal' => $request->subtotal ?? 0,
                'tax' => $request->tax ?? 0,
                'discount' => $request->discount ?? 0,
                'total' => $request->total ?? 0,
                'json_data' => json_encode($request->all()),
            ]);

            $estimateQuotation->items()->detach();

            foreach ($request->items as $item) {
                $estimateQuotation->items()->attach($item['add_item_id'], [
                    'qty' => $item['qty'],
                    'price' => $item['price'] ?? 0,
                    'amount' => $item['amount'] ?? 0,
                    'json_data' => json_encode($item),
                    'created_by_id' => auth()->id(),
                ]);
            }

            $estimateQuotation->update([
                'download_token' => Str::random(40),
                'token_expires_at' => now()->addHours(24),
            ]);

            return redirect()
                ->route('admin.estimate-quotations.index')
                ->with('success', 'Estimate updated successfully.');
        });
    }

    public function show(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_show'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        abort_if(!in_array($estimateQuotation->created_by_id, $allowedUserIds), 403);

        $estimateQuotation->load(['select_customer','items','created_by']);

        $bankDetails = BankAccount::whereIn('created_by_id', $allowedUserIds)
            ->where('print_bank_details', 1)
            ->get();

        $terms = TermAndCondition::
            where('status', 'active')
            ->get();

        return view('admin.estimateQuotations.show', compact(
            'estimateQuotation',
            'bankDetails',
            'terms'
        ));
    }

    public function pdf(EstimateQuotation $estimateQuotation)
    {
        $allowedUserIds = $this->getCompanyAllowedUserIds();

        abort_if(!in_array($estimateQuotation->created_by_id, $allowedUserIds), 403);

        $estimateQuotation->load(['select_customer','items','created_by']);

        $company = auth()->user()->select_companies()->first();

        $bankDetails = BankAccount::whereIn('created_by_id', $allowedUserIds)
            ->where('print_bank_details', 1)
            ->get();

        $terms = TermAndCondition::where('status', 'active')
            ->get();

        return view('admin.estimateQuotations.invoice', compact(
            'estimateQuotation',
            'company',
            'bankDetails',
            'terms'
        ));
    }

    public function destroy(EstimateQuotation $estimateQuotation)
    {
        abort_if(Gate::denies('estimate_quotation_delete'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        abort_if(!in_array($estimateQuotation->created_by_id, $allowedUserIds), 403);

        $estimateQuotation->items()->detach();
        $estimateQuotation->delete();

        return back()->with('success', 'Estimate deleted successfully.');
    }

    public function massDestroy(Request $request)
    {
        abort_if(Gate::denies('estimate_quotation_delete'), Response::HTTP_FORBIDDEN);

        $allowedUserIds = $this->getCompanyAllowedUserIds();

        EstimateQuotation::whereIn('id', $request->ids ?? [])
            ->whereIn('created_by_id', $allowedUserIds)
            ->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function cancel(EstimateQuotation $estimateQuotation)
    {
        $allowedUserIds = $this->getCompanyAllowedUserIds();

        abort_if(!in_array($estimateQuotation->created_by_id, $allowedUserIds), 403);

        if ($estimateQuotation->status === 'converted') {
            return back()->with('error', 'Converted estimate cannot be cancelled.');
        }

        $estimateQuotation->update(['status' => 'cancelled']);

        return back()->with('success', 'Estimate cancelled.');
    }

    public function updateDate(Request $request, EstimateQuotation $estimateQuotation)
    {
        $allowedUserIds = $this->getCompanyAllowedUserIds();

        abort_if(!in_array($estimateQuotation->created_by_id, $allowedUserIds), 403);

        $request->validate(['due_date' => 'required|date']);

        $estimateQuotation->update(['due_date' => $request->due_date]);

        return back()->with('success', 'Valid date updated.');
    }
}
