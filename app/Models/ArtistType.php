<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'artist_id'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
