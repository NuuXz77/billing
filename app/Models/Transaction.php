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
        'status',
        'start_date',
        'end_date',
        'total_payment',
        'subdomain_web',
        'subdomain_server',
        'billing_cycle',
        'payment_proof',
        'admin_notes',
        'confirmed_at',
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
