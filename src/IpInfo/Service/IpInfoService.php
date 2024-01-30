<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Service;

use GuzzleHttp\Client;
use Palmyr\CommonUtils\IpInfo\Exception\IpInfoException;
use Palmyr\CommonUtils\IpInfo\IpInfoAccessor\IpInfoAccessorInterface;
use Palmyr\CommonUtils\IpInfo\Dto\IpInfoDtoInterface;
use Psr\Log\LoggerInterface;

class IpInfoService implements IpInfoServiceInterface
{
    /**
     * @var IpInfoAccessorInterface[]
     */
    protected array $ipInfoHandlerCollection;

    protected ?IpInfoDtoInterface $ipInfoModel;

    protected ?LoggerInterface $logger;

    public function __construct(
        array $ipInfoHandlerCollection,
        ?LoggerInterface $logger = null
    ) {
        $this->ipInfoHandlerCollection = $ipInfoHandlerCollection;
        $this->logger = $logger;
    }

    /**
     * @return IpInfoDtoInterface
     * @throws IpInfoException
     */
    public function getIpInfo(): IpInfoDtoInterface
    {

        if (isset($this->ipInfoModel)) {
            return $this->ipInfoModel;
        }

        foreach ($this->ipInfoHandlerCollection as $ipInfoHandler) {
            try {
                return $this->ipInfoModel = $ipInfoHandler->getInfo();
            } catch (\Exception $e) {
                if ($this->logger) {
                    $this->logger->warning((string)$e);
                } else {
                    trigger_error((string)$e, E_USER_WARNING);
                }
            }
        }

        throw new IpInfoException("Failed to get ip.");
    }
}
