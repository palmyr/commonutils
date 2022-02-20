<?php

declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\Iterator;

use Palmyr\CommonUtils\Iterator\IteratorArrayIterator;
use PHPUnit\Framework\TestCase;

class IteratorArrayIteratorTest extends TestCase
{
    /**
     * @return void
     * @covers IteratorArrayIterator::current
     */
    public function testMultipleIterators(): void
    {
        $values = [
            'value1',
            'value2',
            'value3',
            'value4',
            'value5',
            'value6',
            'value7',
            'value8',
            'value9',
        ];

        $iterator1 = new \ArrayIterator([
            'value1',
            'value2',
            'value3',
        ]);
        $iterator2 = new \ArrayIterator([
            'value4',
            'value5',
            'value6',
        ]);
        $iterator3 = new \ArrayIterator([
            'value7',
            'value8',
            'value9',
        ]);

        $iteratorMultiple = new IteratorArrayIterator([
            $iterator1,
            $iterator2,
            $iterator3,
        ]);

        foreach ($iteratorMultiple as $key => $value) {
            $this->assertEquals($values[$key], $value);
        }
    }
}
