<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Writer;

use Palmyr\CommonUtils\SimpleCsv\AbstractSimpleCsv;

class CsvWriter extends AbstractSimpleCsv implements CsvWriterInterface
{

    public function __construct(
        string $fileName,
        array $headers
    )
    {
        parent::__construct($fileName);
        $this->setHeaders($headers);
    }

    public function put(array $data): CsvWriterInterface
    {

        uksort($data, [$this, "sortRow"]);

        $this->putRaw($data);

        return $this;
    }

    protected function loadRawResource(): \SplFileObject
    {
        return new \SplFileObject($this->getFileName(), 'w');
    }

    protected function sortRow(string $headerA, string $headerB): bool
    {
        return array_search($headerA, $this->getHeaders()) > array_search($headerB, $this->getHeaders());
    }

    protected function putRaw(array $data): void
    {
        $this->loadResource();
        $this->getResource()->fputcsv($data);
    }
}