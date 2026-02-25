<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'commentaire',
        'from_user_id',
        'to_user_id',
        'colocation_id',
    ];
}
