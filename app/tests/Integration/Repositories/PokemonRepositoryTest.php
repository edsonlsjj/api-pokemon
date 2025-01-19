<?php

namespace Tests\Integration\Repositories;

use App\Domain\Collections\PokemonCollection;
use App\Models\Pokemon;
use App\Repositories\PokemonRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PokemonRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private PokemonRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = app(PokemonRepository::class);
    }

    public function test_get_filtered_pokemons(): void
    {

        Pokemon::factory()->create(['nome' => 'Pikachu', 'tipo' => 'Electric']);
        Pokemon::factory()->create(['nome' => 'Bulbasaur', 'tipo' => 'Grass']);


        $collection = $this->repository->getFilteredPokemons('Pikachu', null);

        $this->assertInstanceOf(PokemonCollection::class, $collection);
        $this->assertCount(1, $collection);
        $this->assertEquals('Pikachu', $collection->toArray()[0]['nome']);
    }
}
