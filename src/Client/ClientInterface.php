<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\Client;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{

    public function request(string $method, string $uri, array $options = []): ResponseInterface;

}