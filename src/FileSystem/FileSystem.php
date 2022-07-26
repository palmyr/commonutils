<?php

declare(strict_types=1);

namespace Palmyr\CommonUtils\FileSystem;

use Palmyr\CommonUtils\FileSystem\Exception\FileSystemException;

class FileSystem implements FileSystemInterface
{
    public function getCurrentWorkingDirectory(): string
    {
        return getcwd() ?: $_SERVER["PWD"];
    }

    public function setCurrentWorkingDirectory(string $path): FileSystemInterface
    {
        $path = $this->realPath($path);
        if (chdir($path)) {
            return $this;
        }

        throw new FileSystemException(sprintf('Unable to change to the directory %s', $path));
    }

    public function realPath(string $path): string
    {
        if ($realPath = realpath($path)) {
            return $realPath;
        }

        throw new FileSystemException('Unable to read realpath');
    }

    public function remove(string $fileName): void
    {
        if ( !@unlink($fileName) )
        {
            $error = error_get_last();

            throw new FileSystemException(implode(', ', $error));
        }
    }
}
