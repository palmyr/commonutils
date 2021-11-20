<?php declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\InternetProtocol\IPV4;

use Palmyr\CommonUtils\InternetProtocol\IPV4\IPV4;
use PHPUnit\Framework\TestCase;

class IPV4Test extends TestCase
{

    public function testString(): void
    {
        $testString = 'pippo';

        $testClass = new IPV4($testString);

        $this->assertEquals($testString, (string)$testClass);
    }
}