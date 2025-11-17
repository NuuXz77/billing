<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_code',
        'master_user',
        'role',
        'email',
        'full_name',
        'username',
        'password',
        'status',
        'foto_profile',
        'phone',
        'address',
        'district',
        'city',
        'province',
        'pos_code',
        'country',
        'company_name',
        'last_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_active' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // relasi ke transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }
}
