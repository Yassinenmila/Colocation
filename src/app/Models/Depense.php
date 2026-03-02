<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'description',
        'category_id',
        'user_id',
        'colocation_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
