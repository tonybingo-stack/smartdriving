<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\TrackDayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('roles/enums', [UserController::class, 'getRoleEnums'])->name('roles.enums');
Route::apiResource('cars', CarController::class)->only(['show', 'store', 'update', 'destroy']);
Route::apiResource('tracks', TrackController::class)->only(['show', 'store', 'update', 'destroy']);
Route::apiResource('track_days', TrackDayController::class)->only(['store', 'update', 'destroy']);
Route::apiResource('users', UserController::class)->only(['store', 'update', 'destroy']);
Route::apiResource('products', ProductController::class)->only(['store', 'update', 'destroy']);
Route::apiResource('stats', StatsController::class)->only(['index']);
