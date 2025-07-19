<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistTypeShow extends Model
{
    use HasFactory;

    protected $fillable = [
        'show_id',
        'artist_type_id',
    ];

    /**
     * Get the show associated with this record.
     */
    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    /**
     * Get the artist type associated with this record.
     */
    public function artistType()
    {
        return $this->belongsTo(ArtistType::class);
    }
}
