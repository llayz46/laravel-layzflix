<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/film', function () {
    return view('film');
})->name('film');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::prefix('film.')->controller(MovieController::class)->group(function () {
    Route::get('/', 'browse')->name('browse');
});
