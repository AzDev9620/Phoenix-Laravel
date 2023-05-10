<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panorama extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name',
    ];

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
