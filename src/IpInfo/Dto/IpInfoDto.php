<?php

namespace Palmyr\CommonUtils\IpInfo\Dto;

class IpInfoDto implements IpInfoDtoInterface
{
    protected string $ip;

    protected string $city;

    protected string $country;

    protected string $region;

    protected string $timezone;

    protected string $organization;

    protected string $location;

    public function __construct(
        string $ip,
        string $city,
        string $country,
        string $region,
        string $timezone,
        string $organization,
        string $location,
    ) {
        $this->ip = $ip;
        $this->city = $city;
        $this->country = $country;
        $this->region = $region;
        $this->timezone = $timezone;
        $this->organization = $organization;
        $this->location = $location;
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

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function getOrganization(): string
    {
        return $this->organization;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

}
