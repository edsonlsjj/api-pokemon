<?php

namespace Tests\Feature;

use App\Models\Pokemon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PokemonEndpointTest extends TestCase
{
    use RefreshDatabase;

    public function test_pokemon_endpoint_returns_filtered_data(): void
    {

        Pokemon::factory()->create(['nome' => 'Pikachu', 'tipo' => 'Electric']);
        Pokemon::factory()->create(['nome' => 'Bulbasaur', 'tipo' => 'Grass']);


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
}
