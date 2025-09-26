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
            'poster_url' => 'https://plus.unsplash.com/premium_photo-1663126831394-25b3e9c9e059?q=80&w=2670&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'floor_area' => $this->faker->numberBetween(15, 100),
            'type' => $this->faker->randomElement(['single', 'double', 'suite']),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'hotel_id' => null,
        ];
    }
}
