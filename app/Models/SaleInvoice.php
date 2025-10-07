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

class SaleInvoice extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'sale_invoices';

    protected $appends = [
        'image',
        'document',
    ];
    protected $casts = [
        'po_date' => 'date',
        'due_date' => 'date',
    ];
    protected $dates = [
        'po_date',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'select_customer_id',                 // Customer
        'po_no',                    // Invoice/PO Number
        'docket_no',
        'po_date',
        'due_date',
        'e_way_bill_no',
        'phone_number',
        'billing_address',
        'shipping_address',
        'notes',
        'terms',
        'overall_discount',
        'subtotal',
        'tax',
        'discount',
        'total',
        'attachment',               // File path
        'created_by_id',
        'json_data',
        'payment_type',
        'status',
        'sale_invoice_number',
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

    public function items()
    {
        return $this->belongsToMany(\App\Models\AddItem::class, 'add_item_sale_invoice', 'sale_invoice_id', 'add_item_id')
            ->withPivot([
                'description', 
                'qty', 
                'unit', 
                'price', 
                'discount_type', 
                'discount', 
                'tax_type', 
                'tax', 
                'amount',
                'created_by_id',
                'json_data'
            ])->withTimestamps();
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

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
}
