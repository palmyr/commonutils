<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Builder;

use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDRInterface;
use Palmyr\CommonUtils\InternetProtocol\Exception\ValidationException;
use Palmyr\CommonUtils\InternetProtocol\Netmask\NetmaskInterface;

interface CIDRBuilderInterface
{
    public const RANGE_MINIMUM = 0;

    public const RANGE_MAXIMUM = 32;

    /**
     * @param  string $cidr
     * @return CIDRInterface
     * @throws ValidationException
     */
    public function build(string $cidr): CIDRInterface;

    public function buildFromNetmask(NetmaskInterface $netmask): CIDRInterface;
}
