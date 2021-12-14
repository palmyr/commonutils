<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Builder;

use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDRInterface;
use Palmyr\CommonUtils\InternetProtocol\Exception\ValidationException;
use Palmyr\CommonUtils\InternetProtocol\Netmask\NetmaskInterface;

interface NetmaskBuilderInterface
{

    public const NETMASK_SEPARATOR = ' ';

    /**
     * @param string $netmask
     * @return NetmaskInterface
     * @throws ValidationException
     */
    public function build(string $netmask): NetmaskInterface;

    public function buildFromCIDR(CIDRInterface $CIDR): NetmaskInterface;
}