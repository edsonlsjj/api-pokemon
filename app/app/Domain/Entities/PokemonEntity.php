<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\AlturaVO;
use App\Domain\ValueObjects\PesoVO;

readonly class PokemonEntity
{
    public function __construct(
        public int      $id,
        public string   $nome,
        public string   $tipo,
        public PesoVO   $peso,
        public AlturaVO $altura
    )
    {

    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'tipo' => $this->tipo,
            'peso_kg' => $this->peso->getKg(),
            'altura_cm' => $this->altura->getCm(),
        ];
    }
}
