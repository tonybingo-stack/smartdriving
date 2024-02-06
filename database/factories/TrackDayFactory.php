<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Track;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrackDay>
 */
class TrackDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'track_id' => Track::factory(),
            'date' => $this->faker->date(),
            'description' => $this->faker->text(200), // Generate random text for description
            'services' => $this->faker->text(200), 
            'start_time' => Carbon::createFromTime($this->faker->numberBetween(6, 10), 0)->format('H:i:s'),
            'lunch_time' => Carbon::createFromTime(12, 0)->format('H:i:s'),
            'end_time' => Carbon::createFromTime($this->faker->numberBetween(14, 18), 0)->format('H:i:s'),
        ];
    }

    public function withCars($count = 5)
{
    return $this->has(Car::factory()->count($count), 'cars');
}
}
