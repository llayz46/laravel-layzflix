<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/film', function () {
    return view('film');
})->name('film');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// Movies routes
Route::controller(MovieController::class)->name('movies.')->prefix('/movies')->group(function () {
    Route::get('/', 'search')->name('search'); // Browse movies page
    Route::get('/{id}-{movie}', 'show')->name('show'); // Show a movie page
});
