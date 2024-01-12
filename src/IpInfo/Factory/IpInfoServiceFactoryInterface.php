<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Factory;

use Palmyr\CommonUtils\IpInfo\IpInfoAccessor\IpInfoAccessorInterface;
use Palmyr\CommonUtils\IpInfo\Service\IpInfoServiceInterface;

interface IpInfoServiceFactoryInterface
{
    public function createIpInfoService(): IpInfoServiceInterface;

    public function addIpInfoAccessor(IpInfoAccessorInterface $ipInfoAccessor): IpInfoServiceFactoryInterface;
}
