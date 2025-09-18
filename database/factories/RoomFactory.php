<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Room ' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->sentence(),
            'poster_url' => $this->faker->imageUrl(640, 480, 'room', true),
            'floor_area' => $this->faker->numberBetween(15, 100),
            'type' => $this->faker->randomElement(['single','double','suite']),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'hotel_id' => null,
        ];
    }
}
