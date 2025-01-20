<?php

namespace Modules\Pokemon\Domain\Repositories\Contracts;

use Modules\Pokemon\Domain\Collections\PokemonCollection;

interface PokemonRepositoryInterface
{
    /**
     * Retrieve paginated list of Pokémon filtered by name and type.
     *
     * @param string|null $nome
     * @param string|null $tipo
     * @param int $perPage
     * @param int $page
     * @return PokemonCollection
     */
    public function getFilteredPokemons(
        ?string $nome,
        ?string $tipo,
        int     $perPage = 10,
        int     $page = 1): PokemonCollection;

}
