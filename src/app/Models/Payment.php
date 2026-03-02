<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
    public function depense()
    {
        return $this->belongsTo(Depense::class);
    }
}
