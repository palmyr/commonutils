<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Converter;

use Palmyr\Commonutils\InternetProtocol\Mask\MaskInterface;
use Palmyr\CommonUtils\InternetProtocol\Range\RangeInterface;

interface SubnetConverterInterface
{
    public function RangeToMask(RangeInterface $range): MaskInterface;

    public function MaskToRange(MaskInterface $mask): RangeInterface;
}
