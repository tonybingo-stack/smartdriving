<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use Inertia\Inertia;

class CarController extends Controller
{
    //
    public function index(){
        $cars = Car::all();

        return Inertia::render("User/Car/index", ['cars' => $cars,]);
    }
}
