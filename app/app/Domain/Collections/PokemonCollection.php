<?php

namespace App\Domain\Collections;

use App\Domain\Entities\PokemonEntity;
use App\Domain\Traits\Paginatable;
use ArrayIterator;
use Countable;
use IteratorAggregate;

class PokemonCollection implements IteratorAggregate, Countable
{
    use Paginatable;

    /**
     * @var PokemonEntity[]
     */
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
     * @param PokemonEntity $pokemon
     * @return void
     */
    public function add(PokemonEntity $pokemon): void
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
        return array_map(fn(PokemonEntity $pokemon) => $pokemon->toArray(), $this->items);
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
