<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Converter;

use Palmyr\CommonUtils\InternetProtocol\Mask\Mask;
use Palmyr\Commonutils\InternetProtocol\Mask\MaskInterface;
use Palmyr\CommonUtils\InternetProtocol\Range\Range;
use Palmyr\CommonUtils\InternetProtocol\Range\RangeInterface;

class SubnetConverter implements SubnetConverterInterface
{

    public function RangeToMask(RangeInterface $range): MaskInterface
    {

        $pieces = str_split(str_pad(str_pad('', (int)$range->getString(), '1'), 32, '0'), 8);

        $pieces = array_map('bindec', $pieces);

        return new Mask(join('.', $pieces));


    }

    public function MaskToRange(MaskInterface $mask): RangeInterface
    {
        $pieces = explode('.', $mask->getString());

        $pieces = array_map('intval', $pieces);
        $pieces = array_map('decbin', $pieces);
        $maskString = str_replace('0', '', implode('', $pieces));

        return new Range(strlen($maskString));
    }
}