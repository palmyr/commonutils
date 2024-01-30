<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Service;

use Palmyr\CommonUtils\IpInfo\Dto\IpInfoDtoInterface;

interface IpInfoServiceInterface
{
    public function getIpInfo(): IpInfoDtoInterface;
}
