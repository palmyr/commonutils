<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Netmask;

use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4Interface;
use Palmyr\Commonutils\InternetProtocol\Mask\MaskInterface;
use Palmyr\CommonUtils\String\StringAble;

class Netmask extends StringAble implements NetmaskInterface
{
    protected IPV4Interface $IPV4;

    protected MaskInterface $mask;

    public function __construct(
        IPV4Interface $IPV4,
        MaskInterface $mask,
    )
    {
        $this->IPV4 = $IPV4;
        $this->mask = $mask;
        parent::__construct('');
    }

    public function getString(): string
    {
        return $this->IPV4 . ' ' . $this->mask;
    }

    /**
     * @return IPV4Interface
     */
    public function getIPV4(): IPV4Interface
    {
        return $this->IPV4;
    }

    /**
     * @param IPV4Interface $IPV4
     */
    public function setIPV4(IPV4Interface $IPV4): void
    {
        $this->IPV4 = $IPV4;
    }

    /**
     * @return MaskInterface
     */
    public function getMask(): MaskInterface
    {
        return $this->mask;
    }

    /**
     * @param MaskInterface $mask
     */
    public function setMask(MaskInterface $mask): void
    {
        $this->mask = $mask;
    }

}