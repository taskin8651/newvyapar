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

    // Existing type options
    public const TYPE_SELECT = [
        'Asset'     => 'Asset',
        'Liability' => 'Liability',
    ];

    // 🆕 New constant for Sale / Purchase / Capital field
    public const CATEGORY_TYPE_SELECT = [
        'sale'     => 'Sale',
        'purchase' => 'Purchase',
        'capital'  => 'Capital',
    ];

    protected $fillable = [
        'expense_category',
        'type',
        'category_type', // 🆕 new field added
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
