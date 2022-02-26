<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Shell\Result;

class ShellResult implements ShellResultInterface
{
    protected int $code;

    /**
     * @var array<int,string>
     */
    protected array $output;

    /**
     * @param int $code
     * @param array<int,string> $output
     */
    public function __construct(
        int $code,
        array $output
    ) {
        $this->code = $code;
        $this->output = $output;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return array<int,string>
     */
    public function getOutput(): array
    {
        return $this->output;
    }

    public function toString(): string
    {
        return implode(PHP_EOL, $this->output);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
