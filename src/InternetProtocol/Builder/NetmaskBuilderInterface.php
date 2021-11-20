<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Builder;

use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDRInterface;
use Palmyr\CommonUtils\InternetProtocol\Netmask\NetmaskInterface;

interface NetmaskBuilderInterface
{

    public function build(string $ipv4, string $mask): NetmaskInterface;

    public function buildFromCIDR(CIDRInterface $CIDR): NetmaskInterface;
}