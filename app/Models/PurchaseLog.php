<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseLog extends Model
{
    protected $fillable = [
        'user_id',
        'party_id',
        'main_cost_center_id',
        'sub_cost_center_id',
        'payment_type_id',
        'items',
        'extra_data',
    ];

    protected $casts = [
        'items' => 'array',
        'extra_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function party()
    {
        return $this->belongsTo(PartyDetail::class, 'party_id');
    }
}
