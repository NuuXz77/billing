<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    // cek untuk fillable di table payments
    protected $fillable = [
        'payment_code',
        'payment_method',
        'payment_bank',
        'payment_account_name',
        'payment_account_number',
        'status',
    ];

    // relasi ke transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'payment_id', 'id'); 
    }
}
