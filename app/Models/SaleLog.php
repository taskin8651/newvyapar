<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_invoice_id',
        'item_id',
        'item_type',
        'stock_id',
        'previous_qty',
        'sold_qty',
        'previous_amount',
        'sold_amount',
        'price',
        'sold_to_user_id',
        'created_by_id',
        'json_data_add_item_sale_invoice',  
        'json_data_current_stock',
        'json_data_sale_invoice',
        
    ];

    public function invoice()
    {
        return $this->belongsTo(SaleInvoice::class, 'sale_invoice_id');
    }

    public function item()
    {
        return $this->belongsTo(AddItem::class, 'item_id');
    }
}
