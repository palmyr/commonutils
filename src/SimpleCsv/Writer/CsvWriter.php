<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv\Writer;

class CsvWriter implements CsvWriterInterface
{

    protected string $fileName;

    protected array $headers;

    /**
     * @var resource
     */
    protected $resource;

    public function __construct(
        string $fileName,
        array $headers
    )
    {
        $this->fileName = $fileName;
        $this->headers = $headers;
    }

    public function put(array $data): CsvWriterInterface
    {
        $this->loadResource();
        fputcsv($this->resource, $data);

        return $this;
    }

    protected function loadResource(): void
    {
        if ( !is_resource($this->resource) ) {
            $this->resource = fopen($this->fileName, 'w');

            $this->put($this->headers);
        }
    }
}