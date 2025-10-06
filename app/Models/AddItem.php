<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddItem extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'add_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const ITEM_TYPE_SELECT = [
        'product' => 'Product',
        'service' => 'Service',
    ];

    public const SELECT_TYPE_SELECT = [
        'Without Tax' => 'Without Tax',
        'With Tax'    => 'With Tax',
    ];

    public const SELECT_PURCHASE_TYPE_SELECT = [
        'Without Tax' => 'Without Tax',
        'With Tax'    => 'With Tax',
    ];

    public const SELECT_TYPE_WHOLESALE_SELECT = [
        'Without Tax' => 'Without Tax',
        'With Tax'    => 'With Tax',
    ];

    protected $fillable = [
        'item_type',
        'item_name',
        'item_hsn',
        'select_unit_id',
        'item_code',
        'quantity',
        'sale_price',
        'select_type',
        'disc_on_sale_price',
        'disc_type',
        'wholesale_price',
        'select_type_wholesale',
        'minimum_wholesale_qty',
        'purchase_price',
        'select_purchase_type',
        'select_tax_id',
        'opening_stock',
        'low_stock_warning',
        'warehouse_location',
        'online_store_title',
        'online_store_description',
        'online_store_image',
        'json_data',
        'created_by_id'
    ];

    protected $casts = [
        'json_data' => 'array',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function select_unit()
    {
        return $this->belongsTo(Unit::class, 'select_unit_id');
    }

    public function select_categories()
    {
        return $this->belongsToMany(Category::class, 'add_item_category', 'add_item_id', 'category_id');
    }

    public function select_tax()
    {
        return $this->belongsTo(TaxRate::class, 'select_tax_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function purchaseBills()
{
    return $this->belongsToMany(PurchaseBill::class, 'add_item_purchase_bill', 'add_item_id', 'purchase_bill_id')
        ->withPivot('qty');
}

}
