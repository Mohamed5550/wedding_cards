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
        $this->call(CountrySeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'country_id' => 1,
            'birthdate' => '1990-01-01',
            'email' => 'test@example.com',
        ]);
    }
}
