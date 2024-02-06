<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GuestSeeder::class,
            CarSeeder::class,
            TrackSeeder::class,
            TrackDaySeeder::class,
            BookingSeeder::class,
            ProductSeeder::class,
            SlotSeeder::class,
        ]);
    }
}
