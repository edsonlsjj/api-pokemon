<?php

namespace App\Domain\Filters;

readonly class PokemonFilter
{
    public function __construct(
        public ?string $nome = null,
        public ?string $tipo = null
    ){}
}
