<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Shell\Factory;

use Palmyr\CommonUtils\FileSystem\FileSystemInterface;
use Palmyr\CommonUtils\Shell\Command\ShellCommand;
use Palmyr\CommonUtils\Shell\Command\ShellCommandInterface;

class ShellCommandFactory implements ShellCommandFactoryInterface
{
    protected FileSystemInterface $fileSystem;

    public function __construct(
        FileSystemInterface $fileSystem
    ) {
        $this->fileSystem = $fileSystem;
    }

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
    ): ShellCommandInterface {
        if (is_null($workingDirectory)) {
            $workingDirectory = $this->fileSystem->getCurrentWorkingDirectory();
        }

        return new ShellCommand($this->fileSystem, $command, $arguments, $workingDirectory);
    }
}
