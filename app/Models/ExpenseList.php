<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseList extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

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
        'category_id',
        'amount',
        'description',
        'payment_id',
        'tax_include',
        'notes',
        'main_cost_center_id',
        'sub_cost_center_id',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /* ---------------- Relations ---------------- */

    // ✅ Expense Category
    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    // ✅ Payment (Bank / Cash)
    public function payment()
    {
        return $this->belongsTo(BankAccount::class, 'payment_id');
    }

    // ✅ Created By
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /* ---------------- Accessors ---------------- */

    public function getEntryDateAttribute($value)
    {
        return $value
            ? Carbon::parse($value)->format(config('panel.date_format'))
            : null;
    }

    public function setEntryDateAttribute($value)
    {
        $this->attributes['entry_date'] =
            $value
                ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d')
                : null;
    }
}
