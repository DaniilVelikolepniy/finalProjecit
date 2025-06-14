<?php

namespace Database\Factories;

use App\Models\Facility;
use App\Models\Hotel;
use App\Models\FacilityHotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacilityHotel>
 */
class FacilityHotelFactory extends Factory
{
    protected $model = FacilityHotel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'facility_id' => Facility::factory(),
            'hotel_id' => Hotel::factory(),
        ];
    }
}
