<?php

namespace Database\Seeders;

use App\Models\TrackDay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrackDay::factory()->count(10)->withCars()->create();
    }
}
