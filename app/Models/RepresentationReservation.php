<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentationReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'representation_id',
        'reservation_id',
        'price_id',
        'quantity',
    ];
}
