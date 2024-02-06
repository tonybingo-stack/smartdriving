<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Instructor/InstructorDashboard')->name('dashboard');