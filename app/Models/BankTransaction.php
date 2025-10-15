<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bank_transactions';

    protected $fillable = [
        'party_id',
        'party_name',
        'opening_balance_type',
        'opening_balance',
        'current_balance',
        'current_balance_type',
        'payment_type_id',
        'amount',
        'created_by_id',
        'updated_by_id',
        'description',
        'json',
        'payment_out_id',
        'payment_in_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // 🔗 Relationships
    public function party()
    {
        return $this->belongsTo(PartyDetail::class, 'party_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(BankAccount::class, 'payment_type_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
    public function paymentOut()
{
    return $this->belongsTo(PaymentOut::class, 'payment_out_id');
}
    public function paymentIn()
{
    return $this->belongsTo(PaymentIn::class, 'payment_in_id');

}
}
