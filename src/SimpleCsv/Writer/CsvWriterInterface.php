<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Writer;

use Palmyr\CommonUtils\SimpleCsv\SimpleCsvInterface;

interface CsvWriterInterface extends SimpleCsvInterface
{

    public function put(array $data): CsvWriterInterface;

}