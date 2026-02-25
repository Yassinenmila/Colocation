<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'description',
        'date',
        'category_id',
        'user_id',
        'colocation_id',
    ];
}
