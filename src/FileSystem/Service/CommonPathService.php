<?php declare(strict_types=1);

namespace Palmyr\CommonUtils\FileSystem\Service;

class CommonPathService implements CommonPathServiceInterface
{

    public static function getHomeDirectory(): string
    {
        // On Linux/Unix-like systems, use the HOME environment variable
        if ($homeDir = getenv('HOME')) {
            return $homeDir;
        }

        throw new \RuntimeException("Failed to get home directory");
    }
}