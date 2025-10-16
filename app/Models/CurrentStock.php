<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrentStock extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'current_stocks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',          // Stock owner
        'created_by_id',    // Who created this record
        'item_id',          // Reference to AddItem
        'qty',              // Quantity in stock
        'type',             // e.g., "Opening Stock", "Manufactured Stock"
        'product_type',     // raw_material / finished_goods / single / ready_made
        'json_data',        // Backup of request data
        'party_id',         // Optional: party reference
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Serialize dates to standard format
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Stock belongs to a single AddItem
     */
    public function addItem()
    {
        return $this->belongsTo(AddItem::class, 'item_id', 'id');
    }

    /**
     * Stock created by this user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Stock record created by
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * Optional: Stock associated with a party
     */
    public function party()
    {
        return $this->belongsTo(PartyDetail::class, 'party_id');
    }

    /**
     * Many-to-many relationship with AddItem (pivot table if needed)
     * Example: finished goods using raw materials
     */
    public function addItems()
    {
        return $this->belongsToMany(AddItem::class, 'add_item_current_stock', 'current_stock_id', 'add_item_id');
    }

    /**
     * Optional: Only service items from this stock
     */
    public function serviceItems()
    {
        return $this->addItems()->where('item_type', 'service');
    }

    /**
     * Helper: Fetch product items (optional)
     */
    public function productItems()
    {
        return $this->addItems()->where('item_type', 'product');
    }
}
