<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Writer;

interface CsvWriterInterface
{

    public function put(array $data): CsvWriterInterface;

}