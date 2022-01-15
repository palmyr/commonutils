<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Service;

class IpInfoService implements IpInfoServiceInterface
{

    protected string $uri;

    protected array $rawIpInfo;

    public function __construct(
        string $uri = self::DEFAULT_URI
    )
    {
        $this->uri = $uri;
    }

    public function getIp(): string
    {
        return $this->get('ip');
    }

    protected function get(string $key): mixed
    {
        $data = $this->getRawIpInfo();

        if (array_key_exists($key, $data) ) {
            return $data[$key];
        }

        throw new \InvalidArgumentException('No data found for argument');
    }

    protected function getRawIpInfo(): array
    {
        if ( !isset($this->rawIpInfo) ) {
            $this->rawIpInfo = $this->loadIpInfo();
        }

        return $this->rawIpInfo;
    }

    protected function loadIpInfo(): array
    {
        if ( $json = @file_get_contents($this->uri) ) {
            return json_decode($json, true);
        }

        $error = error_get_last();

        throw new \RuntimeException('Failed to get ip info from server');
    }
}