<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_bill_id',
        'sale_invoice_id',
        'sale_amount',
        'select_customer_id',
        'payment_type_id',
        'purchase_amount',
        'opening_balance',
        'closing_balance',
        'transaction_type',
        'transaction_id',
        'created_by_id',
        'json_data',
        'main_cost_center_id',
        'sub_cost_center_id',
    ];

    public function customer()
    {
        return $this->belongsTo(\App\Models\PartyDetail::class, 'select_customer_id');
    }

    public function purchaseBill()
    {
        return $this->belongsTo(\App\Models\PurchaseBill::class, 'purchase_bill_id');
    }
}
