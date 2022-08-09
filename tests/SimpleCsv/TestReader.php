<?php

declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\SimpleCsv;

use Palmyr\CommonUtils\SimpleCsv\Reader\CsvReader;
use PHPUnit\Framework\TestCase;

class TestReader extends TestCase
{
    protected const VERIFY_FILE = __DIR__ . '/Resources/verify.csv';

    protected const HEADERS = ["Header1", "Header2", "Header3"];

    /**
     * @return void
     * @covers CsvReader::getHeaders
     */
    public function testHeaders(): void
    {
        $reader = new CsvReader(self::VERIFY_FILE);

        $this->assertEquals(self::HEADERS, $reader->getHeaders());
    }

    /**
     * @return void
     * @covers CsvReader::get
     */
    public function testRead(): void
    {
        $reader = new CsvReader(self::VERIFY_FILE);

        foreach ($reader->getIterator() as $rowNumber => $row) {
            $this->assertIsArray($row);
            $this->assertCount(3, $row);
            $baseRowValue = $rowNumber * count(self::HEADERS);
            foreach ( self::HEADERS as $headerkey => $header ) {
                $expectedValue = "Value" . (string)($baseRowValue + $headerkey + 1);

                $this->assertEquals($expectedValue, $row[$header]);
            }
        }
    }
}
