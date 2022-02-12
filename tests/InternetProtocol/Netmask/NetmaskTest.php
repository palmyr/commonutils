<?php

declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\InternetProtocol\Netmask;

use Palmyr\CommonUtils\InternetProtocol\Builder\NetmaskBuilder;
use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverter;
use PHPUnit\Framework\TestCase;

class NetmaskTest extends TestCase
{
    protected NetmaskBuilder $builder;


    /**
     * @param string $value
     * @return void
     * @dataProvider netmaskProvider
     * @covers NetmaskBuilder::build
     */
    public function testNetMask(string $value): void
    {
        $netmask = $this->builder->build($value);

        $this->assertEquals($value, (string)$netmask);
    }

    public function netmaskProvider(): array
    {
        return [
            ['192.168.1.0 255.255.255.0'],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new NetmaskBuilder(new SubnetConverter());
    }
}
