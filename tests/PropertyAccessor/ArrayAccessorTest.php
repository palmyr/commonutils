<?php declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\PropertyAccessor;

use Palmyr\CommonUtils\PropertyAccessor\ArrayAccessor;
use Palmyr\CommonUtils\PropertyAccessor\ArrayAccessorInterface;
use PHPUnit\Framework\TestCase;

class ArrayAccessorTest extends TestCase
{

    protected ArrayAccessorInterface $propertyAccessor;

    /**
     * @return void
     * @covers SimplePropertyAccessor::getValue
     * @dataProvider arrayDataProvider
     */
    public function testGetValue(array $value): void
    {

        $this->assertEquals("value1", $this->propertyAccessor->getValue($value, "key1"));
        $this->assertEquals("value2", $this->propertyAccessor->getValue($value, "key2.key3"));
        $this->assertEquals("value3", $this->propertyAccessor->getValue($value, "key2.key4.key5"));
        $this->assertEquals(null, $this->propertyAccessor->getValue($value, "key2.key4.key5.fake"));
    }

    /**
     * @return void
     * @covers SimplePropertyAccessor::hasValue
     * @dataProvider arrayDataProvider
     */
    public function testHasValue(array $value): void
    {
        $this->assertTrue($this->propertyAccessor->hasValue($value, "key1"));
        $this->assertTrue($this->propertyAccessor->hasValue($value, "key2.key3"));
        $this->assertTrue($this->propertyAccessor->hasValue($value, "key2.key4.key5"));
        $this->assertFalse($this->propertyAccessor->hasValue($value, "key2.key4.key5.fake"));
        $this->assertEquals(null, $this->propertyAccessor->getValue($value, "key2.key4.key5.fake"));
    }

    /**
     * @return void
     * @covers SimplePropertyAccessor::setValue
     * @dataProvider arrayDataProvider
     */
    public function testSetValue(array $value): void
    {

        $this->propertyAccessor->setValue($value, "key3", "newvalue1");
        $this->assertEquals("newvalue1", isset($value["key3"]) ? $value["key3"] : null);

        $this->propertyAccessor->setValue($value, "key2.key3", "newvalue2");
        $this->assertEquals("newvalue2", isset($value["key2"]["key3"]) ? $value["key2"]["key3"] : null);

        $this->propertyAccessor->setValue($value, "key2.key3.key5.key6", "newvalue3");
        $this->assertEquals("newvalue3", isset($value["key2"]["key3"]["key5"]["key6"]) ? $value["key2"]["key3"]["key5"]["key6"] : null);
    }

    public function arrayDataProvider(): array
    {
        return [
            [
                [
                    "key1" => "value1",
                    "key2" => [
                        "key3" => "value2",
                        "key4" => [
                            "key5" => "value3"
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->propertyAccessor = new ArrayAccessor();
    }
}