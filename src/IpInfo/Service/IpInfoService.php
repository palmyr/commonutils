<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Service;

use GuzzleHttp\Client;
use Palmyr\CommonUtils\IpInfo\IpInfoAccessor\IpInfoAccessorInterface;

class IpInfoService implements IpInfoServiceInterface
{

    /**
     * @var IpInfoAccessorInterface[]
     */
    protected array $ipInfoHandlerCollection;

    public function __construct(
        array $ipInfoHandlerCollection
    ) {
        $this->ipInfoHandlerCollection = $ipInfoHandlerCollection;
    }

    public function getIp(): string
    {
        foreach ( $this->ipInfoHandlerCollection as $ipInfoHandler ) {
            if ( $ip = $ipInfoHandler->getIp() ) {
                return $ip;
            }
        }

        throw new \Exception("Failed to get ip");
    }
}
