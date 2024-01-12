<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Guzzle\Factory;

use GuzzleHttp\HandlerStack;

interface HandlerStackFactoryInterface
{
    public function push(callable $handler): HandlerStackFactoryInterface;

    public function createHandlerStack(): HandlerStack;
}
