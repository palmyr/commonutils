<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Range;

use Palmyr\CommonUtils\String\StringableInterface;

interface RangeInterface extends StringableInterface
{
    public function getValue(): int;
}
