<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\Classes;

use Palmyr\CommonUtils\Collection\ArrayCollection;
use Palmyr\CommonUtils\Collection\Collection;

trait CreateClassTrait
{

    /**
     * @return object
     */
    static public function create(): object
    {
        $params = func_get_args();
        return new static(...$params);
    }

    static public function createFromArray(array $items): Collection
    {
        $items = array_map(static::class . '::create', $items);

        return new ArrayCollection($items);
    }

}