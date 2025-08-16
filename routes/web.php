<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// -------------------------
// Public Routes
// -------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/show', [HomeController::class, 'show'])->name('shows');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/venue', [HomeController::class, 'venue'])->name('venues');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/show-details/{show}', [HomeController::class, 'showDetail'])->name('show.details');

// -------------------------
// Admin Routes
// -------------------------
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Shows
    Route::get('/shows', [AdminController::class, 'shows'])->name('shows');
    Route::post('/shows', [AdminController::class, 'createShow'])->name('shows.store');
    Route::put('/shows/{show}', [AdminController::class, 'updateShow'])->name('shows.update');
    Route::delete('/shows/{show}', [AdminController::class, 'destroyShow'])->name('shows.destroy');

    // Representations
    Route::get('/representations', [AdminController::class, 'representations'])->name('representations');
    Route::post('/representations', [AdminController::class, 'createRepresentation'])->name('representations.store');
    Route::put('/representations/{representation}', [AdminController::class, 'updateRepresentation'])->name('representations.update');
    Route::delete('/representations/{representation}', [AdminController::class, 'destroyRepresentation'])->name('representations.destroy');

    // Bookings management
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');

    // Venues
    Route::get('/venues', [AdminController::class, 'venues'])->name('venues');
    Route::post('/venues', [AdminController::class, 'createVenue'])->name('venues.store');
    Route::put('/venues/{venue}', [AdminController::class, 'updateVenue'])->name('venues.update');
    Route::delete('/venues/{venue}', [AdminController::class, 'destroyVenue'])->name('venues.destroy');

    // Other
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::put('/users/{user}', [AdminController::class, 'userUpdate'])->name('users.update');


    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

// -------------------------
// User Routes
// -------------------------
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/my-bookings', [HomeController::class, 'myBookings'])->name('bookings.my');
    Route::put('/my-bookings/{booking}', [HomeController::class, 'updateBooking'])->name('bookings.update');

});

// -------------------------
// Profile Routes
// -------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/bookings', [AdminController::class, 'createBooking'])->name('bookings.store');

});

require __DIR__ . '/auth.php';
