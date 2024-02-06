<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Mechanic/MechanicDashboard')->name('dashboard');