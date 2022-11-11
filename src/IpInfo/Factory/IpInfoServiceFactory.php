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

    public function __construct(
        ClientFactoryInterface $clientFactory = null,
        LoggerInterface $logger = null
    )
    {
        if ( is_null($clientFactory) ) {
            $clientFactory = ClientFactory::create();
        }

        $this->clientFactory = $clientFactory;



        $this->ipInfoAccessors = [
            new PalmyrIpInfoAccessor($this->clientFactory->createClient(), $logger),
            new IpInfoAccessor($this->clientFactory->createClient()),
        ];
    }

    public function createIpInfoService(): IpInfoServiceInterface
    {
        return new IpInfoService($this->ipInfoAccessors);
    }

    public function addIpInfoAccessor(IpInfoAccessorInterface $ipInfoAccessor): IpInfoServiceFactoryInterface
    {
        $this->ipInfoAccessors[] = $ipInfoAccessor;

        return $this;
    }
}