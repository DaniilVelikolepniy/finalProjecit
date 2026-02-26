<?php

namespace Database\Seeders;

use App\Models\Role;
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

        $adminRole = Role::where('name', 'admin')->first();

        $existingRoot = User::where('email', 'root@booking.com')->first();

        if (! $existingRoot) {
            $root = User::create([
                'name' => 'root',
                'email' => 'root@booking.com',
                'password' => 'root_admin',
            ]);
            $root->forceFill(['email_verified_at' => now()])->save();
            $root->roles()->sync([$adminRole->id]);
        }
    }
}
