<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Review routes
Route::controller(ReviewController::class)->name('review.')->prefix('/review')->middleware('auth')->group(function () {
    Route::post('/', 'addReview')->name('add'); // Store a review
    Route::delete('/{review}', 'deleteReview')->name('delete'); // Delete a review
});

// Movies routes
Route::controller(MovieController::class)->name('movies.')->prefix('/movies')->group(function () {
    Route::get('/', 'search')->name('search'); // Browse movies page
    Route::get('/{id}-{movie}', 'show')->name('show'); // Show a movie page
    Route::post('/{id}-{movie}', 'movieToFavorite')->name('favorite'); // Add a movie to favorite
});

// Auth routes
Route::controller(AuthController::class)->name('auth.')->group(function () {
    Route::get('/register', 'register')->name('register')->middleware('guest'); // Register view page
    Route::post('/register', 'store')->name('store')->middleware('guest'); // Register a new user

    Route::get('/login', 'login')->name('login')->middleware('guest'); // Login view page
    Route::post('/login', 'doLogin')->name('doLogin')->middleware('guest'); // Login a user

    Route::delete('/logout', 'destroy')->name('logout')->middleware('auth'); // Logout a user
});

// Settings routes
Route::controller(SettingsController::class)->middleware('auth')->group(function () {
    Route::get('/settings', 'index')->name('settings.index'); // Settings view page
    Route::patch('/settings', 'update')->name('profile.update'); // Update a user profile
    Route::put('/settings', 'updatePassword')->name('profile.updatePassword'); // Update a user password
});

// Profile routes
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile/{user:username}', 'index')->name('profile.index'); // Profile view page
    Route::patch('/profile', 'updateInformation')->name('profile.updateInformation'); // Update a user profile information
    Route::post('/settings', 'updateImage')->name('profile.updateImage'); // Update a user profile image

    Route::get('/profile/{user:username}/reviews', 'reviews')->name('profile.reviews'); // User reviews view page
    Route::get('/profile/{user:username}/favorites', 'favorites')->name('profile.favorites'); // User favorites view page
});

// Friend routes
Route::controller(FriendController::class)->middleware('auth')->group(function () {
    Route::post('/friend/{user:username}', 'add')->name('friend.add'); // Add a friend
    Route::delete('/friend/{user:username}', 'delete')->name('friend.delete'); // Delete a friend
    // TODO : Une listes des amis ?
});
