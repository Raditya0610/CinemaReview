<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

// Film
Route::get('/film', [FilmController::class, 'index']);
Route::middleware(['auth'])->group(function(){
    Route::get('/film/create', [FilmController::class, 'create']);
    Route::post('/film', [FilmController::class, 'store']);
    Route::get('/film/{id}/edit', [FilmController::class, 'edit']);
    Route::put('/film/{id}', [FilmController::class, 'update']);
    Route::delete('/film/{id}', [FilmController::class, 'destroy']);
});
Route::get('/film/{id}', [FilmController::class, 'show']);

// Genre
Route::get('/genre', [GenreController::class, 'index']);
Route::middleware(['auth'])->group(function () {
    Route::get('/genre/create', [GenreController::class, 'create']);
    Route::post('/genre', [GenreController::class, 'store']);
    Route::get('/genre/{id}/edit', [GenreController::class, 'edit']);
    Route::put('/genre/{id}', [GenreController::class, 'update']);
    Route::delete('/genre/{id}', [GenreController::class, 'destroy']);
});
Route::get('/genre/{id}', [GenreController::class, 'show']);

Route::middleware(['auth'])->group(function () {
    Route::get('/films/{film_id}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/films/{film_id}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/films/{film_id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
Auth::routes();
