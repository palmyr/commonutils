<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv;

abstract class AbstractSimpleCsv implements SimpleCsvInterface
{
    private string $fileName;

    private array $headers;

    private \SplFileObject $resource;

    public function __construct(
        string $fileName
    ) {
        $this->fileName = $fileName;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getHeaders(): array
    {
        $this->loadResource();

        return $this->headers;
    }

    protected function loadResource(): SimpleCsvInterface
    {
        if (!isset($this->resource)) {
            $this->resource = $this->loadRawResource();
        }
        return $this;
    }

    abstract protected function loadRawResource(): \SplFileObject;

    protected function setHeaders(array $headers): SimpleCsvInterface
    {
        $this->headers = $headers;

        return $this;
    }

    protected function getResource(): \SplFileObject
    {
        return $this->resource;
    }
}
