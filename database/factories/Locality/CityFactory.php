<?php

namespace Database\Factories\Locality;

use App\Models\Locality\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->locale();

        return [
            'name' => $this->faker->city,
            'region_id' => null,
        ];
    }
}
