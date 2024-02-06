<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->streetName,
            'type' => $this->faker->word,
            'description' => $this->faker->text,
            'photo_url' => 'car.jpg',
            'engine_type' => $this->faker->realTextBetween(5, 15),
            'power' => $this->faker->numberBetween(100, 1000),
            'acceleration' => $this->faker->randomFloat(2, 2, 10),
            'vin' => $this->faker->unique()->bothify('??######'),
            'km' => $this->faker->numberBetween(0, 200000),
            'damages' => $this->faker->text(200),
            'fuel_level' => $this->faker->numberBetween(0, 100), // Fuel level as percentage
            'wheel_percentages' => json_encode([ // Random percentages for each wheel
                'front_left' => $this->faker->numberBetween(0, 100),
                'front_right' => $this->faker->numberBetween(0, 100),
                'rear_left' => $this->faker->numberBetween(0, 100),
                'rear_right' => $this->faker->numberBetween(0, 100),
            ]),
        ];
    }
}
