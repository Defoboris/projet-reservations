<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'designation',
        'address',
        'locality_id',
        'website',
        'phone',
    ];

    /**
     * Get the locality that the location belongs to.
     */
    public function locality()
    {
        return $this->belongsTo(Locality::class)->withDefault();
    }
}
