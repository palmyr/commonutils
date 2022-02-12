<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Builder;

use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDR;
use Palmyr\CommonUtils\InternetProtocol\CIDR\CIDRInterface;
use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverterInterface;
use Palmyr\CommonUtils\InternetProtocol\Exception\ValidationException;
use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4;
use Palmyr\CommonUtils\InternetProtocol\Netmask\NetmaskInterface;
use Palmyr\CommonUtils\InternetProtocol\Range\Range;

class CIDRBuilder extends AbstractBuilder implements CIDRBuilderInterface
{
    protected SubnetConverterInterface $subnetConverter;

    public function __construct(
        SubnetConverterInterface $subnetConverter
    ) {
        $this->subnetConverter = $subnetConverter;
    }

    /**
     * @param string $cidr
     * @return CIDRInterface
     * @throws ValidationException
     */
    public function build(string $cidr): CIDRInterface
    {
        list($ipv4, $range) = $this->parse($cidr);

        $this->validateIPV4($ipv4);
        $this->validateRange($range);

        return new CIDR(
            new IPV4($ipv4),
            new Range($range),
        );
    }

    public function buildFromNetmask(NetmaskInterface $netmask): CIDRInterface
    {
        $range = $this->subnetConverter->MaskToRange($netmask->getMask());

        return new CIDR($netmask->getIPV4(), $range);
    }

    /**
     * @param string $value
     * @return array
     * @throws ValidationException
     */
    protected function parse(string $value): array
    {
        $pieces = explode(CIDRInterface::CIDR_SEPARATOR, $value);

        if (count($pieces) !== 2) {
            throw new ValidationException('The given value is not a valid CIDR');
        }

        $pieces[1] = (int)$pieces[1];

        return $pieces;
    }

    /**
     * @param int $range
     * @throws ValidationException
     */
    protected function validateRange(int $range): void
    {
        if ($range < self::RANGE_MINIMUM || $range > self::RANGE_MAXIMUM) {
            throw new ValidationException('Range is outside of allowed values');
        }
    }
}
