<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Facility;
use App\Models\Hotel;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'description' => 'Super administrator'],
            ['name' => 'editor', 'description' => 'Hotel editor'],
            ['name' => 'client', 'description' => 'Client'],
        ];
        foreach ($roles as $r) {
            Role::firstOrCreate(['name' => $r['name']], $r);
        }

        $admins = User::factory(2)->create();
        $editors = User::factory(5)->create();
        $clients = User::factory(10)->create();

        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();
        $clientRole = Role::where('name', 'client')->first();

        $admins->each(fn($u) => $u->roles()->syncWithoutDetaching([$adminRole->id]));
        $editors->each(fn($u) => $u->roles()->syncWithoutDetaching([$editorRole->id]));
        $clients->each(fn($u) => $u->roles()->syncWithoutDetaching([$clientRole->id]));


        $facilities = Facility::factory(6)->create();

        $hotels = Hotel::factory(3)->create()->each(function ($hotel) use ($editors, $facilities) {

            $hotel->update(['editor_id' => $editors->random()->id]);


            $hotel->facilities()->attach($facilities->random(rand(2, 4)));


            $rooms = Room::factory(rand(5, 8))->create(['hotel_id' => $hotel->id]);


            $hotelFacilities = $hotel->facilities()->pluck('facilities.id');
            $rooms->each(function ($room) use ($hotelFacilities) {
                $room->facilities()->attach(
                    $hotelFacilities->random(rand(1, $hotelFacilities->count()))
                );
            });
        });


        $rooms = Room::all();
        $clients = User::whereHas('roles', fn($q) => $q->where('name', 'client'))->get();

        foreach ($rooms as $room) {
            Booking::factory(rand(1, 3))->create([
                'room_id' => $room->id,
                'user_id' => $clients->random()->id,
            ]);
        }
    }
}
