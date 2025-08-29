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

class PartyDetail extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'party_details';

    public const CREDIT_LIMIT_RADIO = [
        'off' => 'OFF',
        'on'  => 'ON',
    ];

    protected $dates = [
        'as_of_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_OF_SUPPLY_SELECT = [
        'Intra-State' => 'Intra-State',
        'Inter-State' => 'Inter-State',
    ];

    public const OPENING_BALANCE_TYPE_SELECT = [
        'Debit'  => 'Debit (Receivable)',
        'Credit' => 'Credit (Payable)',
    ];

    public const STATUS_SELECT = [
        'enable'     => 'Enable',
        'disable'    => 'Disable',
        'hold'       => 'Hold',
        'black_list' => 'Black List',
    ];

    public const GST_TYPE_SELECT = [
        'Unregistered_Consumer'           => 'Unregistered/Consumer',
        'Registered_Business_Regular'     => 'Registered Business - Regular',
        'Registered_Business_Composition' => 'Registered Business - Composition',
    ];

    protected $fillable = [
        'party_name',
        'gstin',
        'phone_number',
        'pan_number',
        'place_of_supply',
        'type_of_supply',
        'gst_type',
        'pincode',
        'state',
        'city',
        'billing_address',
        'shipping_address',
        'email',
        'opening_balance',
        'as_of_date',
        'opening_balance_type',
        'credit_limit',
        'credit_limit_amount',
        'payment_terms',
        'ifsc_code',
        'account_number',
        'bank_name',
        'branch',
        'notes',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
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

    public function getAsOfDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setAsOfDateAttribute($value)
    {
        $this->attributes['as_of_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
