<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Service;

interface IpInfoServiceInterface
{

    public const DEFAULT_URI = 'https://ipinfo.io/json';

    public function getIp(): string;

}