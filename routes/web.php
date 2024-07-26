<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

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

Route::controller(SettingsController::class)->middleware('auth')->group(function () {
    Route::get('/settings', 'index')->name('settings.index'); // Settings view page
    Route::patch('/settings', 'update')->name('profile.update'); // Update a user profile
    Route::put('/settings', 'updatePassword')->name('profile.updatePassword'); // Update a user password
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile/{user:username}', 'index')->name('profile.index'); // Profile view page
    Route::patch('/profile', 'updateInformation')->name('profile.updateInformation'); // Update a user profile information
    Route::post('/settings', 'updateImage')->name('profile.updateImage'); // Update a user profile image
});
