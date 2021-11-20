<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Builder;

use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDRInterface;
use Palmyr\CommonUtils\InternetProtocol\Netmask\NetmaskInterface;

interface CIDRBuilderInterface
{

    public function build(string $cidr): CIDRInterface;

    public function buildFromNetmask(NetmaskInterface $netmask): CIDRInterface;
}