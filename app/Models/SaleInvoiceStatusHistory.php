<?php

// app/Models/SaleInvoiceStatusHistory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleInvoiceStatusHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_invoice_id',
        'old_status',
        'new_status',
        'remark',
        'changed_by_id',
    ];

    public function invoice() {
        return $this->belongsTo(SaleInvoice::class, 'sale_invoice_id');
    }

    public function changedBy() {
        return $this->belongsTo(User::class, 'changed_by_id');
    }
}
