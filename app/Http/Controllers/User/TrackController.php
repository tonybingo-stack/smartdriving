<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Track;
class TrackController extends Controller
{
    //
    public function index(){
        $tracks = Track::all();
        return Inertia::render("User/Track/index", ["tracks" => $tracks]);
    }
}
