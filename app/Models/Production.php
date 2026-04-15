<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $fillable = [
        'reference_no',
        'add_item_template_id',

        'finished_good_id',
        'product_name',

        'finished_qty',
        'sale_price',
        'sale_mode',
        'finished_tax_percent',

        'total_raw_cost',
        'total_production_cost',

        'input_tax',
        'output_tax',

        'profit',

        'warehouse_location',
        'batch_no',

        'party_id',       // ← NEW: linked party
        'created_by_id',
    ];

    protected $casts = [
        'finished_qty'           => 'float',
        'sale_price'             => 'float',
        'total_raw_cost'         => 'float',
        'total_production_cost'  => 'float',
        'input_tax'              => 'float',
        'output_tax'             => 'float',
        'profit'                 => 'float',
        'finished_tax_percent'   => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function template()
    {
        return $this->belongsTo(AddItem::class, 'add_item_template_id');
    }

    public function finishedGoods()
    {
        return $this->hasMany(FinishedGood::class, 'production_id');
    }

    public function finishedGood()
    {
        return $this->belongsTo(FinishedGood::class);
    }

    public function rawMaterials()
    {
        return $this->hasMany(ProductionRawMaterial::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /** Linked party (buyer/client) */
    public function party()
    {
        return $this->belongsTo(PartyDetail::class, 'party_id');
    }
}
