<?php

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\PesoVO;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PesoVOTest extends TestCase
{
    public function test_valid_peso_vo(): void
    {
        $peso = new PesoVO(100);
        $this->assertEquals(10, $peso->getKg());
        $this->assertEquals(100, $peso->getRaw());
    }

    public function test_negative_peso_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Peso não pode ser negativo.');

        new PesoVO(-10);
    }
}
