<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Reader;

interface CsvReaderInterface
{

    static public function createFromPath(string $fileName, string $mode = 'r'): CsvReaderInterface;

    /**
     * @return array<int,mixed>
     */
    public function headers(): array;

    /**
     * @return \Generator
     */
    public function get(): \Generator;
}