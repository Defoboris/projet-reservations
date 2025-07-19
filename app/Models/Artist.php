<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    public function showsAsAuthor()
    {
        return $this->hasMany(Show::class);
    }

    public function showsAsDirector()
    {
        return $this->hasMany(Show::class);
    }

    public function showsAsActor()
    {
        return $this->belongsToMany(Show::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }
}
