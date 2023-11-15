<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\IpInfoAccessor;

use GuzzleHttp\Exception\GuzzleException;

interface IpInfoAccessorInterface
{

    /**
     * @return string|null
     * @throws GuzzleException
     */
    public function getIp(): ?string;
}