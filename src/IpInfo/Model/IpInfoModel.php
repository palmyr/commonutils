<?php

namespace Palmyr\CommonUtils\IpInfo\Model;

class IpInfoModel implements IpInfoModelInterface
{

    protected string $ip;

    protected string $city;

    protected string $country;

    protected string $timezone;

    protected string $organization;

    public function __construct(
        string $ip,
        string $city,
        string $country,
        string $timezone,
        string $organization,
    )
    {
        $this->ip = $ip;
        $this->city = $city;
        $this->country = $country;
        $this->timezone = $timezone;
        $this->organization = $organization;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function getOrganization(): string
    {
        return $this->organization;
    }

}