<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/film', function () {
    return view('film');
})->name('film');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::controller(MovieController::class)->group(function () {
    Route::get('/movies', 'search')->name('movies.search');
});
