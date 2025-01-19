<?php

namespace Tests\Unit\Domain\Services;

use App\Domain\Collections\PokemonCollection;
use App\Domain\Entities\PokemonEntity;
use App\Domain\Filters\PokemonFilter;
use App\Domain\Repositories\Contracts\PokemonRepositoryInterface;
use App\Domain\Services\PokemonService;
use App\Domain\ValueObjects\AlturaVO;
use App\Domain\ValueObjects\PesoVO;
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
            new PokemonEntity(1, 'Pikachu', 'Electric', new PesoVO(60), new AlturaVO(150)),
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
