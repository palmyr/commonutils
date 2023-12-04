<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Service;

use Palmyr\CommonUtils\IpInfo\Model\IpInfoModelInterface;

interface IpInfoServiceInterface
{

    public function getIpInfo(): IpInfoModelInterface;
}
