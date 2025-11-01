<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DateTimeInterface;

class Ledger extends Model
{
    use SoftDeletes, HasFactory, MultiTenantModelTrait, Auditable;

    protected $table = 'ledgers';

    protected $fillable = [
        'ledger_name',
        'opening_balance',
        'expense_category_id',
        'created_by_id',
        'updated_by_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    // 🔗 Relationship with Expense Category
    public function expense_category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    // 🔗 Created by user
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    // 🔗 Updated by user
    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
