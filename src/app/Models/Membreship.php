<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membreship extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'colocation_id',
        'role',
        'joined_at',
        'left_at',
    ];

    
}
