<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PurchaseBill extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'purchase_bills';

    protected $appends = [
        'image',
        'document',
        'json_data',
    ];

    protected $dates = [
        'po_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $casts = [
    'json_data' => 'array',
    ];


    protected $fillable = [
        'select_customer_id',
        'billing_name',
        'phone_number',
        'e_way_bill_no',
        'billing_address',
        'shipping_address',
        'po_no',
        'po_date',
        'qty',
        'description',
        'created_at',
        'payment_type_id',
        'reference_no',
        'updated_at',
        'deleted_at',
        'created_by_id',
        'main_cost_center_id',
        'sub_cost_center_id',   
        'purchase_bill_no',
        'note',
        'json_data',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function select_customer()
    {
        return $this->belongsTo(PartyDetail::class, 'select_customer_id');
    }

    public function getPoDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPoDateAttribute($value)
    {
        $this->attributes['po_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
    public function getJsonDataAttribute($value)
    {
        return $this->attributes['json_data'] ? json_decode($this->attributes['json_data'], true) : [];
    }


 public function items()
{
    return $this->belongsToMany(AddItem::class, 'add_item_purchase_bill', 'purchase_bill_id', 'add_item_id')
        ->withPivot('qty');
}



    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getDocumentAttribute()
    {
        return $this->getMedia('document')->last();
    }

    public function payment_type()
    {
        return $this->belongsTo(BankAccount::class, 'payment_type_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    public function main_cost_center()
    {
        return $this->belongsTo(MainCostCenter::class, 'main_cost_center_id');
    }
    public function sub_cost_center()
    {
        return $this->belongsTo(SubCostCenter::class, 'sub_cost_center_id');
    }


}
