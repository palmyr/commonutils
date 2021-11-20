<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Builder;

use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDR;
use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDRInterface;
use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverterInterface;
use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4;
use Palmyr\CommonUtils\InternetProtocol\Netmask\NetmaskInterface;
use Palmyr\CommonUtils\InternetProtocol\Range\Range;

class CIDRBuilder implements CIDRBuilderInterface
{

    protected SubnetConverterInterface $subnetConverter;

    public function __construct(
        SubnetConverterInterface $subnetConverter
    )
    {
        $this->subnetConverter = $subnetConverter;
    }

    public function build(string $cidr): CIDRInterface
    {
        list($ipv4, $range) = $this->parse($cidr);

        return new CIDR(
            new IPV4($ipv4),
            new Range($range),
        );
    }

    public function buildFromNetmask(NetmaskInterface $netmask): CIDRInterface
    {
        return $this->subnetConverter->NetmaskToCIDR($netmask);
    }

    protected function parse(string $value): array
    {
        $pieces = explode(CIDRInterface::CIDR_SEPARATOR, $value);

        if ( count($pieces) !== 2) {
            throw new \InvalidArgumentException('The given value is not a valid CIDR');
        }

        return $pieces;
    }
}