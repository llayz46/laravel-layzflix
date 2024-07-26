<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile-test', function () {
    return view('profile');
});

// Movies routes
Route::controller(MovieController::class)->name('movies.')->prefix('/movies')->group(function () {
    Route::get('/', 'search')->name('search'); // Browse movies page
    Route::get('/{id}-{movie}', 'show')->name('show'); // Show a movie page
});

// Auth routes
Route::controller(AuthController::class)->name('auth.')->group(function () {
    Route::get('/register', 'register')->name('register'); // Register view page
    Route::post('/register', 'store')->name('store'); // Register a new user

    Route::get('/login', 'login')->name('login'); // Login view page
    Route::post('/login', 'doLogin')->name('doLogin'); // Login a user

    Route::delete('/logout', 'destroy')->name('logout'); // Logout a user
});

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index'); // Settings view page

Route::controller(ProfileController::class)->name('profile.')->group(function () {
    Route::patch('/settings', 'update')->name('update'); // Update a user profile
    Route::post('/settings', 'updateImage')->name('updateImage'); // Update a user profile image
    Route::put('/settings', 'updatePassword')->name('updatePassword'); // Update a user password
});
