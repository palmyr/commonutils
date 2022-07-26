<?php declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\SimpleCsv;

use Palmyr\CommonUtils\FileSystem\FileSystem;
use Palmyr\CommonUtils\FileSystem\FileSystemInterface;
use Palmyr\CommonUtils\SimpleCsv\Writer\CsvWriter;
use PHPUnit\Framework\TestCase;

class TestWriter extends TestCase
{

    protected const RESOURCE_DIRECTORY = __DIR__ . '/Resources';

    protected const VERIFY_FILE = self::RESOURCE_DIRECTORY . '/verify.csv';


    protected FileSystemInterface $fileSystem;

    /**
     * @return void
     * @covers CsvWriter
     * @dataProvider csvDataProvider
     */
    public function testWrite(array $headers, array $rows): void
    {
        $fileName = self::RESOURCE_DIRECTORY . '/test.csv';
        $headers = ["Header1", "Header2", "Header3"];
        $headersCount = count($headers);
        $writer = new CsvWriter($fileName, $headers);

        $this->fileSystem->remove($fileName);

        $this->assertFileDoesNotExist($fileName);

        foreach ( $rows as $row ) {
            $writer->put($row);
        }

        $this->assertFileExists($fileName);

        $this->assertEquals(file_get_contents($fileName), file_get_contents(self::VERIFY_FILE));
    }

    public function csvDataProvider(): array
    {
        return [
            [
                ["Header1", "Header2", "Header3"],
                [
                    ["Header1" => "Value1", "Header2" => "Value2", "Header3" => "Value3"],
                    ["Header2" => "Value5", "Header1" => "Value4", "Header3" => "Value6"],
                    ["Header3" => "Value9", "Header2" => "Value8", "Header1" => "Value7"],
                ]
            ]
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->fileSystem = new FileSystem();
    }
}