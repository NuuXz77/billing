<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    // cek untuk fillable di table products
    protected $fillable = [
        'product_code',
        'name_product',
        'domain_included',
        'ssh_access',
        'email_feature',
        'database_feature',
        'ssl_included',
        'storage',
        'price_monthly',
        'description',
        'status',
    ];

    // relasi ke transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'product_id', 'id');
    }
}
