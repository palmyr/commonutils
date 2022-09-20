<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\Guzzle\Factory;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

interface ClientFactoryInterface
{

    public function createClient(array $options = [], HandlerStack $handlerStack = null): Client;
}