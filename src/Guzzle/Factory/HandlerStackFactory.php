<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\Guzzle\Factory;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Log\LoggerInterface;

class HandlerStackFactory implements HandlerStackFactoryInterface
{

    protected array $stack = [];

    protected ?LoggerInterface $logger;

    public function __construct(
        LoggerInterface $logger = null
    )
    {
        $this->logger = $logger;
    }

    public function createHandlerStack(): HandlerStack
    {
        $handlerStack = HandlerStack::create();

        foreach ( $this->stack as $handler ) {
            $handlerStack->push($handler);
        }

        if ( isset($this->logger) ) {
            $handlerStack->push(Middleware::log(
                $this->logger,
                new MessageFormatter()
            ));
        }

        return $handlerStack;
    }

    public function push(callable $handler, string $name = ""): HandlerStackFactoryInterface
    {
        $this->stack[] = [$handler, $name];

        return $this;
    }
}