<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Colocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'owner_id',
    ];

    public function membreships()
    {
        return $this->hasMany(Membreship::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function categories()
    {
        return $this->hasMany(Categorie::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
