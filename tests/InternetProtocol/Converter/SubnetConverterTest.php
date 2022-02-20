<?php

declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\InternetProtocol\Converter;

use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverter;
use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverterInterface;
use Palmyr\CommonUtils\InternetProtocol\Mask\Mask;
use Palmyr\CommonUtils\InternetProtocol\Range\Range;
use PHPUnit\Framework\TestCase;

class SubnetConverterTest extends TestCase
{
    protected SubnetConverterInterface $subnetConverter;

    /**
     * @dataProvider rangeDataProvider
     * @covers SubnetConverter::rangeToMask
     */
    public function testConvertRangeToMask(int $range, string $result): void
    {
        $range = new Range($range);

        $mask = $this->subnetConverter->rangeToMask($range);

        $this->assertEquals($result, $mask);
    }

    /**
     * @dataProvider maskDataProvider
     * @covers SubnetConverter::maskToRange
     */
    public function testConvertMaskToRange(string $mask, int $result): void
    {
        $mask = new Mask($mask);

        $range = $this->subnetConverter->maskToRange($mask);

        $this->assertEquals($result, $range->getValue());
    }

    /**
     * @return array<int,array<int,string|int>>
     */
    public function rangeDataProvider(): array
    {
        return $this->baseDataProvider();
    }

    /**
     * @return array<int,array<int,string|int>>
     */
    public function maskDataProvider(): array
    {
        $data = $this->baseDataProvider();

        $data = array_map(function (array $item): array {
            return array_reverse($item);
        }, $data);

        return $data;
    }

    /**
     * @return array<int,array<int,string|int>>
     */
    protected function baseDataProvider(): array
    {
        return [
            [32, '255.255.255.255'],
            [31, '255.255.255.254'],
            [30, '255.255.255.252'],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->subnetConverter = new SubnetConverter();
    }
}
