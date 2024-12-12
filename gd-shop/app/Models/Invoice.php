<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'customer_name',
        'phone',
        'address',
        'total_amount',
        'status',
        'payment_type'
    ];
    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id');
    }
}
