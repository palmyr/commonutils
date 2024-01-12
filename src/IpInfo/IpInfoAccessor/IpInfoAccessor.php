<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\IpInfoAccessor;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Palmyr\CommonUtils\IpInfo\Exception\IpInfoException;
use Palmyr\CommonUtils\IpInfo\Model\IpInfoModel;
use Palmyr\CommonUtils\IpInfo\Model\IpInfoModelInterface;
use Psr\Log\LoggerInterface;

class IpInfoAccessor implements IpInfoAccessorInterface
{
    protected Client $client;

    public function __construct(
        Client $client
    ) {
        $this->client = $client;
    }

    public function getInfo(): IpInfoModelInterface
    {
        $response = $this->client->get("https://ipinfo.io/json");

        $data = json_decode((string)$response->getBody(), true);

        $errors = $this->getErrorsFromResponse($data);

        if (count($errors) > 0) {
            throw new IpInfoException(sprintf("The data returned is invalid. [Errors: %s ]", json_encode($errors)));
        }

        return new IpInfoModel(
            ip: $data["ip"],
            city: $data["city"],
            country: $data["country"],
            timezone: $data["timezone"],
            organization: $data["org"]
        );
    }

    protected function getErrorsFromResponse(array $data): array
    {
        $errors = [];

        foreach (["ip"] as $item) {
            if (!array_key_exists($item, $data)) {
                $errors[$item][] = "Missing key";
            } elseif (empty($data[$item])) {
                $errors[$item][] = "Value cannot be empty";
            }
        }
        return $errors;
    }
}
