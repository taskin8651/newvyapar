<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BankAccount extends Model implements HasMedia
{
    use SoftDeletes, Auditable, HasFactory, InteractsWithMedia;

    public $table = 'bank_accounts';

    protected $appends = [
        'upi_qr', // ✅ Will return UPI QR URL
    ];

    protected $dates = [
        'as_of_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'account_name',
        'opening_balance',
        'as_of_date',
        'account_number',
        'ifsc_code',
        'bank_name',
        'account_holder_name',
        'upi',
        'print_upi_qr',
        'print_bank_details',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getAsOfDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setAsOfDateAttribute($value)
    {
        $this->attributes['as_of_date'] = $value
            ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d')
            : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /* ✅ UPI QR Accessor: returns only URL string */
    public function getUpiQrAttribute()
    {
        $media = $this->getFirstMedia('upi_qr');
        return $media ? $media->getUrl() : null;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 200, 200);
    }
}
