<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\IpInfo\Factory;

use Palmyr\CommonUtils\Guzzle\Factory\ClientFactory;
use Palmyr\CommonUtils\Guzzle\Factory\ClientFactoryInterface;
use Palmyr\CommonUtils\IpInfo\IpInfoAccessor\IpInfoAccessor;
use Palmyr\CommonUtils\IpInfo\IpInfoAccessor\IpInfoAccessorInterface;
use Palmyr\CommonUtils\IpInfo\IpInfoAccessor\PalmyrIpInfoAccessor;
use Palmyr\CommonUtils\IpInfo\Service\IpInfoService;
use Palmyr\CommonUtils\IpInfo\Service\IpInfoServiceInterface;
use Psr\Log\LoggerInterface;

class IpInfoServiceFactory implements IpInfoServiceFactoryInterface
{

    protected array $ipInfoAccessors;

    protected ClientFactoryInterface $clientFactory;

    protected ?LoggerInterface $logger;

    public function __construct(
        ClientFactoryInterface $clientFactory = null,
        LoggerInterface $logger = null
    )
    {
        if ( is_null($clientFactory) ) {
            $clientFactory = ClientFactory::create();
        }

        $this->clientFactory = $clientFactory;
        $this->logger = $logger;



        $this->ipInfoAccessors = [
            new IpInfoAccessor($this->clientFactory->createClient()),
        ];
    }

    public function createIpInfoService(): IpInfoServiceInterface
    {
        return new IpInfoService($this->ipInfoAccessors, $this->logger);
    }

    public function addIpInfoAccessor(IpInfoAccessorInterface $ipInfoAccessor): IpInfoServiceFactoryInterface
    {
        $this->ipInfoAccessors[] = $ipInfoAccessor;

        return $this;
    }
}