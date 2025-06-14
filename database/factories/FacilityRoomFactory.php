<?php

namespace Database\Factories;

use App\Models\Facility;
use App\Models\Room;
use App\Models\FacilityRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacilityRoom>
 */
class FacilityRoomFactory extends Factory
{
    protected $model = FacilityRoom::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'facility_id' => Facility::factory(),
            'room_id' => Room::factory(),
        ];
    }
}
