<?php

namespace Modules\Pokemon\Domain\ValueObjects;

class AlturaVO
{
    private float $altura;

    public function __construct(float $altura)
    {
        if ($altura < 0) {
            throw new \InvalidArgumentException("Altura não pode ser negativa.");
        }

        $this->altura = $altura;
    }

    public function getCm(): float
    {
        return $this->altura * 10;
    }

    public function getRaw(): float
    {
        return $this->altura;
    }
}
