<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\IpInfoAccessor;

use Palmyr\CommonUtils\IpInfo\Dto\IpInfoDtoInterface;
use Palmyr\CommonUtils\IpInfo\Exception\IpInfoException;

interface IpInfoAccessorInterface
{

    /**
     * @return IpInfoDtoInterface
     * @throws IpInfoException
     */
    public function getInfo(): IpInfoDtoInterface;
}
