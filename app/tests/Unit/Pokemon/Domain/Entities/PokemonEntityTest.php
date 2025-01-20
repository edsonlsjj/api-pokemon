<?php

namespace Tests\Unit\Domain\Entities;

use Modules\Pokemon\Domain\Entities\Pokemon;
use Modules\Pokemon\Domain\ValueObjects\AlturaVO;
use Modules\Pokemon\Domain\ValueObjects\PesoVO;
use PHPUnit\Framework\TestCase;

class PokemonEntityTest extends TestCase
{
    public function test_pokemon_entity_creation(): void
    {
        $peso = new PesoVO(60);
        $altura = new AlturaVO(150);

        $pokemon = new Pokemon(1,'Pikachu', 'Electric', $peso, $altura);

        $this->assertEquals(1, $pokemon->id);
        $this->assertEquals('Pikachu', $pokemon->nome);
        $this->assertEquals('Electric', $pokemon->tipo);
        $this->assertEquals(6, $pokemon->peso->getKg());
        $this->assertEquals(1500, $pokemon->altura->getCm());
    }

    public function test_pokemon_entity_to_array(): void
    {
        $peso = new PesoVO(60);
        $altura = new AlturaVO(150);

        $pokemon = new Pokemon(1, 'Pikachu', 'Electric', $peso, $altura);

        $expected = [
            'id' => 1,
            'nome' => 'Pikachu',
            'tipo' => 'Electric',
            'peso_kg' => 6,
            'altura_cm' => 1500,
        ];

        $this->assertEquals($expected, $pokemon->toArray());
    }
}
