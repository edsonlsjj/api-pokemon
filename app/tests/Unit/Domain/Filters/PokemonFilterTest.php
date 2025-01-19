<?php

namespace Tests\Unit\Domain\Filters;

use App\Domain\Filters\PokemonFilter;
use PHPUnit\Framework\TestCase;

class PokemonFilterTest extends TestCase
{
    public function test_pokemon_filter_initialization(): void
    {
        $filter = new PokemonFilter(nome: 'Pikachu', tipo: 'Electric');

        $this->assertEquals('Pikachu', $filter->nome);
        $this->assertEquals('Electric', $filter->tipo);
    }

    public function test_pokemon_filter_default_values(): void
    {
        $filter = new PokemonFilter();

        $this->assertNull($filter->nome);
        $this->assertNull($filter->tipo);
    }
}
