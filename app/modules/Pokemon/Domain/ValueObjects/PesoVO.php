<?php

namespace Modules\Pokemon\Domain\ValueObjects;

class PesoVO
{
    private float $peso;

    public function __construct(float $peso)
    {
        if ($peso < 0) {
            throw new \InvalidArgumentException("Peso não pode ser negativo.");
        }

        $this->peso = $peso;
    }

    public function getKg(): float
    {
        return $this->peso / 10;
    }

    public function getRaw(): float
    {
        return $this->peso;
    }
}
