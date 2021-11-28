<?php declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\InternetProtocol\Netmask;

use Palmyr\CommonUtils\InternetProtocol\Builder\NetmaskBuilder;
use Palmyr\CommonUtils\InternetProtocol\Converter\SubnetConverter;
use PHPUnit\Framework\TestCase;

class NetmaskTest extends TestCase
{

    protected NetmaskBuilder $builder;

    

    protected function setUp(): void
    {
        parent::setUp();
        $this->builder = new NetmaskBuilder(new SubnetConverter());
    }
}