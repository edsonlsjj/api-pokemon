<?php
namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\AlturaVO;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AlturaVOTest extends TestCase
{
    public function test_valid_altura_vo(): void
    {
        $altura = new AlturaVO(150);
        $this->assertEquals(1500, $altura->getCm());
        $this->assertEquals(150, $altura->getRaw());
    }

    public function test_negative_altura_throws_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Altura não pode ser negativa.');

        new AlturaVO(-5);
    }
}
