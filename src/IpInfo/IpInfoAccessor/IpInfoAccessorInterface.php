<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\IpInfoAccessor;

interface IpInfoAccessorInterface
{

    public function getIp(): ?string;
}