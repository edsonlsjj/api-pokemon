<?php

namespace Tests\Integration\Repositories;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Modules\Pokemon\Infrastructure\Repositories\PokemonRepository;
use Tests\TestCase;

class PokemonRepositoryPaginationTest extends TestCase
{
    use RefreshDatabase;

    private PokemonRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = app(PokemonRepository::class);
        $faker = Factory::create();

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

    public function test_pagination_data_is_correct(): void
    {

        $collection = $this->repository->getFilteredPokemons(null, null, 10, 1);

        $paginationData = $collection->getPaginationData();

        $this->assertEquals(30, $paginationData['total']);
        $this->assertEquals(10, $paginationData['per_page']);
        $this->assertEquals(1, $paginationData['current_page']);
        $this->assertEquals(3, $paginationData['last_page']);
    }

    public function test_paginate_to_array(): void
    {

        $collection = $this->repository->getFilteredPokemons(null, null, 10, 2);

        $dataArray = $collection->paginateToArray($collection->toArray());

        $this->assertArrayHasKey('total', $dataArray);
        $this->assertArrayHasKey('per_page', $dataArray);
        $this->assertArrayHasKey('current_page', $dataArray);
        $this->assertArrayHasKey('last_page', $dataArray);
        $this->assertArrayHasKey('data', $dataArray);

        $this->assertEquals(30, $dataArray['total']);
        $this->assertEquals(10, $dataArray['per_page']);
        $this->assertEquals(2, $dataArray['current_page']);
        $this->assertEquals(3, $dataArray['last_page']);
        $this->assertCount(10, $dataArray['data']);
    }
}
