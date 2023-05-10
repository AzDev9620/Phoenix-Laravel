<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Apartment extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'project_id',
        'name',
        'title',
        'about',
        'rooms_number'
    ];

    protected $translatable = [
        'name',
        'title',
        'about',
    ];

    public function panoramas()
    {
        return $this->hasMany(Panorama::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
