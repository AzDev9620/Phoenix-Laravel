<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::post('contacts', [ContactController::class, 'store']);
Route::get('locales', [ApiController::class, 'locales']);

Route::group([
    'prefix' => '{locale?}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'apilocale'
], function () {
    Route::get('projects', [ApiController::class, 'projects_index'])->name('project-index');
    Route::get('projects/{project}', [ApiController::class, 'projects_show']);
});

