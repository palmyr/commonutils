<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Converter;

use Palmyr\CommonUtils\InternetProtocol\Mask\Mask;
use Palmyr\CommonUtils\InternetProtocol\Mask\MaskInterface;
use Palmyr\CommonUtils\InternetProtocol\Range\Range;
use Palmyr\CommonUtils\InternetProtocol\Range\RangeInterface;

class SubnetConverter implements SubnetConverterInterface
{
    public function rangeToMask(RangeInterface $range): MaskInterface
    {
        $pieces = str_split(str_pad(str_pad('', (int)$range->toString(), '1'), 32, '0'), 8);

        $pieces = array_map('bindec', $pieces);

        return new Mask(join('.', $pieces));
    }

    public function maskToRange(MaskInterface $mask): RangeInterface
    {
        $pieces = explode('.', $mask->toString());

        $pieces = array_map('intval', $pieces);
        $pieces = array_map('decbin', $pieces);
        $maskString = str_replace('0', '', implode('', $pieces));

        return new Range(strlen($maskString));
    }
}
