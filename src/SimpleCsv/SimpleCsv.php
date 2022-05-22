<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv;

abstract class SimpleCsv
{

    protected \SplFileObject $resource;

    protected function __construct(
        \SplFileObject $resource
    )
    {
        $this->resource = $resource;
    }

    public function __destruct()
    {
        if ( isset($this->resource) ) {
            unset($this->resource);
        }
    }

    protected function loadResource(string $fileName, string $mode)
}