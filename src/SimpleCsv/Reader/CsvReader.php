<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Reader;

use Palmyr\CommonUtils\SimpleCsv\AbstractSimpleCsv;
use Palmyr\CommonUtils\SimpleCsv\Exception\CsvException;
use Palmyr\CommonUtils\SimpleCsv\SimpleCsvInterface;

class CsvReader extends AbstractSimpleCsv implements CsvReaderInterface
{
    public function getIterator(): \Generator
    {
        $this->loadResource();
        while ($row = $this->rawGet()) {
            if (count($row) === 1 && $row[0] === null) {
                /* Here in the case it is an empty row we skip it */
                continue;
            }
            $mappedRows = $this->mapHeaders($row);

            yield $mappedRows;
        }
    }

    public function toArray(): array
    {
        $rows = [];

        foreach ($this->getIterator() as $row) {
            $rows[] = $row;
        }

        return $rows;
    }

    protected function loadRawResource(): \SplFileObject
    {
        return new \SplFileObject($this->getFileName());
    }

    protected function loadResource(): SimpleCsvInterface
    {
        parent::loadResource();

        if (!$this->headersLoaded()) {
            $headers = $this->rawGet();
            $this->setHeaders($headers);
        }

        return $this;
    }

    private function mapHeaders(array $row): array
    {

        $rowCount = count($row);

        if ($this->getHeadersCount() !== $rowCount) {
            throw new CsvException("the header count does not match");
        }

        $headers = $this->getHeaders();

        $mappedRows = [];

        foreach ($row as $key => $value) {
            $header = $headers[$key];
            $mappedRows[$header] = $value;
        }

        return $mappedRows;
    }

    private function rawGet(): ?array
    {
        if ($row = $this->getResource()->fgetcsv()) {
            return $row;
        }
        return null;
    }
}
