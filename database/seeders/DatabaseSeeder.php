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

        for ($i = 0; $i < 1000; $i++) {
            $date = fake()->dateTimeBetween('-1 year', 'now');
            User::factory()->create([
                'name' => fake()->name(),
                'email' => fake()->email(),
                'password' => bcrypt('password'),
                'is_admin' => 0,
                'approved' => 0,
                'gender' => fake()->randomElement(['male', 'female']),
                'age' => rand(10, 60),
                'city' => 'Daska',
                'province' => fake()->randomElement(['Punjab', 'Sindh', 'Gilgit-Baltistan', 'Balochistan', 'Khyber Pakhtunkhwa', 'Azad Kashmir']),
                'employement_status' => "full_time",
                'degree_level' => "master",
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
