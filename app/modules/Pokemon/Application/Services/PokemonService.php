<?php

namespace Modules\Pokemon\Application\Services;

use Modules\Pokemon\Application\Filters\PokemonFilter;
use Modules\Pokemon\Domain\Collections\PokemonCollection;
use Modules\Pokemon\Domain\Repositories\Contracts\PokemonRepositoryInterface;

class PokemonService
{

    public function __construct(protected PokemonRepositoryInterface $pokemonRepository)
    {
    }

    public function getPokemons(PokemonFilter $filter, int $perPage = 10, int $page = 1): PokemonCollection
    {
        return $this->pokemonRepository->getFilteredPokemons(
            $filter->nome,
            $filter->tipo,
            $perPage,
            $page
        );
    }

}
