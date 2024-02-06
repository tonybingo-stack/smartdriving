<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackDayController extends Controller
{
    public function index(){
        return inertia("User/TrackDay/index");
    }
}