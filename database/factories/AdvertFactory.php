<?php

namespace Database\Factories;

use App\Models\Advert;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Advert::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'overview' => $this->faker->text(250),
            'price' => random_int(100, 5000),
            'state' => 'new',
            'type_author' => 'private',
            'category_id' => random_int(1, 10),
            'user_id' => random_int(1, 10),
        ];
    }
}
