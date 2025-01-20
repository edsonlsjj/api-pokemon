<?php

namespace Modules\Pokemon\Domain\Collections;

use Modules\Pokemon\Domain\Entities\Pokemon;
use Modules\Shared\Application\Traits\Paginatable;
use Modules\Shared\Domain\Collections\Collection;


/**
 * @property Pokemon[] $items
 */
class PokemonCollection extends Collection
{
    use Paginatable;
}
