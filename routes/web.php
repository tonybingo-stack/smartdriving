<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\InstructorController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\PaymentReturnController;
use App\Http\Controllers\User\TrackController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\TrackDayController;
use App\Http\Controllers\User\CarController;
use App\Http\Controllers\User\BookingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');



Route::resource('login', LoginController::class)->only(['destroy']);

Route::post('logout', [LoginController::class,'destroy'])->name('logout');

Route::resource('profile', UserController::class)->only(['index']);
Route::resource('bookings', BookingController::class)->only(['index']);
Route::resource('payment', PaymentController::class)->only(['index']);
Route::resource('cars', CarController::class)->only(['index']);
Route::resource('tracks', TrackController::class)->only(['index']);
Route::resource('trackday', TrackDayController::class)->only(['index']);
Route::resource('instructors', InstructorController::class)->only(['index']);

Route::prefix('payments')->name('payments.')->group(function() {
    Route::get('success', [PaymentReturnController::class, 'success'])->name('success');
});

Route::put('user/{id}/pay', [UserController::class, 'pay'])->name('user.pay'); 
Route::get('/payment/start-payment', [PaymentController::class, 'startPayment'])->name('payment.startpayment');
