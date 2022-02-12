<?php

declare(strict_types=1);

namespace Tests\Palmyr\Commonutils\InternetProtocol\CIDR;

use Palmyr\CommonUtils\InternetProtocol\Builder\CIDRBuilder;
use Palmyr\CommonUtils\InternetProtocol\Builder\CIDRBuilderInterface;
use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverter;
use Palmyr\CommonUtils\InternetProtocol\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class CIDRTest extends TestCase
{
    protected CIDRBuilderInterface $builder;

    /**
     * @dataProvider CIDRDateProvider
     * @covers CIDRBuilder::build
     */
    public function testCIDR(string $value): void
    {
        $cidr = $this->builder->build($value);

        $this->assertEquals($value, $cidr->getString());
    }

    public function CIDRDateProvider(): array
    {
        return [
            ['192.168.1.0/24'],
            ['172.12.0.0/24'],
            ['192.168.1.255/32'],
            ['0.0.0.0/0'],
        ];
    }

    /**
     * @covers CIDRBuilder::build
     */
    public function testOutOfIPV4(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectErrorMessage('he provided ipv4 is out of range');

        $this->builder->build('256.255.255.255/0');
    }

    /**
     * @covers CIDRBuilder::build
     */
    public function testOutOfRange(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectErrorMessage('Range is outside of allowed values');

        $this->builder->build('255.255.255.255/33');
    }

    /**
     * @covers CIDRBuilder::build
     */
    public function testInvalidCIDR(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectErrorMessage('The given value is not a valid CIDR');

        $this->builder->build('255.255.255.255');
    }

    /**
     * @covers CIDRBuilder::build
     */
    public function testInvalidIPV4(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectErrorMessage('The provided ipv4 is not correctly formatted');

        $this->builder->build('255.255.255.255.255/0');
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new CIDRBuilder(new SubnetConverter());
    }
}
