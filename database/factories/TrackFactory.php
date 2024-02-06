<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text,
            'photo_url' => 'track.jpg',
            'length' => $this->faker->numberBetween(1000, 5000),
            'straight_line_length' => $this->faker->numberBetween(100, 1000),
            'country' => strtolower($this->faker->countryCode),
        ];
    }
}
