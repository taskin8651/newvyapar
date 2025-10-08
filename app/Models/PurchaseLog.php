<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_bill_id',
        'party_id',
        'main_cost_center_id',
        'sub_cost_center_id',
        'payment_type_id',
        'json_data',
        'purchase_bill_id',
        'stock_id',
        'previous_qty',
        'purchased_qty',
        'price',
        'purchased_amount',
        'purchased_to_user_id',
        'created_by_id',
        'json_data_purchase_invoice',
        'json_data_current_stock',
        'json_data_add_item_purchase_invoice',
        
    ];

    public function invoice()
    {
        return $this->belongsTo(PurchaseBill::class, 'sale_invoice_id');
    }

    public function item()
    {
        return $this->belongsTo(AddItem::class, 'item_id');
    }

}
