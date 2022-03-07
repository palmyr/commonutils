<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Shell\Command;

class PassThruShellCommand extends ShellCommand
{
    protected function executeRaw(string $command, &$output, &$code): bool
    {
        return passthru($command, $code);
    }
}
