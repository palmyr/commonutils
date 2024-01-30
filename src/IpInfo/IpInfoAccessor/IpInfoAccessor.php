<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\IpInfoAccessor;

use GuzzleHttp\Client;
use Palmyr\CommonUtils\IpInfo\Exception\IpInfoException;
use Palmyr\CommonUtils\IpInfo\Dto\IpInfoDto;
use Palmyr\CommonUtils\IpInfo\Dto\IpInfoDtoInterface;

class IpInfoAccessor implements IpInfoAccessorInterface
{
    protected Client $client;

    protected string $url;

    public function __construct(
        Client $client,
        string $url = "https://ipinfo.io/json"
    ) {
        $this->client = $client;
        $this->url = $url;
    }

    public function getInfo(): IpInfoDtoInterface
    {
        $response = $this->client->get($this->url);

        $data = json_decode((string)$response->getBody(), true);

        $errors = $this->getErrorsFromResponse($data);

        if (count($errors) > 0) {
            throw new IpInfoException(sprintf("The data returned is invalid. [Errors: %s ]", json_encode($errors)));
        }

        return new IpInfoDto(
            ip: $data["ip"] ?? "",
            city: $data["city"] ?? "",
            country: $data["country"] ?? "",
            region: $data["region"] ?? "",
            timezone: $data["timezone"] ?? "",
            organization: $data["org"] ?? "",
            location: $data["loc"] ?? "",
        );
    }

    protected function getErrorsFromResponse(array $data): array
    {
        $errors = [];

        foreach (["ip", "city", "country", "region", "timezone", "org", "loc"] as $item) {
            if (!array_key_exists($item, $data)) {
                $errors[$item][] = "Missing key";
            } elseif (empty($data[$item])) {
                $errors[$item][] = "Value cannot be empty";
            }
        }
        return $errors;
    }
}
