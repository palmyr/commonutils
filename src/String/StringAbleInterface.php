<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\String;

interface StringAbleInterface
{
    public function toString(): string;

    public function __toString(): string;
}
