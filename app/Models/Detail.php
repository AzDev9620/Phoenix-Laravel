<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Detail extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'apartment_id',
        'name',
        'value',
    ];

    protected $translatable = [
        'name',
        'value',
    ];
}
