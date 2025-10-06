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
        'user_id',
        'qty',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
        'json_data',
        'item_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function items()
    {
        return $this->belongsToMany(AddItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    // In CurrentStock.php
public function party()
{
    return $this->belongsTo(PartyDetail::class, 'party_id');
}
public function serviceItems()
{
    return $this->belongsToMany(AddItem::class)
        ->where('item_type', 'service');
}
public function addItems()
{
    // Many-to-many relationship with pivot table
    return $this->belongsToMany(AddItem::class, 'add_item_current_stock', 'current_stock_id', 'add_item_id');
}

public function productItems()
{
    return $this->belongsToMany(AddItem::class, 'item_id');
    
}

}
