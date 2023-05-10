<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Benefit extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'project_id',
        'icon',
        'name',
        'number',
    ];

    protected $translatable = [
        'name',
        'number',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
