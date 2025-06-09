<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomsController;

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\EnsureUserConfirmed;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [BookingController::class, 'index'])->name('home');

Route::get('register', [UserController::class, 'create'])->name('register');
Route::post('register', [UserController::class, 'store'])->name('user.store');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'authinticate'])->name('authinticate');
Route::middleware(['auth'])->group(function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms');
    Route::post('/rooms/store', [RoomsController::class, 'store'])->name('rooms.store');
    Route::put('/rooms/update', [RoomsController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/destroy', [RoomsController::class, 'destroy'])->name('rooms.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::put('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/confirm', [UserController::class, 'confirmUser'])->name('users.confirm');

});

Route::middleware(['auth', 'confirmed'])->group(function(){
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

