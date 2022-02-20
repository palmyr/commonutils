<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Mask;

class Mask implements MaskInterface
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
