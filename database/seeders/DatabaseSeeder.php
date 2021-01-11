<?php

declare(strict_types=1);

/**
 *
 */

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            RegionSeeder::class,
//            AdvertSeeder::class,
        ]);

        User::factory(10)->create();
//        Advert::factory(10)->create();
    }
}
