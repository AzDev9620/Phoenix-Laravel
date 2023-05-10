<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\AspectController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PanoramaController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';


Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'main'])->name('main');
    Route::get('language/{locale}', [HomeController::class, 'language']);

    Route::get('projects/{project}/apartments/create', [ApartmentController::class, 'create'])->name('apartments.create.project');
    Route::post('features/attach', [FeatureController::class, 'attach'])->name('features.attach');
    Route::post('features/detach', [FeatureController::class, 'detach'])->name('features.detach');
    Route::post('images/upload', [ImageController::class, 'upload'])->name('images.upload');
    Route::post('images/delete', [ImageController::class, 'delete'])->name('images.delete');

    Route::resources([
        'apartments' => ApartmentController::class,
        'languages' => LanguageController::class,
        'panoramas' => PanoramaController::class,
        'projects' => ProjectController::class,
        'features' => FeatureController::class,
        'benefits' => BenefitController::class,
        'contacts' => ContactController::class,
        'aspects' => AspectController::class,
        'details' => DetailController::class,
        'floors' => FloorController::class,
        'images' => ImageController::class,
        'links' => LinkController::class,
    ]);

});
