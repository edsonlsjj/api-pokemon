<?php
namespace Modules\Pokemon\Infrastructure\Repositories;

use Modules\Pokemon\Domain\Collections\PokemonCollection;
use Modules\Pokemon\Domain\Entities\Pokemon as PokemonEntity;
use Modules\Pokemon\Domain\Repositories\Contracts\PokemonRepositoryInterface;
use Modules\Pokemon\Domain\ValueObjects\AlturaVO;
use Modules\Pokemon\Domain\ValueObjects\PesoVO;
use Modules\Pokemon\Infrastructure\Models\Pokemon;

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


