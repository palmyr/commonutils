<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\FileSystem;

use Palmyr\CommonUtils\FileSystem\Exception\FileSystemException;

interface FileSystemInterface
{
    public function getCurrentWorkingDirectory(): string;

    /**
     * @param string $path
     * @return FileSystemInterface
     * @throws FileSystemException
     */
    public function setCurrentWorkingDirectory(string $path): FileSystemInterface;

    /**
     * @param string $path
     * @return string
     * @throws FileSystemException
     */
    public function realPath(string $path): string;

    /**
     * @param string $fileName
     * @return void
     * @throws FileSystemException
     */
    public function remove(string $fileName): void;
}
