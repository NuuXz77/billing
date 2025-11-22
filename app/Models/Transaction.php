<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // cek untuk fillable di table transactions
    protected $fillable = [
        'transaction_code',
        'transaction_type',
        'description',
        'user_id',
        'user_transaction_number',
        'product_id',
        'payment_id',
        'status',
        'start_date',
        'end_date',
        'total_payment',
        'payment_method',
        'subdomain_web',
        'subdomain_server',
        'billing_cycle',
        'payment_proof',
        'admin_notes',
        'confirmed_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_payment' => 'decimal:2',
        'confirmed_at' => 'datetime',
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // relasi ke products
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // relasi ke payments
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    /**
     * Boot method untuk auto-generate user_transaction_number
     * Setiap kali transaksi baru dibuat, akan otomatis hitung nomor transaksi user
     */
    protected static function boot()
    {
        parent::boot();

        // Event sebelum create transaction baru
        static::creating(function ($transaction) {
            // Jika user_transaction_number belum diset (NULL atau kosong)
            if (empty($transaction->user_transaction_number)) {
                // Hitung jumlah transaksi user ini + 1
                $lastNumber = self::where('user_id', $transaction->user_id)
                    ->max('user_transaction_number') ?? 0;
                
                $transaction->user_transaction_number = $lastNumber + 1;
            }

            // Generate transaction code jika belum ada
            if (empty($transaction->transaction_code)) {
                $date = now()->format('d-m-Y');
                $transaction->transaction_code = "TRX-{$transaction->user_transaction_number}-{$date}";
            }
        });

        // Event setelah delete transaction
        static::deleted(function ($transaction) {
            // Reset auto increment jika tidak ada transaksi lagi
            $count = self::count();
            
            if ($count === 0) {
                // Kalau sudah kosong, reset ke 1
                \DB::statement('ALTER TABLE transactions AUTO_INCREMENT = 1');
            } else {
                // Kalau masih ada, reset ke ID tertinggi + 1
                $maxId = self::max('id') ?? 0;
                \DB::statement('ALTER TABLE transactions AUTO_INCREMENT = ' . ($maxId + 1));
            }
        });
    }
}
