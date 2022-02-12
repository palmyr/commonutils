<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\String;

use Palmyr\CommonUtils\Collection\Collection;

interface StringInterface
{
    /**
     * @param string $separator
     * @param int $limit
     * @return Collection<string>
     */
    public function explode(string $separator, int $limit = PHP_INT_MAX): Collection;
}
