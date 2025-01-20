<?php

namespace Tests\Unit\Pokemon\Domain\Collections;

use ArrayIterator;
use Modules\Pokemon\Domain\Collections\PokemonCollection;
use Tests\Unit\Shared\Mocks\MockEntity;
use Tests\TestCase;

class PokemonCollectionTest extends TestCase
{
    public function test_can_add_items_to_collection(): void
    {
        $mockItem = $this->createMock(MockEntity::class);
        $collection = new PokemonCollection();

        $collection->add($mockItem);

        $this->assertCount(1, $collection);
        $this->assertSame($mockItem, $collection->getIterator()->current());
    }

    public function test_to_array_converts_items_correctly(): void
    {
        $mockItem = $this->createMock(MockEntity::class);
        $mockItem->method('toArray')->willReturn(['key' => 'value']);

        $collection = new PokemonCollection([$mockItem]);

        $this->assertSame([['key' => 'value']], $collection->toArray());
    }

    public function test_set_and_get_pagination_data(): void
    {
        $collection = new PokemonCollection();
        $collection->setPagination(total: 100, perPage: 10, currentPage: 3);

        $expectedPagination = [
            'total' => 100,
            'per_page' => 10,
            'current_page' => 3,
            'last_page' => 10,
        ];

        $this->assertSame($expectedPagination, $collection->getPaginationData());
    }

    public function test_paginate_to_array_merges_data_with_pagination(): void
    {
        $mockItem = $this->createMock(MockEntity::class);
        $mockItem->method('toArray')->willReturn(['name' => 'Pikachu']);

        $collection = new PokemonCollection([$mockItem]);
        $collection->setPagination(total: 100, perPage: 10, currentPage: 1);

        $expected = [
            'total' => 100,
            'per_page' => 10,
            'current_page' => 1,
            'last_page' => 10,
            'data' => [['name' => 'Pikachu']],
        ];

        $this->assertSame($expected, $collection->paginateToArray($collection->toArray()));
    }

    public function test_get_iterator_returns_array_iterator(): void
    {
        $mockItem = $this->createMock(MockEntity::class);
        $collection = new PokemonCollection([$mockItem]);

        $iterator = $collection->getIterator();

        $this->assertInstanceOf(ArrayIterator::class, $iterator);
        $this->assertSame($mockItem, $iterator->current());
    }
}
