<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Reseller/ResellerDashboard')->name('dashboard');