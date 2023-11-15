<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\IpInfoAccessor;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

class IpInfoAccessor implements IpInfoAccessorInterface
{
    protected Client $client;

    public function __construct(
        Client $client
    )
    {
        $this->client = $client;
    }

    public function getIp(): ?string
    {
        $response = $this->client->get("https://ipinfo.io/json");

        $data = json_decode((string)$response->getBody());

        return $data->ip ?: null;
    }
}