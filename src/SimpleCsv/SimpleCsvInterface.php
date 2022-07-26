<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\SimpleCsv;

interface SimpleCsvInterface
{
    public function getFileName(): string;

    public function getHeaders(): array;
}
