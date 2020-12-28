<?php

namespace Database\Seeders;

use App\Models\Locality\City;
use App\Models\Locality\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::factory(5)->create()->each(function (Region $region) {
            $region->cities()->saveMany(City::factory(5)->create());
        });
    }
}
