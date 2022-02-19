<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Classes;

use Palmyr\CommonUtils\Collection\ArrayCollection;
use Palmyr\CommonUtils\Collection\Collection;
use Palmyr\CommonUtils\String\StringInterface;

trait CreateClassTrait
{
    /**
     * @return object
     */
    public static function create(): object
    {
        $params = func_get_args();
        return new static(...$params);
    }

    /**
     * @param array $items
     * @return Collection<int|string,mixed>
     */
    public static function createFromArray(array $items): Collection
    {
        $items = array_map(static::class . '::create', $items);

        return new ArrayCollection($items);
    }
}
