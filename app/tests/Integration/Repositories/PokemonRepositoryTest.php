<?php

namespace Tests\Integration\Repositories;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Modules\Pokemon\Domain\Collections\PokemonCollection;
use Modules\Pokemon\Infrastructure\Repositories\PokemonRepository;
use Tests\TestCase;

class PokemonRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private PokemonRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = app(PokemonRepository::class);
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

    public function test_get_filtered_pokemons(): void
    {
        $collection = $this->repository->getFilteredPokemons('Pikachu', null);
        $this->assertInstanceOf(PokemonCollection::class, $collection);
        $this->assertCount(1, $collection);
        $this->assertEquals('Pikachu', $collection->toArray()[0]['nome']);
    }

    public function test_get_filtered_pokemons_with_peso_kg(): void
    {
        $collection = $this->repository->getFilteredPokemons('Pikachu', null);
        $this->assertInstanceOf(PokemonCollection::class, $collection);
        $this->assertCount(1, $collection);
        $this->assertEquals(4 / 10, $collection->toArray()[0]['peso_kg']);
    }

    public function test_get_filtered_pokemons_with_altura_cm(): void
    {
        $collection = $this->repository->getFilteredPokemons('Pikachu', null);
        $this->assertInstanceOf(PokemonCollection::class, $collection);
        $this->assertCount(1, $collection);
        $this->assertEquals(11 * 10, $collection->toArray()[0]['altura_cm']);
    }
}
