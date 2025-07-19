<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_date',
        'status',
    ];

    /**
     * The user who made the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * If a reservation belongs to a show or seat,
     * define the relation here when needed.
     * For example:
     */
    public function show()
    {
        return $this->belongsTo(Show::class);
    }
    //  *
    //  * public function seats()
    //  * {
    //  *     return $this->belongsToMany(Seat::class, 'reservation_seats');
    //  * }

}
