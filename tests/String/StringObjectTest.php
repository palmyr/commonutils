<?php

declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\String;

use Palmyr\CommonUtils\String\StringObject;
use PHPUnit\Framework\TestCase;

class StringObjectTest extends TestCase
{
    public function testExplode(): void
    {
        $string = new StringObject('This is a test string');

        $items = $string->explode(' ');

        $this->assertCount(5, $items);
    }

    /**
     * @return void
     * @covers ArrayCollection::implode
     */
    public function testImplode(): void
    {
        $items = StringObject::createFromArray(['This', 'is', 'a', 'test', 'string']);

        $result = $items->implode(' ');

        $this->assertEquals('This is a test string', (string)$result);
    }
}
