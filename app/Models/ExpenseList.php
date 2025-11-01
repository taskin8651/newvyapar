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

class ExpenseList extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    protected $table = 'expense_lists';

    public const TAX_INCLUDE_RADIO = [
        'Yes' => 'Yes',
        'No'  => 'No',
    ];

    protected $dates = [
        'entry_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'entry_date',
        'category_id', // refers to ledger
        'amount',
        'description',
        'payment_id', // BankAccount or CashInHand
        'tax_include',
        'notes',
        'main_cost_center_id',
        'sub_cost_center_id',
        'cash_in_hand_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
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

    // 🔹 Entry Date formatting
    public function getEntryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEntryDateAttribute($value)
    {
        $this->attributes['entry_date'] =
            $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    // 🔹 Ledger Relation (Category)
    public function ledger()
    {
        return $this->belongsTo(Ledger::class, 'category_id');
    }

    // 🔹 Bank Account Relation
    public function payment()
    {
        return $this->belongsTo(BankAccount::class, 'payment_id');
    }

    // 🔹 Cash In Hand Relation
    public function cash_in_hand()
    {
        return $this->belongsTo(CashInHand::class, 'cash_in_hand_id');
    }

    // 🔹 Main Cost Center Relation
    public function main_cost_center()
    {
        return $this->belongsTo(MainCostCenter::class, 'main_cost_center_id');
    }

    // 🔹 Sub Cost Center Relation
    public function sub_cost_center()
    {
        return $this->belongsTo(SubCostCenter::class, 'sub_cost_center_id');
    }

    // 🔹 Created By Relation
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    public function category()
{
    return $this->belongsTo(Ledger::class, 'category_id');
}

}
