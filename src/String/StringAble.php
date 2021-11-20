<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\String;

class StringAble implements StringAbleInterface
{

    protected string $value;

    public function __construct(
        string $value
    )
    {
        $this->value = $value;
    }

    public function getString(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getString();
    }
}