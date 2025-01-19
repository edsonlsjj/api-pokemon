<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PokemonSeeder extends Seeder
{
    public function run()
    {
        $this->fetchPokemonData();
    }


    private function fetchPokemonData(): void
    {
        $url = 'https://pokeapi.co/api/v2/pokemon?offset=0&limit=517';
        $maxBatchSize = 100; // Limite de URLs por batch
        $response = Http::get($url);

        if (!$response->successful()) {
            throw new Exception('Erro ao buscar dados da API.');
        }

        $data = $response->json();
        $pokemonUrls = array_column($data['results'], 'url');
        $currentBatch = [];

        foreach ($pokemonUrls as $pokemonUrl) {
            $currentBatch[] = $pokemonUrl;

            if (count($currentBatch) === $maxBatchSize) {
                $this->processAndSavePokemonBatch($currentBatch);
                $currentBatch = [];
            }
        }

        if (!empty($currentBatch)) {
            $this->processAndSavePokemonBatch($currentBatch);
        }
    }

    private function processAndSavePokemonBatch(array $pokemonUrls): void
    {
        $responses = Http::pool(fn(Pool $pool) =>
        array_map(fn($url) => $pool->get($url), $pokemonUrls)
        );

        $pokemonData = [];
        foreach ($responses as $response) {
            if ($response->successful()) {
                $details = $response->json();
                $pokemonData[] = [
                    'nome' => $details['name'],
                    'peso' => $details['weight'],
                    'altura' => $details['height'],
                    'tipo' => $details['types'][0]['type']['name'] ?? null,
                    'created_at' => Carbon::now(),
                ];
            }
        }

        if (!empty($pokemonData)) {
            DB::table('pokemon')->insert($pokemonData);
        }

        dump(count($pokemonData) . " Pokémon salvos no banco.");
    }

}
