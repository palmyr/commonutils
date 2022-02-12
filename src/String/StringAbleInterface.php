<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\String;

interface StringAbleInterface
{
    public function getString(): string;

    public function __toString(): string;
}
