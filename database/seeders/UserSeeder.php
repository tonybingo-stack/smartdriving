<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Alin Fulga',
            'email' => 'contact@artificially.io',
            'password' => Hash::make('password'),
            'role' => UserRole::Admin,
        ]);

        User::create([
            'name' => 'Andrea Fogliazza',
            'email' => 'info@smart-driving.eu',
            'password' => Hash::make('ligier'),
            'role' => UserRole::Admin,
        ]);

        User::factory()->count(10)->create();
    }
}
