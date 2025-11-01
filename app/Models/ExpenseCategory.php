<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'expense_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // 🆕 Combined options
    public const CATEGORY_TYPE_SELECT = [
        'Asset'     => 'Asset',
        'Liability' => 'Liability',
        'Sale'      => 'Sale',
        'Purchase'  => 'Purchase',
        'Capital'   => 'Capital',
    ];

    protected $fillable = [
        'expense_category',
        'category_type', // now handles all options
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
