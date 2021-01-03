<?php

declare(strict_types=1);

/***
 *
 */

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class UserFactory
 * @package Database\Factories
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition(): array
    {
        $active = $this->faker->boolean;

        return [
            'name' => $this->faker->name,
            'contact_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$vixdexO6fXsDVivKiQ0AyOr/lq8lrrzruYYha6d3PIiVWSAgu95Jm', // password
            'remember_token' => Str::random(10),
            'telephone' => $this->faker->unique()->phoneNumber,
            'photo' => $this->faker->image(),
            'city_id' => random_int(1, 25),
            'verify_token' => $active ? null : Str::random(10),
            'verify_status' => $active ? User::STATUS_ACTIVE : User::STATUS_WAIT,
        ];
    }
}
