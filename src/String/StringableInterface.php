<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\String;

interface StringableInterface extends \Stringable
{
    public function toString(): string;

    public function __toString(): string;
}
