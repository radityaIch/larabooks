<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'index']);
Route::get('/famous-authors', [BookController::class, 'showFamousAuthor'])->name('famous_authors');
Route::get('/input-rating', [BookController::class, 'showInputRating'])->name('input_rating');
Route::post('/input-rating', [BookController::class, 'storeInputRating'])->name('input_rating.store');
