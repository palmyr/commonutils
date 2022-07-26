<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Reader;

use Palmyr\CommonUtils\SimpleCsv\SimpleCsvInterface;

interface CsvReaderInterface extends SimpleCsvInterface
{
    /**
     * @return \Generator
     */
    public function get(): \Generator;
}
