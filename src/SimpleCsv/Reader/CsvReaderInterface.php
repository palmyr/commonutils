<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Reader;

use Palmyr\CommonUtils\SimpleCsv\SimpleCsvInterface;

interface CsvReaderInterface extends SimpleCsvInterface
{
    public function getIterator(): \Iterator;

    public function toArray(): array;
}
