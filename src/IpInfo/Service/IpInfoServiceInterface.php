<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Service;

interface IpInfoServiceInterface
{

    public function getIp(): string;
}
