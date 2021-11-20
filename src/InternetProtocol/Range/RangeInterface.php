<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Range;

use Palmyr\CommonUtils\String\StringAbleInterface;

interface RangeInterface extends StringAbleInterface
{

    public function getValue(): int;
}