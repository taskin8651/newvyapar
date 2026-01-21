<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartyDetail;
use App\Models\SaleInvoice;
use Illuminate\Http\Request;

class Gst1Controller extends Controller
{
public function index(Request $request)
{
    $month      = $request->month;
    $partyId    = $request->select_customer_id;
    $showNoGst  = $request->boolean('show_no_gst');

    $query = SaleInvoice::with([
        'select_customer',
        'items.select_tax',
        'items.rawMaterials'
    ]);

    /* ================= MONTH FILTER ================= */
    if ($month) {
        $query->whereMonth('po_date', date('m', strtotime($month)))
              ->whereYear('po_date', date('Y', strtotime($month)));
    }

    /* ================= PARTY FILTER ================= */
    if ($partyId) {
        $query->where('select_customer_id', $partyId);
    }

    /* ================= GST FILTER ================= */
    if (!$showNoGst) {
        $query->where('tax', '>', 0);
    }

    $invoices = $query->orderBy('po_date')->get();

    /* ================= PARTY WISE ================= */
    $partyWise = $invoices->groupBy('select_customer_id');

    $grandTotalGst   = $invoices->sum('tax');
    $grandTotalSales = $invoices->sum('total');

    $parties = PartyDetail::orderBy('party_name')->get();

    $selectedParty = $partyId
        ? PartyDetail::with('created_by')->find($partyId)
        : null;

    /* =====================================================
       ✅ GST PDF DATA (SAFE FOR BLADE)
       ===================================================== */
    $gstInvoices = $invoices->map(function ($i) {
        return [
            'date'    => $i->po_date,
            'invoice' => $i->sale_invoice_number,
            'party'   => optional($i->select_customer)->party_name ?? '-',
            'taxable' => number_format($i->total - $i->tax, 2),
            'gst'     => number_format($i->tax, 2),
            'total'   => number_format($i->total, 2),
        ];
    })->values();

    /* =====================================================
       ✅ AUTH USER NAME + ROLE (CUSTOM ROLE SYSTEM)
       ===================================================== */
    $authUser = auth()->user();

    $authUserData = [
        'name'  => $authUser->name,
        // 👇 role title column use ho raha hai (change to 'name' if needed)
        'roles' => $authUser->roles->pluck('title')->toArray(),
    ];

    return view('admin.gst-1.index', compact(
        'invoices',
        'gstInvoices',
        'partyWise',
        'grandTotalGst',
        'grandTotalSales',
        'month',
        'showNoGst',
        'parties',
        'selectedParty',
        'partyId',
        'authUserData'   // 👈 ADD THIS
    ));
}


}
