<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\CIDR;

use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4Interface;
use Palmyr\CommonUtils\InternetProtocol\Range\RangeInterface;
use Palmyr\CommonUtils\String\StringAbleInterface;

interface CIDRInterface extends StringAbleInterface
{
    public const CIDR_SEPARATOR = '/';

    /**
     * @return IPV4Interface
     */
    public function getIPV4(): IPV4Interface;

    /**
     * @param IPV4Interface $IPV4
     */
    public function setIPV4(IPV4Interface $IPV4): void;

    /**
     * @return RangeInterface
     */
    public function getRange(): RangeInterface;

    /**
     * @param RangeInterface $range
     */
    public function setRange(RangeInterface $range): void;
}
