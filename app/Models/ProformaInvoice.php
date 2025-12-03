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

class ProformaInvoice extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    protected $table = 'proforma_invoices';

    protected $dates = [
        'po_date',
        'due_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'image',
        'document',
    ];

    // ----------------------------------------------------------------------
    // FILLABLE FIELDS
    // ----------------------------------------------------------------------
    protected $fillable = [
        'delivery_challan_number',
        'payment_type',
        'select_customer_id',

        'po_no',
        'docket_no',
        'po_date',
        'due_date',
        'e_way_bill_no',

        'phone_number',
        'billing_address',
        'shipping_address',

        'notes',
        'terms',

        // BILL CALC
        'overall_discount',
        'subtotal',
        'tax',
        'discount',
        'total',

        'status',

        // COST CENTERS
        'main_cost_centers_id',
        'sub_cost_centers_id',

        // FOR AUDIT & MISC
        'json_data',
        'created_by_id',
    ];

    // ----------------------------------------------------------------------
    // ACCESSORS + MUTATORS
    // ----------------------------------------------------------------------
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getPoDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setPoDateAttribute($value)
    {
        $this->attributes['po_date'] = $value
            ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d')
            : null;
    }

    // ----------------------------------------------------------------------
    // RELATIONSHIPS
    // ----------------------------------------------------------------------

    public function select_customer()
    {
        return $this->belongsTo(PartyDetail::class, 'select_customer_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function main_cost_center()
    {
        return $this->belongsTo(MainCostCenter::class, 'main_cost_centers_id');
    }

    public function sub_cost_center()
    {
        return $this->belongsTo(SubCostCenter::class, 'sub_cost_centers_id');
    }

    public function items()
    {
        return $this->belongsToMany(AddItem::class)
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
                'json_data',
            ]);
    }

    // ----------------------------------------------------------------------
    // MEDIA
    // ----------------------------------------------------------------------

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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }
}
