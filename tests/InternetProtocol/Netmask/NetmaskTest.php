<?php

declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\InternetProtocol\Netmask;

use Palmyr\CommonUtils\InternetProtocol\Builder\NetmaskBuilder;
use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverter;
use PHPUnit\Framework\TestCase;
use Palmyr\CommonUtils\InternetProtocol\Exception\ValidationException;

class NetmaskTest extends TestCase
{
    protected NetmaskBuilder $builder;


    /**
     * @param string $value
     * @return void
     * @throws ValidationException
     * @dataProvider netmaskProvider
     * @covers NetmaskBuilder::build
     */
    public function testNetMask(string $value): void
    {
        $netmask = $this->builder->build($value);

        $this->assertEquals($value, (string)$netmask);
    }

    /**
     * @return array<int,array<int,string>>
     */
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
