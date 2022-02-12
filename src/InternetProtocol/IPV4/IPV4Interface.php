<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\IPV4;

use Palmyr\CommonUtils\String\StringAbleInterface;

interface IPV4Interface extends StringAbleInterface
{
    public const IPV4_PATTERN = '^(\d+)\.(\d+)\.(\d+)\.(\d+)$';
}
