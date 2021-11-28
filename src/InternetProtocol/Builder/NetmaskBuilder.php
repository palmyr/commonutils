<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Builder;

use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDRInterface;
use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverterInterface;
use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4;
use Palmyr\CommonUtils\InternetProtocol\Mask\Mask;
use Palmyr\CommonUtils\InternetProtocol\Netmask\Netmask;
use Palmyr\CommonUtils\InternetProtocol\Netmask\NetmaskInterface;
use Palmyr\CommonUtils\InternetProtocol\Exception\ValidationException;

class NetmaskBuilder extends AbstractBuilder implements NetmaskBuilderInterface
{

    protected SubnetConverterInterface $subnetConverter;

    public function __construct(
        SubnetConverterInterface $subnetConverter
    )
    {
        $this->subnetConverter = $subnetConverter;
    }

    /**
     * @param string $ipv4
     * @param string $mask
     * @return NetmaskInterface
     * @throws ValidationException
     */
    public function build(string $ipv4, string $mask): NetmaskInterface
    {

        $this->validateIPV4($ipv4);
        $this->validateMask($mask);

        return new Netmask(
            new IPV4($ipv4),
            new Mask($mask),
        );
    }

    public function buildFromCIDR(CIDRInterface $CIDR): NetmaskInterface
    {
        $mask = $this->subnetConverter->RangeToMask($CIDR->getRange());

        return new Netmask($CIDR->getIPV4(), $mask);
    }

    /**
     * @param string $mask
     * @throws ValidationException
     */
    protected function validateMask(string $mask): void
    {
        $this->validateIPV4($mask);
    }
}