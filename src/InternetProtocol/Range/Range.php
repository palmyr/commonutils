<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\InternetProtocol\Range;

class Range implements RangeInterface
{
    protected int $value;

    public function __construct(
        int $value
    ) {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function toString(): string
    {
        return (string)$this->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
