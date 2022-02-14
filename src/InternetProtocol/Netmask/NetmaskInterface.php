<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Netmask;

use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4Interface;
use Palmyr\CommonUtils\InternetProtocol\Mask\MaskInterface;
use Palmyr\CommonUtils\String\StringAbleInterface;

interface NetmaskInterface extends StringAbleInterface
{
    /**
     * @return IPV4Interface
     */
    public function getIPV4(): IPV4Interface;

    /**
     * @param IPV4Interface $IPV4
     */
    public function setIPV4(IPV4Interface $IPV4): void;

    /**
     * @return MaskInterface
     */
    public function getMask(): MaskInterface;

    /**
     * @param MaskInterface $mask
     */
    public function setMask(MaskInterface $mask): void;
}
