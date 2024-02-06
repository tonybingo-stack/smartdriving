<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Models\Car;
use App\Models\Track;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login.create');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');

    Route::get('register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/track-days/{trackDayId}/available-slots', [BookingController::class, 'availableSlots']);
    Route::post('/bookings', [BookingController::class, 'createBooking']);
    
    Route::get('/', function () {
        $tracks = Track::all();
        $cars = Car::all();
        return Inertia::render('Welcome', [
            'cars' => $cars,
            'tracks' => $tracks
        ]);
    })->name('welcome');
});

