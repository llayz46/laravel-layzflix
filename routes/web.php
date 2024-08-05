<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\EmailVerificationController;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Review routes
Route::controller(ReviewController::class)->name('review.')->prefix('/review')->middleware('verified_user')->group(function () {
    Route::post('/', 'addReview')->name('add'); // Store a review
    Route::delete('/{review}', 'deleteReview')->name('delete'); // Delete a review
});

// Movies routes
Route::controller(MovieController::class)->name('movies.')->prefix('/medias')->group(function () {
    Route::get('/', 'search')->name('search'); // Browse movies page
    Route::get('/{id}-{mediaType}-{media}', 'show')->name('show'); // Show a movie page
    Route::post('/{id}-{mediaType}-{media}', 'mediaToFavorite')->name('favorite'); // Add a movie to favorite
});

// Auth routes
Route::controller(AuthController::class)->name('auth.')->group(function () {
    Route::get('/register', 'register')->name('register')->middleware('guest'); // Register view page
    Route::post('/register', 'store')->name('store')->middleware('guest'); // Register a new user

    Route::get('/login', 'login')->name('login')->middleware('guest'); // Login view page
    Route::post('/login', 'doLogin')->name('doLogin')->middleware('guest'); // Login a user

    Route::delete('/logout', 'destroy')->name('logout')->middleware('auth'); // Logout a user
});

// Email verification routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'verifyView'])->name('verification.notice'); // Email verification view page
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify'); // Verify email
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('throttle:6,1')->name('verification.send'); // Send email verification link -> resend
});

// Settings routes
Route::controller(SettingsController::class)->middleware('verified_user')->group(function () {
    Route::get('/settings', 'index')->name('settings.index'); // Settings view page
    Route::patch('/settings', 'update')->name('profile.update'); // Update a user profile
    Route::put('/settings', 'updatePassword')->name('profile.updatePassword'); // Update a user password
});

// Profile routes
Route::controller(ProfileController::class)->name('profile.')->group(function () {
    Route::get('/profile/{user:username}', 'index')->name('index'); // Profile view page
    Route::patch('/profile', 'updateInformation')->name('updateInformation'); // Update a user profile information
    Route::post('/settings', 'updateImage')->name('updateImage'); // Update a user profile image

    Route::get('/profile/{user:username}/reviews', 'reviews')->name('reviews'); // User reviews view page
    Route::get('/profile/{user:username}/favorites', 'favorites')->name('favorites'); // User favorites view page
    Route::get('/profile/{user:username}/following', 'following')->middleware('auth')->name('following'); // User friends view page
    Route::get('/profile/{user:username}/followers', 'followers')->middleware('auth')->name('followers'); // User friends view page
});

// Follower routes
Route::controller(FollowerController::class)->middleware('auth')->name('follow.')->group(function () {
    Route::post('/follower/{user:username}', 'add')->name('add'); // Add a user at followers
    Route::delete('/follower/{user:username}', 'delete')->name('delete'); // Delete a user from followers
});
