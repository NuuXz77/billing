<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // cek untuk fillable di table transactions
    protected $fillable = [
        'transaction_code',
        'user_id',
        'product_id',
        'payment_id',
        'amount',
        'status',
        'transaction_date',
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // relasi ke products
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    // relasi ke payments
    public function payment()
    {
        return $this->belongsTo(Payments::class, 'payment_id', 'id');
    }
}
