<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\LeaderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\FarmingItemController;
use App\Http\Controllers\Admin\TourismAttractionController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\MediaController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/farming', [PageController::class, 'farming'])->name('farming');
Route::get('/tourism', [PageController::class, 'tourism'])->name('tourism');
Route::get('/biography', [PageController::class, 'biography'])->name('biography');

// Legacy dashboard redirect (for Breeze auth controllers)
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Page Sections
    Route::get('/sections', [PageSectionController::class, 'index'])->name('sections.index');
    Route::get('/sections/{page}', [PageSectionController::class, 'edit'])->name('sections.edit');
    Route::put('/sections/{page}', [PageSectionController::class, 'update'])->name('sections.update');

    // Hero Slideshow
    Route::get('/hero-slides', [PageSectionController::class, 'heroSlides'])->name('hero.slides');
    Route::post('/hero-slides', [PageSectionController::class, 'updateHeroSlides'])->name('hero.slides.update');

    // Hospital Photos
    Route::get('/hospital-photos', [PageSectionController::class, 'hospitalPhotos'])->name('hospital.photos');
    Route::post('/hospital-photos', [PageSectionController::class, 'updateHospitalPhotos'])->name('hospital.photos.update');

    // Football Photos
    Route::get('/football-photos', [PageSectionController::class, 'footballPhotos'])->name('football.photos');
    Route::post('/football-photos', [PageSectionController::class, 'updateFootballPhotos'])->name('football.photos.update');

    // Leaders
    Route::post('/leaders/reorder', [LeaderController::class, 'reorder'])->name('leaders.reorder');
    Route::resource('leaders', LeaderController::class);

    // Services
    Route::resource('services', ServiceController::class);

    // Farming Items
    Route::resource('farming', FarmingItemController::class);

    // Tourism Attractions
    Route::resource('tourism', TourismAttractionController::class);

    // News Posts
    Route::resource('news', NewsController::class);

    // Contact Info
    Route::get('/contact', [ContactInfoController::class, 'edit'])->name('contact.edit');
    Route::put('/contact', [ContactInfoController::class, 'update'])->name('contact.update');

    // Media Library
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');
});

require __DIR__.'/auth.php';
