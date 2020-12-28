<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'contact_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$vixdexO6fXsDVivKiQ0AyOr/lq8lrrzruYYha6d3PIiVWSAgu95Jm', // password
            'remember_token' => Str::random(10),
            'telephone' => $this->faker->unique()->phoneNumber,
            'photo' => $this->faker->image(),
            'city_id' => random_int(1, 25),
        ];
    }
}
