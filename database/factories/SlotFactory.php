<?php

namespace Database\Factories;

use App\Models\TrackDay;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slot>
 */
class SlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('next Monday', 'next Monday +7 days');
        $endTime = (clone $startTime)->modify('+20 minutes');
    
        return [
            'track_day_id' => TrackDay::factory(),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }

    public function withInstructors($count = 3)
    {
        return $this->has(User::factory()->count($count)->instructor(), 'instructors');
    }
}
