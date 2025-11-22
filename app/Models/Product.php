<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name_product',
        'domain_included',
        'ssh_access',
        'email_feature',
        'database_feature',
        'ssl_included',
        'storage',
        'bandwidth',
        'price_monthly',
        'price_original',
        'discount_percentage',
        'free_months',
        'description',
        'sub_description',
        'features',
        'status',
    ];

    protected $casts = [
        'domain_included' => 'boolean',
        'ssh_access' => 'boolean',
        'email_feature' => 'boolean',
        'database_feature' => 'boolean',
        'ssl_included' => 'boolean',
        'status' => 'boolean',
        'price_monthly' => 'decimal:2',
        'price_original' => 'decimal:2',
        'discount_percentage' => 'integer',
        'free_months' => 'integer',
    ];

    /**
     * Scope untuk produk yang public/aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Format price dengan Rupiah
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price_monthly, 0, ',', '.');
    }

    /**
     * Get storage dengan unit
     */
    public function getStorageWithUnitAttribute()
    {
        return $this->storage . ' GB';
    }
}
