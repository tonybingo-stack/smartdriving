<?php

use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\TrackDayController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Admin/AdminDashboard')->name('dashboard');

Route::resource('audits', AuditController::class)->only(['index']);
Route::resource('bookings', BookingController::class)->only(['index']);
Route::resource('cars', CarController::class)->only(['index']);
Route::resource('guests', GuestController::class)->only(['index']);
Route::resource('tracks', TrackController::class)->only(['index']);
Route::resource('products', ProductController::class)->only(['index']);
Route::resource('track_days', TrackDayController::class)->only(['index']);
Route::resource('users', UserController::class)->only(['index']);
