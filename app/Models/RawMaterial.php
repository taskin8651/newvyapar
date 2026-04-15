<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $fillable = [
        'unique_code',
        'buyer_code',
        'title',
        'item_code',
        'item_hsn',
        'unit',
        'unit_type',
        'quantity',
        'purchase_price',
        'sale_price',
        'with_tax',
        'tax_percent',
        'low_stock_warning',
        'warehouse_location',
    ];

    protected $casts = [
        'with_tax' => 'boolean',
    ];

    public function productions()
    {
        return $this->hasMany(ProductionRawMaterial::class);
    }
}
