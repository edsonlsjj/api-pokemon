<?php
namespace App\Repositories;

use App\Domain\Repositories\Contracts\PokemonRepositoryInterface;
use App\Models\Pokemon;
use App\Domain\Entities\PokemonEntity;
use App\Domain\Collections\PokemonCollection;
use App\Domain\ValueObjects\AlturaVO;
use App\Domain\ValueObjects\PesoVO;

class PokemonRepository implements PokemonRepositoryInterface
{
    public function getFilteredPokemons(?string $nome, ?string $tipo, int $perPage = 10, int $page = 1): PokemonCollection
    {
        $query = Pokemon::query()
            ->when($nome, fn($query) => $query->where('nome', 'like', "%$nome%"))
            ->when($tipo, fn($query) => $query->where('tipo', 'like', "%$tipo%"));

        $total = $query->count();
        $results = $query->forPage($page, $perPage)->get();

        $entities = $results->map(function ($pokemon) {
            return new PokemonEntity(
                $pokemon->id,
                $pokemon->nome,
                $pokemon->tipo,
                new PesoVO($pokemon->peso),
                new AlturaVO($pokemon->altura)
            );
        })->toArray();

        $collection = new PokemonCollection($entities);
        $collection->setPagination($total, $perPage, $page);

        return $collection;
    }
}


