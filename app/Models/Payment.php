<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_code',
        'payment_method',
        'payment_bank',
        'payment_account_name',
        'payment_account_number',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
