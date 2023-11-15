<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Service;

use GuzzleHttp\Client;
use Palmyr\CommonUtils\IpInfo\IpInfoAccessor\IpInfoAccessorInterface;
use Psr\Log\LoggerInterface;

class IpInfoService implements IpInfoServiceInterface
{

    /**
     * @var IpInfoAccessorInterface[]
     */
    protected array $ipInfoHandlerCollection;

    protected ?LoggerInterface $logger;

    public function __construct(
        array $ipInfoHandlerCollection,
        ?LoggerInterface $logger = null
    ) {
        $this->ipInfoHandlerCollection = $ipInfoHandlerCollection;
        $this->logger = $logger;
    }

    /**
     * @throws \Exception
     */
    public function getIp(): string
    {
        foreach ( $this->ipInfoHandlerCollection as $ipInfoHandler ) {
            try {
                if ( $ip = $ipInfoHandler->getIp() ) {
                    return $ip;
                }
            } catch ( \Exception $e ) {
                if ( $this->logger ) {
                    $this->logger->error((string)$e);
                } else {
                    trigger_error((string)$e, E_USER_WARNING);
                }
            }
        }

        throw new \Exception("Failed to get ip");
    }
}
