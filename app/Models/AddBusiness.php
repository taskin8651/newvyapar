<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AddBusiness extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'add_businesses';

    protected $appends = [
        'logo_upload',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const INDUSTRY_TYPE_SELECT = [
        'Retail'        => 'Retail',
        'Manufacturing' => 'Manufacturing',
        'Services'      => 'Services',
        'Other'         => 'Other',
    ];

    protected $fillable = [
        'company_name',
        'legal_name',
        'business_type',
        'industry_type',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public const BUSINESS_TYPE_SELECT = [
        'Proprietorship' => 'Proprietorship',
        'Partnership'    => 'Partnership',
        'Pvt Ltd'        => 'Pvt Ltd',
        'LLP'            => 'LLP',
        'Other'          => 'Other',
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

    public function getLogoUploadAttribute()
    {
        $files = $this->getMedia('logo_upload');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
