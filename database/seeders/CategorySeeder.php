<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(5)->create()->each(function(Category $category) {
            $category->children()->saveMany(Category::factory(3)->create()->each(function (Category $category) {
                $category->children()->saveMany(Category::factory(3)->create());
            }));
        });
    }
}
