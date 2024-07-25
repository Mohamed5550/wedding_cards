<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    private array $countries;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->countries = include(base_path('database/data/countries.php'));

        Country::insert($this->countries);
    }
}
