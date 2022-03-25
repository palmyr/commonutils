<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractBaseClient implements ClientInterface
{

    private LoggerInterface $logger;

    private Client $client;

    public function __construct(
        Client $client,
        LoggerInterface $logger = null
    )
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function request(string $method, string $uri, array $options = []): ResponseInterface
    {

        $this->log('debug', 'calling endpoint');

        try {
            $response = $this->client->request($method, $uri, $options);

            return $response;
        } catch ( GuzzleException $e ) {
            $this->log('error', $e);

            throw $e;
        }
    }


    protected function log($level, string|\Stringable $message, array $context = []): void
    {
        if ( isset( $this->logger) ) {
            $this->logger->log($level, $message, $context);
        }
    }
}