<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\String;

use Palmyr\CommonUtils\Collection\Collection;

interface StringInterface
{
    public function explode(string $separator, int $limit = PHP_INT_MAX): Collection;
}
