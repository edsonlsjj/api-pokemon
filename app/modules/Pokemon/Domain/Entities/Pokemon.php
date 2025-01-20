<?php

namespace Modules\Pokemon\Domain\Entities;

use Modules\Pokemon\Domain\ValueObjects\AlturaVO;
use Modules\Pokemon\Domain\ValueObjects\PesoVO;

readonly class Pokemon
{
    public function __construct(
        public ?int      $id,
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
