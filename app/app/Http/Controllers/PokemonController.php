<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Pokemon\Application\Filters\PokemonFilter;
use Modules\Pokemon\Application\Services\PokemonService;

class PokemonController extends Controller
{
    public function __construct(protected PokemonService $pokemonService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 10);
        $page = (int) $request->query('page', 1);

        $collection = $this->pokemonService->getPokemons(
            new PokemonFilter(
                $request->query('nome'),
                $request->query('tipo')
            ),
            $perPage,
            $page);

        return response()->json($collection->paginateToArray($collection->toArray()));
    }
}
