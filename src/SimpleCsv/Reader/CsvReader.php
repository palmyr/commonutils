<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Reader;

use Palmyr\CommonUtils\FileSystem\Exception\FileSystemException;
use Palmyr\CommonUtils\SimpleCsv\SimpleCsv;

class SimpleCsvReader extends SimpleCsv implements CsvReaderInterface
{

    protected array $headers;


    public static function createFromPath(string $fileName, string $mode = 'r'): CsvReaderInterface
    {
        return new static(new \SplFileObject($fileName, $mode));
    }


    public function headers(): array
    {
        return $this->headers;
    }

    public function get(): \Generator
    {

    }


}