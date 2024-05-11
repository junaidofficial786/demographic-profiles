<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        for ($i = 0; $i < 100; $i++) {
            User::factory()->create([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'password' => bcrypt('password'),
                'is_admin' => 0,
                'approved' => 0,
                'gender' => 'male',
                'age' => 30,
                'city' => 'Daska',
                'province' => 'Punjab',
                'employement_status' => "full_time",
                'degree_level' => "master",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
