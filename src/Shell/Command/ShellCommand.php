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
    protected array $arguments = [];

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
        $this->command = $command;
        $this->setArguments($arguments);
        $this->workingDirectory = $this->fileSystem->realPath($workingDirectory);
    }

    public function execute(): ShellResultInterface
    {
        $currentDirectory = $this->fileSystem->getCurrentWorkingDirectory();

        try {
            $this->fileSystem->setCurrentWorkingDirectory($this->workingDirectory);
            $this->executeRaw($this->toString(), $output, $code);
            $this->fileSystem->setCurrentWorkingDirectory($currentDirectory);
        } catch (FileSystemException $e) {
            throw new ShellException('Filesystem error', 0, $e);
        }

        return new ShellResult($code, $output);
    }

    /**
     * @param array $arguments
     * @return void
     */
    protected function setArguments(array $arguments): void
    {
        foreach ($arguments as $key => $argument) {
            $this->arguments['{{' . $key . '}}'] = $this->escapeArgument($argument);
        }
    }

    protected function escapeArgument(string $argument): string
    {
        return escapeshellarg($argument);
    }

    protected function executeRaw(string $command, &$output, &$code): bool
    {
        return (bool)exec($command, $output, $code);
    }

    public function toString(): string
    {
        return str_replace(array_keys($this->arguments), array_values($this->arguments), $this->command);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
