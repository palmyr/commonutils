<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
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
        $this->log(
            "debug",
            "Preparing request",
            ["method" => $method, "uri" => $uri, "options" => $options]
        );

        try {

            $response = $this->client->request($method, $uri, $options);

            $this->log(
                "debug",
                "finished request",
                ["method" => $method, "uri" => $uri, "options" => $options, "body" => $this->getSummaryFromStream($response->getBody())]
            );
            return $response;
        } catch ( BadResponseException $e ) {
            $response = $e->getResponse();
            $this->log(
                "error",
                "There was an error during the request",
                ["method" => $method, "uri" => $uri, "respondCode" => $response->getStatusCode(), "options" => $options, "body" => $this->getSummaryFromStream($response->getBody())]
            );
            throw $e;
        }
    }


    protected function log($level, string|\Stringable $message, array $context = []): void
    {
        if ( isset( $this->logger) ) {
            $this->logger->log($level, $message, $context);
        }
    }

    protected function getSummaryFromStream(StreamInterface $stream): string
    {
        if ( $stream->getSize() > 1000 ) {
            return $stream->read(1000);
        }

        return (string)$stream;
    }
}