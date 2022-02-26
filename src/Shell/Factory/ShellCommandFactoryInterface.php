<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Shell\Factory;

use Palmyr\CommonUtils\Shell\Command\ShellCommandInterface;

interface ShellCommandFactoryInterface
{
    /**
     * @param string $command
     * @param array<int,string> $arguments
     * @param string|null $workingDirectory
     * @return ShellCommandInterface
     */
    public function build(
        string $command,
        array $arguments = [],
        ?string $workingDirectory = null
    ): ShellCommandInterface;
}
