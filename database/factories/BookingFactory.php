<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{

    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 day', '+1 week');
        $end = (clone $start)->modify('+'.rand(1, 7).' days');
        $days = $start->diff($end)->days;

        return [
            'room_id' => Room::factory(),
            'user_id' => User::factory(),
            'started_at' => $start,
            'finished_at' => $end,
            'days' => $days,
            'price' => $this->faker->randomFloat(2, 100, 3000),
        ];
    }
}
