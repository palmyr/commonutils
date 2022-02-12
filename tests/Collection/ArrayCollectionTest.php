<?php

declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\Collection;

use Palmyr\CommonUtils\Collection\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ArrayCollectionTest extends TestCase
{
    public function testCount(): void
    {
        $obj = new ArrayCollection([1,2,3]);

        $this->assertCount(3, $obj);
    }

    public function testGet(): void
    {
        $obj = new ArrayCollection([
            'key1' => 'pippo',
            'key2' => 'pluto',
            'key3' => 'goofy',
        ]);

        $this->assertEquals('goofy', $obj->get('key3'));
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
