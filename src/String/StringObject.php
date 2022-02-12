<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\String;

use Palmyr\CommonUtils\Classes\CreateClassTrait;
use Palmyr\CommonUtils\Collection\ArrayCollection;
use Palmyr\CommonUtils\Collection\Collection;

class StringObject extends StringAble implements StringInterface
{
    use CreateClassTrait;

    public function explode(string $separator, int $limit = PHP_INT_MAX): Collection
    {
        $pieces = explode($separator, $this->value, $limit);

        return static::createFromArray($pieces);
    }
}
