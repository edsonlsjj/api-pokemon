<?php

namespace Database\Factories;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PokemonFactory extends Factory
{
    protected $model = Pokemon::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'tipo' => $this->faker->randomElement(['Electric', 'Grass', 'Water', 'Fire']),
            'peso' => $this->faker->numberBetween(10, 100),
            'altura' => $this->faker->numberBetween(10, 200),
        ];
    }
}
