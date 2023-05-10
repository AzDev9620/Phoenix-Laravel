<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Aspect extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'project_id',
        'name',
    ];

    protected $translatable = [
        'name',
    ];
}
