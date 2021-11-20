<?php declare(strict_types=1);

namespace Tests\Palmyr\Commonutils\InternetProtocol\CIDR;

use Palmyr\CommonUtils\InternetProtocol\Builder\CIDRBuilder;
use Palmyr\CommonUtils\InternetProtocol\Builder\CIDRBuilderInterface;
use PHPUnit\Framework\TestCase;

class CIDRTest extends TestCase
{

    protected CIDRBuilderInterface $builder;

    /**
     * @dataProvider CIDRDateProvider
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
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new CIDRBuilder();
    }
}