<?php

declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\SimpleCsv;

use Palmyr\CommonUtils\SimpleCsv\Reader\CsvReader;
use PHPUnit\Framework\TestCase;

class TestReader extends TestCase
{
    protected const VERIFY_FILE = __DIR__ . '/Resources/verify.csv';

    public function testRead(): void
    {
        $reader = new CsvReader(self::VERIFY_FILE);

        $this->assertEquals(["Header1", "Header2", "Header3"], $reader->getHeaders());

        $loader = $reader->get();
        foreach ($loader as $itemKey => $row) {
            $this->assertIsArray($row);
            $this->assertCount(3, $row);
            $baseRowValue = $itemKey * 3;
            foreach ($row as $rowKey => $value) {
                $expectedValue = "Value" . (string)($baseRowValue + $rowKey + 1);

                $this->assertEquals($expectedValue, $row[$rowKey]);
            }
        }
    }
}
