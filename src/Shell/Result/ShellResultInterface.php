<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Shell\Result;

use Palmyr\CommonUtils\String\StringableInterface;

interface ShellResultInterface extends StringableInterface
{
    public function getCode(): int;

    /**
     * @return array<int,string>
     */
    public function getOutput(): array;
}
