<?php

namespace Tests\Unit\Domain\Services;

use Modules\Pokemon\Application\Filters\PokemonFilter;
use Modules\Pokemon\Application\Services\PokemonService;
use Modules\Pokemon\Domain\Collections\PokemonCollection;
use Modules\Pokemon\Domain\Entities\Pokemon;
use Modules\Pokemon\Domain\Repositories\Contracts\PokemonRepositoryInterface;
use Modules\Pokemon\Domain\ValueObjects\AlturaVO;
use Modules\Pokemon\Domain\ValueObjects\PesoVO;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class PokemonServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_get_pokemons(): void
    {
        $repositoryMock = $this->createMock(PokemonRepositoryInterface::class);
        $pokemonService = new PokemonService($repositoryMock);

        $filter = new PokemonFilter(nome: 'Pikachu', tipo: 'Electric');

        $mockedCollection = new PokemonCollection([
            new Pokemon(1, 'Pikachu', 'Electric', new PesoVO(60), new AlturaVO(150)),
        ]);

        $repositoryMock
            ->expects($this->once())
            ->method('getFilteredPokemons')
            ->with('Pikachu', 'Electric', 10, 1)
            ->willReturn($mockedCollection);

        $result = $pokemonService->getPokemons($filter, 10, 1);

        $this->assertInstanceOf(PokemonCollection::class, $result);
        $this->assertCount(1, $result);
        $this->assertEquals('Pikachu', $result->toArray()[0]['nome']);
    }
}
