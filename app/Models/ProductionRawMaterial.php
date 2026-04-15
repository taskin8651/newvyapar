<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionRawMaterial extends Model
{
    protected $fillable = [
        'production_id',
        'raw_material_id',   // references add_items.id
        'used_qty',
        'purchase_price',
        'base_cost',
        'tax_percent',
        'tax_amount',
        'total_cost',
        'warehouse_location',
        'batch_no',
        'created_by_id',
    ];

    protected $casts = [
        'used_qty'       => 'float',
        'purchase_price' => 'float',
        'base_cost'      => 'float',
        'tax_percent'    => 'float',
        'tax_amount'     => 'float',
        'total_cost'     => 'float',
    ];

    public function production()
    {
        return $this->belongsTo(Production::class);
    }

    /**
     * The raw material item (references AddItem, not a separate RawMaterial model)
     */
    public function rawMaterial()
    {
        return $this->belongsTo(AddItem::class, 'raw_material_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
