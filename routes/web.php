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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/show', [HomeController::class, 'show'])->name('shows');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/venue', [HomeController::class, 'venue'])->name('venues');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/show-details', [HomeController::class, 'showDetail'])->name('show-details');

Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/shows', [AdminController::class, 'shows'])->name('shows');
    Route::post('/shows', [AdminController::class, 'createShow'])->name('shows.store');
    Route::put('/shows/{show}', [AdminController::class, 'updateShow'])->name('shows.update');
    Route::delete('/shows/{show}', [AdminController::class, 'destroyShow'])->name('shows.destroy');


    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::get('/venues', [AdminController::class, 'venues'])->name('venues');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
