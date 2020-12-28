<?php

namespace Database\Seeders;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
//            CitySeeder::class,
            RegionSeeder::class,
//            AdvertSeeder::class,
        ]);

        User::factory(10)->create();
        Advert::factory(10)->create();
    }
}
