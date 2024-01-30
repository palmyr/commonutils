<?php
declare(strict_types=1);

namespace Tests\Palmyr\CommonUtils\IpInfo\IpInfoAccessor;

use GuzzleHttp\Client;
use Palmyr\CommonUtils\IpInfo\IpInfoAccessor\IpInfoAccessor;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class IpInfoAccessorTest extends TestCase
{

    protected Client $fakeClient;

    protected IpInfoAccessor $testClass;


    /**
     * @param array $data
     * @return void
     * @dataProvider ipInfoProvider
     */
    public function testgetInfo(array $data): void
    {
        $fakeResponse = \Phake::mock(ResponseInterface::class);
        $fakeStream = \Phake::mock(StreamInterface::class);
        \Phake::when($this->fakeClient)->get("https://ipinfo.io/json")->thenReturn($fakeResponse);
        \Phake::when($fakeResponse)->getBody()->thenReturn($fakeStream);
        \Phake::when($fakeStream)->__toString()->thenReturn(json_encode($data));

        $ipInfo = $this->testClass->getInfo();
    }

    public function ipInfoProvider(): array
    {
        return [
          [
              [
                  "ip" => "151.48.161.141",
                  "hostname" => "adsl-ull-141-161.48-151.wind.it",
                  "city" => "Milan",
                  "region" => "Lombardy",
                  "country" => "IT",
                  "loc" => "45.4643,9.1895",
                  "org" => "AS1267 WIND TRE S.P.A.",
                  "postal" => "20121",
                  "timezone" => "Europe/Rome",
                  "readme" => "https://ipinfo.io/missingauth"
              ]
          ]
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeClient = \Phake::mock(Client::class);
        $this->testClass = new IpInfoAccessor($this->fakeClient);

    }
}