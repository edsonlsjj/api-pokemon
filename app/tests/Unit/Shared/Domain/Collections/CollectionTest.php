<?php

namespace Tests\Unit\Shared\Domain\Collections;

use ArrayIterator;
use Modules\Shared\Domain\Collections\Collection;
use Tests\Unit\Shared\Mocks\MockEntity;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    public function test_can_add_items_to_collection(): void
    {
        $mockItem = $this->createMock(MockEntity::class);
        $collection = new TestCollection();

        $collection->add($mockItem);

        $this->assertCount(1, $collection);
        $this->assertSame($mockItem, $collection->getIterator()->current());
    }

    public function test_to_array_converts_items_correctly(): void
    {
        $mockItem = $this->createMock(MockEntity::class);
        $mockItem->method('toArray')->willReturn(['key' => 'value']);

        $collection = new TestCollection([$mockItem]);

        $this->assertSame([['key' => 'value']], $collection->toArray());
    }

    public function test_count_returns_correct_number_of_items(): void
    {
        $mockItem1 = $this->createMock(MockEntity::class);
        $mockItem2 = $this->createMock(MockEntity::class);

        $collection = new TestCollection([$mockItem1, $mockItem2]);

        $this->assertCount(2, $collection);
    }

    public function test_get_iterator_returns_array_iterator(): void
    {
        $mockItem = $this->createMock(MockEntity::class);
        $collection = new TestCollection([$mockItem]);

        $iterator = $collection->getIterator();

        $this->assertInstanceOf(ArrayIterator::class, $iterator);
        $this->assertSame($mockItem, $iterator->current());
    }
}

class TestCollection extends Collection
{
}
