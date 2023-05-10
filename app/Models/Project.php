<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'sub_name',
        'about',
        'file',
    ];

    protected $translatable = [
        'name',
        'sub_name',
        'about',
        'file',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }

    public function aspects()
    {
        return $this->hasMany(Aspect::class);
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }
}
