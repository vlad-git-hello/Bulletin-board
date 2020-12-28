<?php

namespace Database\Seeders;

use App\Models\Locality\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::factory(45)->create();
    }
}
