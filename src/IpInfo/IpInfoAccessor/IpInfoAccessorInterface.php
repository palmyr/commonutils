<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\IpInfoAccessor;

use GuzzleHttp\Exception\GuzzleException;
use Palmyr\CommonUtils\IpInfo\Model\IpInfoModelInterface;

interface IpInfoAccessorInterface
{
    public function getInfo(): IpInfoModelInterface;
}
