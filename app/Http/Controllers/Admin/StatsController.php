<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Booking, Track, TrackDay, Guest, User, Car};

class StatsController extends Controller
{
    public function index()
    {
        $stats = [
            'bookingsCount' => Booking::count(),
            'tracksCount' => Track::count(),
            'trackDaysCount' => TrackDay::count(),
            'guestsCount' => Guest::count(),
            'usersCount' => User::count(),
            'instructorsCount' => User::where('role', 'instructor')->count(),
            'carsCount' => Car::count(),
            'revenue' => 1200,
        ];

        return response()->json($stats);
    }
}