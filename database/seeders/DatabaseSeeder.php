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
        $this->call(RoleSeeder::class);

        $admin = User::factory()->create([
            'name' => 'Admin user',
            'country_id' => 1,
            'birthdate' => '1990-01-01',
            'email' => 'admin@admin.com',
        ]);

        $admin->assignRole('admin');

    }
}
