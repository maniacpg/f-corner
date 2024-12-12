<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope for filtering by year
    public function scopeForYear($query, $year)
    {
        return $query->whereYear('created_at', $year);
    }
}
