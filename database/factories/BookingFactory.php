<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Guest;
use App\Models\Slot;
use App\Models\TrackDay;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Booking::class;

    public function definition()
    {
        // Randomly decide whether to create a booking for a User or a Guest
        $bookableType = $this->faker->randomElement([User::class, Guest::class]);
        $bookable = $bookableType::factory()->create();

        return [
            'bookable_id' => $bookable->id,
            'bookable_type' => $bookableType,
            'car_id' => Car::factory(),
            'track_day_id' => TrackDay::factory(),
            'slot_id' => Slot::factory(),
            'instructor_id' => User::factory(),
        ];
    }
}
