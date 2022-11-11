<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\IpInfoAccessor;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

class PalmyrIpInfoAccessor implements IpInfoAccessorInterface
{

    protected Client $client;

    protected LoggerInterface $logger;

    public function __construct(
        Client $client,
        LoggerInterface $logger
    )
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getIp(): ?string
    {
        try {
            $response = $this->client->get("https://app.palmyr.xyz/api/ip-info");

            $data = json_decode((string)$response->getBody());

            return $data->ip ?: null;

        } catch ( GuzzleException $e ) {
            $this->logger->error(sprintf("Failed to get ip info %s", $e));
            return null;
        }
    }
}