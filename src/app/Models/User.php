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
        'name',
        'email',
        'password',
        'reputation',
        'role',
        'is_banned',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function membreships()
    {
        return $this->hasOne(Membreship::class);
    }

    public function colocation()
    {
        return $this->hasOneThrough(Colocation::class, Membreship::class);
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function paymentsFrom()
    {
        return $this->hasMany(Payment::class, 'from_user_id');
    }

    public function paymentsTo()
    {
        return $this->hasMany(Payment::class, 'to_user_id');
    }
}
