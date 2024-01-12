<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Guzzle\Factory;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class ClientFactory implements ClientFactoryInterface
{
    protected HandlerStackFactoryInterface $handlerStackFactory;

    public function __construct(
        HandlerStackFactoryInterface $handlerStackFactory
    ) {
        $this->handlerStackFactory = $handlerStackFactory;
    }

    public function createClient(array $options = [], HandlerStack $handlerStack = null): Client
    {

        if (!isset($options["handler"]) && is_null($handlerStack)) {
            $options["handler"] = $this->handlerStackFactory->createHandlerStack();
        }

        return new Client($options);
    }

    public static function create(HandlerStackFactoryInterface $handlerStackFactory = null): ClientFactoryInterface
    {

        if (is_null($handlerStackFactory)) {
            $handlerStackFactory = new HandlerStackFactory();
        }

        return new static($handlerStackFactory);
    }
}
