<?php

namespace App\Domain\Services;

use App\Domain\Collections\PokemonCollection;
use App\Domain\Filters\PokemonFilter;
use App\Domain\Repositories\Contracts\PokemonRepositoryInterface;

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
