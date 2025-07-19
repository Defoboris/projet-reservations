<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'poster_url',
        'duration',
        'created_in',
        'locality_id',
        'bookable',
    ];

    public function representations()
    {
        return $this->hasMany(Representation::class);
    }
}
