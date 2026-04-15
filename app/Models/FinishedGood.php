<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishedGood extends Model
{
    protected $fillable = [
        'production_id',
        'add_item_template_id',

        'unique_code',
        'buyer_code',
        'title',
        'item_code',      // serial_no
        'item_hsn',
        'unit',
        'quantity',
        'manufacturing_cost',
        'sale_price',
        'profit_per_unit',

        'tax_percent',
        'sale_mode',
        'warehouse_location',

        'batch_no',       // ← NEW: e.g. APR2026-AB3X9
        'notes',          // ← NEW: free-text notes per unit

        'attachment',
    ];

    protected $casts = [
        'quantity'           => 'float',
        'manufacturing_cost' => 'float',
        'sale_price'         => 'float',
        'profit_per_unit'    => 'float',
        'tax_percent'        => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    public function template()
    {
        return $this->belongsTo(AddItem::class, 'add_item_template_id');
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }

    public function currentStocks()
    {
        return $this->hasMany(CurrentStock::class, 'item_id');
    }
}
