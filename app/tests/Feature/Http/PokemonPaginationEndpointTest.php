<?php

namespace Tests\Feature\Http;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PokemonPaginationEndpointTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $faker = Factory::create();

        // Inserindo 30 Pokémons para testar a paginação
        $pokemonData = [];
        for ($i = 1; $i <= 30; $i++) {
            $pokemonData[] = [
                'nome' => $faker->unique()->name(),
                'peso' => $faker->numberBetween(10, 100),
                'altura' => $faker->numberBetween(10, 100),
                'tipo' => $faker->randomElement(['Electric', 'Grass', 'Water', 'Fire']),
            ];
        }

        DB::table('pokemon')->insert($pokemonData);
    }

    public function test_pokemon_endpoint_pagination_data(): void
    {
        $response = $this->getJson('/api/pokemon?page=1&per_page=10');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'total',
                'per_page',
                'current_page',
                'last_page',
                'data' => [
                    '*' => [
                        'id',
                        'nome',
                        'tipo',
                        'peso_kg',
                        'altura_cm',
                    ],
                ],
            ])
            ->assertJson([
                'total' => 30,
                'per_page' => 10,
                'current_page' => 1,
                'last_page' => 3,
            ]);
    }

    public function test_pokemon_endpoint_returns_correct_page_data(): void
    {
        $response = $this->getJson('/api/pokemon?page=2&per_page=10');

        $response->assertStatus(200)
            ->assertJson([
                'current_page' => 2,
                'per_page' => 10,
            ]);

        $this->assertCount(10, $response->json('data')); // Verifica se a página contém 10 itens
    }

    public function test_pokemon_endpoint_handles_invalid_page(): void
    {
        $response = $this->getJson('/api/pokemon?page=100&per_page=10');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [],
                'current_page' => 100,
            ]);
    }
}

