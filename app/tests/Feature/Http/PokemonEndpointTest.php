<?php

namespace Tests\Feature\Http;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PokemonEndpointTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $faker = Factory::create();

        DB::table('pokemon')->insert(
            [
                [
                    'nome' => $faker->name(),
                    'peso' => $faker->numberBetween(10, 100),
                    'altura' => $faker->numberBetween(10, 100),
                    'tipo' => $faker->randomElement(['Electric', 'Grass', 'Water', 'Fire'])
                ],
                ['nome' => 'Pikachu', 'peso' => 4, 'altura' => 11, 'tipo' => 'Electric']
            ]);
    }

    public function test_pokemon_endpoint_returns_filtered_data(): void
    {

        $response = $this->getJson('/api/pokemon?nome=Pikachu');
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'nome' => 'Pikachu',
                        'tipo' => 'Electric',
                    ],
                ],
            ]);
    }

    public function test_pokemon_endpoint_returns_filtered_data_peso_kg(): void
    {
        $response = $this->getJson('/api/pokemon?nome=Pikachu');
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'nome' => 'Pikachu',
                        'tipo' => 'Electric',
                        'peso_kg' => 4 / 10,
                    ],
                ],
            ]);
    }

    public function test_pokemon_endpoint_returns_filtered_data_altura_cm(): void
    {
        $response = $this->getJson('/api/pokemon?nome=Pikachu');
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'nome' => 'Pikachu',
                        'tipo' => 'Electric',
                        'altura_cm' => 11 * 10,
                    ],
                ],
            ]);
    }
}
