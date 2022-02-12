<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\CIDR;

use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4;
use Palmyr\Commonutils\InternetProtocol\Range\Range;
use Palmyr\CommonUtils\String\StringAbleInterface;

interface CIDRInterface extends StringAbleInterface
{
    public const CIDR_SEPARATOR = '/';

    /**
     * @return IPV4
     */
    public function getIPV4(): IPV4;

    /**
     * @param IPV4 $IPV4
     */
    public function setIPV4(IPV4 $IPV4): void;

    /**
     * @return Range
     */
    public function getRange(): Range;

    /**
     * @param Range $range
     */
    public function setRange(Range $range): void;
}
