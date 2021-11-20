<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Builder;

use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDRInterface;
use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverterInterface;
use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4;
use Palmyr\CommonUtils\InternetProtocol\Mask\Mask;
use Palmyr\CommonUtils\InternetProtocol\Netmask\Netmask;
use Palmyr\CommonUtils\InternetProtocol\Netmask\NetmaskInterface;

class NetmaskBuilder implements NetmaskBuilderInterface
{

    protected SubnetConverterInterface $subnetConverter;

    public function __construct(
        SubnetConverterInterface $subnetConverter
    )
    {
        $this->subnetConverter = $subnetConverter;
    }

    public function build(string $ipv4, string $mask): NetmaskInterface
    {
        return new Netmask(
            new IPV4($ipv4),
            new Mask($mask),
        );
    }

    public function buildFromCIDR(CIDRInterface $CIDR): NetmaskInterface
    {
        return $this->subnetConverter->CIDRToNetmask($CIDR);
    }
}