<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\CIDR;

use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4Interface;
use Palmyr\CommonUtils\InternetProtocol\Range\RangeInterface;
use Palmyr\CommonUtils\String\StringAble;

class CIDR extends StringAble implements CIDRInterface
{
    protected IPV4Interface $IPV4;

    protected RangeInterface $range;

    public function __construct(
        IPV4Interface $IPV4,
        RangeInterface $range
    ) {
        parent::__construct('');
        $this->IPV4 = $IPV4;
        $this->range = $range;
    }

    public function getString(): string
    {
        return $this->IPV4 . self::CIDR_SEPARATOR . $this->range;
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
     * @return RangeInterface
     */
    public function getRange(): RangeInterface
    {
        return $this->range;
    }

    /**
     * @param RangeInterface $range
     */
    public function setRange(RangeInterface $range): void
    {
        $this->range = $range;
    }
}
