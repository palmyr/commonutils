<?php

namespace Palmyr\CommonUtils\IpInfo\Dto;

interface IpInfoDtoInterface
{
    public function getIp(): string;

    public function getCity(): string;

    public function getCountry(): string;

    public function getRegion(): string;

    public function getTimezone(): string;

    public function getOrganization(): string;

    public function getLocation(): string;
}
