<?php

namespace Modules\Pokemon\Application\Filters;

readonly class PokemonFilter
{
    public function __construct(
        public ?string $nome = null,
        public ?string $tipo = null
    ){}
}
