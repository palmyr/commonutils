<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Reader;

use Palmyr\CommonUtils\SimpleCsv\AbstractSimpleCsv;
use Palmyr\CommonUtils\SimpleCsv\SimpleCsvInterface;

class CsvReader extends AbstractSimpleCsv implements CsvReaderInterface
{

    public function get(): \Generator
    {
        while ( $row = $this->rawGet() ) {
            if ( count($row) === 1 && $row[0] === null) {
                /* Here in the case it is the last row send return*/
                return;
            }
            yield $row;
        }
    }

    protected function loadRawResource(): \SplFileObject
    {
        return new \SplFileObject($this->getFileName());
    }

    protected function loadResource(): SimpleCsvInterface
    {
        parent::loadResource();

        $headers = $this->rawGet();

        $this->setHeaders($headers);

        return $this;
    }

    private function rawGet(): array
    {
        return $this->getResource()->fgetcsv();
    }
}