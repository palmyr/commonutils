<?php declare(strict_types=1);

namespace Palmyr\Commonutils\InternetProtocol\CIDR;

use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4;
use Palmyr\Commonutils\InternetProtocol\Range\Range;
use Palmyr\CommonUtils\String\StringAble;

class CIDR extends StringAble implements CIDRInterface
{

    protected IPV4 $IPV4;

    protected Range $range;

    public function __construct(
        IPV4 $IPV4,
        Range $range
    )
    {
        parent::__construct('');
        $this->IPV4 = $IPV4;
        $this->range = $range;
    }

    public function getString(): string
    {
        return $this->IPV4 . self::CIDR_SEPARATOR . $this->range;
    }

    /**
     * @return IPV4
     */
    public function getIPV4(): IPV4
    {
        return $this->IPV4;
    }

    /**
     * @param IPV4 $IPV4
     */
    public function setIPV4(IPV4 $IPV4): void
    {
        $this->IPV4 = $IPV4;
    }

    /**
     * @return Range
     */
    public function getRange(): Range
    {
        return $this->range;
    }

    /**
     * @param Range $range
     */
    public function setRange(Range $range): void
    {
        $this->range = $range;
    }

}