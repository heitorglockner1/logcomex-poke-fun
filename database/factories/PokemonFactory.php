<?php

namespace Database\Factories;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PokemonFactory extends Factory
{
    protected $model = Pokemon::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'name' => $faker->unique()->name(),
            'height' => $this->faker->numberBetween(1, 20),
            'weight' => $this->faker->numberBetween(10, 1000),
        ];
    }
}
