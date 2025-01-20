<?php

namespace Modules\Shared\Domain\Collections;

use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class Collection implements IteratorAggregate, Countable
{
    private array $items = [];

    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * Add a PokemonEntity to the collection.
     *
     * @param object $pokemon
     * @return void
     */
    public function add(object $pokemon): void
    {
        $this->items[] = $pokemon;
    }

    /**
     * Get all items in the collection as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(fn(object $pokemon) => $pokemon->toArray(), $this->items);
    }

    /**
     * Get the number of items in the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Get an iterator for the collection.
     *
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }
}
