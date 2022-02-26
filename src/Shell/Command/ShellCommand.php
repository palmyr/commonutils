<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\Shell\Command;

use Palmyr\CommonUtils\FileSystem\Exception\FileSystemException;
use Palmyr\CommonUtils\FileSystem\FileSystemInterface;
use Palmyr\CommonUtils\Shell\Exception\ShellException;
use Palmyr\CommonUtils\Shell\Result\ShellResult;
use Palmyr\CommonUtils\Shell\Result\ShellResultInterface;

class ShellCommand implements ShellCommandInterface
{
    protected FileSystemInterface $fileSystem;

    protected string $command;

    /**
     * @var array<int,string>
     */
    protected array $arguments;

    protected string $workingDirectory;

    /**
     * @param string $command
     * @param array<int,string> $arguments
     * @param string $workingDirectory
     */
    public function __construct(
        FileSystemInterface $fileSystem,
        string $command,
        array $arguments,
        string $workingDirectory
    ) {
        $this->fileSystem = $fileSystem;
        $this->command = $this->escapeCommand($command);
        $this->arguments = $this->escapeArguments($arguments);
        $this->workingDirectory = $this->fileSystem->realPath($workingDirectory);
    }

    public function execute(): ShellResultInterface
    {
        $currentDirectory = $this->fileSystem->getCurrentWorkingDirectory();

        try {
            $this->fileSystem->setCurrentWorkingDirectory($this->workingDirectory);
            exec($this->toString(), $output, $code);
            $this->fileSystem->setCurrentWorkingDirectory($currentDirectory);
        } catch (FileSystemException $e) {
            throw new ShellException('Filesystem error', 0, $e);
        }

        return new ShellResult($code, $output);
    }

    protected function escapeCommand(string $argument): string
    {
        return escapeshellcmd($argument);
    }

    /**
     * @param array<int,string> $arguments
     * @return array<int,string>
     */
    protected function escapeArguments(array $arguments): array
    {
        return array_map([$this, 'escapeArgument'], $arguments);
    }

    protected function escapeArgument(string $argument): string
    {
        return escapeshellarg($argument);
    }

    public function toString(): string
    {
        return $this->command . ' ' . implode(' ', $this->arguments);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
